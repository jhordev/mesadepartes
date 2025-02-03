const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                colorAthensGray: '#EDF0F4',
                colorGrayOpacity: '#DEE3EA',
                colorBlack: '#26292e',
                colorBlue: '#0056AC',
            }
        },
    },
    plugins: [],
};
