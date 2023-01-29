<script setup>
defineProps({
    products: Object,
});
</script>
<template>
    <div
        class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 my-5"
        v-if="products.length > 0"
    >
        <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
            <h2 class="sr-only">Products</h2>

            <div
                class="-mx-px grid grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"
            >
                <div
                    v-for="product in products"
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
                            <Link :href="route('product.show', product.slug)">
                                {{ product.title }}
                            </Link>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
