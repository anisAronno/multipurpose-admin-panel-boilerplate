<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {
    ChevronDoubleDownIcon,
    ChevronDoubleRightIcon,
} from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";
defineProps({
    navigation: Object,
    isOpenSidebar: Boolean,
});
</script>
<template>
    <div
        class="hidden md:fixed md:inset-y-0 md:flex md:flex-col"
        :class="isOpenSidebar ? 'md:w-64' : 'md:w-20'"
    >
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex flex-grow flex-col overflow-y-auto bg-gray-100 dark:bg-gray-800 pt-5">
            <div class="flex flex-shrink-0 items-center px-4">
                <Link :href="route('dashboard')">
                    <ApplicationLogo
                        class="block h-12 w-auto fill-current text-gray-800 dark:text-gray-200"
                    />
                </Link>
            </div>
            <div class="mt-5 flex flex-1 flex-col">
                <nav class="flex-1 space-y-1 px-2 pb-4">
                    <div v-if="isOpenSidebar">
                        <div
                            v-for="item in navigation"
                            :key="item.name"
                            :class="[
                                item.current
                                    ? 'dark:bg-gray-700 bg-gray-300 text-gray-900 dark:text-white p-0.5 rounded-sm'
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
                                        ? ' dark:bg-gray-800 bg-gray-400 text-gray-900 dark:text-white'
                                        : 'dark:text-gray-100 text-gray-900 dark:hover:bg-gray-700 hover:bg-gray-400',
                                    'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                                ]"
                            >
                                <component
                                    :is="item.icon"
                                    class="mr-3 h-6 w-6 flex-shrink-0 dark:text-gray-300"
                                    aria-hidden="true"
                                />
                                {{ item.name }}
                            </Link>
                            <span
                                class="absolute right-0 top-3 pl-2 text-right cursor-pointer text-gray-900 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-50 hover:scale-110"
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
                                class="p-2 my-1 mx-3 border dark:border-gray-600 border-gray-400 rounded-md dark:bg-gray-700 bg-gray-200 shadow-md"
                                :class="{
                                    'transition duration-500 ease-in-out':
                                        item.current,
                                }"
                                v-show="
                                    item.current && item?.children?.length > 0
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
                                                ? 'dark:bg-gray-800 bg-gray-400 text-gray-900 dark:text-white'
                                                : 'text-gray-900 bg-gray-300 hover:bg-gray-400 dark:text-gray-100 dark:bg-gray-600 dark:hover:bg-gray-600',
                                        ]"
                                        class="px-1 py-1.5 group flex items-center text-sm font-medium rounded-md"
                                        ><component
                                            :is="children.icon"
                                            class="mr-3 ml-1 h-4 w-4 flex-shrink-0   text-gray-900 dark:text-white"
                                            aria-hidden="true"
                                        />
                                        {{ children.name }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div
                            v-for="item in navigation"
                            :key="item.name"
                            :class="[
                                item.current
                                    ?  ' bg-gray-400 dark:bg-gray-600 text-gray-900 dark:text-white p-0.5 rounded-sm my-2'
                                    : '',
                            ]"
                        >
                            <Link
                                v-can="item.permission"
                                :href="route(item.route)"
                                :class="[
                                    item.current
                                        ? 'dark:bg-gray-800 bg-gray-300 text-white'
                                        : 'text-gray-900 dark:text-gray-100 hover:bg-gray-600',
                                    'group flex items-center px-3 py-3 text-sm font-medium rounded-md',
                                ]"
                            >
                                <component
                                    :is="item.icon"
                                    class="mr-3 h-8 w-8 flex-shrink-0 dark:text-gray-300 text-gray-900"
                                    aria-hidden="true"
                                />
                            </Link>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>
