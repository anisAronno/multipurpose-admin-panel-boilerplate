<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Textarea from "@/Components/Textarea.vue";
import TextInput from "@/Components/TextInput.vue";
import { useCountries } from "@/composables/useCountries";
import { useForm } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import { watch, ref } from "vue";

const { userCountry, countries } = useCountries();

const props = defineProps(["modelValue", "address"]);

const emit = defineEmits(["update:modelValue"]);

const closeModal = () => {
    emit("update:modelValue", false);
};
const titleInput = ref(null);
const addresslInput = ref(null);
const cityInput = ref(null);
const stateInput = ref(null);
const districtInput = ref(null);
const zip_codeInput = ref(null);
const countryInput = ref(null);

const form = useForm({
    title: props.address?.title,
    address: props.address?.address,
    city: props.address?.city,
    state: props.address?.state,
    district: props.address?.district,
    zip_code: props.address?.zip_code,
    country: userCountry?.country,
});

watch(
    () => props.address,
    (card) => {
        if (card) {
            form.title = card.title;
            form.address = card.address;
            form.city = card.city;
            form.state = card.state;
            form.district = card.district;
            form.zip_code = card.zip_code;
            form.country = card.country;
        }
    }
);

const editRecord = (id) => {
    form.post(route("address.update", props.address.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => {
            if (form.errors.title) {
                titleInput.value.focus();
            }
            if (form.errors.address) {
                addresslInput.value.focus();
            }
            if (form.errors.city) {
                cityInput.value.focus();
            }
            if (form.errors.state) {
                stateInput.value.focus();
            }
            if (form.errors.district) {
                districtInput.value.focus();
            }
            if (form.errors.zip_code) {
                zip_codeInput.value.focus();
            }
            if (form.errors.country) {
                countryInput.value.focus();
            }
        },
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <section>
        <Modal :show="modelValue" @close="closeModal">
            <div
                class="p-6 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-50"
            >
                <form action="">
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel
                            for="title"
                            value="Title: "
                            class="text-xl"
                        />

                        <TextInput
                            id="title"
                            ref="titleInput"
                            v-model="form.title"
                            type="title"
                            class="block w-full h-8 p-1"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel
                            for="address"
                            value="Address: "
                            class="text-xl"
                        />

                        <Textarea
                            id="address"
                            ref="addresslInput"
                            v-model="form.address"
                            type="address"
                            class="block w-full h-8 p-1"
                            @keyup.enter="deleteUser"
                        >
                        </Textarea>

                        <InputError
                            :message="form.errors.address"
                            class="mt-2"
                        />
                    </div>
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel for="city" value="city: " class="text-xl" />

                        <TextInput
                            id="city"
                            ref="cityInput"
                            v-model="form.city"
                            type="city"
                            class="block w-full h-8 p-1"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.city" class="mt-2" />
                    </div>
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel
                            for="state"
                            value="State: "
                            class="text-xl"
                        />

                        <TextInput
                            id="state"
                            ref="stateInput"
                            v-model="form.state"
                            type="state"
                            class="block w-full p-1"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.state" class="mt-2" />
                    </div>
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel
                            for="district"
                            value="district: "
                            class="text-xl"
                        />

                        <TextInput
                            id="district"
                            ref="districtInput"
                            v-model="form.district"
                            type="district"
                            class="block w-full h-8 p-1"
                            @keyup.enter="deleteUser"
                        />

                        <InputError
                            :message="form.errors.district"
                            class="mt-2"
                        />
                    </div>
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel
                            for="zip_code"
                            value="Zip Code: "
                            class="text-xl"
                        />

                        <TextInput
                            id="zip_code"
                            ref="zipCodeInput"
                            v-model="form.zip_code"
                            type="zip_code"
                            class="block w-full h-8 p-1"
                            @keyup.enter="deleteUser"
                        />

                        <InputError
                            :message="form.errors.zip_code"
                            class="mt-2"
                        />
                    </div>
                    <div class="p-2 sm:p-4 space-y-2 sm:space-y-5 w-full">
                        <InputLabel
                            for="country"
                            value="Country: "
                            class="text-xl"
                        />

                        <Multiselect
                            v-model="form.country"
                            :options="countries"
                            :selected="form.country"
                            placeholder="Pick some..."
                               ref="countryInput"
                            class="block w-full multiselect-green form-controll dark:text-black"
                            :searchable="true"
                            :classes="{
                                 search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-700',
                                singleLabelText:
                                    '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                            }"
                            id="country"
                        >
                        </Multiselect>

                        <InputError
                            :message="form.errors.country"
                            class="mt-2"
                        />
                    </div>
                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal">
                            Cancel
                        </SecondaryButton>

                        <button
                            class="ml-3 btn btn-primary"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="editRecord"
                        >
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </Modal>
    </section>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>
