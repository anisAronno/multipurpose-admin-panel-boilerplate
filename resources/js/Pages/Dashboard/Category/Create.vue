<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateCategoryForm from "@/Pages/Dashboard/Category/Partials/CreateCategoryForm.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    statusArr: Object,
    featuredArr: Object,
    categories: Object,
});
</script>

<template>
    <Head title="Catgory" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Create Catgory
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
                                Create Catgory
                            </h1>
                            <p
                                class="mt-2 text-sm text-gray-700 dark:text-white"
                            >
                                Create a new Category.
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link
                            v-can="'category.view'"
                                :href="route('admin.user.index')"
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
                    <CreateCategoryForm
                        :statusArr="statusArr"
                        :featuredArr="featuredArr"
                        :categories="categories"
                    ></CreateCategoryForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
