<script setup>
import { useSocial } from "@/composables/useSocial.js";
import { usePage } from "@inertiajs/inertia-vue3";

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

const updatedSocials = socialLink.filter(social => {
  const url = socialUrls[social.name.toLowerCase()]; 
  if (!url || url === '#') {
    return false;
  } 
  const regex = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/i;
  return regex.test(url);
}).map(social => {
  const url = socialUrls[social.name.toLowerCase()];
  return { ...social, href: url };
});

</script>

<template> 
    <div class="mt-10 flex justify-center space-x-5 lg:space-x-7 2xl:space-x-10">
        <a
            target="_blank"
            v-for="item in updatedSocials"
            :key="item.name"
            :href="item.href"
            class="text-gray-300 hover:text-gray-400 dark:hover:text-gray-200"
        >
            <span class="sr-only">{{ item.name }}</span>
            <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
        </a>
    </div>
</template>
