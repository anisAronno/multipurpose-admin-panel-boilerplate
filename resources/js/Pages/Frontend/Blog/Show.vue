<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
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
        <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50">
            <Hero>{{ blog.title }}</Hero>
            <BlogShow :blog="blog"></BlogShow>
        </div>
    </MasterLayout>
</template>
