<script setup>
import DeleteForm from "@/Components/DeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import Search from "@/Components/Search.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
defineProps({
    users: Object,
});
</script>

<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                User
            </h2>
        </template>

        <div class="py-12 dark:text-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg"
                >
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1
                                    class="text-xl font-semibold text-gray-900 dark:text-white"
                                >
                                    User
                                </h1>
                                <p
                                    class="mt-2 text-sm text-gray-700 dark:text-white"
                                >
                                    A list of all the users.
                                </p>
                            </div>
                            <div
                                class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"
                            >
                                <Link
                                    :href="route('user.create')"
                                    class="btn btn-primary"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle-plus"
                                        class="mr-1"
                                    />
                                    Create New
                                </Link>
                                <Link
                                    :href="route('user.index')"
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
                                        class="flex items-center justify-between pb-4 bg-white dark:bg-gray-800 pt-3 pr-0.5"
                                    >
                                        <div class="flex-1">
                                            <!-- Action Item Here -->
                                        </div>

                                        <div class="flex-auto">
                                            <Search></Search>
                                        </div>
                                    </div>
                                    <div
                                        v-if="users.data?.length > 0"
                                        class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                    >
                                        <table
                                            class="min-w-full table-auto divide-y divide-gray-300 p-3"
                                        >
                                            <thead class="bg-gray-50 w-full">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="py-3.5 pr-3 pl-3 text-left text-base font-bold text-gray-900"
                                                    >
                                                        Name
                                                    </th>

                                                    <th
                                                        scope="col"
                                                        class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                    >
                                                        Email
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                    >
                                                        Avatar
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-3 py-3.5 text-left text-base font-bold text-gray-900"
                                                    >
                                                        Role
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
                                                        Date Time
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-3 w-[20%] py-3.5 text-center text-base font-bold text-gray-900"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200 bg-white w-full"
                                            >
                                                <tr
                                                    v-for="user in users.data"
                                                    :key="user.id"
                                                    :id="user.id"
                                                >
                                                    <td
                                                        class="min-w-[10%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                    >
                                                        {{ user.name }}
                                                    </td>

                                                    <td
                                                        class="min-w-[10%] whitespace-nowrap p-3 text-md text-gray-500"
                                                    >
                                                        {{ user.email }}
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap min-w-[10%] p-3 text-md text-gray-500"
                                                    >
                                                        <img
                                                            :src="user.avatar"
                                                            :alt="user.avatar"
                                                            class="w-16 h-16"
                                                        />
                                                    </td>
                                                    <td
                                                        class="min-w-[40%] whitespace-nowrap p-3 text-md text-gray-500"
                                                    >
                                                        <div
                                                            v-for="role in user.roles"
                                                            :key="role.id"
                                                            class="mr-2"
                                                        >
                                                            <font-awesome-icon
                                                                icon="fa-solid fa-user-shield"
                                                                class="text-blue-400"
                                                            />
                                                            {{ role.name }}
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="min-w-[10%] whitespace-nowrap p-3 text-md text-gray-500"
                                                    >
                                                        {{ user.status }}
                                                    </td>
                                                    <td
                                                        class="min-w-[10%] whitespace-nowrap p-3 text-md text-gray-500"
                                                    >
                                                        {{ user.created_at }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap min-w-[10%] max-w-[30%] text-right text-sm font-medium"
                                                    >
                                                        <div
                                                            class="flex justify-end flex-wrap gap-2 pr-3"
                                                        >
                                                            <div>
                                                                <Link
                                                                    :href="
                                                                        route(
                                                                            'user.show',
                                                                            user.id
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
                                                                    :href="
                                                                        route(
                                                                            'user.edit',
                                                                            user.id
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
                                                                v-if="
                                                                    user.isDeletable
                                                                "
                                                                :data="{
                                                                    id: user.id,
                                                                    model: 'user',
                                                                }"
                                                            ></DeleteForm>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot
                                                class="bg-gray-50 min-w-full"
                                                v-if="users.meta.last_page > 1"
                                            >
                                                <tr>
                                                    <td
                                                        colspan="16"
                                                        class="w-[100%]"
                                                    >
                                                        <Pagination
                                                            class="mt-6 dark:text-white flex justify-end p-3"
                                                            :meta="users.meta"
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
