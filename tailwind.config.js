const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
    darkMode: 'media', // or 'media' or 'class'

    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './vendor/georgeboot/laravel-tiptap/resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
			colors: {
				gray: {
					150: '#ECECEE',
					750: '#333338',
					850: '#202023',
					...colors.gray,
				},
				primary: '#009990'
			},
			minHeight: theme => theme('height'),
			minWidth: theme => theme('width'),
			spacing: {
				nav: defaultTheme.spacing[20],
				sidebar: defaultTheme.spacing[80],
			},
        },
    },
}
