import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/scss/main.scss',
                'resources/scss/dashboard.scss',
                'resources/js/app.js',
                'resources/vue/dashboard.js',
                'resources/vue/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler',
        }
    }
});
