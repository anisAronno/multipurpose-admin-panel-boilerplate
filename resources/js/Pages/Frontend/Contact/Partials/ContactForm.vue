<script setup>
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
                        <ul role="list" class="mt-8 flex space-x-12">
                            <li>
                                <a
                                    class="text-cyan-200 hover:text-cyan-100"
                                    href="#"
                                >
                                    <span class="sr-only">Facebook</span>
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M22.258 1H2.242C1.556 1 1 1.556 1 2.242v20.016c0 .686.556 1.242 1.242 1.242h10.776v-8.713h-2.932V11.39h2.932V8.887c0-2.906 1.775-4.489 4.367-4.489 1.242 0 2.31.093 2.62.134v3.037l-1.797.001c-1.41 0-1.683.67-1.683 1.653v2.168h3.362l-.438 3.396h-2.924V23.5h5.733c.686 0 1.242-.556 1.242-1.242V2.242C23.5 1.556 22.944 1 22.258 1"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a
                                    class="text-cyan-200 hover:text-cyan-100"
                                    href="#"
                                >
                                    <span class="sr-only">GitHub</span>
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M11.999 0C5.373 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.386.6.11.819-.26.819-.578 0-.284-.01-1.04-.017-2.04-3.337.724-4.042-1.61-4.042-1.61-.545-1.386-1.332-1.755-1.332-1.755-1.09-.744.082-.73.082-.73 1.205.086 1.838 1.238 1.838 1.238 1.07 1.833 2.81 1.304 3.493.996.109-.775.419-1.303.762-1.603C7.145 17 4.343 15.97 4.343 11.373c0-1.31.468-2.382 1.236-3.22-.124-.304-.536-1.524.118-3.176 0 0 1.007-.323 3.3 1.23.956-.266 1.983-.4 3.003-.404 1.02.005 2.046.138 3.005.404 2.29-1.553 3.296-1.23 3.296-1.23.655 1.652.243 2.872.12 3.176.77.838 1.233 1.91 1.233 3.22 0 4.61-2.806 5.624-5.478 5.921.43.37.814 1.103.814 2.223 0 1.603-.015 2.898-.015 3.291 0 .321.217.695.825.578C20.565 21.796 24 17.3 24 12c0-6.627-5.373-12-12.001-12"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a
                                    class="text-cyan-200 hover:text-cyan-100"
                                    href="#"
                                >
                                    <span class="sr-only">Twitter</span>
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M7.548 22.501c9.056 0 14.01-7.503 14.01-14.01 0-.213 0-.425-.015-.636A10.02 10.02 0 0024 5.305a9.828 9.828 0 01-2.828.776 4.94 4.94 0 002.165-2.724 9.867 9.867 0 01-3.127 1.195 4.929 4.929 0 00-8.391 4.491A13.98 13.98 0 011.67 3.9a4.928 4.928 0 001.525 6.573A4.887 4.887 0 01.96 9.855v.063a4.926 4.926 0 003.95 4.827 4.917 4.917 0 01-2.223.084 4.93 4.93 0 004.6 3.42A9.88 9.88 0 010 20.289a13.941 13.941 0 007.548 2.209"
                                            fill="currentColor"
                                        />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact form -->
                    <Form></Form>
                </div>
            </div>
        </div>
    </div>
</template>
