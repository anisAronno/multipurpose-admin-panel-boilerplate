<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditUserForm from "@/Pages/User/Partials/EditUserForm.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    user: Object,
    roleArr: Object,
    statusArr: Object,
});
</script>

<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit User
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
                                Edit User
                            </h1>
                            <p
                                class="mt-2 text-sm text-gray-700 dark:text-white"
                            >
                                Edit a new users with roles.
                            </p>
                        </div>
                        <div
                            class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-2"
                        >
                            <Link
                                :href="route('user.show', user.id)"
                                class="btn btn-primary"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-eye"
                                    class="mr-1"
                                />
                                Back
                            </Link>
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
                    <EditUserForm
                        :user="user"
                        :roleArr="roleArr"
                        :statusArr="statusArr"
                    ></EditUserForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
