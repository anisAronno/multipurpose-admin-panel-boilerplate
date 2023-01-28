<template>
    <div
        class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14"
    >
        <div class="mx-auto max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                <div
                    class="mx-auto max-w-md px-6 sm:max-w-2xl sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left"
                >
                    <div class="lg:py-24">
                        <a
                            href="#"
                            class="inline-flex items-center rounded-full p-1 pr-2 text-gray-900 dark:text-white bg-gray-200 dark:bg-black hover:text-gray-200 sm:text-base lg:text-sm xl:text-base"
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
                            class="mt-4 text-4xl font-bold tracking-tight dark:text-white text-gray-800 sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl"
                        >
                            <span class="block">A better way to</span>
                            <span
                                class="block bg-gradient-to-r from-teal-200 to-cyan-400 bg-clip-text pb-3 text-transparent sm:pb-5"
                                >ship web apps</span
                            >
                        </h1>
                        <p
                            class="text-base text-gray-500 dark:text-gray-300 sm:text-xl lg:text-lg xl:text-xl"
                        >
                            Anim aute id magna aliqua ad ad non deserunt sunt.
                            Qui irure qui Lorem cupidatat commodo. Elit sunt
                            amet fugiat veniam occaecat fugiat.
                        </p>
                    </div>
                </div>
                <div class="mt-12 -mb-16 sm:-mb-48 lg:relative lg:m-0">
                    <div
                        class="mx-auto max-w-md px-6 sm:max-w-2xl lg:max-w-none lg:px-0"
                    >
                        <img
                            class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                            :src="$page.props.global.options.banner"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup></script>

<style></style>
