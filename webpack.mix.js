const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
const source = 'resources';
const distribute = 'resources/dist';

mix.setPublicPath(`./${distribute}`)

mix.sass(`${source}/sass/app.scss`, `${distribute}/css`).options({
    processCssUrls: false,
    postCss: [
        tailwindcss('./tailwind.config.js'),
        require('autoprefixer')
    ],
}).version()
