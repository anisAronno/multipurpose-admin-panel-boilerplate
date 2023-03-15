<script setup>
import SocialLink from "@/Components/SocialLink.vue";
import Form from "@/Pages/Frontend/Contact/Partials/Form.vue";
import { EnvelopeIcon, PhoneIcon } from "@heroicons/vue/24/outline";
</script>
<template>
    <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50">
        <div class="mx-auto max-w-full py-6 px-6 sm:py-10 lg:px-8">
            <div
                class="relative bg-cyan-50 dark:bg-gray-800 text-gray-900 dark:text-gray-50 shadow-xl"
            >
                <h2 class="sr-only">
                    {{ __("contact.form.mobile_title") }}
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <div
                        class="relative overflow-hidden bg-cyan-700 py-10 px-6 sm:px-10 xl:p-12"
                    >
                        <div
                            class="pointer-events-none absolute inset-0 sm:hidden"
                            aria-hidden="true"
                        >
                            <svg
                                class="absolute inset-0 h-full w-full"
                                width="343"
                                height="388"
                                viewBox="0 0 343 388"
                                fill="none"
                                preserveAspectRatio="xMidYMid slice"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M-99 461.107L608.107-246l707.103 707.107-707.103 707.103L-99 461.107z"
                                    fill="url(#linear1)"
                                    fill-opacity=".1"
                                />
                                <defs>
                                    <linearGradient
                                        id="linear1"
                                        x1="254.553"
                                        y1="107.554"
                                        x2="961.66"
                                        y2="814.66"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#fff" />
                                        <stop
                                            offset="1"
                                            stop-color="#fff"
                                            stop-opacity="0"
                                        />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div
                            class="pointer-events-none absolute top-0 right-0 bottom-0 hidden w-1/2 sm:block lg:hidden"
                            aria-hidden="true"
                        >
                            <svg
                                class="absolute inset-0 h-full w-full"
                                width="359"
                                height="339"
                                viewBox="0 0 359 339"
                                fill="none"
                                preserveAspectRatio="xMidYMid slice"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M-161 382.107L546.107-325l707.103 707.107-707.103 707.103L-161 382.107z"
                                    fill="url(#linear2)"
                                    fill-opacity=".1"
                                />
                                <defs>
                                    <linearGradient
                                        id="linear2"
                                        x1="192.553"
                                        y1="28.553"
                                        x2="899.66"
                                        y2="735.66"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#fff" />
                                        <stop
                                            offset="1"
                                            stop-color="#fff"
                                            stop-opacity="0"
                                        />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div
                            class="pointer-events-none absolute top-0 right-0 bottom-0 hidden w-1/2 lg:block"
                            aria-hidden="true"
                        >
                            <svg
                                class="absolute inset-0 h-full w-full"
                                width="160"
                                height="678"
                                viewBox="0 0 160 678"
                                fill="none"
                                preserveAspectRatio="xMidYMid slice"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M-161 679.107L546.107-28l707.103 707.107-707.103 707.103L-161 679.107z"
                                    fill="url(#linear3)"
                                    fill-opacity=".1"
                                />
                                <defs>
                                    <linearGradient
                                        id="linear3"
                                        x1="192.553"
                                        y1="325.553"
                                        x2="899.66"
                                        y2="1032.66"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#fff" />
                                        <stop
                                            offset="1"
                                            stop-color="#fff"
                                            stop-opacity="0"
                                        />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white">
                            {{ __("contact.information.title") }}
                        </h3>
                        <p
                            class="mt-6 max-w-3xl text-base text-cyan-50 break-words"
                        >
                            {{ $page.props.global.options.address }}
                        </p>
                        <dl class="mt-8 space-y-6">
                            <dt>
                                <span class="sr-only">{{
                                    __("contact.phone")
                                }}</span>
                            </dt>
                            <dd class="flex text-base text-cyan-50">
                                <PhoneIcon
                                    class="h-6 w-6 flex-shrink-0 text-cyan-200"
                                    aria-hidden="true"
                                />
                                <span class="ml-3">{{
                                    $page.props.global.options.phone
                                }}</span>
                            </dd>
                            <dt><span class="sr-only">Email</span></dt>
                            <dd class="flex text-base text-cyan-50">
                                <EnvelopeIcon
                                    class="h-6 w-6 flex-shrink-0 text-cyan-200"
                                    aria-hidden="true"
                                />
                                <span class="ml-3">{{
                                    $page.props.global.options.email
                                }}</span>
                            </dd>
                        </dl>
                        <div class="grid justify-start">
                            <SocialLink></SocialLink>
                        </div>
                    </div>

                    <!-- Contact form -->
                    <Form></Form>
                </div>
            </div>
        </div>
    </div>
</template>
