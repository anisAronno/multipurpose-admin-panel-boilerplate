<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Form from "@/Pages/Dashboard/Products/Partials/Form.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    product: Object,
    categories: Object,
    statusArr: Object,
    featuredArr: Object,
});
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit Product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg"
                >
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Edit Product
                            </h1>
                            <p
                                class="mt-2 text-sm text-gray-700 dark:text-white"
                            >
                                Edit a new users with categories.
                            </p>
                        </div>
                        <div
                            class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"
                        >
                            <Link
                                :href="route('admin.product.show', product.id)"
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-eye"
                                    class="mr-1"
                                />
                                Back
                            </Link>
                            <Link
                                :href="route('admin.product.create')"
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-circle-plus"
                                    class="mr-1"
                                />
                                Create New
                            </Link>
                            <Link
                                :href="route('admin.product.index')"
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-eye"
                                    class="mr-1"
                                />
                                View All
                            </Link>
                        </div>
                    </div>
                    <Form
                        :product="product"
                        :categories="categories"
                        :statusArr="statusArr"
                        :featuredArr="featuredArr"
                    ></Form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
