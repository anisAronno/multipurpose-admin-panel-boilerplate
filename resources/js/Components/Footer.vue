<script setup>
import { useMenu } from "@/Composables/useMenu";
import SocialLink from "@/Components/SocialLink.vue"; 

const { navigation } = useMenu();
 
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
            <SocialLink></SocialLink>
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
