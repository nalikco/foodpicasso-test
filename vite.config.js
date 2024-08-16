import {defineConfig} from 'vite';
import path from 'path';

export default defineConfig({
    root: 'assets',
    build: {
        outDir: '../public/build',
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, 'assets/js/app.js'),
            },
            output: {
                entryFileNames: 'assets/app.js',
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name === 'main.css') {
                        return 'assets/app.css';
                    }
                    return 'assets/[name].[ext]';
                }
            },
        },
    },
    css: {
        postcss: './postcss.config.js',
    },
});
