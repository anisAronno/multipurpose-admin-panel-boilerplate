<script setup>
import DeleteForm from "@/Components/DeleteForm.vue";
import Dropdown from "@/Components/Dropdown.vue";
import { ref } from "vue";
import EditForm from "./EditForm.vue";
import Form from "./Form.vue";

const props = defineProps({
    addresses: Object,
});
const toggle = ref(null);
const showEditModal = ref(false);
const visible = ref(false);

const addAddress = () => {
    visible.value = true;
};

const editAddress = () => {
    showEditModal.value = true;
};
</script>

<template>
    <section>
        <header class="flex justify-between">
            <div>
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Address
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your Address.
                </p>
            </div>
            <div>
                <Form v-model="visible" v-if="visible"></Form>
                <span
                    class="btn btn-primary cursor-pointer"
                    @click="addAddress"
                >
                    <font-awesome-icon
                        icon="fa-solid fa-circle-plus"
                        class="mr-1"
                    />Add New Address
                </span>
            </div>
        </header>

        <div class="flex flex-wrap">
            <div
                class="p-5 gap-5 w-1/2"
                v-for="address in addresses"
                :key="address.id"
            >
                <EditForm
                    v-model="showEditModal"
                    :address="address"
                    v-if="showEditModal"
                    @blur="showEditModal != true"
                    tabindex="-1"
                ></EditForm>
                <div
                    class="w-full border border-gray-200 rounded-lg shadow-md bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-50 dark:border-gray-700"
                >
                    <div class="flex justify-between px-4 pt-4 relative">
                        <h2 class="text-2xl border-b-2 border-stone-600 pb-1">
                            {{ address.title }}
                        </h2>
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        id="dropdownButton"
                                        data-dropdown-toggle="dropdown"
                                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                        type="button"
                                    >
                                        <span class="sr-only"
                                            >Open dropdown</span
                                        >
                                        <svg
                                            class="w-6 h-6"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
                                            ></path>
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <ul
                                    class="py-3 space-y-3"
                                    aria-labelledby="dropdownButton"
                                >
                                    <li class="flex justify-center">
                                        <div
                                            class="btn btn-primary flex gap-3 cursor-pointer"
                                            @click="editAddress"
                                        >
                                            <font-awesome-icon
                                                icon="fa-solid fa-pen-to-square"
                                                class="text-white text-lg inline-block"
                                            />Edit
                                        </div>
                                    </li>
                                    <li class="flex justify-center">
                                        <div class="cursor-pointer">
                                            <DeleteForm
                                                class="w-full"
                                                :data="{
                                                    id: address.id,
                                                    model: 'address',
                                                }"
                                                >Delete</DeleteForm
                                            >
                                        </div>
                                    </li>
                                </ul>
                            </template>
                        </Dropdown>
                    </div>
                    <div
                        class="bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-50 p-5 space-y-3"
                    >
                        <div class="flex gap-5 w-full">
                            <h2>Address :</h2>
                            <p class="break-all break-words">
                                {{ address.address }}
                            </p>
                        </div>
                        <div class="flex gap-5 w-full">
                            <h2>City :</h2>
                            <p class="break-all">{{ address.city }}</p>
                        </div>
                        <div class="flex gap-5 w-full">
                            <h2>State :</h2>
                            <p class="break-all">{{ address.state }}</p>
                        </div>
                        <div class="flex gap-5 w-full">
                            <h2>District :</h2>
                            <p class="break-all">{{ address.district }}</p>
                        </div>
                        <div class="flex gap-5 w-full">
                            <h2>Zip Code :</h2>
                            <p class="break-all">{{ address.zip_code }}</p>
                        </div>
                        <div class="flex gap-5 w-full">
                            <h2>Country :</h2>
                            <p class="break-all">{{ address.country }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
