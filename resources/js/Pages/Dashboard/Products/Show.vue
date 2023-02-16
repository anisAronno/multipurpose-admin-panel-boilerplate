<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    product: Object,
});
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Show Product
            </h2>
        </template>

        <div class="py-12 dark:text-white">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg"
                >
                    <div class="sm:flex sm:items-center mb-5">
                        <div class="sm:flex-auto">
                            <h1
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                View Product
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
                                :href="route('admin.product.edit', product.id)"
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-pen-to-square"
                                    class="mr-1"
                                />
                                Edit
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
                                                    Product Title
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
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                >
                                                    Category
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
                                                    {{ product.title }}
                                                </td>
                                                <td
                                                    class="w-[20%] text-gray-900"
                                                    v-html="product.description"
                                                > 
                                                </td>
                                                <td
                                                    class="w-[20%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                >
                                                     <div v-for="image in product.images" :key="image.id">
                                                            <img
                                                                :src="image.url"
                                                                :alt="
                                                                    image.title
                                                                "
                                                                class="w-16 h-16 m-1"
                                                            />
                                                        </div>
                                                </td>
                                                <td
                                                    class="w-[20%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                >
                                                    {{ product.status }}
                                                </td>
                                                <td
                                                    class="whitespace-normal p-3 text-md text-gray-500"
                                                >
                                                    <div
                                                        v-for="(
                                                            category, index
                                                        ) in product.categories"
                                                        :key="category.id"
                                                        class="mr-2"
                                                    >
                                                        {{ index + 1 + "." }}
                                                        <Link
                                                            class="text-blue-500"
                                                            :href="
                                                                route(
                                                                    'admin.category.show',
                                                                    category.id
                                                                )
                                                            "
                                                        >
                                                            {{
                                                                category.title
                                                            }}</Link
                                                        >
                                                    </div>
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
