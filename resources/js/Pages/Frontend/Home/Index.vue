<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Blog from "@/Pages/Frontend/Home/Partials/Blog.vue";
import Category from "@/Pages/Frontend/Home/Partials/Category.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import Products from "@/Pages/Frontend/Products/Partials/Products.vue";

import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <MasterLayout>
        <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50">
            <Banner></Banner>
            <Category></Category>
            <!-- Feature section with grid -->

            <Feature></Feature>
            <!-- Product section -->
            <Products></Products>
            <!-- Blog section -->

            <Blog></Blog>
            <!-- CTA Section -->
            <Contact></Contact>
        </div>
    </MasterLayout>
</template>
