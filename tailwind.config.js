const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
    darkMode: 'class', // or 'media' or 'class'

    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
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
			minWidth: theme => theme('width'),
			spacing: {
				nav: defaultTheme.spacing[20],
				sidebar: defaultTheme.spacing[80],
			},
        },
    },
}
