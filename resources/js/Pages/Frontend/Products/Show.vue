<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import ProductsShow from "@/Pages/Frontend/Products/Partials/ProductsShow.vue";
import { Head } from "@inertiajs/inertia-vue3";
defineProps({
    product: Object,
});
</script>

<template>
    <Head>
        <title>{{ product.title }}</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        > 
            <ProductsShow :product="product"></ProductsShow>
        </div>
    </MasterLayout>
</template>
