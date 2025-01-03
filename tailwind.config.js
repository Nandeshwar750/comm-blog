import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['Fira Code', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                dark: {
                    'primary': '#1a1a1a',
                    'secondary': '#2d2d2d',
                    'accent': '#3d3d3d',
                    'tertiary': '#4a4a4a',
                },
                primary: {
                    DEFAULT: '#3b82f6',
                    dark: '#1d4ed8',
                    light: '#60a5fa',
                },
                ocean: {
                    primary: '#0ea5e9',
                    secondary: '#0284c7',
                    accent: '#0369a1',
                    light: '#3b82f6',
                },
                forest: {
                    primary: '#059669',
                    secondary: '#047857',
                    accent: '#065f46',
                    light: '#6ee7b7',
                },
                sunset: {
                    primary: '#f97316',
                    secondary: '#ea580c',
                    accent: '#c2410c',
                    light: '#fdba74',
                },
                lavender: {
                    primary: '#8b5cf6',
                    secondary: '#7c3aed',
                    accent: '#6d28d9',
                    light: '#a78bfa',
                },
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        'h1': {
                            fontWeight: '800',
                            fontSize: '2.25rem',
                            marginBottom: '1rem',
                        },
                        'h2': {
                            fontWeight: '600',
                            fontSize: '1.875rem',
                            marginTop: '2rem',
                            marginBottom: '1rem',
                        },
                        'h3': {
                            fontWeight: '500',
                            fontSize: '1.5rem',
                            marginTop: '1.5rem',
                            marginBottom: '1rem',
                        },
                        'h4': {
                            fontWeight: '400',
                            fontSize: '1.25rem',
                            marginTop: '1.5rem',
                            marginBottom: '1rem',
                        },
                        'p': {
                            marginBottom: '1.25rem',
                            lineHeight: '1.75',
                        },
                        'pre': {
                            backgroundColor: '#1e293b',
                            color: '#e2e8f0',
                            padding: '1rem',
                            borderRadius: '0.5rem',
                            marginBottom: '1.5rem',
                        },
                        'code': {
                            color: '#ef4444',
                            fontFamily: theme('fontFamily.mono'),
                        },
                        'blockquote': {
                            borderLeftWidth: '4px',
                            borderLeftColor: '#94a3b8',
                            paddingLeft: '1rem',
                            fontStyle: 'italic',
                        },
                        'a': {
                            color: '#3b82f6',
                            textDecoration: 'underline',
                            '&:hover': {
                                color: '#1d4ed8',
                            },
                        },
                    }
                },
                dark: {
                    css: {
                        color: theme('colors.gray.300'),
                        'h1, h2, h3, h4': {
                            color: theme('colors.gray.100'),
                        },
                        'a': {
                            color: theme('colors.blue.400'),
                            '&:hover': {
                                color: theme('colors.blue.300'),
                            },
                        },
                        'strong': {
                            color: theme('colors.gray.100'),
                        },
                        'code': {
                            color: theme('colors.red.300'),
                        },
                        'blockquote': {
                            borderLeftColor: theme('colors.gray.700'),
                            color: theme('colors.gray.400'),
                        },
                    },
                },
            }),
            gradients: {
                'blue-purple': 'linear-gradient(to right, #3b82f6, #8b5cf6)',
                'green-blue': 'linear-gradient(to right, #10b981, #3b82f6)',
                'orange-red': 'linear-gradient(to right, #f97316, #ef4444)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-in': 'slideIn 0.5s ease-out',
                'bounce-slow': 'bounce 3s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideIn: {
                    '0%': { transform: 'translateY(-10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            },
            boxShadow: {
                'inner-lg': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
            },
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography'),
        function({ addUtilities }) {
            const newUtilities = {
                '.text-shadow': {
                    textShadow: '2px 2px 4px rgba(0, 0, 0, 0.1)',
                },
                '.text-shadow-md': {
                    textShadow: '4px 4px 8px rgba(0, 0, 0, 0.12)',
                },
                '.text-shadow-lg': {
                    textShadow: '15px 15px 30px rgba(0, 0, 0, 0.11)',
                },
                '.text-shadow-none': {
                    textShadow: 'none',
                },
            }
            addUtilities(newUtilities, ['responsive', 'hover'])
        },
    ],
};