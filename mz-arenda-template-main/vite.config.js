import vituum from 'vituum'
import pug from '@vituum/vite-plugin-pug'
import {defineConfig} from 'vite'
import pages from 'vituum/plugins/pages.js'
import imports from 'vituum/plugins/imports.js'


export default defineConfig({
    plugins: [
        pages({
            dir: './src/templates/pages'
        }),

        imports({
            data: ['src/data/**/*.json'],
            path: ['./src/styles/*/**', './src/scripts/*/**'],


        }),

        vituum({
                imports: {
                    filenamePattern: {
                        '+.css': [],
                        '+.scss': 'src/styles',
                        '+.sass': 'src/styles'
                    }
                },


            }
        ),
        pug({
            root: './src/templates',
        }),
    ],
    build: {
        outDir: 'dist',
        rollupOptions: {
            input: [
                './src/templates/pages/**/*.pug',
                './src/templates/pages/**/*.json',
                './src/scripts/*.{js,ts,mjs}',
                './src/styles/*.{css,pcss,scss,sass,less,styl,stylus}'
            ]
        }

    },
})