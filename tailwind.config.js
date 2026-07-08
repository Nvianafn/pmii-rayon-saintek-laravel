import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                serif: ['"Noto Serif"', 'Georgia', 'serif'],
                sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#002068',
                    container: '#003399',
                    on: '#ffffff',
                    'on-container': '#8aa4ff',
                },
                gold: {
                    DEFAULT: '#fcd400',
                    on: '#6e5c00',
                    dark: '#705d00',
                },
                surface: {
                    DEFAULT: '#f8f9ff',
                    lowest: '#ffffff',
                    low: '#eff4ff',
                    container: '#e5eeff',
                    high: '#dce9ff',
                    highest: '#d3e4fe',
                },
                ink: {
                    DEFAULT: '#0b1c30',
                    variant: '#444653',
                },
                outline: {
                    DEFAULT: '#747684',
                    variant: '#c4c5d5',
                },
                danger: '#ba1a1a',
            },
            borderRadius: {
                sm: '0.25rem',
                DEFAULT: '0.5rem',
                md: '0.75rem',
                lg: '1rem',
                xl: '1.5rem',
            },
            boxShadow: {
                glass: '0 8px 40px -8px rgba(0, 32, 104, 0.10)',
                ambient: '0 30px 80px -10px rgba(0, 32, 104, 0.08)',
                'glass-lg': '0 16px 60px -12px rgba(0, 32, 104, 0.14)',
            },
            maxWidth: {
                content: '1200px',
            },
        },
    },
    plugins: [forms, typography],
};
