<script setup lang="ts">
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Category from "@/Pages/Frontend/Category/Partials/Category.vue";
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
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-10"
        >
            <div
                class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
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
        </div>
    </MasterLayout>
</template>
