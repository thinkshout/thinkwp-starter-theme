
# The ThinkShout Timber Starter Theme for WordPress

This is forked from the "_s" for Timber: a dead-simple theme that you can build from. The primary purpose of this theme is to provide a file structure rather than a framework for markup or styles. Configure your css, scripts, and task runners however you would like!

## What's here?

After installation in the  `assets` directory you'll find `css/`, `js/`, and `static/` is where you can keep your static front-end scripts, styles, or images. In other words, your CSS files, JS files, fonts, and SVGs would live here.

`views/` contains all of your Twig templates. These are rendered by PHP files in the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where the data (`$context`) will be used.

## Installation
Getting started you will need to install theme dependencies with [nvm](https://github.com/nvm-sh/nvm#installing-and-updating), [npm](https://docs.npmjs.com/), and [composer](https://getcomposer.org/).

1. Navigate to the theme directory in your project folder.
2. Run `composer scaffold` to pull the Base Build assets from the [TS Base Assets](https://github.com/thinkshout/base-assets/tree/develop) repository.
3. Run `composer install` to install Timber, Twig, and other dependencies in the theme.
For more information on using Twig in WordPress see our [wiki article](https://github.com/thinkshout/thinkwp-starter-theme/wiki/TWIG-In-WordPress)
4. Run `npm install` to install dependencies. Install will check the node version against the `.nvmrc` file, install all dependencies, and populate an initial set of token definitions.
5. Ensure your project has ACF installed and activated. This theme uses ACF for custom fields and options pages.

## Theme Development

For most development tasks, simply run `npm start` to start Parcel's watch, which will compile the projects CSS and
JavaScript as well as Tailwind in JIT mode.

Additionally, there are a number of scripts to aid in theme development (assume `npm run` prefix):

- `build` to compile css, js, and print css for production.
- `clear-cache` deletes the .parcel-cache directory, is useful for troubleshooting build errors.
- `format`: Formats assets, tokens, and SVG files.
- `lint`: to check styling errors in js/css files. Ran automatically if you commit while inside the theme directory.
- `print.bundle` Bundle the print stylesheet for production.
- `theme.build.prod` Create the production build.
- `theme.build.dev` Create the development build.
- `theme.build.admin` Create the admin build for WP-Admin.
- `theme.watch` Start the watch of the project in development mode (aliased to `npm start`)


## More Information
Please visit [the Wiki](https://github.com/thinkshout/thinkwp-starter-theme/wiki) to get started and for more information:

- [Setup Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Setup)
- [Where Do I Find](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Where-Do-I-Find)
- [Twig Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/TWIG-In-WordPress)
- [PHP Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/PHP-Guide)
- [CSS Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/CSS-Guide)
- [Tailwind Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Tailwind-Guide)

## Other Resources
External docs for relevant theme technologies:

- [WordPress](https://wordpress.org)
- [Tailwind CSS](https://tailwindcss.com/)
- [Timber](https://timber.github.io/docs/)
- [Custom Post Types & Taxonomies](https://posttypes.jjgrainger.co.uk/)