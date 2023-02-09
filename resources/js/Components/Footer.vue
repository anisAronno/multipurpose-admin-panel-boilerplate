<script setup>
import { useMenu } from "@/Composables/useMenu";
import { useSocial } from "@/Composables/useSocial";
import { usePage } from "@inertiajs/inertia-vue3";

const { navigation } = useMenu();
const { socialLink } = useSocial();
const page = usePage();

const socialUrls = {
    facebook: page.props.value.global.options.facebook_url,
    github: page.props.value.global.options.github_url,
    instagram: page.props.value.global.options.instagram_url,
    linkedin: page.props.value.global.options.linkedin_url,
    twitter: page.props.value.global.options.twitter_url,
    youtube: page.props.value.global.options.youtube_channel_url,
};

const updatedSocials = socialLink.map((social) => {
    const url = socialUrls[social.name.toLowerCase()];
    return url ? { ...social, href: url } : social;
});
</script>

<template>
    <footer>
        <div
            class="mx-auto w-full overflow-hidden py-20 px-6 sm:py-24 lg:px-8 bg-cyan-100 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <nav
                class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12 "
                aria-label="Footer"
            >
                <div v-for="item in navigation" :key="item.name" class="pb-6">
                    <Link
                        :href="item.route"
                        class="text-sm leading-6 text-gray-800 dark:text-gray-600 hover:text-gray-900 dark:hover:text-gray-50"
                        >{{ item.name }}</Link
                    >
                </div>
            </nav>
            <div class="mt-10 flex justify-center space-x-10">
                <a
                    target="_blank"
                    v-for="item in updatedSocials"
                    :key="item.name"
                    :href="item.href"
                    class="text-gray-500 hover:text-gray-400 dark:hover:text-gray-200"
                >
                    <span class="sr-only">{{ item.name }}</span>
                    <component
                        :is="item.icon"
                        class="h-6 w-6"
                        aria-hidden="true"
                    />
                </a>
            </div>
            <p class="mt-10 text-center text-md leading-5 text-gray-600 dark:text-gray-400">
                &copy; {{ currentYear }}
                {{ $page.props.global.options.organization_name }}.
                {{ __("footer.copyright.text") }}
            </p>
            <p class="text-center text-sm mt-3 leading-5 text-gray-500 ">
                {{ __("footer.design.developed_by") }}
                <a
                    class="text-md text-blue-600"
                    target="_blank"
                    href="https://anichur.com"
                    >Anichur Rahaman</a
                >
            </p>
        </div>
    </footer>
</template>
