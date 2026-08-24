import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/app-rtl.css',
                'resources/js/app.js',
                'resources/css/public.css',
                'resources/css/public-rtl.css',
                'resources/js/public.js',
            ],
            refresh: true,
        }),
    ],
});
