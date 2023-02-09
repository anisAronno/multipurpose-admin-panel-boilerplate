<script setup></script>

<template>
    <section
        aria-labelledby="sale-heading"
        class="border-b-2 border-cyan-400 dark:border-none"
    >
        <div
            class="overflow-hidden pt-32 sm:pt-14 bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <div
                class="bg-cyan-300 text-gray-900 dark:bg-gray-800 dark:text-gray-50"
            >
                <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
                    <div class="relative pt-48 pb-16 sm:pb-24">
                        <div>
                            <h2
                                id="sale-heading"
                                class="text-2xl font-bold tracking-tight md:text-3xl break-all overflow-hidden"
                            >
                                {{ __("contact.section.title") }}
                            </h2>
                            <div class="inline-flex rounded-md shadow mt-5">
                                <Link
                                    :href="route('contact')"
                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-gray-900 hover:bg-gray-50"
                                >
                                    {{ __("contact.section.link_text") }}

                                    <font-awesome-icon
                                        icon="fa-solid fa-arrow-up-right-from-square"
                                        class="-mr-1 ml-3 h-4 w-4 text-gray-400"
                                    />
                                </Link>
                            </div>
                        </div>

                        <div
                            class="absolute -top-32 left-1/2 -translate-x-1/2 transform sm:top-6 sm:translate-x-0"
                        >
                            <div
                                class="ml-24 flex min-w-max space-x-6 sm:ml-3 lg:space-x-8"
                            >
                                <div
                                    class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8"
                                >
                                    <div class="flex-shrink-0">
                                        <img
                                            class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                            :src="
                                                $page.props.global.options
                                                    .model_one
                                            "
                                            alt=""
                                        />
                                    </div>

                                    <div class="mt-6 flex-shrink-0 sm:mt-0">
                                        <img
                                            class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                            :src="
                                                $page.props.global.options
                                                    .model_two
                                            "
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex space-x-6 sm:-mt-20 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8"
                                >
                                    <div class="flex-shrink-0">
                                        <img
                                            class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                            :src="
                                                $page.props.global.options
                                                    .model_three
                                            "
                                            alt=""
                                        />
                                    </div>

                                    <div class="mt-6 flex-shrink-0 sm:mt-0">
                                        <img
                                            class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                            :src="
                                                $page.props.global.options
                                                    .model_four
                                            "
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex space-x-6 sm:flex-col sm:space-x-0 sm:space-y-6 lg:space-y-8"
                                >
                                    <div class="flex-shrink-0">
                                        <img
                                            class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                            src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-01.jpg"
                                            alt=""
                                        />
                                    </div>

                                    <div class="mt-6 flex-shrink-0 sm:mt-0">
                                        <img
                                            class="h-64 w-64 rounded-lg object-cover md:h-72 md:w-72"
                                            src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-02.jpg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
