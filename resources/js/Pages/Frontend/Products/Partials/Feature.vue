<script setup>
defineProps({
    specialFeatures: Object,
});
</script>
<template>
    <section
        aria-labelledby="perks-heading"
        class="border-t border-b border-gray-200  dark:border-gray-700  bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
    >
        <div class="text-center mt-5">
            <h1 class="text-2xl md:text-4xl mb-2">
                {{ __("special.feature.title") }}
            </h1>
            <p>
                {{ __("special.feature.description") }}
            </p>
        </div>

        <div class="mx-auto max-w-7xl py-8 px-4 sm:px-4 sm:py-12 lg:px-8">
            <div
                class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-0"
            >
                <div
                    v-for="specialFeature in specialFeatures"
                    :key="specialFeature.id"
                    class="py-24 px-4 sm:px-6 sm:py-24 lg:px-8 text-center md:flex md:items-start md:text-left lg:block lg:text-center bg-cyan-100 dark:bg-gray-800"
                >
                    <div class="md:flex-shrink-0">
                        <div class="grid place-content-center">
                            <img
                                :src="specialFeature.image"
                                :alt="specialFeature.title"
                                class="w-12 h-12 md:w-16 md:h-16 rounded-full"
                            />
                        </div>
                    </div>
                    <div class="mt-6 md:mt-0 md:ml-4 lg:mt-6 lg:ml-0">
                        <h3
                            class="text-base font-medium text-gray-900 dark:text-gray-100"
                        >
                            {{ specialFeature.title }}
                        </h3>
                        <p
                            class="mt-3 text-sm text-gray-500 dark:text-gray-300"
                        >
                            {{ specialFeature.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
