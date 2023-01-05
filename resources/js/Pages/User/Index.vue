<script setup>
import DeleteForm from "@/Components/DeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { watch } from "vue";
defineProps({
    users: Object,
});

const form = useForm({
    search: "",
});

watch(
    () => form.search,
    (val) => {
        searchHandaler();
    }
);

const searchHandaler = () => {
    form.get(route("user.index"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.search) {
                searchInput.value.focus();
            }
        },
    });
};
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
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
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
                                        class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900"
                                    >
                                        <div>
                                            <!-- Action Item Here -->
                                        </div>
                                        <label
                                            for="table-search"
                                            class="sr-only"
                                            >Search</label
                                        >
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                            >
                                                <svg
                                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <input
                                                type="text"
                                                id="table-search-users"
                                                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Search for users"
                                                v-model.lazy="form.search"
                                                ref="searchInput"
                                            />
                                        </div>
                                    </div>
                                    <div
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
                                                                    user.id != 1
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
                                                v-if="users.last_page > 1"
                                            >
                                                <tr>
                                                    <td
                                                        colspan="7"
                                                        class="w-[100%]"
                                                    >
                                                        <Pagination
                                                            v-if="
                                                                users.last_page >
                                                                1
                                                            "
                                                            class="mt-6 dark:text-white flex justify-end p-3"
                                                            :links="users.links"
                                                        ></Pagination>
                                                    </td>
                                                </tr>
                                            </tfoot>
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
