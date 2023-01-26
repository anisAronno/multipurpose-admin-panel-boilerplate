<script setup>
const blogPosts = [
    {
        id: 1,
        title: "Boost your conversion rate",
        href: "#",
        date: "Mar 16, 2020",
        datetime: "2020-03-16",
        category: { name: "Article", href: "#" },
        imageUrl:
            "https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80",
        preview:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.",
        author: {
            name: "Roel Aufderehar",
            imageUrl:
                "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            href: "#",
        },
        readingLength: "6 min",
    },
    {
        id: 2,
        title: "How to use search engine optimization to drive sales",
        href: "#",
        date: "Mar 10, 2020",
        datetime: "2020-03-10",
        category: { name: "Video", href: "#" },
        imageUrl:
            "https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80",
        preview:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit facilis asperiores porro quaerat doloribus, eveniet dolore. Adipisci tempora aut inventore optio animi., tempore temporibus quo laudantium.",
        author: {
            name: "Brenna Goyette",
            imageUrl:
                "https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            href: "#",
        },
        readingLength: "4 min",
    },
    {
        id: 3,
        title: "Improve your customer experience",
        href: "#",
        date: "Feb 12, 2020",
        datetime: "2020-02-12",
        category: { name: "Case Study", href: "#" },
        imageUrl:
            "https://images.unsplash.com/photo-1492724441997-5dc865305da7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80",
        preview:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint harum rerum voluptatem quo recusandae magni placeat saepe molestiae, sed excepturi cumque corporis perferendis hic.",
        author: {
            name: "Daniela Metz",
            imageUrl:
                "https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
            href: "#",
        },
        readingLength: "11 min",
    },
];
</script>

<template>
    <div class="relative bg-gray-50 py-16 sm:py-24 lg:py-32">
        <div class="relative">
            <div
                class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
            >
                <h2 class="text-lg font-semibold text-cyan-600">Learn</h2>
                <p
                    class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                >
                    Helpful Resources
                </p>
                <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                    Phasellus lorem quam molestie id quisque diam aenean nulla
                    in. Accumsan in quis quis nunc, ullamcorper malesuada.
                    Eleifend condimentum id viverra nulla.
                </p>
            </div>
            <div
                class="mx-auto mt-12 grid max-w-md gap-8 px-6 sm:max-w-lg lg:max-w-7xl lg:grid-cols-3 lg:px-8"
            >
                <div
                    v-for="post in blogPosts"
                    :key="post.id"
                    class="flex flex-col overflow-hidden rounded-lg shadow-lg"
                >
                    <div class="flex-shrink-0">
                        <img
                            class="h-48 w-full object-cover"
                            :src="post.imageUrl"
                            alt=""
                        />
                    </div>
                    <div
                        class="flex flex-1 flex-col justify-between bg-white p-6"
                    >
                        <div class="flex-1">
                            <p class="text-sm font-medium text-cyan-600">
                                <a
                                    :href="post.category.href"
                                    class="hover:underline"
                                    >{{ post.category.name }}</a
                                >
                            </p>
                            <a :href="post.href" class="mt-2 block">
                                <p class="text-xl font-semibold text-gray-900">
                                    {{ post.title }}
                                </p>
                                <p class="mt-3 text-base text-gray-500">
                                    {{ post.preview }}
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <a :href="post.author.href">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        :src="post.author.imageUrl"
                                        :alt="post.author.name"
                                    />
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <a
                                        :href="post.author.href"
                                        class="hover:underline"
                                        >{{ post.author.name }}</a
                                    >
                                </p>
                                <div
                                    class="flex space-x-1 text-sm text-gray-500"
                                >
                                    <time :datetime="post.datetime">{{
                                        post.date
                                    }}</time>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>{{ post.readingLength }} read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
