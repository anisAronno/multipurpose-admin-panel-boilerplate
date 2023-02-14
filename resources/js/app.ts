import "../css/app.css";
import "./bootstrap";

import {
    permissionDirective,
    roleDirective,
} from "@/Directives/permissions.js";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { createInertiaApp, Link, usePage } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { translations } from "./Mixins/translations";

library.add(fas);

let page = usePage().props;

createInertiaApp({
    title: (title) => `${title} - ${page.value?.global?.options?.site_name}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("Link", Link)
            .mixin(translations)
            .directive("can", permissionDirective)
            .directive("role", roleDirective)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#22d3ee" });
