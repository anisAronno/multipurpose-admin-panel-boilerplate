<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Multiselect from "@suadelabs/vue3-multiselect";
import { ref } from "@vue/reactivity";

const props = defineProps({
    roles: Object,
    statusArr: Object,
});

const nameInput = ref(null);
const emailInput = ref(null);
const avatarInput = ref(null);
const statusInput = ref(null);
const roleInput = ref(null);
const passwordInput = ref(null);

const form = useForm({
    name: "",
    email: "",
    avatar: "",
    avatarPreview: `${route()?.t?.url}/uploads/users/avatar.png`,
    status: "",
    password: "",
    password_confirmation: "",
    roles: [],
});

const previewImage = (e) => {
    const file = e.target.files[0];
    form.avatarPreview = URL.createObjectURL(file);
};

const storeUser = () => {
    form.post(route("user.store"), {
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
            if (form.errors.password) {
                form.reset("password");
                form.reset("password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.roles) {
                roleInput.value.focus();
            }
            if (form.errors.avatar) {
                avatarInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="dark:text-white">
        <form @submit.prevent="storeUser" class="mt-6 space-y-6 p-3">
            <div class="mt-10 sm:mt-0">
                <div class="overflow-hidden shadow sm:rounded-md">
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
                                    :message="form.errors.name"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div
                                class="col-span-6 sm:col-span-3 flex items-center justify-between"
                            >
                                <div>
                                    <InputLabel
                                        for="avatar"
                                        value="Avatar :"
                                        class="block text-sm font-medium text-gray-700"
                                    />
                                    <input
                                        id="avatar"
                                        type="file"
                                        class="mt-1 block form-controll cursor-pointer"
                                        @change="previewImage"
                                        ref="avatarInput"
                                        @input="
                                            form.avatar = $event.target.files[0]
                                        "
                                    />
                                    <InputError
                                        :message="form.errors.avatar"
                                        class="mt-2 col-start-2 col-span-4"
                                    />
                                </div>
                                <span
                                    class="inline-block h-24 w-24 overflow-hidden rounded-full bg-gray-100"
                                >
                                    <img
                                        :src="form.avatarPreview"
                                        class="w-full h-full object-contain"
                                    />
                                </span>
                            </div>
                            <div
                                class="col-span-6 sm:col-span-3 grid grid-cols-6 gap-5 items-center justify-between"
                            >
                                <div class="col-span-3">
                                    <InputLabel
                                        for="roles"
                                        value="Role :"
                                        class="block text-sm font-medium text-gray-700"
                                    />

                                    <InputError
                                        :message="form.errors.roles"
                                        class="mt-2 col-start-2 col-span-4"
                                    />
                                    <multiselect
                                        v-model="form.roles"
                                        :options="roles"
                                        :multiple="true"
                                        :close-on-select="true"
                                        placeholder="Pick some"
                                        class="block w-full !bg-white dark:bg-black mt-1 text-sm font-medium text-gray-700 form-controll"
                                    >
                                    </multiselect>
                                </div>
                                <div class="col-span-3">
                                    <InputLabel
                                        for="status"
                                        value="Status :"
                                        class="block text-sm font-medium text-gray-700"
                                    />
                                    <select
                                        id="status"
                                        name="status"
                                        ref="statusInput"
                                        v-model="form.status"
                                        autocomplete="status-name"
                                        class="block w-full mt-1 text-sm font-medium text-gray-700 form-controll"
                                    >
                                        <option
                                            v-for="status in statusArr"
                                            :key="status"
                                            :value="status"
                                            :selected="status == 'Pending'"
                                        >
                                            {{ status }}
                                        </option>
                                    </select>
                                    <InputError
                                        :message="form.errors.status"
                                        class="mt-2 col-start-2 col-span-4"
                                    />
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <InputLabel
                                    for="password"
                                    value="Password :"
                                    class="block text-sm font-medium text-gray-700"
                                />
                                <TextInput
                                    id="password"
                                    ref="passwordInput"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="password"
                                />
                                <InputError
                                    :message="form.errors.password"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <InputLabel
                                    for="password_confirmation"
                                    value="Password Confirmation :"
                                    class="block text-sm font-medium text-gray-700"
                                />
                                <TextInput
                                    id="password_confirmation"
                                    ref="passwordInput"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="password_confirmation"
                                />
                                <InputError
                                    :message="form.errors.password_confirmation"
                                    class="mt-2 col-start-2 col-span-4"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pr-5 py-5">
                <PrimaryButton :disabled="form.processing"
                    >Submit</PrimaryButton
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
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>
<style>
@media (prefers-color-scheme: dark) {
    .multiselect > .multiselect__tags {
        background: #111827;
    }
}
</style>
