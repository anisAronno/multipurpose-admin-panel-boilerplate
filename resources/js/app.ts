import "../css/app.css";
import "./bootstrap";

import {
    permissionDirective,
    roleDirective,
} from "@/Directives/permissions.js";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { createInertiaApp, Link, usePage } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { translations } from "./Mixins/translations"; 


library.add(fas);

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText ||
    usePage()?.props?.global?.options?.site_name;

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy) 
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("Link", Link)
            .mixin(translations)
            .directive("can", permissionDirective)
            .directive("role", roleDirective)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
