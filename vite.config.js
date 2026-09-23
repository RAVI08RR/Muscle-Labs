import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',   // Storefront CSS
                'resources/js/app.js',     // Storefront JS
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
        },
    },
    server: {
        watch: {
            // Don't trigger HMR for compiled Blade views
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
