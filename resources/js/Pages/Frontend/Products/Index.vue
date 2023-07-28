<script setup>
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import Feature from "@/Pages/Frontend/Products/Partials/Feature.vue";
import Products from "@/Pages/Frontend/Products/Partials/Products.vue";
import { ref, computed } from "vue";
import { usePage, Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    products: Object,
    categories: Object,
});

let categoryValue = ref("");
const queryString = usePage().url;
const params = new URLSearchParams(queryString.value.split("?")[1]);
categoryValue.value = params.get("category") || "";

function findValue(obj, value) {
    for (let item of Object.values(obj)) {
        if (item.slug == value) {
            return item;
        }
        if (Array.isArray(item.children)) {
            let result = findValue(item.children, value);
            if (result) {
                return result;
            }
        }
    }
    return null;
}

const selectedCategory = computed(() => {
    const result = findValue(props.categories, categoryValue.value);
    return result ? result : null;
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
                        class="text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-200"
                    >
                        <span v-if="selectedCategory?.label">
                            Explore
                            <span
                                class="text-xl font-bold sm:text-2xl text-cyan-400"
                            >
                                &nbsp;{{ selectedCategory.label }}&nbsp;
                            </span>
                            in our Collection!</span
                        >
                        <span v-else class="text-2xl">
                            {{ __("product.heading") }}
                        </span>
                    </p>
                    <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                        <span v-if="selectedCategory?.description">
                            {{ selectedCategory.description }}
                        </span>
                        <span v-else>
                            {{ __("product.description") }}
                        </span>
                    </p>
                </div>
                <Products
                    :products="products"
                    :categories="categories"
                ></Products>
            </div>
        </div>
    </MasterLayout>
</template>
