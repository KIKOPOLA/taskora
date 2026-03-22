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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f5ff',
                    100: '#e0ebff',
                    200: '#c2dafe',
                    300: '#9ec2fc',
                    400: '#5e96f8',
                    500: '#3b82f6', // Standard Blue - keeping it as base but will use softer shades in UI
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                neutral: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617',
                }
            },
            boxShadow: {
                'soft': '0 2px 8px rgba(15, 23, 42, 0.08)',
                'soft-lg': '0 8px 24px rgba(15, 23, 42, 0.12)',
                'primary': '0 4px 14px rgba(37, 99, 235, 0.15)',
                'primary-lg': '0 10px 30px rgba(37, 99, 235, 0.2)',
            }
        },
    },

    plugins: [forms],
};
