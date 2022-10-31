import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/main.scss',
                'resources/scss/dashboard.scss',
                'resources/js/app.js',
                'resources/js/dashboard/dashboard.js',
            ],
            refresh: true,
        }),
    ],
});
