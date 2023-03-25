<template>
    <div v-if="meta.links?.length > 3" class="flex justify-between">
        <div class="text-gray-900 dark:text-gray-900">
            <p>
                Showing
                {{ meta.from }}
                to
                {{ meta.to }}
                from {{ meta.total }} items
                
            </p>
        </div> 
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in meta.links" :key="p">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-2 py-2 text-sm leading-4 text-gray-400 border rounded dark:text-white dark:bg-gray-700 hover:dark:bg-gray-800"
                    v-html="__(link.label)"
                />
                <Link
                    v-else
                    class="mr-1 mb-1 px-3 py-2 text-sm leading-4 border rounded focus:border-indigo-500 focus:text-indigo-500 dark:text-white dark:bg-gray-700 hover:dark:bg-gray-800 hover:bg-gray-700 hover:text-gray-100"
                    :class="{
                        'text-white bg-blue-700 dark:text-white dark:bg-blue-700':
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
    meta: Array,
});
</script>
