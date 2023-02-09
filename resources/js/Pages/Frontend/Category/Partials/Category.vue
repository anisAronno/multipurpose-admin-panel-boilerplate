<script setup>
import Pagination from "@/Components/Pagination.vue";
defineProps({
    categories: Object,
});
</script>
<template>
    <div class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50">
        <div
            class="mx-auto max-w-xl px-4 sm:px-6 lg:max-w-full lg:px-8 py-6 sm:py-10 lg:py-12"
        >
            <div
                class="mt-10 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:space-y-0 gap-10"
            >
                <Link
                    v-for="category in categories.data"
                    :key="category.title"
                    :href="route('category.show', category.slug)"
                    class="group block mb-5"
                >
                    <div
                        aria-hidden="true"
                        class="aspect-w-3 aspect-h-2 overflow-hidden rounded-lg group-hover:opacity-75 lg:aspect-w-5 lg:aspect-h-6"
                    >
                        <img
                            :src="category.image"
                            :alt="category.title"
                            class="h-full w-full object-cover object-center"
                        />
                    </div>
                    <h3
                        class="mt-4 text-base font-semibold text-gray-900 dark:text-white"
                    >
                        {{ category.title }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ category.description }}
                    </p>
                </Link>
            </div>
            <Pagination
                v-if="categories.last_page > 1"
                class="my-5 dark:text-white flex justify-end p-3"
                :links="categories.links"
            ></Pagination>
        </div>
    </div>
</template>
