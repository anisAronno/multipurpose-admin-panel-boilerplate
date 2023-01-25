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

        </div>
    </MasterLayout>
</template>
