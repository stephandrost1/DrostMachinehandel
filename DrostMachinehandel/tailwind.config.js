const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.{html,js,blade,blade.php,php}',
        './resources/**/**/*.{html,js,blade,blade.php,php}'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#E56D01',
                secondary: '#707070',
            },
            animation: {
                'bounce-slow': 'bounce 3s linear infinite',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
