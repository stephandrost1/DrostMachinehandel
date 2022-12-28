const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/**/*.{html,js,blade,blade.php,php,vue}',
    './resources/**/**/*.{html,js,blade,blade.php,php,vue}',
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    './app/**/*.php',
    './resources/**/*.php',
    './resources/vue/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: '#E56D01',
        "primary-100": '#fef0e3',
        "primary-200": '#fee1c7',
        "primary-300": '#fed2ab',
        "primary-400": '#fec48f',
        "primary-500": '#feb573',
        "primary-600": '#fea657',
        "primary-700": '#fe973b',
        "primary-800": '#fe891f',
        "primary-900": '#fd7a04',
        secondary: '#707070',
      },
      animation: {
        'bounce-slow': 'bounce 3s linear infinite',
      },
    },
  },
  variants: {
    display: ["group-hover"]
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
};
