<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const options = usePage().props.value.global.options;

const open = ref(false);
const dropdown = ref(false);
const banner = ref(options.banner);
</script>
<template>
    <div>
        <header>
            <nav class="bg-gray-50 dark:bg-gray-900">
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center">
                        <a href="#" class="text-lg font-medium text-black"
                            >My Landing Page</a
                        >
                    </div>
                    <div class="block lg:hidden z-50">
                        <button
                            @click="open = !open"
                            class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 "
                        >
                            <svg
                                class="fill-current h-3 w-3"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <title>Menu</title>
                                <path
                                    d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                                />
                            </svg>
                        </button>
                    </div>
                    <div
                        v-if="open"
                        class="w-full block flex-grow lg:flex lg:items-center lg:w-auto fixed top-0 left-0 bg-white py-2  z-20"
                        tabindex="-1"
                        @blur="open = false"
                    >
                        <div class="text-sm">
                            <a href="#" class="block px-4 py-2 text-black"
                                >Home</a
                            >
                            <a href="#" class="block px-4 py-2 text-black"
                                >About me</a
                            >
                            <a href="#" class="block px-4 py-2 text-black"
                                >Blog</a
                            >
                            <div class="relative" v-if="dropdown">
                                <a
                                    href="#"
                                    @click="dropdown = !dropdown"
                                    class="block px-4 py-2 text-black"
                                >
                                    Blog
                                    <svg
                                        class="h-3 w-3"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </a>
                                <div
                                    class="absolute right-0 w-48 py-2 bg-white rounded-md shadow-md"
                                >
                                    <a
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >Single sidebar blog</a
                                    >
                                    <a
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >Double sidebar blog</a
                                    >
                                </div>
                            </div>
                            <a href="#" class="block px-4 py-2 text-black"
                                >My Project</a
                            >
                            <a href="#" class="block px-4 py-2 text-black"
                                >Contact
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <section
            class="relative bg-cover bg-center h-48 sm:h-60 grid place-items-center"
            :style="{ 'background-image': 'url(' + banner + ')' }"
        >
            <div
                class="absolute inset-0 bg-gray-50 dark:bg-gray-900 opacity-75"
            ></div>
            <div
                class="relative z-10 p-4 text-center text-black dark:text-white"
            >
                <h1 class="text-4xl font-medium">Welcome to my Landing Page</h1>
                <p class="text-lg">
                    A software engineer at Wedevs, now working on Appsero
                    project
                </p>
            </div>
        </section>

        <section class="p-4">
            <div class="mx-auto max-w-xl">
                <h2 class="text-2xl font-medium mb-4">About Me</h2>
                <p class="text-lg">
                    My name is Anisur Rahman and I am a software engineer at
                    Wedevs, currently working on the Appsero project. I have
                    experience in various programming languages and
                    technologies, and am always looking to learn more and
                    improve my skills.
                </p>
            </div>
        </section>

        <section class="p-4">
            <div class="mx-auto max-w-xl">
                <h2 class="text-2xl font-medium mb-4">My Github</h2>
                <p>
                    Github:
                    <a href="https://github.com/anis3139"
                        >https://github.com/anis3139</a
                    >
                </p>
            </div>
        </section>
        <section class="p-4">
            <div class="mx-auto max-w-xl">
                <h2 class="text-2xl font-medium mb-4">My Wakatime</h2>
                <p>
                    Wakatime:
                    <a href="https://wakatime.com/@anis3139"
                        >https://wakatime.com/@anis3139</a
                    >
                </p>
            </div>
        </section>
        <section class="p-4">
            <div class="mx-auto max-w-xl">
                <h2 class="text-2xl font-medium mb-4">My Projects</h2>
                <ul class="text-lg">
                    <li>
                        <a href="https://github.com/anis3139/project1"
                            >Project 1</a
                        >
                    </li>
                    <li>
                        <a href="https://github.com/anis3139/project2"
                            >Project 2</a
                        >
                    </li>
                    <li>
                        <a href="https://github.com/anis3139/project3"
                            >Project 3</a
                        >
                    </li>
                </ul>
            </div>
        </section>
        <section class="p-4">
            <div class="mx-auto max-w-xl">
                <h2 class="text-2xl font-medium mb-4">Contact Me</h2>
                <form>
                    <label class="block text-gray-700 font-medium mb-2"
                        >Name</label
                    >
                    <input type="text" class="p-2 border rounded w-full" />
                    <label class="block text-gray-700 font-medium mb-2"
                        >Email</label
                    >
                    <input type="email" class="p-2 border rounded w-full" />
                    <label class="block text-gray-700 font-medium mb-2"
                        >Subject</label
                    >
                    <input type="text" class="p-2 border rounded w-full" />
                    <label class="block text-gray-700 font-medium mb-2"
                        >Message</label
                    >
                    <textarea class="p-2 border rounded w-full"></textarea>
                    <button
                        class="bg-indigo-500 p-2 rounded-lg text-white mt-4"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </section>

        <footer class="p-4">
            <div class="mx-auto max-w-xl">
                <div class="text-center">
                    <p>
                        Contact me at
                        <a href="mailto:contact@anichur.com"
                            >contact@anichur.com</a
                        >
                        or <a href="tel:01816366535">01816366535</a>
                    </p>
                    <div class="flex justify-center">
                        <a href="#" class="text-gray-500 mx-4">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-500 mx-4">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-500 mx-4">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="text-gray-500 mx-4">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
