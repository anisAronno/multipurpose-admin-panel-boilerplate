<script setup>
import Pagination from "@/Components/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import search from "@/Components/Search.vue";

const props = defineProps({
    products: Object,
    categories: Object,
});

const form = useForm({
    category: [],
});

const searchRoute = usePage().url?.value.split("?")[0];

function getProducts(catID) {
    form.category = catID;
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
            <div class="my-5 flex justify-end">
                <search class="float-right space-x-5" />
            </div>
            <div class="grid grid-cols-6">
                <div
                    class="col-span-2 overflow-hidden px-2 break-words break-all"
                >
                    <h2
                        class="my-5 font-bold underline underline-offset-4 text-2xl"
                    >
                        Product categories
                    </h2>
                    <h4
                        class="my-5 font-semibold cursor-pointer"
                        @click="getProducts(null)"
                    >
                        Show All
                    </h4>
                    <div
                        v-for="category in categories"
                        :key="category.value"
                        class="mb-4"
                    >
                        <div
                            class="font-normal sm:font-semibold cursor-pointer text-sm sm:text-lg md:text-lg"
                            @click="getProducts(category.value)"
                        >
                            {{ category.label }}
                        </div>
                        <div v-if="category?.children?.length > 0" class="ml-4">
                            <ul>
                                <li
                                    v-for="child in category.children.slice(
                                        0,
                                        4
                                    )"
                                    :key="child.value"
                                >
                                    <span
                                        @click="getProducts(child.value)"
                                        class="cursor-pointer"
                                    >
                                        - {{ child.label }}</span
                                    >
                                    <div
                                        v-if="child?.children?.length > 0"
                                        class="ml-4"
                                    >
                                        <ul>
                                            <li
                                                v-for="child2 in child.children.slice(
                                                    0,
                                                    4
                                                )"
                                                :key="child2.value"
                                            >
                                                <span
                                                    @click="
                                                        getProducts(
                                                            child2.value
                                                        )
                                                    "
                                                    class="cursor-pointer"
                                                >
                                                    -- {{ child2.label }}</span
                                                >
                                            </li>
                                            <li
                                                v-if="
                                                    child?.children?.length > 4
                                                "
                                            >
                                                ...
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li v-if="category?.children?.length > 4">
                                    ...
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-4">
                    <div
                        class="-mx-px grid grid-cols-1 sm:grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"
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
