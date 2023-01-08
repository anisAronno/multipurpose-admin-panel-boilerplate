<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        class="form-controll"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        cols="30"
        rows="10"
    ></textarea>
</template>
