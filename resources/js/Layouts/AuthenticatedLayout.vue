<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import DarkMode from "@/Components/DarkMode.vue";
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
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
    ChevronDoubleDownIcon,
    ChevronDoubleRightIcon,
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
const isLoaded = ref(false);
const showingNavigationDropdown = ref(false);

function toggleCurrent(item) {
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
                                    <img
                                        class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=300"
                                        alt="Your Company"
                                    />
                                </div>
                                <div class="mt-5 h-0 flex-1 overflow-y-auto">
                                    <nav class="space-y-1 px-2">
                                        <div
                                            v-for="item in navigation"
                                            :key="item.name"
                                            :class="[
                                                item.current
                                                    ? 'bg-indigo-600 text-white p-0.5 rounded-sm'
                                                    : '',
                                            ]"
                                            @click="toggleCurrent(item)"
                                        >
                                            <div
                                                :class="[
                                                    item.current
                                                        ? 'bg-indigo-800 text-white'
                                                        : 'text-indigo-100 hover:bg-indigo-600',
                                                    'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                                                ]"
                                            >
                                                <component
                                                    :is="item.icon"
                                                    class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300"
                                                    aria-hidden="true"
                                                />
                                                {{ item.name }}
                                                <span
                                                    v-if="
                                                        item.current &&
                                                        item?.children?.length >
                                                            0
                                                    "
                                                    class="absolute right-0 mr-2"
                                                >
                                                    <ChevronDoubleDownIcon
                                                        class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                                        aria-hidden="true"
                                                    ></ChevronDoubleDownIcon>
                                                </span>
                                                <span
                                                    v-else-if="
                                                        !item.current &&
                                                        item?.children?.length >
                                                            0
                                                    "
                                                    class="absolute right-0 mr-2"
                                                >
                                                    <ChevronDoubleRightIcon
                                                        class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                                        aria-hidden="true"
                                                    ></ChevronDoubleRightIcon>
                                                </span>
                                            </div>
                                            <div
                                                class="p-2 my-1 mx-3 border border-indigo-600 rounded-md bg-indigo-700 shadow-md"
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
                                                        :href="
                                                            route(
                                                                children.route
                                                            )
                                                        "
                                                        :class="[
                                                            children.current
                                                                ? 'bg-indigo-800 text-white'
                                                                : 'text-indigo-100 bg-indigo-600 hover:bg-indigo-600',
                                                        ]"
                                                        class="px-1 py-1.5 group flex items-center text-sm font-medium rounded-md"
                                                        ><component
                                                            :is="children.icon"
                                                            class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
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

            <!-- Static sidebar for desktop -->
            <div
                class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col"
            >
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div
                    class="flex flex-grow flex-col overflow-y-auto bg-indigo-700 pt-5"
                >
                    <div class="flex flex-shrink-0 items-center px-4">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                            />
                        </Link>
                    </div>
                    <div class="mt-5 flex flex-1 flex-col">
                        <nav class="flex-1 space-y-1 px-2 pb-4">
                            <div
                                v-for="item in navigation"
                                :key="item.name"
                                :class="[
                                    item.current
                                        ? 'bg-indigo-600 text-white p-0.5 rounded-sm'
                                        : '',
                                ]"
                                @mouseover="toggleCurrent(item)"
                                @mouseout="toggleCurrent(item)"
                            >
                                <Link
                                    :href="route(item.route)"
                                    :class="[
                                        item.current
                                            ? 'bg-indigo-800 text-white'
                                            : 'text-indigo-100 hover:bg-indigo-600',
                                        'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                    <span
                                        v-if="
                                            item.current &&
                                            item?.children?.length > 0
                                        "
                                        class="absolute right-0 mr-2"
                                    >
                                        <ChevronDoubleDownIcon
                                            class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                            aria-hidden="true"
                                        ></ChevronDoubleDownIcon>
                                    </span>
                                    <span
                                        v-else-if="
                                            !item.current &&
                                            item?.children?.length > 0
                                        "
                                        class="absolute right-0 mr-2"
                                    >
                                        <ChevronDoubleRightIcon
                                            class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                            aria-hidden="true"
                                        ></ChevronDoubleRightIcon>
                                    </span>
                                </Link>
                                <div
                                    class="p-2 my-1 mx-3 border border-indigo-600 rounded-md bg-indigo-700 shadow-md"
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
                                            :href="route(children.route)"
                                            :class="[
                                                children.current
                                                    ? 'bg-indigo-800 text-white'
                                                    : 'text-indigo-100 bg-indigo-600 hover:bg-indigo-600',
                                            ]"
                                            class="px-1 py-1.5 group flex items-center text-sm font-medium rounded-md"
                                            ><component
                                                :is="children.icon"
                                                class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                                aria-hidden="true"
                                            />
                                            {{ children.name }}
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-1 flex-col md:pl-64 dark:bg-gray-900 dark:text-white"
            >
                <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 shadow">
                    <button
                        type="button"
                        class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                        @click="sidebarOpen = true"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <Bars3BottomLeftIcon
                            class="h-6 w-6"
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
