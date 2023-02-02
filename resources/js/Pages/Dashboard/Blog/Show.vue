<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    category: Object,
});
</script>

<template>
    <Head title="Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Show Category
            </h2>
        </template>

        <div class="py-12 dark:text-white h-full min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg"
                >
                    <div class="sm:flex sm:items-center mb-5">
                        <div class="sm:flex-auto">
                            <h1
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                View Category
                            </h1>
                            <p
                                class="mt-2 text-sm text-gray-700 dark:text-white"
                            >
                                View products with category.
                            </p>
                        </div>
                        <div
                            class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"
                        >
                            <Link
                                :href="
                                    route('admin.category.edit', category.id)
                                "
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-pen-to-square"
                                    class="mr-1"
                                />
                                Edit
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
                    <div class="mt-8 flex flex-col">
                        <div
                            class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
                        >
                            <div
                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                            >
                                <div
                                    class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                >
                                    <table
                                        class="min-w-full table-auto divide-y divide-gray-300 p-3"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pr-3 pl-3 text-left text-base font-bold text-gray-900"
                                                >
                                                    Category Title
                                                </th>

                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                >
                                                    Description
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                >
                                                    Image
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                >
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 bg-white"
                                        >
                                            <tr>
                                                <td
                                                    class="w-[20%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                >
                                                    {{ category.title }}
                                                </td>
                                                <td
                                                    class="w-[20%] text-gray-900"
                                                >
                                                    {{ category.description }}
                                                </td>
                                                <td
                                                    class="w-[20%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                >
                                                    <img
                                                        :src="category.image"
                                                        alt=""
                                                        class="w-16 h-16"
                                                    />
                                                </td>
                                                <td
                                                    class="w-[20%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                >
                                                    {{ category.status }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
