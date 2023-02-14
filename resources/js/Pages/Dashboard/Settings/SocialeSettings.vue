<script setup>
import Sync from "@/Components/Icon/Sync.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SocialSettingsForm from "@/Pages/Dashboard/Settings/Partials/SocialSettingsForm.vue";
import { Head, usePage } from "@inertiajs/vue3";

const options = usePage().props.global.options;
</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    Socail Settings
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
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <SocialSettingsForm></SocialSettingsForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
