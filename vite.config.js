import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/trecms.css',
                'resources/js/trecms.js',
            ],
            refresh: true,
        }),
    ],
});
