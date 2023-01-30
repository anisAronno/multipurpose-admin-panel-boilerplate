<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Category from "@/Pages/Frontend/Category/Partials/Category.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import { Head } from "@inertiajs/inertia-vue3";
defineProps({
    categories: Object,
});
</script>

<template>
    <Head>
        <title>{{ __("category.title", "Category") }}</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-10"
        >
            <Hero>{{ __("Category Page") }}</Hero>
            <div
                class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8 mt-5 md:mt-10"
            >
                <p
                    class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
                >
                    {{ __("All Category") }}
                </p>
                <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                    {{
                        __(` Phasellus lorem quam molestie id quisque diam aenean nulla
                    in. Accumsan in quis quis nunc, ullamcorper malesuada.
                    Eleifend condimentum id viverra nulla.`)
                    }}
                </p>
            </div>
            <Category :categories="categories"></Category>
            <Contact></Contact>
        </div>
    </MasterLayout>
</template>
