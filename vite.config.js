import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/reset.css', 'resources/css/app.css', 
                'resources/js/hero.js', 'resources/js/scroll.js', 
                'resources/js/menu.js', 'resources/js/icon-placement.js', 
                'resources/js/font-size.js', 'resources/js/anchor-links.js', 
                'resources/js/post.js'],
            refresh: true,
        }),
    ],
});
