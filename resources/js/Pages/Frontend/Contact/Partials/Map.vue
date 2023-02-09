<script setup></script>
<template>
    <div class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50">
        <div class="mx-auto max-w-full py-6 px-6 sm:py-10 lg:px-8">
            <iframe
                :src="`https://maps.google.com/maps?q=${$page.props.global.options.address}&z=15&output=embed`"
                width="100%"
                height="400"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
</template>
