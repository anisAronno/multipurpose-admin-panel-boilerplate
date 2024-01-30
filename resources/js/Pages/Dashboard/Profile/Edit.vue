<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Address from "@/Pages/Dashboard/Profile/Partials/Address.vue";
import DeleteUserForm from "@/Pages/Dashboard/Profile/Partials/DeleteUserForm.vue";
import ProfilePicture from "@/Pages/Dashboard/Profile/Partials/ProfilePicture.vue";
import UpdatePasswordForm from "@/Pages/Dashboard/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Dashboard/Profile/Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    genderArr: Object,
    addresses: Object,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <ProfilePicture
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-full"
                    />
                </div>

                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        :genderArr="genderArr"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <Address
                        class="max-w-full min-w-full"
                        :addresses="addresses"
                    />
                </div>
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                    v-if="$page.props.auth.user.isDeletable"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
