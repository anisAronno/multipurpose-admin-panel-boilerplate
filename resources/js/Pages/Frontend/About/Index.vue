<script setup lang="ts">
import MasterLayout from "@/Layouts/MasterLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Banner from "@/Components/Banner.vue";
</script>

<template>
    <Head>
        <title>About</title>
    </Head>
    <MasterLayout>
        <div>
            <Banner></Banner>
        </div>
    </MasterLayout>
</template>
