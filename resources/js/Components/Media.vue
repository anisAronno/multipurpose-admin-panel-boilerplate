<script setup>
import Loader from "@/Components/Loader.vue";
import Modal from "@/Components/Modal.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import { useInfiniteScroll } from "@vueuse/core";
import axios from "axios";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond/dist/filepond.min.css";
import { computed, reactive, ref } from "vue";
import vueFilePond from "vue-filepond";

const emit = defineEmits(["update:input"]);

const props = defineProps({
    addBtnLabel: {
        type: String,
        default: "Add Image",
        require: false,
    },
    modalBtnLabel: {
        type: String,
        default: "Submit",
        require: false,
    },
    modelValue: {
        type: Array,
        default: [],
        require: false,
    },
    imageWidth: {
        type: String || Number,
        default: "20",
        require: false,
    },
    allowMultiple: {
        type: Boolean,
        default: false,
        require: false,
    },
    showPreview: {
        type: Boolean,
        default: false,
        require: false,
    },
});

const images = ref([]);
const activeTab = ref("upload");
let modalShow = ref(false);
let isLoaded = ref(false);
let pond = ref(null);
let page = usePage();
let pageNumber = 1;
let el = ref(null);

const selectedImages = reactive(props.modelValue);

const setActiveTab = (tab) => {
    if (tab == "media") {
        loadImages();
    }
    activeTab.value = tab;
};

const csrf_token = page.props.value.csrf_token;
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const options = {
    server: {
        process: {
            url: route("admin.image.store"),
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf_token,
            },
        },
    },
};

const handleFilePondInit = (pondInstance) => {
    pond.value = pondInstance;
};

const closeModal = () => {
    modalShow.value = false;
};

useInfiniteScroll(
    el,
    () => {
        pageNumber = pageNumber + 1;
        axios
            .get(`${route("admin.image.index")}?page=${pageNumber}`)
            .then((response) => {
                isLoaded.value = false;
                images.value.push(...response.data.data);
            })
            .catch((error) => {
                console.log(error.message);
            });
    },
    { distance: 10 }
);

const loadImages = async () => {
    isLoaded.value = true;
    await axios
        .get(route("admin.image.index"))
        .then((response) => {
            isLoaded.value = false;
            images.value = response.data.data;
        })
        .catch((error) => {
            console.log(error.message);
        });
};

const deleteImage = async (image) => {
    isLoaded.value = true;
    await axios
        .delete(route("admin.image.destroy", image.id))
        .then((response) => {
            let index = images.value.findIndex((img) => img.id === image.id);
            images.value.splice(index, 1);
            imageSelect(image);
        })
        .catch((error) => {
            console.log(error.message);
        })
        .finally(() => {
            setTimeout(() => {
                loadImages();
                isLoaded.value = false;
            }, 500);
        });
};

const imageObj = computed(() => {
    return [...images.value].map((image) => {
        let checked = props.modelValue.find((object) => object.id === image.id);
        let obj = { ...image, checked: checked };
        return obj;
    });
});

const imageSelect = (image) => {
    let index = selectedImages.findIndex((img) => img.id === image.id);

    if (props.allowMultiple == false) {
        selectedImages.splice(0, selectedImages.length);
    }

    if (index === -1) {
        selectedImages.push(image);
    } else {
        selectedImages.splice(index, 1);
    }
};

const ImageStore = () => {
    emit("update:input", selectedImages);
    closeModal();
};
</script>

<template>
    <div>
        <button @click="modalShow = true" class="btn btn-primary">
            {{ addBtnLabel }}
        </button>

        <div class="flex flex-wrap gap-2 mt-2" v-if="showPreview">
            <img
                :src="image.url"
                alt=""
                v-for="image in selectedImages"
                :key="image.id"
                :class="`rounded-md h-auto w-${imageWidth}`"
            />
        </div>

        <Modal
            :show="modalShow"
            @close="closeModal"
            class="relative"
            maxWidth="2xl"
        >
            <button
                class="absolute top-1 right-1 text-red-600 bg-red-100 font-semibold rounded-full w-6 h-6 text-md cursor-pointer text-center hover:scale-105 shadow-sm shadow-red-200 z-50"
                @click="closeModal"
            >
                X
            </button>
            <div
                class="isolate flex divide-x divide-gray-200 rounded-lg shadow"
                aria-label="Tabs"
            >
                <div
                    class="tab"
                    :class="[
                        activeTab == 'upload'
                            ? 'text-gray-900'
                            : 'text-gray-500 hover:text-gray-700',
                        'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 cursor-pointer',
                    ]"
                    @click="setActiveTab('upload')"
                >
                    Upload
                    <span
                        aria-hidden="true"
                        :class="[
                            activeTab == 'upload'
                                ? 'bg-indigo-500'
                                : 'bg-transparent',
                            'absolute inset-x-0 bottom-0 h-0.5',
                        ]"
                    />
                </div>
                <div
                    class="tab"
                    :class="[
                        activeTab == 'media'
                            ? 'text-gray-900'
                            : 'text-gray-500 hover:text-gray-700',
                        'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10 cursor-pointer',
                    ]"
                    @click="setActiveTab('media')"
                >
                    Media Library
                    <span
                        aria-hidden="true"
                        :class="[
                            activeTab == 'media'
                                ? 'bg-indigo-500'
                                : 'bg-transparent',
                            'absolute inset-x-0 bottom-0 h-0.5',
                        ]"
                    />
                </div>
            </div>
            <div
                class="p-10 h-[400px] md:h-[500px] 2xl:h-[600px] overflow-scroll"
                v-if="activeTab == 'upload'"
            >
                <div>
                    <file-pond
                        name="image"
                        ref="pond"
                        label-idle="Drop files here..."
                        allow-multiple="true"
                        accepted-file-types="image/*"
                        v-bind="options"
                        @init="handleFilePondInit"
                        max-files="99"
                        imagePreviewMaxHeight="200"
                    />
                </div>
            </div>
            <div class="p-10" v-if="activeTab == 'media'">
                <div
                    class="flex flex-wrap xl:grid-cols-4 gap-5 h-[300px] md:h-[400px] 2xl:h-[500px] overflow-scroll"
                    ref="el"
                >
                    <div
                        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 opacity-75 flex flex-col items-center justify-center"
                        v-if="isLoaded"
                    >
                        <span class="w-10 h-10">
                            <Loader></Loader>
                        </span>
                    </div>
                    <div
                        v-for="image in imageObj"
                        :key="image.id"
                        v-else
                        @click.prevent.stop="imageSelect(image)"
                        class="relative"
                    >
                        <label for="images" class="relative">
                            <img
                                :src="image.url"
                                :alt="image.title"
                                class="w-20 h-20 sm:w-32 sm:h-32 cursor-pointer rounded-sm"
                                :class="[
                                    image.checked
                                        ? 'border-2 border-blue-900 '
                                        : '',
                                ]"
                            />
                            <span
                                class="bg-gray-800 text-white w-4 h-4 p-2 grid place-content-center text-md font-semibold absolute top-0 left-0 rounded-sm"
                                v-if="image.checked"
                                >&#x2713;</span
                            >
                        </label>
                        <input
                            type="checkbox"
                            name="images[]"
                            id="images"
                            class="hidden"
                            v-model="selectedImages"
                        />
                        <span
                            class="bg-gray-200 text-red-600 p-1 grid place-content-center text-md font-semibold rounded-sm mt-2 cursor-pointer"
                            @click.prevent="deleteImage(image)"
                            >Delete</span
                        >
                    </div>
                </div>

                <div class="flex justify-end mt-5 md:mt-8">
                    <button
                        class="btn btn-primary text-right"
                        @click.prevent="ImageStore"
                    >
                        {{ modalBtnLabel }}
                    </button>
                </div>
            </div>
        </Modal>
    </div>
</template>
