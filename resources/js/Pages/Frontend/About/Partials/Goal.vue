<script></script>
<template>
    <div
        class="container mx-auto p-6 bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
    >
        <div
            class="grid grid-col sm:grid-cols-2 gap-5 bg-cyan-100 text-gray-900 dark:bg-gray-800 dark:text-gray-50"
        >
            <div class="p-5 sm:p-10">
                <section class="mb-6">
                    <h2 class="text-xl font-medium mb-2">
                        {{ __("about.vision.title", "Vision") }}
                    </h2>
                    <p class="text-lg text-gray-700 dark:text-gray-400">
                        {{
                            __(
                                "about.vision.decription",
                                `Our vision is to become the leading provider of
                        innovative solutions in our industry.`
                            )
                        }}
                    </p>
                </section>
                <section class="mb-6">
                    <h2 class="text-xl font-medium mb-2">
                        {{ __("about.mission.title", "Mission") }}
                    </h2>
                    <p class="text-lg text-gray-700 dark:text-gray-400">
                        {{
                            __(
                                "about.mission.decription",
                                `Our vision is to become the leading provider of
                        innovative solutions in our industry.`
                            )
                        }}
                    </p>
                </section>
                <section>
                    <h2 class="text-xl font-medium mb-2">
                        {{ __("about.goals.title", "Goals") }}
                    </h2>
                    <ul
                        class="text-lg list-disc text-gray-700 dark:text-gray-400"
                    >
                        {{
                            __(
                                "about.mission.decription",
                                `Our goal is to become the leading provider of
                                innovative solutions in our industry.`
                            )
                        }}
                    </ul>
                </section>
            </div>
            <div class="p-5 sm:p-10">
                <img
                    class="w-full h-96 rounded-md"
                    src="https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-01.jpg"
                    alt=""
                />
            </div>
        </div>
    </div>
</template>
