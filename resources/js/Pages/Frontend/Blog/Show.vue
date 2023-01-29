<script setup lang="ts">
import MasterLayout from "@/Layouts/MasterLayout.vue";
import BlogShow from "@/Pages/Frontend/Blog/Partials/BlogShow.vue";
import { Head } from "@inertiajs/inertia-vue3";
defineProps({
    blog: Object,
});
</script>

<template>
    <Head>
        <title>{{ blog.title }}</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <BlogShow :blog="blog"></BlogShow>
        </div>
    </MasterLayout>
</template>
