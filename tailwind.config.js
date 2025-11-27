/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'vanisha-dark-brown': '#5d1717',
                'vanisha-red': '#660b05',
                'vanisha-orange': '#e67e22',
                'vanisha-orange-dark': '#cf711f',
                'vanisha-gold': '#ffd700',
                'vanisha-light-yellow': '#fff0c4',
                'vanisha-about-bg': '#f7e9d9',
                'vanisha-footer-bg': '#660b05',
                'contact-bg': '#a35e38', 
            },
            fontFamily: {
                sans: ['Poppins', 'sans-serif'],
            },
            keyframes: {
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                }
            },
            animation: {
                'fade-up': 'fadeUp 1s ease forwards',
            }
        },
    },
    plugins: [],
}