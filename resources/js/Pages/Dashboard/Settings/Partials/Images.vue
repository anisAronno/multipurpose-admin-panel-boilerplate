<script setup>
import Image from "@/Components/Image/Image.vue";
import { usePage } from "@inertiajs/vue3";

const options = usePage().props.global.options;
</script>
<template>
    <div
        class="max-w-full mx-auto flex flex-wrap justify-around items-center bg-white dark:bg-gray-800 text-black dark:text-white sm:space-x-2 space-y-2 sm:space-y-0"
    >
        <div
            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
        >
            <div class="text-2x block text-center text-2xl">Logo</div>
            <Image
                id="logo"
                field="logo"
                :isDeleteable="true"
                v-model="options.logo"
                class="w-48 h-48 rounded-full overflow-clip bg-red-500"
            />
        </div>
        <div
            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
        >
            <div class="text-2x block text-center text-2xl">Fav Icon</div>
            <Image
                id="fav_icon"
                field="fav_icon"
                :isDeleteable="true"
                v-model="options.fav_icon"
                class="w-48 h-48 rounded-full overflow-clip bg-red-500"
            />
        </div>
        <div
            class="p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"
        >
            <div class="text-2x block text-center text-2xl">Banner</div>
            <Image
                id="banner"
                field="banner"
                :isDeleteable="true"
                v-model="options.banner"
                class="w-48 h-48 rounded-sm overflow-clip bg-red-500"
            />
        </div>
    </div>
</template>
