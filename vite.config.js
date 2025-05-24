import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    build: {
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'resources/js/picker.js'),
                css: path.resolve(__dirname, 'resources/css/picker.scss'),
            },
            output: {
                entryFileNames: 'picker.js',
                assetFileNames: 'picker.css',
            },
        },
        outDir: 'public/assets',
        emptyOutDir: true,
    },
});