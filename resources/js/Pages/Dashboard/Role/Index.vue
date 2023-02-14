<script setup>
import DeleteForm from "@/Components/DeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import Search from "@/Components/Search.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
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
                Roles
            </h2>
        </template>

        <div class="py-12 dark:text-white">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
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
                            <div
                                class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"
                            >
                                <Link
                                    :href="route('admin.role.create')"
                                    class="btn btn-primary"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-circle-plus"
                                        class="mr-1"
                                    />
                                    Create New
                                </Link>
                                <Link
                                    :href="route('admin.role.index')"
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
                                        v-if="roles.data.length > 0"
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
                                                        Name
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
                                                        Date Time
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-3 py-3.5 text-center text-base font-bold text-gray-900"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200 bg-white"
                                                v-if="roles.data.length > 0"
                                            >
                                                <tr
                                                    v-for="role in roles.data"
                                                    :key="role.id"
                                                    :id="role.id"
                                                >
                                                    <td
                                                        class="w-[15%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"
                                                    >
                                                        {{ role.name }}
                                                    </td>

                                                    <td
                                                        class="w-60% whitespace-normal p-3 text-md text-gray-500 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4"
                                                    >
                                                        <p
                                                            v-for="permission in role.permissions"
                                                            :key="permission.id"
                                                            class="mr-2"
                                                        >
                                                            <font-awesome-icon
                                                                icon="fa-solid fa-user-shield"
                                                                class="text-blue-400"
                                                            />
                                                            {{
                                                                permission.name
                                                            }}
                                                        </p>
                                                    </td>
                                                    <td
                                                        class="w-[15%] text-left p-4 text-gray-900"
                                                    >
                                                        {{ role.created_at }}
                                                    </td>
                                                    <td
                                                        class="w-[10%] whitespace-nowrap text-right text-sm font-medium"
                                                    >
                                                        <div
                                                            class="flex justify-end flex-wrap gap-2 pr-3"
                                                        >
                                                            <div>
                                                                <Link
                                                                    :href="
                                                                        route(
                                                                            'admin.role.show',
                                                                            role.id
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

                                                            <div
                                                                v-if="
                                                                    role.isEditable
                                                                "
                                                            >
                                                                <Link
                                                                    :href="
                                                                        route(
                                                                            'admin.role.edit',
                                                                            role.id
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
                                                                    role.isDeletable
                                                                "
                                                                :data="{
                                                                    id: role.id,
                                                                    model: 'role',
                                                                }"
                                                            ></DeleteForm>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="bg-gray-50">
                                                <tr>
                                                    <td
                                                        colspan="4"
                                                        class="w-[100%]"
                                                    >
                                                        <Pagination
                                                            v-if="
                                                                roles.last_page >
                                                                1
                                                            "
                                                            class="mt-6 dark:text-white flex justify-end p-3"
                                                            :links="roles.links"
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
