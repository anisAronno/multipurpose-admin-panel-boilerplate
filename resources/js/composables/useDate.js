import { usePage } from "@inertiajs/inertia-vue3";
export function formattedDate(dateTime) {
    const date = new Date(dateTime);
    const options = {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    };
    return date.toLocaleDateString(
        usePage().props.value.global.options.language,
        options
    );
}
