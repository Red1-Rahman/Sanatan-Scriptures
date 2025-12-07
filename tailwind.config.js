/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                saffron: {
                    50: '#fff8f0',
                    100: '#ffedd5',
                    200: '#ffd9aa',
                    300: '#ffc580',
                    400: '#ffb155',
                    500: '#ff9933',
                    600: '#e68a2e',
                    700: '#cc7a29',
                    800: '#b36b24',
                    900: '#995c1f',
                },
                dharma: {
                    green: '#138808',
                    navy: '#000080',
                    white: '#FFFFFF',
                    saffron: '#FF9933',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
                sanskrit: ['Noto Sans Devanagari', 'serif'],
                transliteration: ['Noto Serif', 'serif'],
            },
            fontSize: {
                'sanskrit-sm': '1.125rem',
                'sanskrit-base': '1.5rem',
                'sanskrit-lg': '1.75rem',
                'sanskrit-xl': '2rem',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
