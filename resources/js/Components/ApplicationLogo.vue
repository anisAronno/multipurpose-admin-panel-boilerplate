<template>
    <img
        :src="$page.props.global.options.logo || defaultFile.logo"
        alt="logo"
        class="rounded-full"
    />
</template>
<script setup>
import defaultFile from "@/Stores/defaultFile.js";
</script>
