const tokens     = require( './tokens/tailwind-tokens.json' );
const typography = require( './tokens/tailwind-typography.json' );
const grids = require('./tokens/tailwind-grids.json');
const plugin     = require( 'tailwindcss/plugin' );

module.exports = {
  prefix: '',
  content: [
    './views/**/*.{html,twig}',
    './js/**/*.js',
  ],
  theme: {
    colors: tokens.color,
    container: {
      center: true
    },
    fontFamily: tokens.font.family,
    fontSize: tokens.font.size,
    fontWeight: tokens.font.weight,
    lineHeight: tokens.lh,
    screens: tokens.screen,
    spacing: tokens.spacer,
    transitionDuration: tokens.duration,
    zIndex: tokens.z,
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
		plugin(
			function ({ addComponents, theme }) {
				addComponents({
					// Auto generate typography classes from keys in tailwind-typography.json
          // Loops through each key in the typography.style object and creates a new object with the key as the class name and the value as the styles
          ...Object.keys(typography.style).map((key) => {
            return {
              [`${key}`]: typography.style[key],
            }
          // Reduce the mapped array of objects into a single object
          }).reduce((typographyStyles, newTypographyStyleObject) => ({ ...typographyStyles, ...newTypographyStyleObject }), {}),
          // Auto generate typography classes from keys in tailwind-typography.json
          // Loops through each key in the typography.style object and creates a new object with the key as the class name and the value as the styles
          ...Object.keys(grids.grid).map((key) => {
            return {
              [`${key}`]: grids.grid[key],
            }
            // Reduce the mapped array of objects into a single object
          }).reduce((gridsStyles, newGridsStyleObject) => ({ ...gridsStyles, ...newGridsStyleObject }), {}),
        });
			}
		)
  ],
}
