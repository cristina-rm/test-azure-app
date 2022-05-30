const defaultTheme = require('tailwindcss/defaultTheme');
// const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                body: ['Titillium'],
            },

            colors: {
                'primary':{
                    DEFAULT: 'rgba(var(--color-primary),var(--tw-bg-opacity))',
                    'interact': 'rgba(var(--color-primary--interact),var(--tw-bg-opacity))'
                },
                'secondary':{
                    DEFAULT: 'rgba(var(--color-secondary),var(--tw-bg-opacity))',
                    'interact': 'rgba(var(--color-secondary--interact),var(--tw-bg-opacity))'
                },
                'ternary':'#F2F2F2',
                'quaternary': '#C4C4C6',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
