<script setup>
defineProps({
    product: Object,
});
</script>
<template>
    <div
        class="container mx-auto p-6 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
    >
        <div
            class="grid grid-col sm:grid-cols-2 gap-5 bg-cyan-100 text-gray-900 dark:bg-gray-800 dark:text-gray-50"
        >
            <div class="p-5 sm:p-10">
                <img
                    class="w-full h-96 rounded-md"
                    :src="product.image?.url"
                    :alt="product.title?.title"
                />
            </div>
            <div class="p-5 sm:p-10">
                <h1
                    class="text-4xl mb-5 underline underline-offset-8 decoration-slate-500"
                >
                    {{ product.title }}
                </h1>
                <p
                    class="text-md text-gray-700 dark:text-gray-400 break-all text-justify"
                >
                    {{ product.description }}
                </p>
            </div>
        </div>
    </div>
</template>
