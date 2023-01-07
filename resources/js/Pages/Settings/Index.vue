<script setup>
import Picture from "@/Components/Image/Picture.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    options: Object,
});

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
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-black dark:text-white shadow sm:rounded-lg"
                >
                    <Picture
                        :id="options.id"
                        table="options"
                        field="logo"
                        class="max-w-full"
                        v-model="options.logo"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
