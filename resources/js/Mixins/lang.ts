import { usePage } from "@inertiajs/vue3";

export const lang = {
    methods: {
        __(key, replacements = {}) {
            let translation = usePage().props.translations[key] || key;

            Object.keys(replacements).forEach((replacement) => {
                translation = translation.replace(
                    `:${replacement}`,
                    replacements[replacement]
                );
            });

            return translation;
        },
    },
};
