/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        colors: {
            'blue': '#47cdff',
            'blue-light': '#8ae2fe',
            'purple': '#7e5bef',
            'pink': '#ff49db',
            'orange': '#ff7849',
            'green': '#13ce66',
            'yellow': '#ffc82c',
            'gray-dark': '#273444',
            'gray': 'rgba(0, 0, 0, 0.4)',
            'gray-light': '#d3dce6',
            white: '#ffffff',
            'grey-light': '#F5F6F9'
        },
        shadow: {
            default: '0 0 5px 0 rgba(0, 0, 0, 0.08)'
        },
        extend: {

        },
    },
    plugins: [],
}
