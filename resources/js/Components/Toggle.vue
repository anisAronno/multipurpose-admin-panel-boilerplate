<template>
    <div
        :class="modelValue==true ? 'bg-orange-500' : 'bg-gray-300'"
        @click="toggle"
        class="w-14 transition-all duration-500 h-8 flex items-center rounded-full p-1"
    >
        <div
            :class="{ 'translate-x-6': modelValue==true }"
            class="w-6 h-6 transition-all duration-500 transform bg-white rounded-full shadow-md"
        ></div>
    </div>
    
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: Boolean,
    },
});
const emit = defineEmits(["update:modelValue"]);

function toggle() {
    emit("update:modelValue", !props.modelValue);
}
</script>
