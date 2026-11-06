import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin/common.css',
                'resources/css/admin/layout.css',
                'resources/css/admin/dashboard.css',
                'resources/css/admin/login.css',
                'resources/css/admin/settings.css',
                'resources/css/admin/catalog.css',
                'resources/js/admin/common.js',
                'resources/js/admin/layout.js',
                'resources/js/admin/dashboard.js',
                'resources/js/admin/login.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
