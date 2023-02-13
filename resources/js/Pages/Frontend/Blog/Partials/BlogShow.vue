<script setup>
defineProps({
    blog: Object,
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
                <div
                    class="m-1"
                    v-for="image in blog.images.slice(0, 1)"
                    :key="image.id"
                >
                    <img
                        class="w-full h-96 rounded-md"
                        :src="image.url"
                        :alt="image.title"
                    />
                </div>
            </div>
            <div class="p-5 sm:p-10">
                <div aria-level="blog-content">
                    <h1
                        class="text-4xl mb-5 underline underline-offset-8 decoration-slate-500"
                    >
                        {{ blog.title }}
                    </h1>
                    <p
                        class="text-md text-gray-700 dark:text-gray-400 break-all text-justify"
                    >
                        {{ blog.description }}
                    </p>
                </div>
                <div class="mt-6 flex items-center">
                    <div class="flex-shrink-0">
                        <span>
                            <img
                                class="h-10 w-10 rounded-full"
                                :src="blog.user.avatar"
                                :alt="blog.user.name"
                            />
                        </span>
                    </div>
                    <div class="ml-3">
                        <p
                            class="text-sm font-medium text-gray-900 dark:text-gray-300 mb-0.5"
                        >
                            <span class="hover:underline">{{
                                blog.user.name
                            }}</span>
                        </p>
                        <div class="flex space-x-1 text-sm text-gray-500">
                            <span>{{ blog.created_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
