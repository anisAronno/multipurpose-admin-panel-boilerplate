export const translations = {
    methods: {
        __(key, defaultText = "", replacements = {}) {
            let translation;
            if (window._translations[key]) {
                translation = window._translations[key];
            } else if (defaultText.length > 0) {
                translation = defaultText;
            } else {
                translation = key;
            }

            Object.keys(replacements).forEach((r) => {
                translation = translation.replace(`:${r}`, replacements[r]);
            });

            return translation;
        },
    },
};
