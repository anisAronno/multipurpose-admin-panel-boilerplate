<script setup lang="ts">
import Loader from "@/Components/Loader.vue";
import Toast from "@/Components/Toast.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import { onMounted, ref } from "vue";

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
            <Header></Header>
            <main>
                <slot></slot>
            </main>
            <Footer></Footer>
        </div>
    </div>
</template>
