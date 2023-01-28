<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import MasterLayout from "@/Layouts/MasterLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head>
        <title>About</title>
    </Head>
    <MasterLayout>
        <div>
            <Banner></Banner>
        </div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 gap-5 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <div class="p-5 sm:p-10">
                <img
                    class="w-full h-96 rounded-md"
                    src="https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-01.jpg"
                    alt=""
                />
            </div>
            <div class="p-5 sm:p-10">
                <h1
                    class="text-4xl mb-5 underline underline-offset-8 decoration-slate-500"
                >
                    About us
                </h1>
                <p class="text-md text-gray-700 dark:text-gray-400 ">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Consequuntur eveniet tempora quis aperiam. Ex nobis vero
                    voluptatem velit impedit delectus ad similique quibusdam,
                    repellat accusamus a suscipit doloribus nihil ab, fugit
                    obcaecati at assumenda adipisci? Perspiciatis earum vitae, a
                    aliquid obcaecati nesciunt magni fugiat, illo tenetur, cum
                    eaque excepturi dolore quisquam. Incidunt dolor
                    consequuntur, quos autem ipsa, voluptatum, voluptatibus modi
                    sint a repellat minus! Sit quod unde a ipsam, fuga pariatur
                    similique error, animi, molestias nulla facilis nisi earum
                    hic fugiat porro voluptatem blanditiis architecto
                    perspiciatis neque ratione non eaque iure. Aperiam assumenda
                    beatae at ipsam laborum, veniam velit optio eveniet quae
                </p>
            </div>
        </div>

        <div
            class="container mx-auto p-6 bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50"
        >
            <div class="grid grid-col sm:grid-cols-2 gap-5">
                <div class="p-5 sm:p-10">
                    <section class="mb-6">
                        <h2 class="text-xl font-medium mb-2">Vision</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-400">
                            Our vision is to become the leading provider of
                            innovative solutions in our industry.
                        </p>
                    </section>
                    <section class="mb-6">
                        <h2 class="text-xl font-medium mb-2">Mission</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-400">
                            Our mission is to deliver exceptional products and
                            services to our customers, while fostering a culture
                            of innovation and excellence.
                        </p>
                    </section>
                    <section>
                        <h2 class="text-xl font-medium mb-2">Goals</h2>
                        <ul class="text-lg list-disc text-gray-700 dark:text-gray-400 pl-[5%]">
                            <li>
                                To increase market share by 20% in the next 3
                                years.
                            </li>
                            <li>
                                To develop and launch at least 2 new products
                                per year.
                            </li>
                            <li>
                                To achieve a customer satisfaction rating of 95%
                                or higher.
                            </li>
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
    </MasterLayout>
</template>
