<script setup>
import Image from "@/Components/Image/Image.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import { ref } from "vue";

const props = defineProps({
    roleArr: Object,
    user: Object,
    statusArr: Object,
});

const nameInput = ref(null);
const emailInput = ref(null);
const statusInput = ref(null);
const roleInput = ref(null);

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    status: props.user.status,
    roles: props.user.has_roles,
});

const storeUser = () => {
    form.post(route("user.update", props.user.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                nameInput.value.focus();
            }
            if (form.errors.email) {
                emailInput.value.focus();
            }
            if (form.errors.status) {
                statusInput.value.focus();
            }
            if (form.errors.roles) {
                roleInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="dark:text-white">
        <form @submit.prevent="storeUser" class="mt-6 space-y-6 p-3">
            <div class="mt-10 sm:mt-0">
                <div class="shadow sm:rounded-md">
                    <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="name"
                                    value="Name :"
                                    class="block text-sm font-medium text-gray-700"
                                />
                                <TextInput
                                    id="name"
                                    ref="nameInput"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="name"
                                />
                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="email"
                                    value="Email :"
                                    class="block text-sm font-medium text-gray-700"
                                />
                                <TextInput
                                    id="email"
                                    ref="emailInput"
                                    v-model="form.email"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="email"
                                />
                                <InputError
                                    :message="form.errors.email"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div
                                    class="p-4 space-x-5 shadow flex items-center min-h-full h-[150px]"
                                >
                                    <div
                                        class="text-2x block text-center text-2xl"
                                    >
                                        Avatar:
                                    </div>
                                    <Image
                                        :id="user.id"
                                        field="avatar"
                                        :isDeleteable="true"
                                        v-model="user.avatar"
                                        route="user.image"
                                        class="w-32 h-32 rounded-full overflow-clip bg-red-500"
                                    />
                                </div>
                            </div>
                            <div
                                class="col-span-6 sm:col-span-3 grid grid-cols-6 gap-5 items-center justify-between"
                            >
                                <div
                                    class="col-span-3"
                                    v-if="roleArr.length > 0"
                                >
                                    <InputLabel
                                        for="roles"
                                        value="Role :"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    />
                                    <Multiselect
                                        v-model="form.roles"
                                        :options="roleArr"
                                        :selected="form.roles"
                                        placeholder="Pick some..."
                                        class="block w-full multiselect-green form-controll dark:text-gray-900"
                                        mode="tags"
                                        :searchable="true"
                                        :close-on-select="false"
                                    >
                                    </Multiselect>

                                    <InputError
                                        :message="form.errors.roles"
                                        class="mt-2 col-start-2 col-span-4"
                                    />
                                </div>
                                <div class="col-span-3">
                                    <InputLabel
                                        for="status"
                                        value="Status :"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    />
                                    <Multiselect
                                        v-model="form.status"
                                        :options="statusArr"
                                        :selected="form.status"
                                        placeholder="Pick some..."
                                        class="block w-full multiselect-green form-controll dark:text-black"
                                        :searchable="true"
                                        :classes="{
                                            search: ' border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-800',
                                            singleLabelText:
                                                '  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold',
                                        }"
                                    >
                                    </Multiselect>
                                    <InputError
                                        :message="form.errors.status"
                                        class="mt-2 col-start-2 col-span-4"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pr-5 py-5">
                <PrimaryButton :disabled="form.processing"
                    >Update</PrimaryButton
                >

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Ppdated.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>
