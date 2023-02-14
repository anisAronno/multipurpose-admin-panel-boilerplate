<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import media from "@/Components/Media.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { useForm } from "@inertiajs/vue3";
import { ref } from "@vue/reactivity";
import Multiselect from "@vueform/multiselect";

const props = defineProps({
    statusArr: Object,
    featuredArr: Object,
    categories: Object,
});

const titleInput = ref(null);
const descriptionInput = ref(null);
const imageInput = ref(null);
const statusInput = ref(null);
const isFeaturedInput = ref(null);
const categoryInput = ref(null);
const editor = ClassicEditor;

const form = useForm({
    title: "",
    description: "",
    images: [],
    status: "",
    is_featured: false,
    categories: [],
});

const storeBlog = () => {
    form.post(route("admin.blog.store"), {
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
            if (form.errors.images) {
                imageInput.value.focus();
            }
            if (form.errors.categories) {
                categoryInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="dark:text-white">
        <form @submit.prevent="storeBlog" class="mt-6 space-y-6 p-3">
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
                                <!-- <Textarea
                                    id="description"
                                    ref="descriptionInput"
                                    v-model="form.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="description"
                                /> -->
                                <ckeditor
                                    :editor="editor"
                                    v-model="form.description"
                                ></ckeditor>

                                <InputError
                                    :message="form.errors.description"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div
                                class="col-span-6 sm:col-span-3 flex items-center justify-between"
                            >
                                <media
                                    v-model="form.images"
                                    imageWidth="20"
                                    addBtnLabel="Add Images"
                                    allowMultiple="true"
                                    showPreview="true"
                                ></media>
                            </div>
                            <div
                                class="col-span-6 sm:col-span-3 lg:col-span-3 mb-20"
                            >
                                <InputLabel
                                    for="categories"
                                    value="Category :"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                />
                                <Multiselect
                                    v-model="form.categories"
                                    :options="props.categories"
                                    :selected="form.categories"
                                    ref="categoryInput"
                                    placeholder="Pick some..."
                                    class="block w-full multiselect-green form-controll dark:text-gray-900"
                                    mode="tags"
                                    :searchable="true"
                                    :close-on-select="false"
                                >
                                </Multiselect>

                                <InputError
                                    :message="form.errors.categories"
                                    class="mt-2 col-start-2 col-span-4 absolute z-5"
                                />
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
