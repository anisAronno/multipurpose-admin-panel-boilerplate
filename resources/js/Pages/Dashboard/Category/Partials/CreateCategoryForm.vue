<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from "@/Components/Textarea.vue";
import TextInput from "@/Components/TextInput.vue";
import defaultFile from "@/Stores/defaultFile.js";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import Multiselect from "@vueform/multiselect";

const props = defineProps({
    statusArr: Object,
    featuredArr: Object,
});

const titleInput = ref(null);
const descriptionInput = ref(null);
const imageInput = ref(null);
const statusInput = ref(null);
const isFeaturedInput = ref(null);

const form = useForm({
    title: "",
    description: "",
    image: "",
    imagePreview: defaultFile.placeholder,
    status: "",
    is_featured: false,
});

const previewImage = (e) => {
    const file = e.target.files[0];
    form.imagePreview = URL.createObjectURL(file);
};

const storeCategory = () => {
    form.post(route("admin.category.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.title) {
                titleInput.value.focus();
            }
            if (form.errors.description) {
                descriptionInput.value.focus();
            }
            if (form.errors.status) {
                statusInput.value.focus();
            }
            if (form.errors.is_featured) {
                form.reset("is_featured");
                isFeaturedInput.value.focus();
            }
            if (form.errors.image) {
                imageInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="dark:text-white">
        <form @submit.prevent="storeCategory" class="mt-6 space-y-6 p-3">
            <div class="mt-10 sm:mt-0">
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-6 gap-6 mb-10">
                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="title"
                                    value="Title :"
                                    class="block text-sm font-medium text-gray-700"
                                />
                                <TextInput
                                    id="title"
                                    ref="titleInput"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="title"
                                />
                                <InputError
                                    :message="form.errors.title"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="description"
                                    value="Description :"
                                    class="block text-sm font-medium text-gray-700"
                                />
                                <Textarea
                                    id="description"
                                    ref="descriptionInput"
                                    v-model="form.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="description"
                                />
                                <InputError
                                    :message="form.errors.description"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div
                                class="col-span-6 sm:col-span-3 flex items-center justify-between"
                            >
                                <div>
                                    <InputLabel
                                        for="image"
                                        value="Image :"
                                        class="block text-sm font-medium text-gray-700"
                                    />
                                    <input
                                        id="image"
                                        type="file"
                                        class="mt-1 block form-controll cursor-pointer"
                                        @change="previewImage"
                                        ref="imageInput"
                                        @input="
                                            form.image = $event.target.files[0]
                                        "
                                    />
                                    <InputError
                                        :message="form.errors.image"
                                        class="mt-2 col-start-2 col-span-4"
                                    />
                                </div>
                                <span
                                    class="inline-block h-24 w-24 overflow-hidden rounded-full bg-gray-100"
                                >
                                    <img
                                        :src="form.imagePreview"
                                        class="w-full h-full object-contain"
                                    />
                                </span>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <InputLabel
                                    for="status"
                                    value="Status :"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                />

                                <Multiselect
                                    v-model="form.status"
                                    :options="statusArr"
                                    :selected="form.status"
                                    placeholder="Pick some..."
                                    class="block w-full multiselect-green form-controll dark:text-black"
                                    :searchable="true"
                                    :classes="{
                                        search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                                        singleLabelText:
                                            '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                                    }"
                                >
                                </Multiselect>
                                <InputError
                                    :message="form.errors.status"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <InputLabel
                                    for="status"
                                    value="Is Featured ?"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                />

                                <Multiselect
                                    v-model="form.is_featured"
                                    :options="featuredArr"
                                    :selected="form.is_featured"
                                    placeholder="Pick some..."
                                    class="block w-full multiselect-green form-controll dark:text-black"
                                    :searchable="true"
                                    :classes="{
                                        search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                                        singleLabelText:
                                            '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                                    }"
                                >
                                </Multiselect>
                                <InputError
                                    :message="form.errors.is_featured"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pr-5 py-5">
                <PrimaryButton :disabled="form.processing"
                    >Submit</PrimaryButton
                >

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>
