<script setup>
import DeleteImage from "@/Components/Image/DeleteImage.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import defaultFile from "@/Stores/defaultFile.js";

const props = defineProps({
    modelValue: String,
    id: {
        type: [Number, String],
        default: 1,
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
        <div class="w-full space-y-5">
            <div class="mt-6 space-y-6 flex-1">
                <div class="flex-1 w-full order-first sm:order-last">
                    <span
                        class="flex items-center justify-center overflow-hidden rounded-full bg-gray-100 relative group w-32 h-32 sm:w-40 sm:h-40"
                    >
                        <img
                            :src="form.imagePreview"
                            alt="logo"
                            class="w-full h-full object-contain inset-0 group-hover:opacity-50 shadow-md shadow-gray-900"
                        />
                        <span
                            class="w-full h-full absolute flex items-center justify-center space-x-2 transition-all transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0"
                        >
                            <div>
                                <label
                                    for="image"
                                    class="btn btn-primary cursor-pointer"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-rotate"
                                    />
                                </label>
                                <input
                                    id="image"
                                    type="file"
                                    name="image"
                                    class="mt-1 form-controll cursor-pointer hidden"
                                    @change="previewImage"
                                    ref="input"
                                    @input="form.image = $event.target.files[0]"
                                />
                            </div>
                            <DeleteImage
                                v-if="
                                    isDeleteable ||
                                    form.imagePreview != defaultImage
                                "
                                class="cursor-pointer"
                                :id="id"
                                :route="route"
                                :field="field"
                                v-model="form.imagePreview"
                            ></DeleteImage>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>
