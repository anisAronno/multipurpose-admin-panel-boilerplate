<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import EditRoleForm from "@/Pages/Role/Partials/EditRoleForm.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    permissionWithGroup: Object,
    permissions: Object,
    all_group: Object,
    total_permissions: String,
    total_group: String,
    role: Object,
});
</script>

<template>
    <Head title="Role" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Role Edit
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
                                Create Role
                            </h1>
                            <p
                                class="mt-2 text-sm text-gray-700 dark:text-white"
                            >
                                Create a new roles with permission.
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link
                                :href="route('role.view')"
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
                    <edit-role-form
                        :permissionWithGroup="permissionWithGroup"
                        :permissions="permissions"
                        :all_group="all_group"
                        :total_permissions="total_permissions"
                        :total_group="total_group"
                        :role="role"
                    ></edit-role-form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
