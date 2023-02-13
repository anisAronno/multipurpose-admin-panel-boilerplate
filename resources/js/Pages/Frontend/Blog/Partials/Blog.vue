<script setup>
import Pagination from "@/Components/Pagination.vue";
defineProps({
    blogs: Object,
});
</script>

<template>
    <div
        class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 py-6 sm:py-10 lg:py-12"
    >
        <div
            class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-full lg:px-8"
        >
            <h2 class="text-lg font-semibold text-cyan-600">
                {{ __("blog.heading") }}
            </h2>
            <p
                class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
            >
                {{ __("blog.sub_heading") }}
            </p>
            <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                {{ __("blog.description") }}
            </p>
        </div>
        <div
            class="mx-auto mt-12 grid max-w-md gap-8 px-6 sm:max-w-lg lg:max-w-full lg:grid-cols-3 lg:px-8"
        >
            <div
                v-for="blog in blogs.data"
                :key="blog.id"
                class="flex flex-col overflow-hidden rounded-lg shadow-lg"
            >
                <div class="flex-shrink-0">
                    <Link :href="route('blog.show', blog.slug)">
                        <img
                            class="h-48 w-full object-cover"
                            :src="blog.images[0].url"
                            alt=""
                        />
                    </Link>
                </div>
                <div class="flex flex-1 flex-col justify-between bg-white p-6">
                    <div class="flex-1">
                        <!-- <p class="text-sm font-medium text-cyan-600">
                                <span href="#" class="hover:underline">
                                    {{ blog.title }}
                                </span>
                            </p> -->
                        <Link
                            :href="route('blog.show', blog.slug)"
                            class="mt-2 block"
                        >
                            <p class="text-xl font-semibold text-gray-900">
                                {{ blog.title }}
                            </p>
                        </Link>
                        <p class="mt-3 text-base text-gray-500">
                            {{
                                blog.description
                                    .split(" ")
                                    .slice(0, 15)
                                    .join(" ") + " ..."
                            }}
                        </p>
                    </div>
                    <div class="mt-6 flex items-center">
                        <div class="flex-shrink-0">
                            <span>
                                <img
                                    class="h-10 w-10 rounded-full"
                                    :src="blog.user.avatar"
                                    :alt="blog.user.name"
                                />
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                <a
                                    :href="blog.user?.href"
                                    class="hover:underline"
                                    >{{ blog.user.name }}</a
                                >
                            </p>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <span>{{ blog.created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination
            v-if="blogs.last_page > 1"
            class="my-5 dark:text-white flex justify-end p-3"
            :links="blogs.links"
        ></Pagination>
    </div>
</template>
