<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import About from "@/Pages/Frontend/About/Partials/About.vue";
import Goal from "@/Pages/Frontend/About/Partials/Goal.vue";
import Contact from "@/Pages/Frontend/Home/Partials/Contact.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head>
        <title>{{ __("about.title") }}</title>
    </Head>
    <MasterLayout>
        <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50">
            <Hero>{{ __("hero.about", "About us") }}</Hero>
            <About></About>
            <Goal></Goal>
            <!-- <Contact></Contact> -->
        </div>
    </MasterLayout>
</template>
