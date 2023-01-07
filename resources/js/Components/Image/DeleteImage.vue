<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const modalShow = ref(false);
const emit = defineEmits(["success"]);
const props = defineProps({
    id: Number,
    route: String,
    field: String,
    table: String,
    oldFile: String,
});

const form = useForm({
    id: props.id,
    table: props.table,
    field: props.field,
    oldFile: props.oldFile,
});
const confirmDeletion = () => {
    modalShow.value = true;
};

const processDelete = () => {
    form.post(route(props.route), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    modalShow.value = false;
    emit("success", true);
};
</script>

<template>
    <section>
        <DangerButton @click.prevent="confirmDeletion">
            <font-awesome-icon icon="fa-solid fa-trash" class="mr-1" />
        </DangerButton>

        <Modal :show="modalShow" @close="closeModal">
            {{ id }}
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Are you sure you want to delete this?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once is deleted, all of its resources and data will be
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
                        @click="processDelete"
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
