<script setup>
import {
    ArrowPathIcon,
    CloudArrowUpIcon,
    CogIcon,
    LockClosedIcon,
    ServerIcon,
    ShieldCheckIcon,
} from "@heroicons/vue/24/outline";

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
</script>
<template>
    <div class="relative bg-white py-6 sm:py-10 lg:py-12">
        <div
            class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8"
        >
            <h2 class="text-lg font-semibold text-cyan-600">Deploy faster</h2>
            <p
                class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
            >
                Everything you need to deploy your app
            </p>
            <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
                Phasellus lorem quam molestie id quisque diam aenean nulla in.
                Accumsan in quis quis nunc, ullamcorper malesuada. Eleifend
                condimentum id viverra nulla.
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
                        <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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
</template>

<style></style>
