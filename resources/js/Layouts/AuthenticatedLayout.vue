<script setup>
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
import DesktopMenu from "@/Layouts/Partials/DesktopMenu.vue";
import Header from "@/Layouts/Partials/Header.vue";
import MobileMenu from "@/Layouts/Partials/MobileMenu.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

import {
    CogIcon,
    HomeIcon,
    PlusCircleIcon,
    ShoppingCartIcon,
    UserGroupIcon,
    UsersIcon,
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
        name: "Product",
        route: "product.index",
        icon: ShoppingCartIcon,
        current:
            route().current("product.index") ||
            route().current("product.create") ||
            route().current("product.edit") ||
            route().current("product.show"),
        children: [
            {
                name: "Product",
                route: "product.index",
                icon: ShoppingCartIcon,
                current: route().current("product.index"),
            },
            {
                name: "Create",
                route: "product.create",
                icon: PlusCircleIcon,
                current: route().current("product.create"),
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

const sidebarOpen = ref(false);
const isOpenSidebar = ref(false);
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
            class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 opacity-75 flex flex-col items-center justify-center"
            v-if="!isLoaded"
        >
            <span class="w-10 h-10">
                <Loader></Loader>
            </span>
        </div>
        <Toast></Toast>
        <div>
            <MobileMenu
                :sidebarOpen="sidebarOpen"
                :navigation="navigation"
                @toggleMobileMenu="sidebarOpen = !sidebarOpen"
                @toggleCurrent="toggleCurrent"
            ></MobileMenu>

            <!-- Static sidebar for desktop -->

            <DesktopMenu
                :navigation="navigation"
                :isOpenSidebar="isOpenSidebar"
                @toggleCurrent="toggleCurrent"
            ></DesktopMenu>

            <div
                class="flex flex-1 flex-col dark:bg-gray-900 dark:text-white"
                :class="isOpenSidebar ? 'md:pl-64' : 'md:pl-20'"
            >
                <Header
                    @toggleMenu="
                        (sidebarOpen = !sidebarOpen),
                            (isOpenSidebar = !isOpenSidebar)
                    "
                    :isOpenSidebar="isOpenSidebar"
                ></Header>

                <main>
                    <div class="py-6 bg-white dark:bg-gray-900 dark:text-white">
                        <div
                            class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8"
                            v-if="$slots.header"
                        >
                            <slot name="header"></slot>
                        </div>
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                            <div class="py-4">
                                <div
                                    class="h-full rounded-lg border-4 border-dashed border-gray-200 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
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
