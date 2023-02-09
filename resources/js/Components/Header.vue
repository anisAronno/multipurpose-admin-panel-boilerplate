<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Menu from "@/Components/Menu.vue";
import { useMenu } from "@/Composables/useMenu";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";

const { navigation } = useMenu();
</script>
<template>
    <Popover as="header" class="relative">
        <div
            class="bg-cyan-100 text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-6 pb-3"
        >
            <Menu :navigation="navigation"></Menu>
        </div>

        <transition
            enter-active-class="duration-150 ease-out"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="duration-100 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <PopoverPanel
                focus
                class="absolute inset-x-0 top-0 origin-top transform p-2 transition md:hidden"
            >
                <div
                    class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow-md ring-1 ring-black ring-opacity-5"
                >
                    <div class="flex items-center justify-between px-5 pt-4">
                        <div>
                            <ApplicationLogo
                                class="h-12 w-12"
                            ></ApplicationLogo>
                        </div>
                        <div class="-mr-2">
                            <PopoverButton
                                class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-600"
                            >
                                <span class="sr-only">Close menu</span>
                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                            </PopoverButton>
                        </div>
                    </div>
                    <div class="pt-5 pb-6">
                        <div class="space-y-1 px-2">
                            <Link
                                v-for="item in navigation"
                                :key="item.name"
                                :href="route(item.route)"
                                :class="
                                    route().current() == item.route
                                        ? 'block rounded-md px-3 py-2 text-base font-medium text-cyan-300   hover:text-cyan-600 underline decoration-cyan-300  underline-offset-4 '
                                        : 'block rounded-md px-3 py-2 text-base font-medium text-gray-900 dark:text-gray-50 hover:text-cyan-300 hover:underline hover:decoration-cyan-300  hover:underline-offset-4'
                                "
                            >
                                {{ item.name }}
                            </Link>
                        </div>
                        <div class="mt-6 px-5">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="block w-full rounded-md bg-gradient-to-r from-teal-500 to-cyan-600 py-3 px-4 text-center font-medium text-white shadow hover:from-teal-600 hover:to-cyan-700"
                                >Go Dashboard</Link
                            >
                            <Link
                                v-else
                                :href="route('login')"
                                class="block w-full rounded-md bg-gradient-to-r from-teal-500 to-cyan-600 py-3 px-4 text-center font-medium text-white shadow hover:from-teal-600 hover:to-cyan-700"
                                >Log in</Link
                            >
                        </div>
                    </div>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>
