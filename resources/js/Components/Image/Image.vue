<script setup>
import DeleteImage from "@/Components/Image/DeleteImage.vue";
import defaultFile from "@/Stores/defaultFile.js";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
    modelValue: String,
    id: {
        type: [Number, String],
        default: "logo",
        require: true,
    },

    alt: {
        type: String,
        default: "image",
        require: false,
    },

    route: {
        type: String,
        default: "options",
        require: false,
    },

    field: {
        type: String,
        default: "option_value",
        require: false,
    },

    isDeleteable: {
        type: Boolean,
        default: false,
        require: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const input = ref(null);
const defaultImage = ref(defaultFile.placeholder);

defineExpose({ focus: () => input.value.focus() });

const form = useForm({
    id: props.id,
    field: props.field,
    image: "",
    imagePreview: props.modelValue || defaultImage.value,
});

const previewImage = (e) => {
    const file = e.target.files[0];
    form.imagePreview = URL.createObjectURL(file);

    form.post(route(`${props.route}.update`, props.id), {
        preserveScroll: true,
        onSuccess: () => successEvent(),
        onError: () => {
            if (form.errors.image) {
                input.value.focus();
                form.reset();
            }
        },
    });
};

const successEvent = () => {
    emit("update:modelValue", form.imagePreview);
};
</script>

<template>
    <section>
        <div
            class="flex items-center justify-center overflow-hidden bg-gray-100 relative group min-w-sm max-w-xl h-full"
        >
            <img
                :src="form.imagePreview"
                :alt="alt"
                class="min-w-sm max-w-xl h-full inset-0 group-hover:opacity-50 shadow-md shadow-gray-900 object-cover object-center"
            />
            <div
                class="min-w-sm max-w-xl h-full absolute flex items-center justify-center transition-all transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 space-x-3"
            >
                <div>
                    <label :for="id" class="btn btn-primary cursor-pointer">
                        <font-awesome-icon icon="fa-solid fa-rotate" />
                    </label>
                    <input
                        :id="id"
                        type="file"
                        name="image"
                        class="mt-1 form-controll cursor-pointer hidden"
                        @change="previewImage"
                        ref="input"
                        @input="form.image = $event.target.files[0]"
                    />
                </div>
                <span v-if="isDeleteable">
                    <DeleteImage
                        v-if="form.imagePreview != defaultImage"
                        class="cursor-pointer"
                        :id="id"
                        :route="route"
                        :field="field"
                        v-model="form.imagePreview"
                    ></DeleteImage>
                </span>
            </div>
        </div>
    </section>
</template>
