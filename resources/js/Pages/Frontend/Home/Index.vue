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
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0 z-50"
    >
        <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-700 dark:text-gray-500 underline"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>

        <div
            class="z-50 flex gap-5 flex-col justify-center items-center text-white w-full"
        >
            <span class="text-bold text-4xl">Coming soon</span>
            <a class="text-xl text-blue-500" href="https://github.com/anis3139">
                <font-awesome-icon icon="fa-brands fa-github" />
                My Github Account
            </a>
        </div>
    </div>
</template>
