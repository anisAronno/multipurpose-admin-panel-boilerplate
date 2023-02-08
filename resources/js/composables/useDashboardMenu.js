import { useWindowSize } from "@vueuse/core";
import { ref } from "vue";

import {
    BookOpenIcon,
    CogIcon, EnvelopeIcon, HomeIcon, LightBulbIcon, ListBulletIcon,
    PlusCircleIcon,
    ShoppingCartIcon,
    UserGroupIcon,
    UsersIcon
} from "@heroicons/vue/24/outline";
 
const { width } = useWindowSize();

const sidebarOpen = ref(false);
const isOpenSidebar = ref(false);
const isLoaded = ref(false);

if(width.value > 1400){
    isOpenSidebar.value = true;
}

const navigation = ref([
    {
        name: "Dashboard",
        route: "dashboard",
        icon: HomeIcon,
        current: route().current("dashboard"),
    },
    {
        name: "User",
        route: "admin.user.index",
        icon: UsersIcon,
        current:
            route().current("admin.user.index") ||
            route().current("admin.user.create") ||
            route().current("admin.user.edit") ||
            route().current("admin.user.show"),
        children: [
            {
                name: "User List",
                route: "admin.user.index",
                icon: UsersIcon,
                current: route().current("admin.user.index"),
            },
            {
                name: "Create",
                route: "admin.user.create",
                icon: PlusCircleIcon,
                current: route().current("admin.user.create"),
            },
        ],
    },

    {
        name: "Role",
        route: "admin.role.index",
        icon: UserGroupIcon,
        current:
            route().current("admin.role.index") ||
            route().current("admin.role.create") ||
            route().current("admin.role.edit") ||
            route().current("admin.role.show"),
        children: [
            {
                name: "Role List",
                route: "admin.role.index",
                icon: UserGroupIcon,
                current: route().current("admin.role.index"),
            },
            {
                name: "Create",
                route: "admin.role.create",
                icon: PlusCircleIcon,
                current: route().current("admin.role.create"),
            },
        ],
    },
    {
        name: "Category",
        route: "admin.category.index",
        icon: ListBulletIcon,
        current:
            route().current("admin.category.index") ||
            route().current("admin.category.create") ||
            route().current("admin.category.edit") ||
            route().current("admin.category.show"),
        children: [
            {
                name: "Category List",
                route: "admin.category.index",
                icon: ListBulletIcon,
                current: route().current("admin.category.index"),
            },
            {
                name: "Create",
                route: "admin.category.create",
                icon: PlusCircleIcon,
                current: route().current("admin.category.create"),
            },
        ],
    },
    {
        name: "Product",
        route: "admin.product.index",
        icon: ShoppingCartIcon,
        current:
            route().current("admin.product.index") ||
            route().current("admin.product.create") ||
            route().current("admin.product.edit") ||
            route().current("admin.product.show"),
        children: [
            {
                name: "Product List",
                route: "admin.product.index",
                icon: ShoppingCartIcon,
                current: route().current("admin.product.index"),
            },
            {
                name: "Create",
                route: "admin.product.create",
                icon: PlusCircleIcon,
                current: route().current("admin.product.create"),
            },
        ],
    },
    {
        name: "Blog",
        route: "admin.blog.index",
        icon: BookOpenIcon,
        current:
            route().current("admin.blog.index") ||
            route().current("admin.blog.create") ||
            route().current("admin.blog.edit") ||
            route().current("admin.blog.show"),
        children: [
            {
                name: "Blog List",
                route: "admin.blog.index",
                icon: BookOpenIcon,
                current: route().current("admin.blog.index"),
            },
            {
                name: "Create",
                route: "admin.blog.create",
                icon: PlusCircleIcon,
                current: route().current("admin.blog.create"),
            },
        ],
    },
    {
        name: "Special Features",
        route: "admin.special-feature.index",
        icon: LightBulbIcon,
        current:
            route().current("admin.special-feature.index") ||
            route().current("admin.special-feature.create") ||
            route().current("admin.special-feature.edit") ||
            route().current("admin.special-feature.show"),
        children: [
            {
                name: "Special Features List",
                route: "admin.special-feature.index",
                icon: LightBulbIcon,
                current: route().current("admin.special-feature.index"),
            },
            {
                name: "Create",
                route: "admin.special-feature.create",
                icon: PlusCircleIcon,
                current: route().current("admin.special-feature.create"),
            },
        ],
    },
    {
        name: "Message",
        route: "admin.contact.index",
        icon: EnvelopeIcon,
        current: route().current("admin.contact.index"),
        children: [
            {
                name: "Message",
                route: "admin.contact.index",
                icon: EnvelopeIcon,
                current: route().current("admin.contact.index"),
            },
        ],
    },
    {
        name: "Settings",
        route: "admin.option.index",
        icon: CogIcon,
        current:
            route().current("admin.option.index") ||
            route().current("admin.option.general")||
            route().current("admin.option.general"),
        children: [
            {
                name: "Application Settings",
                route: "admin.option.index",
                icon: CogIcon,
                current: route().current("admin.option.index"),
            },
            {
                name: "General Settings",
                route: "admin.option.general",
                icon: CogIcon,
                current: route().current("admin.option.general"),
            },
            {
                name: "Social Settings",
                route: "admin.option.social",
                icon: CogIcon,
                current: route().current("admin.option.social"),
            },
            {
                name: "Model Feature",
                route: "admin.option.model",
                icon: CogIcon,
                current: route().current("admin.option.model"),
            },
        ],
    },
]);

/**--------------------------------------
 * @Export Data and
 * Variable Data
 * --------------------------------------*/

export function useDashboardMenu() {
    return {
        navigation,
        sidebarOpen,
        isOpenSidebar,
        isLoaded,
    };
}
