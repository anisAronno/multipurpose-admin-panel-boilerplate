<script setup>
import DeleteForm from "@/Components/DeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import Search from "@/Components/Search.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
defineProps({
    blogs: Object,
});
</script>

<template>
    <Head title="Blog" />

    <AuthenticatedLayout>
        <div class="dark:text-gray-100">
            <div
                class="bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 shadow sm:rounded-lg max-w-full mx-auto sm:px-6 lg:px-8 space-y-6 py-10"
            >
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold">Blog</h1>
                        <p class="mt-2 text-sm">A list of all the blogs.</p>
                    </div>
                    <div
                        class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"
                    >
                        <Link
                            v-can="'blog.create'"
                            :href="route('admin.blog.create')"
                            class="btn btn-primary"
                        >
                            <font-awesome-icon
                                icon="fa-solid fa-circle-plus"
                                class="mr-1"
                            />
                            Create New
                        </Link>
                        <Link
                            v-can="'blog.view'"
                            :href="route('admin.blog.index')"
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
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                        >
                            <div
                                class="flex items-center justify-between pb-4 bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 pt-3 pr-0.5"
                            >
                                <div class="flex-1">
                                    <!-- Action Item Here -->
                                </div>

                                <div class="flex-auto">
                                    <Search></Search>
                                </div>
                            </div>
                            <div
                                v-if="blogs.data.length > 0"
                                class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                            >
                                <table
                                    class="min-w-full table-auto divide-y divide-gray-300 bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-800"
                                >
                                    <thead class="w-full">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="py-3.5 pr-3 pl-3 text-left text-base font-bold"
                                            >
                                                Title
                                            </th>

                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-base font-bold"
                                            >
                                                Image
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-base font-bold"
                                            >
                                                Featured
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-base font-bold"
                                            >
                                                Category
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-base font-bold"
                                            >
                                                Status
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-base font-bold"
                                            >
                                                Date Time
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-center text-base font-bold"
                                            >
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y w-full">
                                        <tr
                                            v-for="blog in blogs.data"
                                            :key="blog.id"
                                            :id="blog.id"
                                        >
                                            <td
                                                class="max-w-[20%] break-all text-left p-4 font-semibold capitalize"
                                            >
                                                <Link
                                                    v-can="'blog.view'"
                                                    :href="
                                                        route(
                                                            'admin.blog.show',
                                                            blog.id
                                                        )
                                                    "
                                                >
                                                    {{ blog.title }}
                                                </Link>
                                            </td>

                                            <td
                                                class="max-w-[15%] break-all p-3 text-md"
                                            >
                                                <img
                                                    :src="blog.image?.url"
                                                    :alt="blog.image?.title"
                                                    class="w-16 h-16 my-1"
                                                />
                                            </td>
                                            <td
                                                class="max-w-[15%] break-all p-3 text-md"
                                            >
                                                {{ blog.is_featured }}
                                            </td>
                                            <td
                                                class="max-w-[20%] break-all p-3 text-md"
                                            >
                                                <div
                                                    v-for="(
                                                        category, index
                                                    ) in blog.categories"
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
                                            <td
                                                class="max-w-[15%] break-all p-3 text-md"
                                            >
                                                {{ blog.status }}
                                            </td>
                                            <td
                                                class="max-w-[15%] break-all p-3 text-md"
                                            >
                                                {{ blog.created_at }}
                                            </td>
                                            <td
                                                class="max-w-[20%] break-all text-right text-sm font-medium"
                                            >
                                                <div
                                                    class="flex justify-end flex-wrap gap-2 pr-3"
                                                >
                                                    <div>
                                                        <Link
                                                            v-can="'blog.view'"
                                                            :href="
                                                                route(
                                                                    'admin.blog.show',
                                                                    blog.id
                                                                )
                                                            "
                                                            class="btn btn-info"
                                                        >
                                                            <font-awesome-icon
                                                                icon="fa-solid fa-eye"
                                                                class="mr-1"
                                                            />
                                                        </Link>
                                                    </div>

                                                    <div>
                                                        <Link
                                                            v-can="'blog.edit'"
                                                            :href="
                                                                route(
                                                                    'admin.blog.edit',
                                                                    blog.id
                                                                )
                                                            "
                                                            class="btn btn-primary"
                                                        >
                                                            <font-awesome-icon
                                                                icon="fa-solid fa-pen-to-square"
                                                                class="mr-1"
                                                            />
                                                        </Link>
                                                    </div>

                                                    <DeleteForm
                                                        v-can="'blog.delete'"
                                                        :data="{
                                                            id: blog.id,
                                                            model: 'blog',
                                                        }"
                                                    ></DeleteForm>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot v-if="blogs.meta.last_page > 1">
                                        <tr>
                                            <td class="pl-4" colspan="1">
                                                Show
                                                {{ blogs.meta.from }}
                                                to
                                                {{ blogs.meta.to }} from ({{
                                                    blogs.meta.total
                                                }}
                                                items)
                                            </td>
                                            <td colspan="9" class="">
                                                <Pagination
                                                    v-if="
                                                        blogs.meta.last_page > 1
                                                    "
                                                    class="mt-6 dark:text-gray-100 flex justify-end p-3"
                                                    :links="blogs.meta.links"
                                                ></Pagination>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div
                                v-else
                                class="h-32 grid place-items-center text-2xl"
                            >
                                <p>Result not found</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
