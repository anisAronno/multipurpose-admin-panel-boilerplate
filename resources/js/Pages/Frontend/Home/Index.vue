<script setup lang="ts">
import Toast from "@/Components/Toast.vue";
import { Head, Link } from "@inertiajs/vue3";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head>
        <title>Home</title>
        <link
            rel="icon"
            type="image/svg+xml"
            :href="$page.props.global.options.fav_icon"
        />
    </Head>
    <Toast></Toast>
    <div class="relative sm:items-center sm:pt-0">
        <div class="absolute right-5 top-20 p-5">
            <div v-if="$page.props.auth.user">
                <Link
                    :href="route('dashboard')"
                    class="text-lg text-gray-900 dark:text-gray-500 underline"
                    >Dashboard</Link
                >
            </div>
            <div v-else>
                <Link
                    :href="route('login')"
                    class="text-lg text-gray-900 dark:text-gray-500 underline"
                    >Log in</Link
                >

                <Link
                    :href="route('register')"
                    class="ml-4 text-lg text-gray-900 dark:text-gray-500 underline"
                    >Register</Link
                >
            </div>
        </div>

        <div
            class="flex gap-5 flex-col justify-center items-center h-screen -mt-20 dark:text-white w-full"
        >
            <span class="text-bold text-4xl">Admin Panel Starter</span>
            <a
                class="text-xl text-blue-500"
                href="https://github.com/anisAronno/multipurpose-admin-panel-boilerplate"
                target="_blank"
            >
                Go Github
            </a>
        </div>
    </div>
</template>
