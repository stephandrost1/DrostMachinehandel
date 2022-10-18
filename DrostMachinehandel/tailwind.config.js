/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.{html,js,blade,blade.php,php}", "./resources/**/**/*.{html,js,blade,blade.php,php}"],
  theme: {
    extend: {
      colors: {
        primary: '#E56D01',
        secondary: '#707070',
      },
      animation: {
        'bounce-slow': 'bounce 3s linear infinite',
      }
    }
  },
}
