<script setup>
defineProps({
    featuredBlog: Object,
});
</script>

<template>
    <div
        class="relative bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 py-6 sm:py-10 lg:my-12"
    >
        <div class="relative">
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
                    v-for="blog in featuredBlog"
                    :key="blog.id"
                    class="flex flex-col overflow-hidden rounded-lg shadow-lg"
                >
                    <div class="flex-shrink-0">
                        <Link :href="route('blog.show', blog.slug)">
                            <img
                                class="h-48 w-full object-cover"
                                :src="blog.image"
                                alt=""
                            />
                        </Link>
                    </div>
                    <div
                        class="flex flex-1 flex-col justify-between bg-white p-6"
                    >
                        <div class="flex-1">
                            <p
                                className="text-sm font-medium text-blue-500"
                                v-for="cat in blog.categories.slice(0, 3)"
                                :key="cat.id"
                            >
                                <Link
                                    :href="route('category.show', cat.slug)"
                                    className="hover:underline"
                                >
                                    {{ cat.title }}
                                </Link>
                            </p>
                            <a :href="blog.href" class="mt-2 block">
                                <Link
                                    :href="route('blog.show', blog.slug)"
                                    class="mt-2 block"
                                >
                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
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
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <a :href="blog.user?.href">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        :src="blog.user.avatar"
                                        :alt="blog.user.name"
                                    />
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <a
                                        :href="blog.user?.href"
                                        class="hover:underline"
                                        >{{ blog.user.name }}</a
                                    >
                                </p>
                                <div
                                    class="flex space-x-1 text-sm text-gray-500"
                                >
                                    <span>{{ blog.created_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
