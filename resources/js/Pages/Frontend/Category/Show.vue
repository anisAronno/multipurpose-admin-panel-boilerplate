<script setup>
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import { Head } from "@inertiajs/inertia-vue3";
defineProps({
    category: Object,
});
</script>
<template>
    <Head>
        <title>{{ category.title }}</title>
    </Head>
    <MasterLayout>
        <div
            class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-10"
        >
            <Hero>
                <span class="break-words leading-none font-normal md:font-semibold text-lg"
                    >{{ __("category_show.title_1") }}
                    <span class="text-blue-600 dark:text-blue-400">{{ category.title }}</span>
                    {{ __("category_show.title_2") }}</span
                >
            </Hero>
            <div class="py-10">
                <div
                    class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
                >
                    <p
                        class="text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
                    >
                        {{ category.title }}
                    </p>
                    <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                        {{ category.description }}
                    </p>
                </div>
            </div>
            <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
                <h2 class="sr-only">
                    {{ __("category.mobile_title") }}
                </h2>

                <div
                    class="-mx-px grid grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4 gap-5"
                >
                    <div
                        v-for="product in category.products"
                        :key="product.id"
                        class="group border border-gray-200 p-4 sm:p-6"
                    >
                        <div
                            class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 group-hover:opacity-75"
                        >
                            <Link :href="route('product.show', product.slug)">
                                <img
                                    :src="product.image"
                                    :alt="product.image"
                                    class="h-full w-full object-cover object-center"
                                />
                            </Link>
                        </div>
                        <div class="pt-10 pb-4 text-center">
                            <h3
                                class="text-sm font-medium bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
                            >
                                <Link
                                    :href="route('product.show', product.slug)"
                                >
                                    {{ product.title }}
                                </Link>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Contact></Contact>
    </MasterLayout>
</template>
