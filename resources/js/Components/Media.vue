<script setup>
import Modal from "@/Components/Modal.vue";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond/dist/filepond.min.css";
import { ref } from "vue";
import vueFilePond from "vue-filepond";

const activeTab = ref("upload");
const setActiveTab = (tab) => {
    activeTab.value = tab;
};

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

let modalShow = ref(false);

const closeModal = () => {
    modalShow.value = false;
    emit("success", true);
};
</script>

<template>
    <div>
        <button @click="modalShow = true" class="btn btn-primary">
            Add Image
        </button>
        <Modal :show="modalShow" @close="closeModal" class="relative">
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
                    Media
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
                class="p-10 h-[400px] md:h-[600px] 2xl:h-[800px] overflow-scroll"
                v-if="activeTab == 'upload'"
            >
                <div>
                    <file-pond
                        name="test"
                        ref="pond"
                        label-idle="Drop files here..."
                        v-bind:allow-multiple="true"
                        accepted-file-types="image/jpeg, image/png"
                        server="/api"
                        v-bind:files="myFiles"
                        v-on:init="handleFilePondInit"
                        max-files="99"
                        imagePreviewMaxHeight="200"
                    />
                </div>
            </div>
            <div
                class="p-10 h-[400px] md:h-[600px] 2xl:h-[800px] overflow-scroll"
                v-if="activeTab == 'media'"
            >
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad
                    reiciendis quibusdam dolor facilis unde deserunt
                    perspiciatis sint harum placeat totam eius eveniet, impedit
                    obcaecati aliquam? Reprehenderit commodi nisi molestiae
                    error quo ratione laborum. Voluptate, aspernatur! Maiores
                    quia nemo culpa corporis iusto sed eius harum sint ducimus
                    fugiat tempore, reprehenderit quidem nostrum voluptatum
                    tenetur. Commodi vero ullam distinctio neque veniam nam
                    error placeat dolorum eos, n to esse aliquid amet sunt
                    quia repellat vel iste, sed impedit tenetur ratione laborum
                    debitis labore nisi eos optio voluptas sapiente pariatur
                    placeat incidunt soluta. Ratione quam nihil dolores iusto
                    eos veniam dolorem voluptatum consequatur! Fugit, incidunt,
                    atque itaque nihil culpa soluta id sed voluptate minus,
                    rerum obcaecati pariatur! Minima amet, repellat unde,
                    expedita, cupiditate nisi illum neque eos deleniti
                    consequatur inventore perspiciatis exercitationem
                    reprehenderit excepturi ea nostrum!
                </div>
            </div>
        </Modal>
    </div>
</template>
