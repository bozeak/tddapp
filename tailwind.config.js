/** @type {import('tailwindcss').Config} */
// const colors = require('tailwindcss/colors')

let colors = {
    default: 'var(--text-default-color)',
    accent: 'var(--text-accent-color)',
    'accent-light': 'var(--text-accent-light-color)',
    muted: 'var(--text-muted-color)',
    'muted-light': 'var(--text-muted-light-color)',
    'error': 'var(--text-error-color)'
};

module.exports = {
    colors: colors,
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        colors: {
            // transparent: 'transparent',
            // current: 'currentColor',
            // black: colors.black,
            white: '#fff',
            // gray: colors.gray,
            // emerald: colors.emerald,
            // indigo: colors.indigo,
            // yellow: colors.yellow,
            'blue': '#47cdff',
            'blue-light': '#8ae2fe',
            // 'purple': '#7e5bef',
            // 'pink': '#ff49db',
            // 'orange': '#ff7849',
            // 'green': '#13ce66',
            // 'yellow': '#ffc82c',
            'gray-dark': '#273444',
            'gray': 'rgba(0, 0, 0, 0.4)',
            'gray-light': '#d3dce6',
            // white: '#ffffff',
            'grey-light': '#F5F6F9',
            'red': 'red',
            'accent': colors.accent,
            'accent-light': colors.accentLight
        },
        shadow: {
            default: '0 0 5px 0 rgba(0, 0, 0, 0.08)',
        },
        extend: {
            backgroundColor: {
                page: 'var(--page-background-color)',
                card: 'var(--card-background-color)',
                button: 'var(--button-background-color)',
                header: 'var(--header-background-color)'
            },
            textColor: {
                DEFAULT: 'var(--text-default-color)'
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
