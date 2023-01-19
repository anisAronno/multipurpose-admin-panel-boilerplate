import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import Markdown from "vite-plugin-vue-markdown";
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.ts",
            ssr: "resources/js/ssr.ts",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
            include: [/\.vue$/, /\.md$/],
        }),
        Markdown(),
    ],
    ssr: {
        noExternal: ["@inertiajs/server"],
    },
});
