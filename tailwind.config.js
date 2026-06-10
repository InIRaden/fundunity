import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                display: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                admin: {
                    50: 'rgb(var(--color-admin-50) / <alpha-value>)',
                    100: 'rgb(var(--color-admin-100) / <alpha-value>)',
                    200: 'rgb(var(--color-admin-200) / <alpha-value>)',
                    300: 'rgb(var(--color-admin-300) / <alpha-value>)',
                    400: 'rgb(var(--color-admin-400) / <alpha-value>)',
                    500: 'rgb(var(--color-admin-500) / <alpha-value>)',
                    600: 'rgb(var(--color-admin-600) / <alpha-value>)',
                    700: 'rgb(var(--color-admin-700) / <alpha-value>)',
                    800: 'rgb(var(--color-admin-800) / <alpha-value>)',
                    900: 'rgb(var(--color-admin-900) / <alpha-value>)',
                    950: 'rgb(var(--color-admin-950) / <alpha-value>)',
                }
            }
        },
    },

    plugins: [forms],
};
