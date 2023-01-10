<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from "@/Components/Textarea.vue";
import TextInput from "@/Components/TextInput.vue";
import Toggle from "@/Components/Toggle.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";

defineProps({
    roleArr: Object,
    ssoFieldsArr: Object,
    userDefaultStatus: Object,
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
    user_default_status: options.user_default_status,
    is_active_sso: options.is_active_sso,
    sso_fields: JSON.parse(options.sso_fields),
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
            class="mt-6 grid auto-cols-auto sm:grid-cols-2 gap-5 justify-between"
        >
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
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

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
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

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
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

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
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

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-xl"
                    for="organization_name"
                    value="Organization Name: "
                />

                <TextInput
                    id="organization_name"
                    type="text"
                    class="block w-full"
                    v-model="form.organization_name"
                    required
                    autocomplete="organization_name"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.organization_name"
                />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
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
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-xl"
                    for="user_default_status"
                    value="User Default Status:"
                />

                <select
                    name="user_default_status"
                    id="user_default_status"
                    class="block w-full form-controll"
                    v-model="form.user_default_status"
                    required
                >
                    <option
                        :value="status"
                        v-for="status in userDefaultStatus"
                        :key="status"
                        :class="
                            status === form.user_default_status ? 'selected' : ''
                        "
                    >
                        {{ status }}
                    </option>
                </select>

                <InputError
                    class="mt-2"
                    :message="form.errors.user_default_status"
                />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <div class="flex justify-between items-center">
                    <InputLabel
                        class="text-xl"
                        for="address"
                        value="Active Social Login: "
                    />
                    <Toggle v-model="form.is_active_sso"></Toggle>
                    <InputError
                        class="mt-2"
                        :message="form.errors.is_active_sso"
                    />
                </div>
                <div v-if="form.is_active_sso == true">
                    <InputLabel
                        class="text-xl block font-medium text-gray-700 mb-1"
                        for="user_default_role"
                        value="Select Social Login Provider :"
                    />
                    <Multiselect
                        v-model="form.sso_fields"
                        :options="ssoFieldsArr"
                        :selected="form.sso_fields"
                        placeholder="Pick some..."
                        class="block w-full multiselect-green form-controll dark:text-gray-900"
                        mode="tags"
                        :searchable="true"
                        :close-on-select="false"
                        id="sso_fields"
                    >
                    </Multiselect>

                    <InputError
                        :message="form.errors.sso_fields"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
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

            <div class="flex items-center justify-center gap-4 py-5 flex-auto">
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

<style src="@vueform/multiselect/themes/default.css"></style>
