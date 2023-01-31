<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Blog from "@/Pages/Frontend/Blog/Partials/Blog.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    blogs: Object,
});
</script>

<template>
    <Head>
        <title>{{ __("blog.title") }}</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <Hero>{{ __("hero.blog") }}</Hero>

            <Blog :blogs="blogs"></Blog>
        </div>
    </MasterLayout>
</template>
