<script setup>
import media from "@/Components/Media.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    images: [
        {
            id: 116,
            title: "Dr. Jevon Fisher PhD",
            url: "https://via.placeholder.com/640x480.png/002266?text=facere",
            mimes: null,
            type: null,
            size: null,
            user_id: 6,
            created_at: "2023-02-12T10:45:29.000000Z",
            updated_at: "2023-02-12T10:45:29.000000Z",
        },
    ],
});
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                {{ __("dashboard") }}
            </h2>
        </template>

        <div class="py-12 h-screen">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <media
                            v-model="form.images"
                            imageWidth="20" 
                            addBtnLabel="Add Images"
                            allowMultiple="true"
                            showPreview="true"
                        ></media>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
