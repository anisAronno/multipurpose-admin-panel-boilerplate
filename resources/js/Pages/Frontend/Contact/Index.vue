<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue"; 
import ContactForm from "@/Pages/Frontend/Contact/Partials/ContactForm.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head>
        <title>Contact</title>
    </Head>
    <MasterLayout>
        <div>
            <Banner></Banner>
            <ContactForm></ContactForm> 
        </div>
    </MasterLayout>
</template>
