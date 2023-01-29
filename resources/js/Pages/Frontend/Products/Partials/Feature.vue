<script setup>
import {
    CurrencyDollarIcon,
    GlobeAltIcon,
    ReceiptRefundIcon,
    ShoppingCartIcon,
} from "@heroicons/vue/24/outline";
const perks = [
    {
        name: "Free returns",
        icon: ReceiptRefundIcon,
        description:
            "Not what you expected? Place it back in the parcel and attach the pre-paid postage stamp.",
    },
    {
        name: "Same day delivery",
        icon: ShoppingCartIcon,
        description:
            "We offer a delivery service that has never been done before. Checkout today and receive your products within hours.",
    },
    {
        name: "All year discount",
        icon: CurrencyDollarIcon,
        description:
            'Looking for a deal? You can use the code "ALLYEAR" at checkout and get money off all year round.',
    },
    {
        name: "For the planet",
        icon: GlobeAltIcon,
        description:
            "We’ve pledged 1% of sales to the preservation and restoration of the natural environment.",
    },
];
</script>
<template>
    <section
        aria-labelledby="perks-heading"
        class="border-t border-gray-200 bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
    >
        <h2 id="perks-heading" class="sr-only">Our perks</h2>

        <div class="mx-auto max-w-7xl py-8 px-4 sm:px-4 sm:py-12 lg:px-8">
            <div
                class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-0"
            >
                <div
                    v-for="perk in perks"
                    :key="perk.name"
                    class="py-24 px-4 sm:px-6 sm:py-32 lg:px-8 text-center md:flex md:items-start md:text-left lg:block lg:text-center bg-cyan-100 dark:bg-gray-800"
                >
                    <div class="md:flex-shrink-0">
                        <div class="grid place-content-center">
                            <component
                                :is="perk.icon"
                                class="w-8 h-8 md:w-12 md:h-12 xl:w-16 xl:h-16"
                                aria-hidden="true"
                            />
                        </div>
                    </div>
                    <div class="mt-6 md:mt-0 md:ml-4 lg:mt-6 lg:ml-0">
                        <h3
                            class="text-base font-medium text-gray-900 dark:text-gray-100"
                        >
                            {{ perk.name }}
                        </h3>
                        <p
                            class="mt-3 text-sm text-gray-500 dark:text-gray-300"
                        >
                            {{ perk.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
