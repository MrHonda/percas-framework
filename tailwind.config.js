const {colors} = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            colors: {
                primary: colors.blue['500'],
                secondary: colors.orange['500'],
            }
        }
    },
    variants: {},
    plugins: [],
};
