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
        <title>{{ __("category.title") }}</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-10"
        >
            <Hero>{{ __("hero.category") }}</Hero>
            <div
                class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-full lg:px-8 mt-5 md:mt-10"
            >
                <p
                    class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
                >
                    {{ __("category.heading") }}
                </p>
                <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                    {{ __("category.description") }}
                </p>
            </div>
            <Category :categories="categories"></Category>
            <Contact></Contact>
        </div>
    </MasterLayout>
</template>
