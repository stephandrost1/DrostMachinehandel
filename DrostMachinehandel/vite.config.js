import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
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
