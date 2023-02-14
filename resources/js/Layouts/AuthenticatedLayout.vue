<script setup>
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
import { useDashboardMenu } from "@/Composables/useDashboardMenu";
import DesktopMenu from "@/Layouts/Partials/DesktopMenu.vue";
import Header from "@/Layouts/Partials/Header.vue";
import MobileMenu from "@/Layouts/Partials/MobileMenu.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

const { navigation, sidebarOpen, isOpenSidebar, isLoaded } = useDashboardMenu();

function mouseOver(item) {
    if (!isOpenSidebar) {
        return;
    }

    if (
        item.route.split(".").slice(0, 2).join(".") ==
        route().current().split(".").slice(0, 2).join(".")
    ) {
        return;
    }
    setTimeout(() => {
        item.current = true;
    }, 100);
}
function mouseOut(item) {
    if (!isOpenSidebar) {
        return;
    }

    if (
        item.route.split(".").slice(0, 2).join(".") ==
        route().current().split(".").slice(0, 2).join(".")
    ) {
        return;
    }

    setTimeout(() => {
        item.current = false;
    }, 100);
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
            :href="$page?.props?.global?.options?.fav_icon"
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
                @mouseOver="mouseOver"
            ></MobileMenu>

            <!-- Static sidebar for desktop -->

            <DesktopMenu
                :navigation="navigation"
                :isOpenSidebar="isOpenSidebar"
                @mouseOver="mouseOver"
                @mouseOut="mouseOut"
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
                            class="mx-auto max-w-full px-4 sm:px-6 md:px-8"
                            v-if="$slots.header"
                        >
                            <slot name="header"></slot>
                        </div>
                        <div class="mx-auto max-w-full px-4 sm:px-6 md:px-8">
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
