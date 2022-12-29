<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    roles: Object,
});
</script>

<template>
    <Head title="Role" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Profile
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
                                    Roles
                                </h1>
                                <p
                                    class="mt-2 text-sm text-gray-700 dark:text-white"
                                >
                                    A list of all the Roles.
                                </p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <button
                                    type="button"
                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                >
                                    Add Role
                                </button>
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
                                            class="min-w-full table-compact divide-y divide-gray-300 p-3"
                                        >
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="py-3.5 pr-3 pl-3 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Name
                                                    </th>

                                                    <th
                                                        scope="col"
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Role
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                    >
                                                        <span class="sr-only"
                                                            >Edit</span
                                                        >
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200 bg-white"
                                            >
                                                <tr
                                                    v-for="role in roles.data"
                                                    :key="role.id"
                                                >
                                                    <td
                                                        class="min-w-[8rem] whitespace-nowrap py-4 pr-3 pl-3 text-sm font-medium text-gray-900"
                                                    >
                                                        {{ role.name }}
                                                    </td>

                                                    <td
                                                        class="min-w-[8rem] max-w-16rem] whitespace-normal px-3 py-4 text-sm text-gray-500 p-2 flex flex-wrap"
                                                    >
                                                        <p
                                                            v-for="permission in role.permissions"
                                                            :key="permission.id"
                                                            class="mr-2"
                                                        >
                                                            <font-awesome-icon
                                                                icon="fa-solid fa-user-shield"
                                                                class="text-green-500"
                                                            />
                                                            {{
                                                                permission.name
                                                            }}
                                                        </p>
                                                    </td>
                                                    <td
                                                        class="min-w-[8rem] whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                                    >
                                                        <a
                                                            href="#"
                                                            class="text-indigo-600 hover:text-indigo-900 mr-2"
                                                            >Edit
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="text-indigo-600 hover:text-indigo-900"
                                                            >Delete
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- More people... -->
                                            </tbody>
                                        </table>
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
