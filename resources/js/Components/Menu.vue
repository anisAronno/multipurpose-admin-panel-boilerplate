<script setup>
import DarkMode from "@/Components/DarkMode.vue";
import { PopoverButton } from "@headlessui/vue";
import { Bars3Icon } from "@heroicons/vue/24/outline";
defineProps({
    navigation: Object,
});
</script>
<template>
    <nav
        class="relative mx-auto flex max-w-full items-center justify-between px-6"
        aria-label="Global"
    >
        <div class="flex flex-1 items-center">
            <div class="flex w-full items-center justify-between md:w-auto">
                <Link :href="route('home')">
                    <span class="sr-only">Your Company</span>
                    <img
                        class="h-8 w-auto sm:h-10"
                        :src="$page.props.global.options.logo"
                        :alt="$page.props.global.options.site_name"
                    />
                </Link>
                <DarkMode class="mx-2 md:hidden"></DarkMode>
                <div class="-mr-2 flex items-center md:hidden">
                    <PopoverButton
                        class="focus-ring-inset inline-flex items-center justify-center rounded-md bg-gray-900 p-2 text-gray-400 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-white"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                </div>
            </div>

            <div class="hidden space-x-8 md:ml-10 md:flex">
                <Link
                    v-for="item in navigation"
                    :key="item.name"
                    :href="route(item.route)"
                    :class="
                        route().current() == item.route
                            ? 'text-base font-medium text-cyan-300    hover:text-cyan-600 underline decoration-cyan-300  underline-offset-4 '
                            : 'text-base font-medium   hover:text-cyan-300 hover:underline hover:decoration-cyan-300  hover:underline-offset-4 '
                    "
                >
                    {{ item.name }}
                </Link>
            </div>
        </div>

        <DarkMode class="mx-2 hidden md:block"></DarkMode>
        <div
            class="hidden md:flex md:items-center md:space-x-6"
            v-if="$page.props.auth.user"
        >
            <Link
                :href="route('dashboard')"
                class="text-base font-medium hover:text-gray-800 dark:hover:text-gray-300 hover:scale-105"
                >Dashboard</Link
            >
        </div>
        <div v-else class="hidden md:flex md:items-center md:space-x-6">
            <Link
                :href="route('login')"
                class="text-base font-medium hover:text-gray-800 dark:hover:text-gray-300 hover:scale-105"
                >Log in</Link
            >
            <Link
                v-if="$page.props.global.options.any_one_can_register == true"
                :href="route('register')"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-gray-100 hover:bg-gray-700"
                >Registration</Link
            >
        </div>
    </nav>
</template>
