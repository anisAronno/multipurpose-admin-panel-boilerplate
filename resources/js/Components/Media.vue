<script setup>
import DeleteImage from "@/Components/Image/DeleteImage.vue";
import Loader from "@/Components/Loader.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import { usePage } from "@inertiajs/vue3";
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
    updateBtnLabel: {
        type: String,
        default: "Update Image",
        require: false,
    },
    modalBtnLabel: {
        type: String,
        default: "Add Image",
        require: false,
    },
    modelValue: {
        type: Array,
        default: [],
        require: true,
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
let isUpdated = ref(false);
let isLoadMore = ref(false);
let pond = ref(null);
let page = usePage();
let pageNumber = 1;
let el = ref(null);

const selectedImages = reactive(props.modelValue);
const csrf_token = page.props.csrf_token;

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const handleFilePondInit = (pondInstance) => {
    pond.value = pondInstance;
};

const editAbleImage = computed(() => {
    let result = selectedImages.filter((object1) => {
        return images.value.some((object2) => object2.id === object1.id);
    });
    return result ? result[result.length - 1] : {};
});

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

const setActiveTab = (tab) => {
    if (tab == "media") {
        loadImages();
    }
    activeTab.value = tab;
};

const closeModal = () => {
    modalShow.value = false;
};

useInfiniteScroll(
    el,
    () => {
        pageNumber = pageNumber + 1;
        isLoadMore.value = true;
        axios
            .get(`${route("admin.image.index")}?page=${pageNumber}`)
            .then((response) => {
                isLoadMore.value = false;
                images.value.push(...response.data);
            })
            .catch((error) => {
                isLoadMore.value = false;
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
            images.value = response.data;
        })
        .catch((error) => {
            console.log(error.message);
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

const updateImage = async (image) => {
    isUpdated.value = true;
    await axios
        .post(route("admin.image.update", image.id), image)
        .then((response) => {
            const objectToUpdate = images.value.find(
                (img) => img.id === image.id
            );

            const updatedObject = {
                ...objectToUpdate,
                title: image.title,
            };

            const updatedArray = images.value.map((img) =>
                img.id === image.id ? updatedObject : img
            );

            images.value = updatedArray;

            isUpdated.value = false;
        })
        .catch((error) => {
            isUpdated.value = false;
            console.log(error.message);
        });
};
</script>

<template>
    <div>
        <span @click="modalShow = true" class="btn btn-primary cursor-pointer">
            <span v-if="selectedImages.length == 0">{{ addBtnLabel }}</span>
            <span v-else>{{ updateBtnLabel }}</span>
        </span>

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
            maxWidth="full"
        >
            <span
                class="absolute top-1 right-1 text-red-500 bg-gray-200 font-semibold rounded-full w-6 h-6 xl:w-8 xl:h-8 grid place-items-center text-md xl:text-xl cursor-pointer text-center hover:scale-105 shadow-sm shadow-red-300 z-50"
                @click="closeModal"
            >
                X
            </span>
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
                <div class="flex-1 gap-5 h-[300px] md:h-[400px] 2xl:h-[500px]">
                    <div
                        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 opacity-75 flex flex-col items-center justify-center"
                        v-if="isLoaded"
                    >
                        <span class="w-10 h-10">
                            <Loader></Loader>
                        </span>
                    </div>
                    <div v-else class="flex">
                        <div
                            class="flex flex-wrap flex-1 gap-5 h-[300px] md:h-[400px] 2xl:h-[500px] overflow-scroll"
                            ref="el"
                            :class="[
                                editAbleImage ? 'W-60% sm:w-80%' : 'w-full',
                            ]"
                        >
                            <div
                                v-for="image in imageObj"
                                :key="image.id"
                                @click.prevent.stop="imageSelect(image)"
                                class="relative"
                            >
                                <label for="images" class="relative">
                                    <img
                                        :src="image.url"
                                        :alt="image.title"
                                        class="w-[90%] h-auto sm:w-32 sm:h-32 xl:w-40 xl:h-40 2xl:w-48 2xl:h-48 cursor-pointer rounded-sm PX-1"
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
                            </div>
                            <div
                                class="flex justify-center items-center w-full"
                                v-if="isLoadMore"
                            >
                                <span class="w-10 h-10">
                                    <Loader></Loader>
                                </span>
                            </div>
                        </div>
                        <div
                            v-if="editAbleImage"
                            :class="[
                                editAbleImage
                                    ? 'w-[40%] sm:w-[20%] p-2'
                                    : 'p-2',
                            ]"
                        >
                            <div>
                                <div class="w-full    text-gray-900   dark:text-gray-50">
                                    <img
                                        :src="editAbleImage.url"
                                        :alt="editAbleImage.title"
                                        class="rounded-sm max-w-[100%] max-h-40 object-cover"
                                    />
                                    <div
                                        class="text-sm mt-5 flex flex-col gap-2"
                                    >
                                        <span
                                            v-if="editAbleImage.created_at"
                                            class="text-xs"
                                            >Date:
                                            {{ editAbleImage.created_at }}</span
                                        >

                                        <span
                                            v-if="editAbleImage.size"
                                            class="text-xs"
                                            >Size:
                                            {{ editAbleImage.size }}</span
                                        >
                                        <span
                                            v-if="editAbleImage.type"
                                            class="text-xs"
                                            >Type:
                                            {{ editAbleImage.type }}</span
                                        >
                                        <span
                                            class="grid place-content-center text-sm font-semibold rounded-sm my-3 cursor-pointer"
                                        >
                                            <DeleteImage
                                                class="cursor-pointer"
                                                :id="editAbleImage.id"
                                                route="image"
                                                :field="editAbleImage.id"
                                            >
                                                <span class="text-sm"
                                                    >Delete image
                                                </span>
                                            </DeleteImage>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <form
                                        @submit.prevent="
                                            updateImage(editAbleImage)
                                        "
                                    >
                                        <TextInput
                                            id="title"
                                            ref="titleInput"
                                            v-model="editAbleImage.title"
                                            type="text"
                                            class="mt-1 block w-full"
                                            autocomplete="title"
                                            maxlength="100"
                                            placeholder="Image Title"
                                            required
                                        />
                                        <button
                                            class="grid grid-cols-6 place-content-center w-full text-sm font-semibold text-white mt-2 xl:mt-3 hover:text-gray-50 hover:bg-blue-600 bg-blue-500 p-1 rounded-md"
                                            type="subnit"
                                            :class="[
                                                isUpdated ? 'opacity-50' : '',
                                            ]"
                                            :disabled="isUpdated"
                                        >
                                            <span
                                                class="col-span-5 sm:py-0.5 xl:py-1"
                                                >Update Title</span
                                            >
                                            <span
                                                class="w-5 h-5 col-span-1"
                                                v-if="isUpdated"
                                            >
                                                <Loader></Loader>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-5 md:mt-8">
                    <span
                        class="btn btn-primary text-right cursor-pointer"
                        @click.prevent="ImageStore"
                    >
                        {{ modalBtnLabel }}
                    </span>
                </div>
            </div>
        </Modal>
    </div>
</template>
