<script setup lang="ts">
import Toast from "@/Components/Toast.vue";
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
    <!-- Component Code -->

    <div
        class="relative h-screen w-full flex items-center justify-center bg-cover bg-center text-center"
        style="
            background-image: url(https://images.pexels.com/photos/260689/pexels-photo-260689.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500);
        "
    >
        <div
            class="absolute top-0 right-0 bottom-0 left-0 bg-gray-900 opacity-75"
        ></div>

        <div
            class="z-50 flex gap-5 flex-col justify-center items-center text-white w-full h-screen"
        >
            <span class="text-bold text-4xl">Coming soon</span>
            <a class="text-xl text-blue-500" href="https://github.com/anis3139">
                <font-awesome-icon icon="fa-brands fa-github" />
                My Github Account
            </a>
        </div>
    </div>
</template>
