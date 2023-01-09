<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import Images from "./Partials/Images.vue";
import SettingsForm from "./Partials/SettingsForm.vue";
defineProps({
    roleArr: Object,
});

const options = usePage().props.value.global.options;
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Settings
            </h2>
        </template>
        <div class="py-12"> 
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <Images></Images>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <SettingsForm :roleArr="roleArr"></SettingsForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
