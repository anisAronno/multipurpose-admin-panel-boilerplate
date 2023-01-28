<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import DarkMode from "@/Components/DarkMode.vue";
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
import DesktopMenu from "@/Layouts/Partials/DesktopMenu.vue";
import MobileMenu from "@/Layouts/Partials/MobileMenu.vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3BottomLeftIcon,
    BellIcon,
    CogIcon,
    HomeIcon,
    PlusCircleIcon,
    UserGroupIcon,
    UsersIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";

const navigation = ref([
    {
        name: "Dashboard",
        route: "dashboard",
        icon: HomeIcon,
        current: route().current("dashboard"),
    },
    {
        name: "User",
        route: "user.index",
        icon: UsersIcon,
        current:
            route().current("user.index") ||
            route().current("user.create") ||
            route().current("user.edit") ||
            route().current("user.show"),
        children: [
            {
                name: "All User",
                route: "user.index",
                icon: UsersIcon,
                current: route().current("user.index"),
            },
            {
                name: "Create",
                route: "user.create",
                icon: PlusCircleIcon,
                current: route().current("user.create"),
            },
        ],
    },
    {
        name: "Role",
        route: "role.index",
        icon: UserGroupIcon,
        current:
            route().current("role.index") ||
            route().current("role.create") ||
            route().current("role.edit") ||
            route().current("role.show"),
        children: [
            {
                name: "Role",
                route: "role.index",
                icon: UserGroupIcon,
                current: route().current("role.index"),
            },
            {
                name: "Create",
                route: "role.create",
                icon: PlusCircleIcon,
                current: route().current("role.create"),
            },
        ],
    },
    {
        name: "Settings",
        route: "options.index",
        icon: CogIcon,
        current: route().current("options.index"),
        children: [
            {
                name: "Settings",
                route: "options.index",
                icon: CogIcon,
                current: route().current("options.index"),
            },
        ],
    },
]);
const userNavigation = [
    { name: "Your Profile", route: "profile.edit" },
    { name: "Sign out", route: "logout" },
];

const sidebarOpen = ref(false);
const isOpenSidebar = ref(true);
const isLoaded = ref(false);

function toggleCurrent(item) {
    if (!isOpenSidebar) {
        return;
    }

    if (item.route.split(".")[0] == route().current().split(".")[0]) {
        return;
    }

    item.current = !item.current;
}

function loaded(data = true) {
    isLoaded.value = data;
}
onMounted(() => {
    loaded();
});
</script>

<template>
    <Head>
        <link
            rel="icon"
            type="image/svg+xml"
            :href="$page.props.global.options.fav_icon"
        />
    </Head>
    <div>
        <div
            class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-900 opacity-75 flex flex-col items-center justify-center"
            v-if="!isLoaded"
        >
            <span class="w-10 h-10">
                <Loader></Loader>
            </span>
        </div>
        <Toast></Toast>
        <div>
            <TransitionRoot as="template" :show="sidebarOpen">
                <Dialog
                    as="div"
                    class="relative z-40 md:hidden"
                    @close="sidebarOpen = false"
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
                                class="relative flex w-full max-w-xs flex-1 flex-col bg-indigo-700 pt-5 pb-4"
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
                                    <div
                                        class="absolute top-0 right-0 -mr-12 pt-2"
                                    >
                                        <button
                                            type="button"
                                            class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                            @click="sidebarOpen = false"
                                        >
                                            <span class="sr-only"
                                                >Close sidebar</span
                                            >
                                            <XMarkIcon
                                                class="h-6 w-6 text-white"
                                                aria-hidden="true"
                                            />
                                        </button>
                                    </div>
                                </TransitionChild>
                                <div
                                    class="flex flex-shrink-0 items-center px-4"
                                >
                                    <ApplicationLogo
                                        class="h-8 auto"
                                    ></ApplicationLogo>
                                </div>
                                <MobileMenu
                                    :navigation="navigation"
                                    @toggleCurrent="toggleCurrent"
                                ></MobileMenu>
                            </DialogPanel>
                        </TransitionChild>
                        <div class="w-14 flex-shrink-0" aria-hidden="true">
                            <!-- Dummy element to force sidebar to shrink to fit close icon -->
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>

            <!-- Static sidebar for desktop -->
            <div
                class="hidden md:fixed md:inset-y-0 md:flex md:flex-col"
                :class="isOpenSidebar ? 'md:w-64' : 'md:w-20'"
            >
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div
                    class="flex flex-grow flex-col overflow-y-auto bg-indigo-700 pt-5"
                >
                    <div class="flex flex-shrink-0 items-center px-4">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-12 w-auto fill-current text-gray-800 dark:text-gray-200"
                            />
                        </Link>
                    </div>
                    <DesktopMenu
                        :navigation="navigation"
                        :isOpenSidebar="isOpenSidebar"
                        @toggleCurrent="toggleCurrent"
                    ></DesktopMenu>
                </div>
            </div>
            <div
                class="flex flex-1 flex-col dark:bg-gray-900 dark:text-white"
                :class="isOpenSidebar ? 'md:pl-64' : 'md:pl-20'"
            >
                <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 shadow">
                    <button
                        type="button"
                        class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:focus:ring-0 md:dark:text-gray-50 md:dark:bg-gray-900"
                        @click="
                            (sidebarOpen = true),
                                (isOpenSidebar = !isOpenSidebar)
                        "
                    >
                        <span class="sr-only">Open sidebar</span>
                        <Bars3BottomLeftIcon
                            class="h-6 w-6 md:h-10 md:w-10"
                            aria-hidden="true"
                        />
                    </button>
                    <div
                        class="flex flex-1 justify-between px-4 dark:bg-gray-900 dark:text-white"
                    >
                        <div
                            class="flex flex-1 dark:bg-gray-900 dark:text-white"
                        >
                            <form
                                class="flex w-full md:ml-0"
                                action="#"
                                method="GET"
                            >
                                <label for="search-field" class="sr-only"
                                    >Search</label
                                >
                                <div
                                    class="relative w-full text-gray-400 focus-within:text-gray-600"
                                >
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-1 flex items-center"
                                    >
                                        <MagnifyingGlassIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
                                    </div>
                                    <input
                                        id="search-field"
                                        class="block h-full w-full border-transparent py-2 px-5 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm dark:bg-gray-900 dark:text-white"
                                        placeholder="Search"
                                        type="search"
                                        name="search"
                                    />
                                </div>
                            </form>
                        </div>
                        <div
                            class="ml-4 flex items-center md:ml-6 dark:bg-gray-900 dark:text-white"
                        >
                            <button
                                type="button"
                                class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <DarkMode
                                class="rounded-full hover:rounded-full ml-2"
                            ></DarkMode>
                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton
                                        class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="$page.props.auth.user.avatar"
                                            alt=""
                                        />
                                    </MenuButton>
                                </div>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <MenuItem
                                            v-for="item in userNavigation"
                                            :key="item.name"
                                            v-slot="{ active }"
                                        >
                                            <Link
                                                :href="route(item.route)"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm text-gray-700',
                                                ]"
                                                >{{ item.name }}</Link
                                            >
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>

                <main>
                    <div class="py-6 bg-white dark:bg-gray-900 dark:text-white">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold">Dashboard</h1>
                        </div>
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                            <div class="py-4">
                                <div
                                    class="h-full rounded-lg border-4 border-dashed border-gray-200"
                                >
                                    <slot></slot>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
