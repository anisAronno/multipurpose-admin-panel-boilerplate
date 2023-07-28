<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";

defineProps({
    placeholder: {
        type: String,
        require: false,
        default: `Search...`,
    },
});
const form = useForm({
    search: "",
});

const searchQuery = ref("");
const queryString = usePage().url;

const params = new URLSearchParams(queryString.value.split("?")[1]);
searchQuery.value = params.get("search") || "";

const route = queryString.value.split("?")[0];

watch(
    () => form.search,
    (val) => {
        searchHandaler();
    }
);

const searchHandaler = () => {
    form.get(route, {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.search) {
                searchInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <div
        class="flex flex-col-reverse sm:flex-row space-x-2 justify-between items-center"
    >
        <div class="mt-5 sm:mt-0">
            <p v-if="searchQuery" class="text-lg">
                Search result for:
                <span class="font-bold dark:text-yellow-400 text-blue-900">{{
                    searchQuery
                }}</span>
            </p>
        </div>
        <div class="sm:float-right">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                >
                    <svg
                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <input
                    type="text"
                    id="table-search-users"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    :placeholder="placeholder"
                    v-model.lazy="form.search"
                    ref="searchInput"
                />
            </div>
        </div>
    </div>
</template>
