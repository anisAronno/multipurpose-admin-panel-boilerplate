<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from "@/Components/Textarea.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

defineProps({
    roleArr: Object,
});

const options = usePage().props.value.global.options;

const form = useForm({
    site_name: options.site_name,
    site_title: options.site_title,
    site_url: options.site_url,
    address: options.address,
    email: options.email,
    phone: options.phone,
    time_zone: options.time_zone,
    user_default_role: options.user_default_role,
    any_one_can_register: options.any_one_can_register,
    pagination_limit: options.pagination_limit,
    organization_name: options.organization_name,
});
</script>

<template>
    <section>
        <header class="text-center sm:text-left">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Site Settings
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400">
                Change Your Web Site Details
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('options.bulk.update'))"
            class="mt-6 grid auto-cols-auto sm:grid-cols-2 gap-5 justify-center"
        >
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel
                    class="text-xl"
                    for="site_name"
                    value="Site Name:"
                />

                <TextInput
                    id="site_name"
                    type="text"
                    class="block w-full"
                    v-model="form.site_name"
                    required
                    autofocus
                    autocomplete="site_name"
                />

                <InputError class="mt-2" :message="form.errors.site_name" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel
                    class="text-xl"
                    for="site_title"
                    value="Site Title:"
                />
                <TextInput
                    id="site_title"
                    type="text"
                    class="block w-full"
                    v-model="form.site_title"
                    required
                    autocomplete="site_title"
                />

                <InputError class="mt-2" :message="form.errors.site_title" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel class="text-xl" for="email" value="Email:" />

                <TextInput
                    id="email"
                    type="email"
                    class="block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel class="text-xl" for="phone" value="Phone:" />

                <TextInput
                    id="phone"
                    type="text"
                    class="block w-full"
                    v-model="form.phone"
                    required
                    autocomplete="phone"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel class="text-xl" for="organization_name" value="Organization Name: " />

                <TextInput
                    id="organization_name"
                    type="text"
                    class="block w-full"
                    v-model="form.organization_name"
                    required
                    autocomplete="organization_name"
                />

                <InputError class="mt-2" :message="form.errors.organization_name" />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel
                    class="text-xl"
                    for="user_default_role"
                    value="User Default Role:"
                />

                <select
                    name="user_default_role"
                    id="user_default_role"
                    class="block w-full form-controll"
                    v-model="form.user_default_role"
                    required
                >
                    <option
                        :value="role"
                        v-for="role in roleArr"
                        :key="role"
                        :class="
                            role === form.user_default_role ? 'selected' : ''
                        "
                    >
                        {{ role }}
                    </option>
                </select>

                <InputError
                    class="mt-2"
                    :message="form.errors.user_default_role"
                />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-80 ">
                <InputLabel class="text-xl" for="address" value="Address: " />

                <Textarea
                    id="address"
                    type="text"
                    class="block w-full"
                    v-model="form.address"
                    required
                    autocomplete="address"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-center gap-4 py-5">
                <PrimaryButton
                    class="btn btn-primary w-32 h-12"
                    :disabled="form.processing"
                    >Update</PrimaryButton
                >

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
