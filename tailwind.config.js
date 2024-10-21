import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors:{
                'light-green': "#F0FDEF",
                'light-green2': "#E4FFE2",
                'dark-green': "#5B9859",
                'dark-green2': "#3C7C3A",
                'light-yellow': "#FFF6E4",
                'dark-yellow': "#F8A900",
            }
        },
    },
    plugins: [],
};
