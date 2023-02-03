<script setup>
import Sync from "@/Components/Icon/Sync.vue";
import Image from "@/Components/Image/Image.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";

const options = usePage().props.value.global.options;
</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    General Settings
                </h2>
                <Link
                    :href="route('cache.clear')"
                    class="flex items-center gap-1 text-blue-700 hover:text-blue-500 text-md"
                >
                    <Sync class="w-5 h-5 animate-spin"></Sync>
                    <span>Cache Clear</span></Link
                >
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <div
                        class="max-w-7xl mx-auto flex flex-wrap justify-around items-center bg-white dark:bg-gray-800 text-black dark:text-white sm:space-x-2 space-y-2 sm:space-y-0"
                    >
                        <div
                            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
                        >
                            <div class="text-2x block text-center text-2xl">
                                First Model
                            </div>
                            <Image
                                id="model_one"
                                field="model_one"
                                :isDeleteable="true"
                                v-model="options.model_one"
                                class="w-48 h-48 rounded-sm overflow-clip bg-red-500"
                            />
                        </div>
                        <div
                            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
                        >
                            <div class="text-2x block text-center text-2xl">
                                Second Model
                            </div>
                            <Image
                                id="model_three"
                                field="model_three"
                                :isDeleteable="true"
                                v-model="options.model_three"
                                class="w-48 h-48 rounded-sm overflow-clip bg-red-500"
                            />
                        </div>
                        <div
                            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
                        >
                            <div class="text-2x block text-center text-2xl">
                                Third Model
                            </div>
                            <Image
                                id="model_three"
                                field="model_three"
                                :isDeleteable="true"
                                v-model="options.model_three"
                                class="w-48 h-48 rounded-sm overflow-clip bg-red-500"
                            />
                        </div>
                        <div
                            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
                        >
                            <div class="text-2x block text-center text-2xl">
                                Fourth Model
                            </div>
                            <Image
                                id="model_three"
                                field="model_three"
                                :isDeleteable="true"
                                v-model="options.model_four"
                                class="w-48 h-48 rounded-sm overflow-clip bg-red-500"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
