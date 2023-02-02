<script setup>
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
import DesktopMenu from "@/Layouts/Partials/DesktopMenu.vue";
import Header from "@/Layouts/Partials/Header.vue";
import MobileMenu from "@/Layouts/Partials/MobileMenu.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

import {
    BookOpenIcon,
    CogIcon,
    HomeIcon,
    ListBulletIcon,
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
        route: "admin.user.index",
        icon: UsersIcon,
        current:
            route().current("admin.user.index") ||
            route().current("admin.user.create") ||
            route().current("admin.user.edit") ||
            route().current("admin.user.show"),
        children: [
            {
                name: "User List",
                route: "admin.user.index",
                icon: UsersIcon,
                current: route().current("admin.user.index"),
            },
            {
                name: "Create",
                route: "admin.user.create",
                icon: PlusCircleIcon,
                current: route().current("admin.user.create"),
            },
        ],
    },

    {
        name: "Role",
        route: "admin.role.index",
        icon: UserGroupIcon,
        current:
            route().current("admin.role.index") ||
            route().current("admin.role.create") ||
            route().current("admin.role.edit") ||
            route().current("admin.role.show"),
        children: [
            {
                name: "Role List",
                route: "admin.role.index",
                icon: UserGroupIcon,
                current: route().current("admin.role.index"),
            },
            {
                name: "Create",
                route: "admin.role.create",
                icon: PlusCircleIcon,
                current: route().current("admin.role.create"),
            },
        ],
    },
    {
        name: "Category",
        route: "admin.category.index",
        icon: ListBulletIcon,
        current:
            route().current("admin.category.index") ||
            route().current("admin.admin.category.create") ||
            route().current("admin.category.edit") ||
            route().current("admin.category.show"),
        children: [
            {
                name: "Category List",
                route: "admin.category.index",
                icon: ListBulletIcon,
                current: route().current("admin.category.index"),
            },
            {
                name: "Create",
                route: "admin.admin.category.create",
                icon: PlusCircleIcon,
                current: route().current("admin.admin.category.create"),
            },
        ],
    },
    {
        name: "Product",
        route: "admin.product.index",
        icon: ShoppingCartIcon,
        current:
            route().current("admin.product.index") ||
            route().current("admin.product.create") ||
            route().current("admin.product.edit") ||
            route().current("admin.product.show"),
        children: [
            {
                name: "Product List",
                route: "admin.product.index",
                icon: ShoppingCartIcon,
                current: route().current("admin.product.index"),
            },
            {
                name: "Create",
                route: "admin.product.create",
                icon: PlusCircleIcon,
                current: route().current("admin.product.create"),
            },
        ],
    },
    {
        name: "Blog",
        route: "admin.blog.index",
        icon: BookOpenIcon,
        current:
            route().current("admin.blog.index") ||
            route().current("admin.blog.create") ||
            route().current("admin.blog.edit") ||
            route().current("admin.blog.show"),
        children: [
            {
                name: "Blog List",
                route: "admin.blog.index",
                icon: BookOpenIcon,
                current: route().current("admin.blog.index"),
            },
            {
                name: "Create",
                route: "admin.blog.create",
                icon: PlusCircleIcon,
                current: route().current("admin.blog.create"),
            },
        ],
    },
    {
        name: "Settings",
        route: "admin.options.index",
        icon: CogIcon,
        current: route().current("admin.options.index"),
        children: [
            {
                name: "Settings",
                route: "admin.options.index",
                icon: CogIcon,
                current: route().current("admin.options.index"),
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
