<script setup>
const offices = [
    {
        id: 1,
        city: "Los Angeles",
        address: ["4556 Brendan Ferry", "Los Angeles, CA 90210"],
    },
    {
        id: 2,
        city: "New York",
        address: ["886 Walter Streets", "New York, NY 12345"],
    },
    {
        id: 3,
        city: "Toronto",
        address: ["7363 Cynthia Pass", "Toronto, ON N3Y 4H8"],
    },
    { id: 4, city: "London", address: ["114 Cobble Lane", "London N1 2EF"] },
];
</script>
<template>
    <section aria-labelledby="offices-heading">
        <div class="mx-auto max-w-7xl py-24 px-6 sm:py-32 lg:px-8">
            <h2
                id="offices-heading"
                class="text-3xl font-bold tracking-tight text-warm-gray-900"
            >
                Our offices
            </h2>
            <p class="mt-6 max-w-3xl text-lg text-warm-gray-500">
                Varius facilisi mauris sed sit. Non sed et duis dui leo,
                vulputate id malesuada non. Cras aliquet purus dui laoreet diam
                sed lacus, fames.
            </p>
            <div
                class="mt-10 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4"
            >
                <div v-for="office in offices" :key="office.id">
                    <h3 class="text-lg font-medium text-warm-gray-900">
                        {{ office.city }}
                    </h3>
                    <p class="mt-2 text-base text-warm-gray-500">
                        <span
                            v-for="line in office.address"
                            :key="line"
                            class="block"
                            >{{ line }}</span
                        >
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<style></style>
