<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded dark:text-white dark:bg-gray-700 hover:dark:bg-gray-800"
                    v-html="__(link.label)"
                />
                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500 dark:text-white dark:bg-gray-700 hover:dark:bg-gray-800"
                    :class="{
                        'bg-blue-700 text-white dark:text-white dark:bg-blue-700':
                            link.active,
                    }"
                    :href="link.url"
                    v-html="__(link.label)"
                >
                </Link>
            </template>
        </div>
    </div>
</template>
<script setup>
defineProps({
    links: Array,
});
</script>
