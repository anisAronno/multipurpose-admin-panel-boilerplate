<script setup>
import { useMenu } from "@/composables/useMenu";

const { navigation, socialLink } = useMenu();
</script>

<template>
    <footer class="bg-white">
        <div
            class="mx-auto max-w-7xl overflow-hidden py-20 px-6 sm:py-24 lg:px-8 bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <nav
                class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12"
                aria-label="Footer"
            >
                <div v-for="item in navigation" :key="item.name" class="pb-6">
                    <Link
                        :href="item.route"
                        class="text-sm leading-6 text-gray-600 hover:text-gray-900"
                        >{{ item.name }}</Link
                    >
                </div>
            </nav>
            <div class="mt-10 flex justify-center space-x-10">
                <a
                    v-for="item in socialLink"
                    :key="item.name"
                    :href="item.href"
                    class="text-gray-400 hover:text-gray-500"
                >
                    <span class="sr-only">{{ item.name }}</span>
                    <component
                        :is="item.icon"
                        class="h-6 w-6"
                        aria-hidden="true"
                    />
                </a>
            </div>
            <p class="mt-10 text-center text-md leading-5 text-gray-500">
                &copy; {{ currentYear }}
                {{ $page.props.global.options.organization_name }}.
                {{ __("copyright.text", "All rights reserved.") }}
            </p>
            <p class="text-center text-sm mt-3 leading-5 text-gray-500">
                {{ __("design.developed.by", "Design & Developed By") }}
                <a
                    class="text-lg text-blue-600"
                    target="_blank"
                    href="https://anichur.com"
                    >Anichur Rahaman</a
                >
            </p>
        </div>
    </footer>
</template>
