<script setup>
const products = [
    {
        id: 1,
        name: "Organize Basic Set (Walnut)",
        price: "$149",
        rating: 5,
        reviewCount: 38,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-01.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 2,
        name: "Organize Pen Holder",
        price: "$15",
        rating: 5,
        reviewCount: 18,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-02.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 3,
        name: "Organize Sticky Note Holder",
        price: "$15",
        rating: 5,
        reviewCount: 14,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-03.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 4,
        name: "Organize Phone Holder",
        price: "$15",
        rating: 4,
        reviewCount: 21,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-04.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 1,
        name: "Organize Basic Set (Walnut)",
        price: "$149",
        rating: 5,
        reviewCount: 38,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-01.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 2,
        name: "Organize Pen Holder",
        price: "$15",
        rating: 5,
        reviewCount: 18,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-02.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 3,
        name: "Organize Sticky Note Holder",
        price: "$15",
        rating: 5,
        reviewCount: 14,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-03.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    {
        id: 4,
        name: "Organize Phone Holder",
        price: "$15",
        rating: 4,
        reviewCount: 21,
        imageSrc:
            "https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-04.jpg",
        imageAlt: "TODO",
        href: "#",
    },
    // More products...
];
</script>
<template>
    <div
        class="bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50 my-5"
    >
        <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
            <h2 class="sr-only">Products</h2>

            <div
                class="-mx-px grid grid-cols-2 border-l border-gray-200 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"
            >
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="group relative border border-gray-200 p-4 sm:p-6"
                >
                    <div
                        class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-50group-hover:opacity-75"
                    >
                        <img
                            :src="product.imageSrc"
                            :alt="product.imageAlt"
                            class="h-full w-full object-cover object-center"
                        />
                    </div>
                    <div class="pt-10 pb-4 text-center">
                        <h3
                            class="text-sm font-medium bg-cyan-50 text-gray-900 dark:bg-gray-900 dark:text-gray-50"
                        >
                            <a :href="product.href">
                                <span
                                    aria-hidden="true"
                                    class="absolute inset-0"
                                />
                                {{ product.name }}
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
