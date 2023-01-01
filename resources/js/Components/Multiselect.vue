<template>
    <div>
        <div
            aria-level="parent"
            class="space-y-2 bg-white text-black dark:bg-gray-700 dark:text-gray-50 "
        >
            <div
                aria-level="input_box"
                class="w-full min-h-16 bg-gray-100 text-black dark:bg-gray-900 dark:text-gray-50 p-2"
            >
                {{ options }}
            </div>
            <div
                aria-level="output_box"
                class="w-full h-32 overflow-scroll bg-gray-200 dark:bg-gray-300 p-2"
            >
                <div v-for="option in options" :key="option">
                    <div
                        class="w-full min-h-8 mt-2 flex gap-2 bg-gray-400 text-black dark:bg-gray-900 dark:text-white items-center p-2 rounded-sm"
                    >
                        <div
                            class="w-4 h-4 inline-block bg-white text-black dark:text-gray-50 p-2"
                        ></div>
                        <div>
                            {{ option }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            type: Array,
            default: [],
            require: false,
        },
    },
};
</script>

<style></style>
