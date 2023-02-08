import { defineComponent, h } from "vue";
/**--------------------
 * User Country Select
 * --------------------*/

const navigation = [
    { name: "Home", route: "home" },
    { name: "About", route: "about" },
    { name: "Products", route: "products" },
    { name: "Category", route: "category" },
    { name: "Blog", route: "blog" },
    { name: "Contact", route: "contact" },
];
 
/**--------------------------------------
 * @Export Data and
 * Variable Data
 * --------------------------------------*/

export function useMenu() {
    return {
        navigation, 
    };
}
