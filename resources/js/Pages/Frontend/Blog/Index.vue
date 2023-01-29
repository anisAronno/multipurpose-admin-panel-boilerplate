<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Blog from "@/Pages/Frontend/Blog/Partials/Blog.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    blogs: Object,
});
</script>

<template>
    <Head>
        <title>Blog</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <Banner></Banner>

            <Blog :blogs="blogs"></Blog>
        </div>
    </MasterLayout>
</template>
