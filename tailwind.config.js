const tokens     = require( './tokens/tailwind-tokens.json' );
const typography = require( './tokens/tailwind-typography.json' );
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
    gap: tokens.grid.gap,
    lineHeight: tokens.lh,
    screens: tokens.screen,
    spacing: tokens.spacer,
    transitionDuration: tokens.duration,
    zIndex: tokens.zIndex,
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
		plugin(
			function ({ addComponents, theme }) {
				addComponents({
					'.h1-lede': typography.style[".h1-lede"],
					'.h1': typography.style[".h1"],
					'.h2': typography.style[".h2"],
					'.h3': typography.style[".h3"],
					'.h4': typography.style[".h4"],
					'.h5': typography.style[".h5"],
					'.body-lg-bold': typography.style[".body-lg-bold"],
					'.body-lg': typography.style[".body-lg"],
					'.body-md': typography.style[".body-md"],
					'.body': typography.style[".body"],
					'.body-base': typography.style[".body"],
					'.body-sm': typography.style[".body-sm"],
					'.btn-back': typography.style[".btn-back"],
					'.utility-md': typography.style[".utility-md"],
					'.utility': typography.style[".utility"],
					'.text-nav--main': typography.style[".text-nav--main"],
					'.text-label': typography.style[".text-label"],
				})
			}
		)
  ],
}
