<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import Products from "@/Pages/Frontend/Products/Partials/Products.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head>
        <title>Products</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <Banner></Banner>

            <Products></Products>
            <Feature></Feature>
        </div>
    </MasterLayout>
</template>
