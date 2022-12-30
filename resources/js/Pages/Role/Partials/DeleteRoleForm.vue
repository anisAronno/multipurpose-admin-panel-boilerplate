<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const modalShow = ref(false);

defineProps({
    item_id: String | Number,
});
const form = useForm();
const confirmDeletion = () => {
    modalShow.value = true;
};

const deleteRole = (id) => {
    form.delete(route("role.destroy", id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    modalShow.value = false;
};
</script>

<template>
    <section>
        <DangerButton @click="confirmDeletion">
            <font-awesome-icon icon="fa-solid fa-trash" class="mr-1" />
            </DangerButton
        >

        <Modal :show="modalShow" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Are you sure you want to delete this Role?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once role is deleted, all of its resources and data will be
                    permanently deleted.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteRole(item_id)"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-trash"
                            class="mr-1"
                        />
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
