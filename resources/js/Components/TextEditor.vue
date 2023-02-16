<script setup>
import { Quill, QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.bubble.css";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import axios from "axios";
import BlotFormatter from "quill-blot-formatter";
import * as Emoji from "quill-emoji";
import "quill-emoji/dist/quill-emoji";
import "quill-emoji/dist/quill-emoji.css";
import htmlEditButton from "quill-html-edit-button";
import ImageUploader from "quill-image-uploader";
import { ref } from "vue";

const props = defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

const toolbarOptions = {
    syntax: true,
    container: [
        ["bold", "italic", "underline", "strike"], // toggled buttons
        ["blockquote", "code-block"],

        [{ header: 1 }, { header: 2 }], // custom button values
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }], // superscript/subscript
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [{ direction: "rtl" }], // text direction

        [{ size: ["small", false, "large", "huge"] }], // custom dropdown
        [{ header: [1, 2, 3, 4, 5, 6, false] }],

        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ font: [] }],
        [{ align: [] }],
        ["link", "image", "video"],
        ["clean"],
        ["emoji"],
    ],
};

const inputValue = ref(props.modelValue);

Quill.register({
    "modules/emoji": Emoji,
    "modules/htmlEditButton": htmlEditButton,
});

const modules = [
    {
        name: "imageUploader",
        module: ImageUploader,
        options: {
            upload: (file) => {
                return new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append("image", file);
                    axios
                        .post(route("admin.image.editor"), formData)
                        .then((res) => {
                            resolve(res.data.url);
                        })
                        .catch((err) => {
                            reject("Upload failed");
                            console.error("Error:", err);
                        });
                });
            },
        },
    },
    {
        name: "BlotFormatter",
        module: BlotFormatter,
        options: {},
    },
    {
        name: "htmlEditButton",
        module: htmlEditButton,
        options: {
            debug: false, // logging, default:false
            msg: "Edit the content in HTML format", //Custom message to display in the editor, default: Edit HTML here, when you click "OK" the quill editor's contents will be replaced
            okText: "Ok", // Text to display in the OK button, default: Ok,
            cancelText: "Cancel", // Text to display in the cancel button, default: Cancel
            buttonHTML: "&lt;&gt;", // Text to display in the toolbar button, default: <>
            buttonTitle: "Show HTML source",
        },
    },
];
</script>
<template>
    <div>
        <QuillEditor
            theme="snow"
            :toolbar="toolbarOptions"
            v-model:content="inputValue"
            content-type="html"
            :modules="modules"
            @input="$emit('update:modelValue', inputValue)" 
        />
    </div>
</template>
<style>
.ql-editor {
    min-height: 150px;
}
</style>
