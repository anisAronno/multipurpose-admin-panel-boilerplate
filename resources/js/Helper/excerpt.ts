export default {
    methods: {
        excerpt(text: string, limit: number = 20) {
            return text?.length > 0
                ? text.split(" ").slice(0, limit).join(" ") + "..."
                : "";
        },
    },
};
