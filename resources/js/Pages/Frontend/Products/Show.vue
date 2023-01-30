<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import FeatureProducts from "@/Pages/Frontend/Products/Partials/FeatureProducts.vue";
import ProductsShow from "@/Pages/Frontend/Products/Partials/ProductsShow.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
defineProps({
    product: Object,
    featuredProducts: Object,
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
            <Hero>{{ product.title }}</Hero>
            <ProductsShow :product="product"></ProductsShow>
            <FeatureProducts
                :featuredProducts="featuredProducts"
            ></FeatureProducts>
            <Contact></Contact>
        </div>
    </MasterLayout>
</template>
