<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    ChevronDoubleDownIcon,
    ChevronDoubleRightIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";
defineProps({
    navigation: Object,
    sidebarOpen: Boolean,
});
</script>
<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog
            as="div"
            class="relative z-40 md:hidden"
            @close="$emit('toggleMobileMenu', false)"
            @blur="sidebarOpen != true"
            tabindex="-1"
        >
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
            </TransitionChild>

            <div class="fixed inset-0 z-40 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <DialogPanel
                        class="relative flex w-full max-w-xs flex-1 flex-col bg-gray-200 dark:bg-gray-700 pt-5 pb-4"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    type="button"
                                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="$emit('toggleMobileMenu', false)"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex flex-shrink-0 items-center px-4">
                            <ApplicationLogo class="h-8 auto"></ApplicationLogo>
                        </div>

                        <div class="mt-5 h-0 flex-1 overflow-y-auto">
                            <nav class="space-y-1 px-2">
                                <div
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :class="[
                                        item.current
                                            ? 'dark:bg-gray-600 dark:text-white bg-gray-300 text-gray-900 p-0.5 rounded-sm'
                                            : '',
                                    ]"
                                    class="relative"
                                    @click="$emit('toggleSidebar', item)"
                                >
                                    <Link
                                        v-can="item.permission"
                                        :href="route(item.route)"
                                        :class="[
                                            item.current
                                                ? 'dark:bg-gray-800 dark:text-white bg-gray-400 text-gray-900'
                                                : 'dark:text-gray-100 text-gray-900 dark:hover:bg-gray-600 hover:bg-slate-400',
                                            'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                                        ]"
                                    >
                                        <component
                                            :is="item.icon"
                                            class="mr-3 h-6 w-6 flex-shrink-0 dark:text-gray-300 text-gray-700"
                                            aria-hidden="true"
                                        />
                                        {{ item.name }}
                                    </Link>
                                    <span
                                        class="absolute right-0 top-3 pl-2 cursor-pointer dark:text-gray-300 text-gray-800 hover:text-gray-50 hover:scale-110"
                                        v-if="item?.children?.length > 0"
                                    >
                                        <component
                                            :is="
                                                item.current &&
                                                item?.children?.length > 0
                                                    ? ChevronDoubleDownIcon
                                                    : ChevronDoubleRightIcon
                                            "
                                            class="mr-3 h-4 w-4 flex-shrink-0"
                                            aria-hidden="true"
                                        />
                                    </span>
                                    <div
                                        class="p-2 my-1 mx-3 border dark:border-gray-600 border-gray-400 rounded-md bg-gray-200 dark:bg-gray-700 shadow-md"
                                        :class="{
                                            'transition duration-500 ease-in-out':
                                                item.current,
                                        }"
                                        v-show="
                                            item.current &&
                                            item?.children?.length > 0
                                        "
                                    >
                                        <div
                                            aria-level="childreen"
                                            v-for="children in item.children"
                                            :key="children.name"
                                            class="px-2 py-1"
                                        >
                                            <Link
                                                v-can="children.permission"
                                                :href="route(children.route)"
                                                :class="[
                                                    children.current
                                                        ? 'bg-gray-400 text-gray-900 dark:bg-gray-800 dark:text-white'
                                                        : 'text-gray-800 bg-gray-300 hover:bg-gray-400 dark:text-gray-100 dark:bg-gray-600 dark:hover:bg-gray-600',
                                                ]"
                                                class="px-1 py-1.5 group flex items-center text-sm font-medium rounded-md"
                                                ><component
                                                    :is="children.icon"
                                                    class="mr-3 h-4 w-4 flex-shrink-0 text-gray-300"
                                                    aria-hidden="true"
                                                />
                                                {{ children.name }}
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </DialogPanel>
                </TransitionChild>
                <div class="w-14 flex-shrink-0" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
