<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

const options = usePage().props.value.global.options;

const form = useForm({
    facebook_url: options.facebook_url,
    instagram_url: options.instagram_url,
    twitter_url: options.twitter_url,
    youtube_channel_url: options.youtube_channel_url,
    linkedin_url: options.linkedin_url,
    github_url: options.github_url,
});
</script>

<template>
    <section class="relative">
        <header class="text-center sm:text-left">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Social Settings
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
                    class="text-md sm:text-lg lg:text-xl"
                    for="facebook_url"
                    value="Facebook Link: "
                />

                <TextInput
                    id="facebook_url"
                    type="text"
                    class="block w-full"
                    v-model="form.facebook_url"
                    autocomplete="facebook_url"
                />

                <InputError class="mt-2" :message="form.errors.facebook_url" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="instagram_url"
                    value="Instagram Link: "
                />

                <TextInput
                    id="instagram_url"
                    type="text"
                    class="block w-full"
                    v-model="form.instagram_url"
                    autocomplete="instagram_url"
                />

                <InputError class="mt-2" :message="form.errors.instagram_url" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="twitter_url"
                    value="Twitter Link: "
                />

                <TextInput
                    id="twitter_url"
                    type="text"
                    class="block w-full"
                    v-model="form.twitter_url"
                    autocomplete="twitter_url"
                />

                <InputError class="mt-2" :message="form.errors.twitter_url" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="youtube_channel_url"
                    value="Youtube Channel Link: "
                />

                <TextInput
                    id="youtube_channel_url"
                    type="text"
                    class="block w-full"
                    v-model="form.youtube_channel_url"
                    autocomplete="youtube_channel_url"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.youtube_channel_url"
                />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="linkedin_url"
                    value="Linkedin Link: "
                />

                <TextInput
                    id="linkedin_url"
                    type="text"
                    class="block w-full"
                    v-model="form.linkedin_url"
                    autocomplete="linkedin_url"
                />

                <InputError class="mt-2" :message="form.errors.linkedin_url" />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="github_url"
                    value="Github Link: "
                />

                <TextInput
                    id="github_url"
                    type="text"
                    class="block w-full"
                    v-model="form.github_url"
                    autocomplete="github_url"
                />

                <InputError class="mt-2" :message="form.errors.github_url" />
            </div>

            <div
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
