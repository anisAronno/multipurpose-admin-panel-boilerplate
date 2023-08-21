<script setup>
import Pagination from "@/Components/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import search from "@/Components/Search.vue";
import SideOverlay from "@/Components/SideOverlay.vue";
import CategoryList from "./CategoryList.vue";
import { ref } from "vue";

const props = defineProps({
    products: Object,
    categories: Object,
});

const form = useForm({
    category: "",
});

let openSidebar = ref(false);

const searchRoute = usePage().url.value.split("?")[0];

function getProducts(catSlug) {
    form.category = catSlug;
    form.get(searchRoute, {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            console.log(form.errors.category);
        },
    });
}
</script>
<template>
    <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50">
        <div class="mx-auto max-w-full overflow-hidden sm:px-6 lg:px-8">
            <h2 class="sr-only">{{ __("product.mobile_title") }}</h2>
            <div class="my-10">
                <div class="flex justify-around sm:justify-end mx-0">
                    <search />
                    <span
                        @click="openSidebar = !openSidebar"
                        class="block sm:hidden w-12"
                    >
                        <svg
                            class="h-10 w-10"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                class="block md:hidden"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </span>
                </div>
                <SideOverlay v-model="openSidebar" title="Category List">
                    <category-list
                        :categories="categories"
                        @selectedCatSlug="getProducts"
                    ></category-list
                ></SideOverlay>
            </div>
            <div class="grid col-span-1 sm:grid-cols-6 mx-2 sm:mx-0">
                <div
                    class="col-span-2 overflow-hidden px-2 break-words break-all hidden sm:block"
                >
                    <h2 class="my-5">
                        <span
                            class="font-bold dark:text-gray-200 text-2xl border-b-gray-500 border-b pb-1"
                        >
                            Category List
                        </span>
                    </h2>
                    <category-list
                        :categories="categories"
                        @selectedCatSlug="getProducts"
                    ></category-list>
                </div>

                <div class="col-span-4">
                    <div
                        class="-mx-px grid grid-cols-1 sm:grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"
                        v-if="products.data.length > 0"
                    >
                        <div
                            v-for="product in products.data"
                            :key="product.id"
                            class="group border border-gray-200 p-4 sm:p-6"
                        >
                            <div
                                class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 group-hover:opacity-75"
                            >
                                <Link
                                    :href="route('product.show', product.slug)"
                                >
                                    <img
                                        :src="product.image"
                                        :alt="product.image"
                                        class="h-full w-full object-cover object-center"
                                    />
                                </Link>
                            </div>
                            <div class="pt-10 pb-4 text-center">
                                <h3
                                    class="text-sm font-medium bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
                                >
                                    <Link
                                        :href="
                                            route('product.show', product.slug)
                                        "
                                    >
                                        {{ product.title }}
                                    </Link>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div
                        v-else
                        class="-mx-px min-h-full text-2xl grid place-items-center text-red-500"
                    >
                        <p>No products found. Please refine your search.</p>
                    </div>
                </div>
            </div>
            <Pagination
                v-if="products.last_page > 1"
                class="mt-6 dark:text-white flex justify-end p-3"
                :links="products.links"
            ></Pagination>
        </div>
    </div>
</template>
