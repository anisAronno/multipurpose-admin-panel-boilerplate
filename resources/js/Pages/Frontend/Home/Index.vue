<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Blog from "@/Pages/Frontend/Home/Partials/Blog.vue";
import Category from "@/Pages/Frontend/Home/Partials/Category.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import FeatureProducts from "@/Pages/Frontend/Products/Partials/FeatureProducts.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    products: Object,
});
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <Banner></Banner>
            <Category></Category>
            <!-- Feature section with grid -->

            <Feature></Feature>
            <!-- Product section -->
            <FeatureProducts :products="products" v-if="products"></FeatureProducts>
            <!-- Blog section -->

            <Blog></Blog>
            <!-- CTA Section -->
            <Contact></Contact>
        </div>
    </MasterLayout>
</template>
