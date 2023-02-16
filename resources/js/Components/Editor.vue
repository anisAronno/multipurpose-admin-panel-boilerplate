<script setup>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { ref } from "vue";

let props = defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const editor = ClassicEditor;
const editorConfig = {
    plugins: [],

    toolbar: {
        items: ["bold", "italic", "link", "undo", "redo"],
    },
};

const input = ref(null);
const inputVal = ref(props.modelValue);
</script>

<template>
    <ckeditor
        :editor="editor"
        v-model="inputVal"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    ></ckeditor>
</template>

<style></style>
