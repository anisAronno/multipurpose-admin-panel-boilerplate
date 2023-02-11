<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    images: [
        {
            id: 1,
            title: "Mr. Jerel Bartoletti V",
            url: "https://via.placeholder.com/640x480.png/0099ff?text=odio",
            mimes: null,
            type: null,
            size: null, 
            created_at: "2023-02-10T21:21:45.000000Z",
            updated_at: "2023-02-10T21:21:45.000000Z",
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
                     <media></media>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
