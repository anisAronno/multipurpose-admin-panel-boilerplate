<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditCategoryForm from "@/Pages/Dashboard/Category/Partials/EditCategoryForm.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    category: Object,
    statusArr: Object,
    featuredArr: Object,
});
</script>

<template>
    <Head title="Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg"
                >
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Edit Category
                            </h1>
                            <p
                                class="mt-2 text-sm text-gray-700 dark:text-white"
                            >
                                Edit a new users with category.
                            </p>
                        </div>
                        <div
                            class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"
                        >
                            <Link
                                :href="
                                    route('admin.category.show', category.id)
                                "
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-eye"
                                    class="mr-1"
                                />
                                Back
                            </Link>
                            <Link
                                :href="route('admin.admin.category.create')"
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-circle-plus"
                                    class="mr-1"
                                />
                                Create New
                            </Link>
                            <Link
                                :href="route('admin.category.index')"
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
                    <EditCategoryForm
                        :category="category"
                        :statusArr="statusArr"
                        :featuredArr="featuredArr"
                    ></EditCategoryForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
