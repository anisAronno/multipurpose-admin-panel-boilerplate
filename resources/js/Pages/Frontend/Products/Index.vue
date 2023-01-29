<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import Products from "@/Pages/Frontend/Products/Partials/Products.vue";
import { Head } from "@inertiajs/inertia-vue3";
defineProps({
    products: Object,
});
</script>

<template>
    <Head>
        <title>Products</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <!-- <Banner></Banner> -->

            <div class="pt-10">
                <div
                    class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
                >
                    <p
                        class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
                    >
                        {{ __("All Products") }}
                    </p>
                    <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                        {{
                            __(` Phasellus lorem quam molestie id quisque diam aenean nulla
                    in. Accumsan in quis quis nunc, ullamcorper malesuada.
                    Eleifend condimentum id viverra nulla.`)
                        }}
                    </p>
                </div>
                <Products :products="products"></Products>
            </div>
            <Feature></Feature>
        </div>
    </MasterLayout>
</template>
