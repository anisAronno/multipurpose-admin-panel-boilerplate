<script setup lang="ts">
import Hero from "@/Components/Hero.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import ContactForm from "@/Pages/Frontend/Contact/Partials/ContactForm.vue";
import Map from "@/Pages/Frontend/Contact/Partials/Map.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head>
        <title>{{ __("contact.title", "Contact") }}</title>
    </Head>
    <MasterLayout>
        <div>
            <Hero>{{ __("hero.contact", "Contact Page") }}</Hero>
            <ContactForm></ContactForm>
            <Map></Map>
        </div>
    </MasterLayout>
</template>
