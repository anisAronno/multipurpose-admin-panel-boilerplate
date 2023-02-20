<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextArea from "@/Components/TextArea.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const options = usePage().props.global.options;

const form = useForm({
    site_name: options.site_name,
    site_title: options.site_title,
    address: options.address,
    email: options.email,
    phone: options.phone,
    organization_name: options.organization_name,
    map: options.map,
    facebook_url: options.facebook_url,
    instagram_url: options.instagram_url,
    twitter_url: options.twitter_url,
    youtube_channel_url: options.youtube_channel_url,
    linkedin_url: options.linkedin_url,
    github_url: options.github_url,
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
            @submit.prevent="form.patch(route('admin.option.bulk.update'))"
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
                <InputLabel class="text-xl" for="address" value="Address: " />

                <TextArea
                    id="address"
                    type="text"
                    class="block w-full"
                    v-model="form.address"
                    required
                    autocomplete="address"
                />

                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div
                v-can="'options.create'"
                class="flex items-center justify-center gap-4 py-5 sm:py-10 flex-auto col-span-full"
            >
                <PrimaryButton
                    class="btn btn-primary w-32 h-12 sm:w-40 sm:h-14 sm:text-xl"
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
