<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import Products from "@/Pages/Frontend/Products/Partials/Products.vue";
import { Head } from "@inertiajs/vue3";
defineProps({
    products: Object,
});
</script>

<template>
    <Head>
        <title>{{ __("product.title") }}</title>
    </Head>
    <MasterLayout>
        <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50">
            <Hero>{{ __("hero.product") }}</Hero>

            <div class="pt-10">
                <div
                    class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-full lg:px-8"
                >
                    <p
                        class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
                    >
                        {{ __("product.heading") }}
                    </p>
                    <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                        {{ __("product.description") }}
                    </p>
                </div>
                <Products :products="products"></Products>
            </div>
            <Feature></Feature>
            <Contact></Contact>
        </div>
    </MasterLayout>
</template>
