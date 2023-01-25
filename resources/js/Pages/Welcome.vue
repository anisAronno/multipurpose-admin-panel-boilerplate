<script setup lang="ts">
import MasterLayout from "@/Layouts/MasterLayout.vue";
import {
    ArrowPathIcon,
    CloudArrowUpIcon,
    CogIcon,
    LockClosedIcon,
    ServerIcon,
    ShieldCheckIcon,
} from "@heroicons/vue/24/outline";
import { Head } from "@inertiajs/inertia-vue3";
import { defineComponent, h } from "vue";

const features = [
    {
        name: "Push to Deploy",
        description:
            "Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi vitae lobortis.",
        icon: CloudArrowUpIcon,
    },
    {
        name: "SSL Certificates",
        description:
            "Qui aut temporibus nesciunt vitae dicta repellat sit dolores pariatur. Temporibus qui illum aut.",
        icon: LockClosedIcon,
    },
    {
        name: "Simple Queues",
        description:
            "Rerum quas incidunt deleniti quaerat suscipit mollitia. Amet repellendus ut odit dolores qui.",
        icon: ArrowPathIcon,
    },
    {
        name: "Advanced Security",
        description:
            "Ullam laboriosam est voluptatem maxime ut mollitia commodi. Et dignissimos suscipit perspiciatis.",
        icon: ShieldCheckIcon,
    },
    {
        name: "Powerful API",
        description:
            "Ab a facere voluptatem in quia corrupti veritatis aliquam. Veritatis labore quaerat ipsum quaerat id.",
        icon: CogIcon,
    },
    {
        name: "Database Backups",
        description:
            "Quia qui et est officia cupiditate qui consectetur. Ratione similique et impedit ea ipsum et.",
        icon: ServerIcon,
    },
];
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
    <Head>
        <title>Home</title>
    </Head>
    <MasterLayout>
        <div>
            <div
                class="bg-gray-900 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14"
            >
                <div class="mx-auto max-w-7xl lg:px-8">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                        <div
                            class="mx-auto max-w-md px-6 sm:max-w-2xl sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left"
                        >
                            <div class="lg:py-24">
                                <a
                                    href="#"
                                    class="inline-flex items-center rounded-full bg-black p-1 pr-2 text-white hover:text-gray-200 sm:text-base lg:text-sm xl:text-base"
                                >
                                    <span
                                        class="rounded-full bg-gradient-to-r from-teal-500 to-cyan-600 px-3 py-0.5 text-sm font-semibold leading-5 text-white"
                                        >Contact us</span
                                    >
                                    <span class="ml-4 text-sm"
                                        >Visit to contact page</span
                                    >
                                    <font-awesome-icon
                                        icon="fa-solid fa-chevron-right "
                                        class="ml-2 h-3 mt-1 w-3 text-gray-500"
                                    />
                                </a>
                                <h1
                                    class="mt-4 text-4xl font-bold tracking-tight text-white sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl"
                                >
                                    <span class="block">A better way to</span>
                                    <span
                                        class="block bg-gradient-to-r from-teal-200 to-cyan-400 bg-clip-text pb-3 text-transparent sm:pb-5"
                                        >ship web apps</span
                                    >
                                </h1>
                                <p
                                    class="text-base text-gray-300 sm:text-xl lg:text-lg xl:text-xl"
                                >
                                    Anim aute id magna aliqua ad ad non deserunt
                                    sunt. Qui irure qui Lorem cupidatat commodo.
                                    Elit sunt amet fugiat veniam occaecat
                                    fugiat.
                                </p>
                            </div>
                        </div>
                        <div class="mt-12 -mb-16 sm:-mb-48 lg:relative lg:m-0">
                            <div
                                class="mx-auto max-w-md px-6 sm:max-w-2xl lg:max-w-none lg:px-0"
                            >
                                <!-- Illustration taken from Lucid Illustrations: https://lucid.pixsellz.io/ -->
                                <img
                                    class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                                    src="https://tailwindui.com/img/component-images/cloud-illustration-teal-cyan.svg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature section with grid -->
            <div class="relative bg-white py-16 sm:py-24 lg:py-32">
                <div
                    class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
                >
                    <h2 class="text-lg font-semibold text-cyan-600">
                        Deploy faster
                    </h2>
                    <p
                        class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                    >
                        Everything you need to deploy your app
                    </p>
                    <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                        Phasellus lorem quam molestie id quisque diam aenean
                        nulla in. Accumsan in quis quis nunc, ullamcorper
                        malesuada. Eleifend condimentum id viverra nulla.
                    </p>
                    <div class="mt-12">
                        <div
                            class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            <div
                                v-for="feature in features"
                                :key="feature.name"
                                class="pt-6"
                            >
                                <div
                                    class="flow-root rounded-lg bg-gray-50 px-6 pb-8"
                                >
                                    <div class="-mt-6">
                                        <div>
                                            <span
                                                class="inline-flex items-center justify-center rounded-md bg-gradient-to-r from-teal-500 to-cyan-600 p-3 shadow-lg"
                                            >
                                                <component
                                                    :is="feature.icon"
                                                    class="h-6 w-6 text-white"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </div>
                                        <h3
                                            class="mt-8 text-lg font-medium tracking-tight text-gray-900"
                                        >
                                            {{ feature.name }}
                                        </h3>
                                        <p class="mt-5 text-base text-gray-500">
                                            {{ feature.description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial section -->
            <div
                class="bg-gradient-to-r from-teal-500 to-cyan-600 pb-16 lg:relative lg:z-10 lg:pb-0"
            >
                <div
                    class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-8 lg:px-8"
                >
                    <div class="relative lg:-my-8">
                        <div
                            aria-hidden="true"
                            class="absolute inset-x-0 top-0 h-1/2 bg-white lg:hidden"
                        />
                        <div
                            class="mx-auto max-w-md px-6 sm:max-w-3xl lg:h-full lg:p-0"
                        >
                            <div
                                class="aspect-w-10 aspect-h-6 overflow-hidden rounded-xl shadow-xl sm:aspect-w-16 sm:aspect-h-7 lg:aspect-none lg:h-full"
                            >
                                <img
                                    class="object-cover lg:h-full lg:w-full"
                                    src="https://images.unsplash.com/photo-1520333789090-1afc82db536a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2102&q=80"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 lg:col-span-2 lg:m-0 lg:pl-8">
                        <div
                            class="mx-auto max-w-md px-6 sm:max-w-2xl lg:max-w-none lg:px-0 lg:py-20"
                        >
                            <blockquote>
                                <div>
                                    <svg
                                        class="h-12 w-12 text-white opacity-25"
                                        fill="currentColor"
                                        viewBox="0 0 32 32"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"
                                        />
                                    </svg>
                                    <p
                                        class="mt-6 text-2xl font-medium text-white"
                                    >
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Sed urna nulla vitae
                                        laoreet augue. Amet feugiat est integer
                                        dolor auctor adipiscing nunc urna, sit.
                                    </p>
                                </div>
                                <footer class="mt-6">
                                    <p class="text-base font-medium text-white">
                                        Judith Black
                                    </p>
                                    <p
                                        class="text-base font-medium text-cyan-100"
                                    >
                                        CEO at PureInsights
                                    </p>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog section -->
            <div class="relative bg-gray-50 py-16 sm:py-24 lg:py-32">
                <div class="relative">
                    <div
                        class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
                    >
                        <h2 class="text-lg font-semibold text-cyan-600">
                            Learn
                        </h2>
                        <p
                            class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                        >
                            Helpful Resources
                        </p>
                        <p
                            class="mx-auto mt-5 max-w-prose text-xl text-gray-500"
                        >
                            Phasellus lorem quam molestie id quisque diam aenean
                            nulla in. Accumsan in quis quis nunc, ullamcorper
                            malesuada. Eleifend condimentum id viverra nulla.
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
                                    <p
                                        class="text-sm font-medium text-cyan-600"
                                    >
                                        <a
                                            :href="post.category.href"
                                            class="hover:underline"
                                            >{{ post.category.name }}</a
                                        >
                                    </p>
                                    <a :href="post.href" class="mt-2 block">
                                        <p
                                            class="text-xl font-semibold text-gray-900"
                                        >
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
                                        <p
                                            class="text-sm font-medium text-gray-900"
                                        >
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
                                            <span aria-hidden="true"
                                                >&middot;</span
                                            >
                                            <span
                                                >{{
                                                    post.readingLength
                                                }}
                                                read</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="relative bg-gray-900">
                <div
                    class="relative h-56 bg-indigo-600 sm:h-72 md:absolute md:left-0 md:h-full md:w-1/2"
                >
                    <img
                        class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=60&sat=-100"
                        alt=""
                    />
                    <div
                        aria-hidden="true"
                        class="absolute inset-0 bg-gradient-to-r from-teal-500 to-cyan-600 mix-blend-multiply"
                    />
                </div>
                <div
                    class="relative mx-auto max-w-md py-12 px-6 sm:max-w-7xl sm:py-20 md:py-28 lg:px-8 lg:py-32"
                >
                    <div class="md:ml-auto md:w-1/2 md:pl-10">
                        <h2 class="text-lg font-semibold text-gray-300">
                            Award winning support
                        </h2>
                        <p
                            class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl"
                        >
                            We’re here to help
                        </p>
                        <p class="mt-3 text-lg text-gray-300">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Et, egestas tempus tellus etiam sed. Quam a
                            scelerisque amet ullamcorper eu enim et fermentum,
                            augue. Aliquet amet volutpat quisque ut interdum
                            tincidunt duis.
                        </p>
                        <div class="mt-8">
                            <div class="inline-flex rounded-md shadow">
                                <a
                                    href="#"
                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-gray-900 hover:bg-gray-50"
                                >
                                    Visit the help center

                                    <font-awesome-icon
                                        icon="fa-solid fa-arrow-up-right-from-square"
                                        class="-mr-1 ml-3 h-4 w-4 text-gray-400"
                                    />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MasterLayout>
</template>
