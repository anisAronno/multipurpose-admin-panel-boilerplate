<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from "@/Components/Textarea.vue";
import TextInput from "@/Components/TextInput.vue";
import Toggle from "@/Components/Toggle.vue";
import { useCountries, useLanguage } from "@/composables/useCountries";
import defaultFile from "@/Stores/defaultFile";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";

const { userCountry, timeZoneList, userTimeZone, countries, countryWithCode } =
    useCountries();

defineProps({
    roleArr: Object,
    socialLoginFields: Object,
    userDefaultStatus: Object,
});

const options = usePage().props.value.global.options;

const languageArray = useLanguage(options.existing_language_file);

const form = useForm({
    site_name: options.site_name,
    site_title: options.site_title,
    site_url: options.site_url,
    address: options.address,
    email: options.email,
    phone: options.phone,
    time_zone: options.time_zone,
    language: options.language,
    languageArray: languageArray,
    user_default_role: options.user_default_role,
    any_one_can_register: options.any_one_can_register,
    pagination_limit: options.pagination_limit,
    organization_name: options.organization_name,
    user_default_status: options.user_default_status,
    collect_user_location: options.collect_user_location,
    allow_social_login: options.allow_social_login,
    social_login_fields: JSON.parse(options.social_login_fields || [""]),
    map: options.map,
    facebook_url: options.facebook_url,
    instagram_url: options.instagram_url,
    twitter_url: options.twitter_url,
    youtube_channel_url: options.youtube_channel_url,
    linkedin_url: options.linkedin_url,
    github_URL: options.github_URL,
});
</script>

<template>
    <section class="relative">
        <header class="text-center sm:text-left">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Site Settings
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400">
                Change Your Web Site Details
            </p>
        </header>
        <form
            @submit.prevent="form.patch(route('admin.options.bulk.update'))"
            class="mt-6 grid auto-cols-auto sm:grid-cols-2 gap-5 justify-between "
        >
            <div class="absolute right-0 top-0 hidden sm:block">
                <div
                class="flex items-center justify-center gap-4 md:py-5 sm:py-10 flex-auto col-span-full "
            >
                <PrimaryButton
                    class="btn btn-primary w-32 h-12 sm:w-40 sm:h-12 sm:text-lg"
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
            </div>
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
            <div
                class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full flex justify-between items-center"
            >
                <InputLabel
                    class="text-xl"
                    for="any_one_can_register"
                    value="Any One Can Register? :"
                />

                <Toggle
                    id="any_one_can_register"
                    v-model="form.any_one_can_register"
                ></Toggle>
                <InputError
                    class="mt-2"
                    :message="form.errors.any_one_can_register"
                />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-xl"
                    for="user_default_role"
                    value="User Default Role:"
                />

                <Multiselect
                    v-model="form.user_default_role"
                    :options="roleArr"
                    :selected="form.user_default_role"
                    placeholder="Pick some..."
                    class="block w-full multiselect-green form-controll dark:text-black"
                    :searchable="true"
                    :classes="{
                        search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                        singleLabelText:
                            '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                    }"
                    id="user_default_role"
                >
                </Multiselect>
                <InputError
                    class="mt-2"
                    :message="form.errors.user_default_role"
                />
            </div>
            <div
                class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full flex justify-between items-center"
            >
                <InputLabel
                    class="text-xl"
                    for="collect_user_location"
                    value="Collect User Location:"
                />

                <Toggle
                    id="collect_user_location"
                    v-model="form.collect_user_location"
                ></Toggle>
                <InputError
                    class="mt-2"
                    :message="form.errors.collect_user_location"
                />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-xl"
                    for="user_default_status"
                    value="User Default Status:"
                />

                <Multiselect
                    v-model="form.user_default_status"
                    :options="userDefaultStatus"
                    :selected="form.user_default_status"
                    placeholder="Pick some..."
                    class="block w-full multiselect-green form-controll dark:text-black"
                    :searchable="true"
                    :classes="{
                        search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                        singleLabelText:
                            '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                    }"
                    id="user_default_status"
                >
                </Multiselect>

                <InputError
                    class="mt-2"
                    :message="form.errors.user_default_status"
                />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <div class="flex justify-between items-center">
                    <InputLabel
                        class="text-xl"
                        for="allow_social_login"
                        value="Active Social Login: "
                    />
                    <Toggle
                        id="allow_social_login"
                        v-model="form.allow_social_login"
                    ></Toggle>
                    <InputError
                        class="mt-2"
                        :message="form.errors.allow_social_login"
                    />
                </div>
                <div v-if="form.allow_social_login == true">
                    <InputLabel
                        class="text-xl block font-medium text-gray-700 mb-1"
                        for="social_login_fields"
                        value="Select Social Login Provider :"
                    />
                    <Multiselect
                        v-model="form.social_login_fields"
                        :options="socialLoginFields"
                        :selected="form.social_login_fields"
                        placeholder="Pick some..."
                        class="block w-full multiselect-green form-controll dark:text-gray-900"
                        mode="tags"
                        :searchable="true"
                        :close-on-select="false"
                        id="social_login_fields"
                    >
                    </Multiselect>

                    <InputError
                        :message="form.errors.social_login_fields"
                        class="mt-2 col-start-2 col-span-4"
                    />
                </div>
                {{ form.map }}
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-xl block font-medium text-gray-700 mb-1"
                    for="time_zone"
                    value="Select Time Zone :"
                />
                <Multiselect
                    v-model="form.time_zone"
                    :options="timeZoneList"
                    :selected="form.time_zone"
                    placeholder="Pick some..."
                    class="block w-full multiselect-green form-controll dark:text-black"
                    :searchable="true"
                    :classes="{
                        search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                        singleLabelText:
                            '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                    }"
                    id="time_zone"
                >
                </Multiselect>

                <InputError
                    :message="form.errors.time_zone"
                    class="mt-2 col-start-2 col-span-4"
                />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <div class="flex justify-between items-center">
                    <InputLabel
                        class="text-xl"
                        for="languages"
                        value="Application Default Language:"
                    />
                    <a
                        target="_blank"
                        :href="`${defaultFile.site_url}/languages`"
                        class="text-blue-500 underline underline-offset-4 decoration-slate-500 animate-pulse"
                        >Go For Translation
                    </a>
                </div>

                <Multiselect
                    v-model="form.language"
                    :options="form.languageArray"
                    :selected="form.language"
                    placeholder="Pick some..."
                    class="block w-full multiselect-green form-controll dark:text-black"
                    :searchable="true"
                    :classes="{
                        search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                        singleLabelText:
                            '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                    }"
                    id="language"
                >
                </Multiselect>
                <InputError class="mt-2" :message="form.errors.language" />
            </div>

            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="map"
                    value="Organization Google Map Location: "
                />

                <TextInput
                    id="map"
                    type="text"
                    class="block w-full"
                    v-model="form.map"
                    required
                    autocomplete="map"
                />

                <InputError class="mt-2" :message="form.errors.map" />
            </div>

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
                    required
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
                    required
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
                    required
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
                    required
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
                    required
                    autocomplete="linkedin_url"
                />

                <InputError class="mt-2" :message="form.errors.linkedin_url" />
            </div>
            <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                <InputLabel
                    class="text-md sm:text-lg lg:text-xl"
                    for="github_URL"
                    value="Github Link: "
                />

                <TextInput
                    id="github_URL"
                    type="text"
                    class="block w-full"
                    v-model="form.github_URL"
                    required
                    autocomplete="github_URL"
                />

                <InputError class="mt-2" :message="form.errors.github_URL" />
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

<style src="@vueform/multiselect/themes/default.css"></style>
