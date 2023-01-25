<script setup lang="ts">
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";

import { Head, Link } from "@inertiajs/inertia-vue3";
import { defineComponent, h, onMounted, ref } from "vue";

const navigation = [
    { name: "Home", route: "home" },
    { name: "About", route: "about" },
    { name: "Products", route: "products" },
    { name: "Contact", route: "contact" },
];
const footerNavigation = {
    solutions: [
        { name: "Marketing", href: "#" },
        { name: "Analytics", href: "#" },
        { name: "Commerce", href: "#" },
        { name: "Insights", href: "#" },
    ],
    support: [
        { name: "Pricing", href: "#" },
        { name: "Documentation", href: "#" },
        { name: "Guides", href: "#" },
        { name: "API Status", href: "#" },
    ],
    company: [
        { name: "About", href: "#" },
        { name: "Blog", href: "#" },
        { name: "Jobs", href: "#" },
        { name: "Press", href: "#" },
        { name: "Partners", href: "#" },
    ],
    legal: [
        { name: "Claim", href: "#" },
        { name: "Privacy", href: "#" },
        { name: "Terms", href: "#" },
    ],
    social: [
        {
            name: "Facebook",
            href: "#",
            icon: defineComponent({
                render: () =>
                    h("svg", { fill: "currentColor", viewBox: "0 0 24 24" }, [
                        h("path", {
                            "fill-rule": "evenodd",
                            d: "M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z",
                            "clip-rule": "evenodd",
                        }),
                    ]),
            }),
        },
        {
            name: "Instagram",
            href: "#",
            icon: defineComponent({
                render: () =>
                    h("svg", { fill: "currentColor", viewBox: "0 0 24 24" }, [
                        h("path", {
                            "fill-rule": "evenodd",
                            d: "M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z",
                            "clip-rule": "evenodd",
                        }),
                    ]),
            }),
        },
        {
            name: "Twitter",
            href: "#",
            icon: defineComponent({
                render: () =>
                    h("svg", { fill: "currentColor", viewBox: "0 0 24 24" }, [
                        h("path", {
                            d: "M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84",
                        }),
                    ]),
            }),
        },
        {
            name: "GitHub",
            href: "#",
            icon: defineComponent({
                render: () =>
                    h("svg", { fill: "currentColor", viewBox: "0 0 24 24" }, [
                        h("path", {
                            "fill-rule": "evenodd",
                            d: "M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z",
                            "clip-rule": "evenodd",
                        }),
                    ]),
            }),
        },
        {
            name: "Youtube",
            href: "#",
            icon: defineComponent({
                render: () =>
                    h("svg", { fill: "currentColor", viewBox: "0 0 24 24" }, [
                        h("path", {
                            "fill-rule": "evenodd",
                            d: "M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z",
                            "clip-rule": "evenodd",
                        }),
                    ]),
            }),
        },
    ],
};

const isLoaded = ref(false);
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
    <div
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-900 opacity-75 flex flex-col items-center justify-center"
        v-if="!isLoaded"
    >
        <span class="w-10 h-10">
            <Loader></Loader>
        </span>
    </div>
    <Toast></Toast>

    <div class="bg-white">
        <div class="relative overflow-hidden">
            <Popover as="header" class="relative">
                <div class="bg-gray-900 pt-6">
                    <nav
                        class="relative mx-auto flex max-w-7xl items-center justify-between px-6"
                        aria-label="Global"
                    >
                        <div class="flex flex-1 items-center">
                            <div
                                class="flex w-full items-center justify-between md:w-auto"
                            >
                                <a href="#">
                                    <span class="sr-only">Your Company</span>
                                    <img
                                        class="h-8 w-auto sm:h-10"
                                        :src="$page.props.global.options.logo"
                                        :alt="
                                            $page.props.global.options.site_name
                                        "
                                    />
                                </a>
                                <div class="-mr-2 flex items-center md:hidden">
                                    <PopoverButton
                                        class="focus-ring-inset inline-flex items-center justify-center rounded-md bg-gray-900 p-2 text-gray-400 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-white"
                                    >
                                        <span class="sr-only"
                                            >Open main menu</span
                                        >
                                        <Bars3Icon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
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
                                            : 'text-base font-medium text-white hover:text-cyan-300 hover:underline hover:decoration-cyan-300  hover:underline-offset-4 '
                                    "
                                >
                                    {{ item.name }}
                                </Link>
                            </div>
                        </div>

                        <div
                            class="hidden md:flex md:items-center md:space-x-6"
                            v-if="$page.props.auth.user"
                        >
                            <Link
                                :href="route('dashboard')"
                                class="text-base font-medium text-white hover:text-gray-300"
                                >Dashboard</Link
                            >
                        </div>
                        <div
                            v-else
                            class="hidden md:flex md:items-center md:space-x-6"
                        >
                            <Link
                                :href="route('login')"
                                class="text-base font-medium text-white hover:text-gray-300"
                                >Log in</Link
                            >
                            <Link
                                :href="route('register')"
                                class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-white hover:bg-gray-700"
                                >Registration</Link
                            >
                        </div>
                    </nav>
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
                            class="overflow-hidden rounded-lg bg-white shadow-md ring-1 ring-black ring-opacity-5"
                        >
                            <div
                                class="flex items-center justify-between px-5 pt-4"
                            >
                                <div>
                                    <img
                                        class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/mark.svg?from-color=teal&from-shade=500&to-color=cyan&to-shade=600&toShade=600"
                                        alt=""
                                    />
                                </div>
                                <div class="-mr-2">
                                    <PopoverButton
                                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-600"
                                    >
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
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
                                                : 'block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:text-cyan-300 hover:underline hover:decoration-cyan-300  hover:underline-offset-4'
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
            <main>
                <slot></slot>
            </main>
            <footer class="bg-gray-50" aria-labelledby="footer-heading">
                <h2 id="footer-heading" class="sr-only">Footer</h2>
                <div
                    class="mx-auto max-w-md px-6 pt-12 sm:max-w-7xl lg:px-8 lg:pt-16"
                >
                    <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                        <div class="space-y-8 xl:col-span-1">
                            <img
                                class="h-10"
                                :src="$page.props.global.options.logo"
                                :alt="$page.props.global.options.site_name"
                            />
                            <p class="text-base text-gray-500">
                                Making the world a better place through
                                constructing elegant hierarchies.
                            </p>
                            <div class="flex space-x-6">
                                <a
                                    v-for="item in footerNavigation.social"
                                    :key="item.name"
                                    :href="item.href"
                                    class="text-gray-400 hover:text-gray-500"
                                >
                                    <span class="sr-only">{{ item.name }}</span>
                                    <component
                                        :is="item.icon"
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    />
                                </a>
                            </div>
                        </div>
                        <div
                            class="mt-12 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0"
                        >
                            <div class="md:grid md:grid-cols-2 md:gap-8">
                                <div>
                                    <h3
                                        class="text-base font-medium text-gray-900"
                                    >
                                        Solutions
                                    </h3>
                                    <ul role="list" class="mt-4 space-y-4">
                                        <li
                                            v-for="item in footerNavigation.solutions"
                                            :key="item.name"
                                        >
                                            <a
                                                :href="item.href"
                                                class="text-base text-gray-500 hover:text-gray-900"
                                                >{{ item.name }}</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-12 md:mt-0">
                                    <h3
                                        class="text-base font-medium text-gray-900"
                                    >
                                        Support
                                    </h3>
                                    <ul role="list" class="mt-4 space-y-4">
                                        <li
                                            v-for="item in footerNavigation.support"
                                            :key="item.name"
                                        >
                                            <a
                                                :href="item.href"
                                                class="text-base text-gray-500 hover:text-gray-900"
                                                >{{ item.name }}</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="md:grid md:grid-cols-2 md:gap-8">
                                <div>
                                    <h3
                                        class="text-base font-medium text-gray-900"
                                    >
                                        Company
                                    </h3>
                                    <ul role="list" class="mt-4 space-y-4">
                                        <li
                                            v-for="item in footerNavigation.company"
                                            :key="item.name"
                                        >
                                            <a
                                                :href="item.href"
                                                class="text-base text-gray-500 hover:text-gray-900"
                                                >{{ item.name }}</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-12 md:mt-0">
                                    <h3
                                        class="text-base font-medium text-gray-900"
                                    >
                                        Legal
                                    </h3>
                                    <ul role="list" class="mt-4 space-y-4">
                                        <li
                                            v-for="item in footerNavigation.legal"
                                            :key="item.name"
                                        >
                                            <a
                                                :href="item.href"
                                                class="text-base text-gray-500 hover:text-gray-900"
                                                >{{ item.name }}</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 border-t border-gray-200 py-8">
                        <p class="text-base text-gray-400 xl:text-center">
                            &copy; 2020 Your Company, Inc. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
