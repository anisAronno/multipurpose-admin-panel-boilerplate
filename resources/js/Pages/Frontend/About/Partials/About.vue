<script setup></script>
<template>
    <div
        class="container mx-auto p-6 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
    >
        <div
            class="grid grid-col sm:grid-cols-2 gap-5 bg-cyan-50 text-gray-900 dark:bg-gray-800 dark:text-gray-50"
        >
            <div class="p-5 sm:p-10">
                <img
                    class="w-full h-96 rounded-md"
                    src="https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-01.jpg"
                    alt=""
                />
            </div>
            <div class="p-5 sm:p-10">
                <h1
                    class="text-4xl mb-5 underline underline-offset-8 decoration-slate-500"
                >
                    {{ __("about.us.title") }}
                </h1>
                <p class="text-md text-gray-700 dark:text-gray-400">
                    {{ __("about.us.description") }}
                </p>
            </div>
        </div>
    </div>
</template>
