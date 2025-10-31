import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'
import {wayfinder} from "@laravel/vite-plugin-wayfinder";

export default defineConfig({
    server: {
        host: '0.0.0.0',
    },
    plugins: [
        wayfinder(),
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
