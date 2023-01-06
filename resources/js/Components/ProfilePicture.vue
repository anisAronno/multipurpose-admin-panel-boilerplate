<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const avatarInput = ref(null);

const user = usePage().props.value.auth.user;

const form = useForm({
    avatar: user.avatar,
    avatarPreview: user.avatar || `${route()?.t?.url}/uploads/users/avatar.png`,
});

const previewImage = (e) => {
    const file = e.target.files[0];
    form.avatarPreview = URL.createObjectURL(file);
};

const avatarHandaler = () => {};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Profile Picture
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile Picture.
            </p>
        </header>
        <div class="flex flex-wrap justify-between items-center w-full">
            <form
                @submit.prevent="form.patch(route('profile.image'))"
                class="mt-6 space-y-6 flex-1"
            >
                <div>
                    <InputLabel for="avatar" value="Avatar" />

                    <input
                        type="file"
                        name="avatar"
                        class="mt-1 block form-controll cursor-pointer"
                        @change="previewImage"
                        ref="avatarInput"
                        @input="form.avatar = $event.target.files[0]"
                    />

                    <InputError class="mt-2" :message="form.errors.avatar" />
                </div>

                <div class="flex items-center gap-4">
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
                            Update.
                        </p>
                    </Transition>
                </div>
            </form>
            <div class="flex-1 w-full">
                <img
                    :src="form.avatarPreview"
                    alt=""
                    class="w-16 h-16 block sm:w-32 sm:h-32"
                />
            </div>
        </div>
    </section>
</template>
