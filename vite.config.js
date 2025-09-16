import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/text-editor.js'],
            refresh: true,
        }),

         viteStaticCopy({
            targets: [
                {
                    src: 'node_modules/lightbox2/dist/images',
                    dest: 'assets' 
                }
            ]
        })
    ],
});
