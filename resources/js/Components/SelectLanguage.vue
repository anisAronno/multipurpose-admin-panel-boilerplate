<template>
    <div class="p-2 sm:p-4">
        <select
            name="language"
            id="language"
            v-model="form.language"
            @change="updateLanguage"
            class="text-gray-900 dark:text-gray-50 bg-gray-50 dark:bg-gray-800 rounded-lg"
        >
            <option
                :value="language.value"
                v-for="language in languageArray"
                :key="language.value"
                :selected="language.value === $page.props.language"
            >
                {{ language.label }}
            </option>
        </select>
    </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { useCountries, useLanguage } from "@/composables/useCountries";
const propsData = usePage().props;
const language = propsData?.global.options;

const languageArray = useLanguage(propsData.languages);

const form = useForm({
    language: usePage().props?.language,
});

const updateLanguage = (value) => {
    form.post(route("language.store"), { language: value });
};
</script>

 