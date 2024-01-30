<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import toast from "@/Stores/toast";
import { router, usePage } from "@inertiajs/vue3";
import { onUnmounted } from "vue";

const page = usePage();

let removeFinshEventListener = router.on("finish", () => {
    if (page.props.flash.message) {
        toast.add({
            message: page.props.flash.message,
            success: page.props.flash.success,
        });
    }
});

onUnmounted(() => removeFinshEventListener());

function remove(index) {
    toast.remove(index);
}
</script>
<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4"
    >
        <ToastListItem
            v-for="(item, index) in toast.items"
            :key="item.key"
            :message="item.message"
            :success="item.success"
            :duration="2000"
            @remove="remove(index)"
        />
    </TransitionGroup>
</template>
