<script></script>
<template>
    <div
        class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14 bg-cover bg-center pb-10"
        :style="`background-image: url(${$page.props.global.options.banner}); `"
        id="bg-banner"
    >
        <div class="mx-auto max-w-full lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                <div
                    class="mx-auto max-w-md px-6 sm:max-w-2xl sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left"
                >
                    <div class="lg:py-24">
                        <Link
                            :href="route('contact')"
                            class="inline-flex items-center rounded-full p-1 pr-2 text-gray-900 dark:text-white bg-gray-200 dark:bg-black hover:text-gray-500 dark:hover:text-gray-500 sm:text-base lg:text-sm xl:text-base"
                        >
                            <span
                                class="rounded-full bg-gradient-to-r from-teal-500 to-cyan-600 px-3 py-0.5 text-sm font-semibold leading-5 text-white"
                                >{{ __("banner.contact") }}</span
                            >
                            <span class="ml-4 text-sm">{{
                                __("banner.to_contact")
                            }}</span>
                            <font-awesome-icon
                                icon="fa-solid fa-chevron-right "
                                class="ml-2 h-3 mt-1 w-3 text-gray-500"
                            />
                        </Link>
                        <h1
                            class="mt-4 text-4xl font-bold tracking-tight lg:dark:text-white lg:text-gray-800 sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl text-cyan-400 bg-blend-saturation lg:bg-transparent p-2 lg:p-0"
                        >
                            <span class="block">{{
                                __("banner.title_1")
                            }}</span>
                            <span
                                class="block bg-gradient-to-r from-teal-400 to-cyan-500 bg-clip-text pb-3 text-transparent sm:pb-5"
                                >{{ __("banner.title_2") }}</span
                            >
                        </h1>
                        <p
                            class="text-base lg:text-gray-500 lg:dark:text-gray-300 sm:text-xl lg:text-lg xl:text-xl text-cyan-300 bg-[rgba(255, 230, 180, 0.1)] bg-blend-saturation lg:bg-transparent p-2 lg:p-0 hidden lg:block"
                        >
                            {{ __("banner.sub_title") }}
                        </p>
                    </div>
                </div>
                <div
                    class="mt-12 -mb-16 sm:-mb-48 lg:relative lg:m-0 hidden lg:block"
                >
                    <div
                        class="mx-auto max-w-md px-6 sm:max-w-2xl lg:max-w-none lg:px-0"
                    >
                        <img
                            class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                            :src="$page.props.global.options.banner"
                            alt="Banner Image"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@media only screen and (min-width: 1024px) {
    #bg-banner {
        background-image: none !important;
    }
}
</style>
