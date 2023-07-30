<script></script>
<template>
    <div
        class="container mx-auto p-6 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
    >
        <div
            class="grid grid-col sm:grid-cols-2 gap-5 bg-cyan-50 text-gray-900 dark:bg-gray-800 dark:text-gray-50"
        >
            <div class="p-5 sm:p-10">
                <section class="mb-6">
                    <h2 class="text-xl font-medium mb-2">
                        {{ __("about.vision.title", "Vision") }}
                    </h2>
                    <p class="text-lg text-gray-700 dark:text-gray-400">
                        {{ __("about.vision.description") }}
                    </p>
                </section>
                <section class="mb-6">
                    <h2 class="text-xl font-medium mb-2">
                        {{ __("about.mission.title") }}
                    </h2>
                    <p class="text-lg text-gray-700 dark:text-gray-400">
                        {{ __("about.mission.description") }}
                    </p>
                </section>
                <section>
                    <h2 class="text-xl font-medium mb-2">
                        {{ __("about.goal.title") }}
                    </h2>
                    <ul
                        class="text-lg list-disc text-gray-700 dark:text-gray-400"
                    >
                        {{
                            __("about.goal.description")
                        }}
                    </ul>
                </section>
            </div>
            <div class="p-5 sm:p-10">
                <img
                    class="w-full h-auto rounded-md"
                    :src="$page.props.global.options.vission_mission_image"
                    alt="About Picture"
                />
            </div>
        </div>
    </div>
</template>
