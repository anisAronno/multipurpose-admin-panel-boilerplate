<script setup lang="ts">
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import Category from "@/Pages/Frontend/Category/Partials.vue/Category.vue";
import { Head } from "@inertiajs/inertia-vue3";
defineProps({
    categories: Object,
});
</script>

<template>
    <Head>
        <title>Category</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <Category :categories="categories"></Category> 
        </div>
    </MasterLayout>
</template>
