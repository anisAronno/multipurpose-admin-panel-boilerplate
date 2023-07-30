<script setup>
defineProps({
    categories: Object,
});
</script>
<template>
    <div
        class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 my-5 sm:my-5 md:lg-3"
        v-if="categories?.length > 0"
    >
        <div
            class="mx-auto max-w-xl px-4 sm:px-6 lg:max-w-full lg:px-8 py-2 sm:py-3 lg:py-5"
        >
            <div class="text-center mb-5 lg:mb-10">
                <h1 class="text-2xl md:text-4xl mb-2">
                    {{ __("featured.category.title") }}
                </h1>
                <p>
                    {{ __("featured.category.description") }}
                </p>
            </div>

            <div class="flex flex-wrap gap-10 justify-center">
                <Link
                    v-for="category in categories"
                    :key="category.title"
                    :href="route('category.show', category.slug)"
                    class="group block mb-2 md:mb-5 w-96"
                >
                    <div
                        aria-hidden="true"
                        class="aspect-w-3 aspect-h-3 overflow-hidden rounded-lg group-hover:opacity-75 lg:aspect-w-6 lg:aspect-h-6"
                    >
                        <img
                            :src="category.image"
                            :alt="category.title"
                            class="h-80 w-80 sm:h-80 sm:w-80 lg:h-96 lg:w-96 object-center object-cover"
                        />
                    </div>
                    <h3
                        class="mt-4 text-base font-semibold text-gray-900 dark:text-gray-100"
                    >
                        {{ category.title }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ category.description }}
                    </p>
                </Link>
            </div>
        </div>
    </div>
</template>
