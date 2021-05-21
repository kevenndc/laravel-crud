const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                logo: ['Raleway'],
            },
            maxWidth: {
                '200': '200px',
                '300': '300px',
            },
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
            borderWidth: ['last'],
            display: ['group-hover'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
