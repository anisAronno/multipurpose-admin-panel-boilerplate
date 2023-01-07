<script setup>
import DeleteImage from "@/Components/Image/DeleteImage.vue";
import { ref } from "vue";

const props = defineProps({
    modelValue: String,
    id: String || Number,
    route: {
        type: String,
        default: "file.destroy",
    },
    table: String,
    field: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

const defaultImage = ref(
    props.modelValue || `${route()?.t?.url}/uploads/placeholder.png`
);

defineExpose({ focus: () => input.value.focus() });

const previewImage = (e) => {
    const file = e.target.files[0];
    defaultImage.value = URL.createObjectURL(file);
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
                            :src="defaultImage"
                            :alt="modelValue"
                            class="w-full h-full object-contain inset-0 group-hover:opacity-50 shadow-md shadow-gray-900"
                        />
                        <span
                            class="w-full h-full absolute grid grid-cols-2 place-items-center transition-all transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0"
                        >
                            <div>
                                <label
                                    :for="modelValue"
                                    class="btn btn-primary cursor-pointer"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-rotate"
                                    />
                                </label>
                                <input
                                    :id="modelValue"
                                    type="file"
                                    name="avatar"
                                    class="mt-1 form-controll cursor-pointer hidden"
                                    @change="previewImage"
                                    ref="input"
                                    @input="
                                        $emit(
                                            'update:modelValue',
                                            $event.target.files[0]
                                        )
                                    "
                                />
                            </div>
                            <DeleteImage
                                v-if="defaultImage == modelValue"
                                class="cursor-pointer"
                                :id="id"
                                :route="route"
                                :table="table"
                                :field="field"
                                :oldFile="modelValue"
                                @success="$emit('update:modelValue')"
                            ></DeleteImage>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>
