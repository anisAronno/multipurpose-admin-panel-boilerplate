<script setup>
import DeleteForm from "@/Components/DeleteForm.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import defaultFile from "@/Stores/defaultFile.js";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const avatarInput = ref(null);
const defaultImage = ref(defaultFile.avatar);

const user = usePage().props.auth.user;

const form = useForm({
    avatar: user.avatar,
    avatarPreview: user.avatar,
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
        <div
            class="flex flex-wrap sm:justify-between sm:items-center w-full space-y-5"
        >
            <form
                @submit.prevent="form.post(route('profile.image'))"
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
            <div class="flex-1 w-full order-first sm:order-last">
                <span
                    class="flex items-center justify-center w-32 h-32 sm:w-40 sm:h-40 overflow-hidden rounded-full bg-gray-100 relative group"
                >
                    <img
                        :src="form.avatarPreview"
                        alt=""
                        class="w-full h-full object-contain inset-0 group-hover:opacity-50 shadow-md shadow-gray-900"
                    />
                    <span
                        v-if="defaultImage != form.avatarPreview"
                        class="w-full h-full absolute grid place-items-center transition-all transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0"
                    >
                        <DeleteForm
                            class="cursor-pointer"
                            :data="{
                                id: user.id,
                                model: 'user.image',
                            }"
                            @success="form.avatarPreview = defaultImage"
                        ></DeleteForm>
                    </span>
                </span>
            </div>
        </div>
    </section>
</template>
