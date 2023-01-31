<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __("verify_email.heading") }}
        </div>

        <div
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
            v-if="verificationLinkSent"
        >
            {{ __("verify_email.message") }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ __("verify_email.resend_link") }}
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >{{ __("verify_email.log_out", `Log out`) }}</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
