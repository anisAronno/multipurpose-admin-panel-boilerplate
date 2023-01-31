<script setup>
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const firstNameInput = ref(null);
const lastNameInput = ref(null);
const emailInput = ref(null);
const phoneInput = ref(null);
const subjectInput = ref(null);
const messageInput = ref(null);

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
});

const storeContact = () => {
    form.post(route("contact.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.first_name) {
                firstNameInput.value.focus();
            }
            if (form.errors.last_name) {
                lastNameInput.value.focus();
            }
            if (form.errors.email) {
                emailInput.value.focus();
            }
            if (form.errors.phone) {
                phoneInput.value.focus();
            }
            if (form.errors.subject) {
                subjectInput.value.focus();
            }
            if (form.errors.message) {
                messageInput.value.focus();
            }
        },
    });
};
</script>
<template>
    <div class="py-10 px-6 sm:px-10 lg:col-span-2 xl:p-12">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-50">
            {{ __("contact.form.title") }}
        </h3>
        <form
            @submit.prevent="storeContact"
            method="POST"
            class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8"
        >
            <div>
                <label
                    for="first-name"
                    class="block text-sm font-medium text-gray-900 dark:text-gray-50"
                    >{{ __("contact.form.first_name") }}</label
                >
                <div class="mt-1">
                    <input
                        type="text"
                        name="first-name"
                        id="first-name"
                        ref="firstNameInput"
                        v-model="form.first_name"
                        autocomplete="given-first_name"
                        class="block w-full rounded-md border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                    />
                    <InputError
                        :message="form.errors.first_name"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div>
                <div class="flex justify-between">
                    <label
                        for="last-name"
                        class="block text-sm font-medium text-gray-900 dark:text-gray-50"
                        >{{ __("contact.form.last_name") }}</label
                    >
                    <span
                        id="last-name-optional"
                        class="text-sm text-gray-500 dark:text-gray-300"
                        >{{ __("contact.form.last_name_optional") }}</span
                    >
                </div>

                <div class="mt-1">
                    <input
                        type="text"
                        name="last-name"
                        id="last-name"
                        ref="lastNameInput"
                        v-model="form.last_name"
                        autocomplete="family-last_name"
                        class="block w-full rounded-md border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                    />
                    <InputError
                        :message="form.errors.last_name"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-900 dark:text-gray-50"
                    >{{ __("contact.form.email") }}</label
                >
                <div class="mt-1">
                    <input
                        id="email"
                        name="email"
                        type="email"
                        ref="emailInput"
                        v-model="form.email"
                        autocomplete="email"
                        class="block w-full rounded-md border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                    />
                    <InputError
                        :message="form.errors.email"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div>
                <div class="flex justify-between">
                    <label
                        for="phone"
                        class="block text-sm font-medium text-gray-900 dark:text-gray-50"
                        >{{ __("contact.form.phone") }}</label
                    >
                    <span
                        id="phone-optional"
                        class="text-sm text-gray-500 dark:text-gray-300"
                        >{{ __("contact.form.phone_optional") }}</span
                    >
                </div>
                <div class="mt-1">
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        ref="phoneInput"
                        v-model="form.phone"
                        autocomplete="tel"
                        class="block w-full rounded-md border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                        aria-describedby="phone-optional"
                    />
                    <InputError
                        :message="form.errors.phone"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div class="sm:col-span-2">
                <label
                    for="subject"
                    class="block text-sm font-medium text-gray-900 dark:text-gray-50"
                    >{{ __("contact.form.subject") }}</label
                >
                <div class="mt-1">
                    <input
                        type="text"
                        name="subject"
                        id="subject"
                        ref="subjectInput"
                        v-model="form.subject"
                        class="block w-full rounded-md border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                    />
                    <InputError
                        :message="form.errors.subject"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div class="sm:col-span-2">
                <div class="flex justify-between">
                    <label
                        for="message"
                        class="block text-sm font-medium text-gray-900 dark:text-gray-50"
                        >{{ __("contact.form.message") }}</label
                    >
                    <span
                        id="message-max"
                        class="text-sm text-gray-500 dark:text-gray-300"
                        >{{ __("contact.form.subject_taxt_max") }}</span
                    >
                </div>
                <div class="mt-1">
                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        ref="messageInput"
                        v-model="form.message"
                        class="block w-full rounded-md border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
                        aria-describedby="message-max"
                    />
                    <InputError
                        :message="form.errors.message"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div class="sm:col-span-2 sm:flex sm:justify-end">
                <button
                    type="submit"
                    class="mt-2 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-cyan-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 sm:w-auto"
                >
                    {{ __("contact.form.submit") }}
                </button>
            </div>
        </form>
    </div>
</template>
