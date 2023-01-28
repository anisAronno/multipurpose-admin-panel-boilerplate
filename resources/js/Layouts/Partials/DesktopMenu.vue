<script setup>
import {
    ChevronDoubleDownIcon,
    ChevronDoubleRightIcon,
} from "@heroicons/vue/24/outline";
defineProps({
    navigation: Object,
    isOpenSidebar: Boolean,
});
</script>
<template>
    <div class="mt-5 flex flex-1 flex-col">
        <nav class="flex-1 space-y-1 px-2 pb-4">
            <div v-if="isOpenSidebar">
                <div
                    v-for="item in navigation"
                    :key="item.name"
                    :class="[
                        item.current
                            ? 'bg-indigo-600 text-white p-0.5 rounded-sm'
                            : '',
                    ]"
                    @mouseover="$emit('toggleCurrent', item)"
                    @mouseout="$emit('toggleCurrent', item)"
                >
                    <Link
                        :href="route(item.route)"
                        :class="[
                            item.current
                                ? 'bg-indigo-800 text-white'
                                : 'text-indigo-100 hover:bg-indigo-600',
                            'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                        ]"
                    >
                        <component
                            :is="item.icon"
                            class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300"
                            aria-hidden="true"
                        />
                        {{ item.name }}
                        <span
                            v-if="item.current && item?.children?.length > 0"
                            class="absolute right-0 mr-2"
                        >
                            <ChevronDoubleDownIcon
                                class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                aria-hidden="true"
                            ></ChevronDoubleDownIcon>
                        </span>
                        <span
                            v-else-if="
                                !item.current && item?.children?.length > 0
                            "
                            class="absolute right-0 mr-2"
                        >
                            <ChevronDoubleRightIcon
                                class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                aria-hidden="true"
                            ></ChevronDoubleRightIcon>
                        </span>
                    </Link>
                    <div
                        class="p-2 my-1 mx-3 border border-indigo-600 rounded-md bg-indigo-700 shadow-md"
                        :class="{
                            'transition duration-500 ease-in-out': item.current,
                        }"
                        v-show="item.current && item?.children?.length > 0"
                    >
                        <div
                            aria-level="childreen"
                            v-for="children in item.children"
                            :key="children.name"
                            class="px-2 py-1"
                        >
                            <Link
                                :href="route(children.route)"
                                :class="[
                                    children.current
                                        ? 'bg-indigo-800 text-white'
                                        : 'text-indigo-100 bg-indigo-600 hover:bg-indigo-600',
                                ]"
                                class="px-1 py-1.5 group flex items-center text-sm font-medium rounded-md"
                                ><component
                                    :is="children.icon"
                                    class="mr-3 h-4 w-4 flex-shrink-0 text-indigo-300"
                                    aria-hidden="true"
                                />
                                {{ children.name }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div
                    v-for="item in navigation"
                    :key="item.name"
                    :class="[
                        item.current
                            ? 'bg-indigo-600 text-white p-0.5 rounded-sm'
                            : '',
                    ]"
                >
                    <Link
                        :href="route(item.route)"
                        :class="[
                            item.current
                                ? 'bg-indigo-800 text-white'
                                : 'text-indigo-100 hover:bg-indigo-600',
                            'group flex items-center px-3 py-3 text-sm font-medium rounded-md',
                        ]"
                    >
                        <component
                            :is="item.icon"
                            class="mr-3 h-8 w-8 flex-shrink-0 text-indigo-300"
                            aria-hidden="true"
                        />
                    </Link>
                </div>
            </div>
        </nav>
    </div>
</template>
