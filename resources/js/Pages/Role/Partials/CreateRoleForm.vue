<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    all_permissions: Object,
});
const form = useForm({
    name: "",
    permissions: [],
});

const storeRole = () => {
    form.post(route("role.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                form.reset("name");
                nameInput.value.focus();
            }
            if (form.errors.permissions) {
                form.reset("permissions");
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Update Password
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </header>
        <form @submit.prevent="storeRole" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password" value="Role Name" />

                <TextInput
                    id="name"
                    ref="nameInput"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="grid md:grid-cols-4 grid-cols-3 gap-5">
                <div
                    v-for="(permissions, index) in all_permissions"
                    :key="index"
                >
                    <h2 class="text-2xl capitalize mb-3">{{ index }}</h2>
                    <div
                        v-for="permission in permissions"
                        :key="permission.id"
                        class="flex"
                    >
                        <input
                            type="checkbox"
                            id="permissions"
                            :value="permission.name"
                            v-model="form.permissions"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        />
                        <InputLabel
                            for="permissions"
                            :value="permission.name"
                        />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end pr-[10%] py-5">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

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
