<script setup>
import DarkMode from "@/Components/DarkMode.vue";
import SelectLanguage from "@/Components/SelectLanguage.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";

defineProps({
    isOpenSidebar: Boolean,
});
</script>

<template>
    <div
        class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <button
                            @click="$emit('toggleMenu', true)"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        'md:hidden': isOpenSidebar,
                                        'inline-flex': !isOpenSidebar,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        'md:hidden': !isOpenSidebar,
                                        'inline-flex': isOpenSidebar,
                                    }"
                                    class="hidden md:block"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :href="route('home')" :active="true">
                            Visit website
                        </NavLink>
                    </div>
                    <div class="sm:space-y-5 ml-5 space-x-8">
                        <select-language />
                    </div>
                </div>

                <div class="flex items-center sm:ml-6 justify-center">
                    <DarkMode></DarkMode>
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-1 md:px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-800 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 capitalize"
                                    >
                                        <img
                                            :src="$page.props.auth.user.avatar"
                                            :alt="$page.props.auth.user.name"
                                            class="w-8 h-8 rounded-full mr-1 md:mr-2"
                                        />
                                        <span class="hidden md:block">{{
                                            $page.props.auth.user.name
                                        }}</span>

                                        <svg
                                            class=":ml-2 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
