<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
    categories: Object,
});
const emit = defineEmits(["selectedCatSlug"]);

let categoryValue = ref("");
const queryString = usePage().url;

const params = new URLSearchParams(queryString.value.split("?")[1]);
categoryValue.value = params.get("category") || "";

function selectCategory(catSlug) {
    emit("selectedCatSlug", catSlug);
}
</script>
<template>
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-50">
        <h3
            class="mb-3 mt-5 font-semibold cursor-pointer"
            @click="selectCategory(null)"
        >
            <span
                class="dark:text-gray-200 text-lg border-b-gray-500 border-b pb-1"
                :class="categoryValue.length == 0 ? ' !text-cyan-300' : ''"
            >
                Show All
            </span>
        </h3>
        <div v-for="category in categories" :key="category.slug" class="mb-4">
            <div
                class="font-normal sm:font-semibold cursor-pointer text-sm sm:text-lg md:text-lg flex gap-2 justify-start place-items-center"
                :class="categoryValue == category.slug ? ' text-cyan-400' : ''"
                @click="selectCategory(category.slug)"
            >
                {{ category.label }}
                <img
                    class="w-4 h-4 rounded-sm"
                    :src="category.image"
                    :alt="category.slug"
                />
            </div>
            <div v-if="category?.children?.length > 0" class="ml-4">
                <ul>
                    <li
                        v-for="child in category.children.slice(0, 10)"
                        :key="child.slug"
                    >
                        <span
                            @click="selectCategory(child.slug)"
                            class="cursor-pointer"
                            :class="
                                categoryValue == child.slug
                                    ? ' text-cyan-400'
                                    : ''
                            "
                        >
                            <span
                                class="flex gap-2 justify-start place-items-center"
                            >
                                <span>- {{ child.label }}</span>
                                <img
                                    class="w-4 h-4 rounded-sm"
                                    :src="child.image"
                                    :alt="child.slug"
                                />
                            </span>
                        </span>
                        <div v-if="child?.children?.length > 0" class="ml-4">
                            <ul>
                                <li
                                    v-for="child2 in child.children.slice(
                                        0,
                                        10
                                    )"
                                    :key="child2.slug"
                                >
                                    <span
                                        @click="selectCategory(child2.slug)"
                                        class="cursor-pointer"
                                        :class="
                                            categoryValue == child2.slug
                                                ? ' text-cyan-400'
                                                : ''
                                        "
                                    >
                                        <span
                                            class="flex gap-2 justify-start place-items-center"
                                        >
                                            <span>
                                                --
                                                {{ child2.label }}
                                            </span>
                                            <img
                                                class="w-4 h-4 rounded-sm"
                                                :src="child2.image"
                                                :alt="child2.slug"
                                            />
                                        </span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
