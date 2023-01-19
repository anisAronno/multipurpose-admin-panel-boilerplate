<script setup lang="ts">
import Toast from "@/Components/Toast.vue";
import Readme from "@/Markdown/Readme.md";
import { Head, Link } from "@inertiajs/inertia-vue3";
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
            class="text-white"
        >
            <Readme></Readme>
        </div>
    </div>
</template>
