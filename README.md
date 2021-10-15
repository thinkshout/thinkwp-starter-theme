
# The ThinkShout Timber Starter Theme for WordPress

This is forked from the "_s" for Timber: a dead-simple theme that you can build from. The primary purpose of this theme is to provide a file structure rather than a framework for markup or styles. Configure your Sass, scripts, and task runners however you would like!

## What's here?

In `assets` you'll find `css/`, `js/`, and `static/` is where you can keep your static front-end scripts, styles, or images. In other words, your CSS files, JS files, fonts, and SVGs would live here.

`views/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data [or `$context`] will be used. Just an FYI.

## Installation
Getting started you will need to install theme dependencies with [nvm](https://github.com/nvm-sh/nvm#installing-and-updating), [npm](https://docs.npmjs.com/), and [composer](https://getcomposer.org/).

1. Navigate to the theme directory in your project folder.
2. Run `composer require timber/timber` to install Timber in the site, if prompted use the existing `composer.json` file in the project root directory. For more information on using Twig in WordPress see our [wiki article](https://github.com/thinkshout/thinkwp-starter-theme/wiki/TWIG-In-WordPress)
3. If using custom Gutenberg blocks with ACF run `composer require palmiak/timber-acf-wp-blocks` and add the following line to the constructor of the theme class in [class-theme.php](https://github.com/thinkshout/thinkwp-starter-theme/blob/main/lib/class-theme.php).
```php
new Timber_Acf_Wp_Blocks(); // Register blocks in views/blocks with ACF.
```
4. Run `npm install` to install dependencies. Install will check the node version against the `.nvmrc` file, install all dependencies, and populate an initial set of token definitions.

## Theme Development

For most development tasks, simply run `npm start` to start Parcel's watch, which will compile the projects CSS and
JavaScript as well as Tailwind in JIT mode.

Additionally, there are a number of scripts to aid in theme development (assume `npm run` prefix):

- `build` to compile css, js, and print css for production.
- `format`: Formats assets, tokens, and SVG files.
- `lint`: to check styling errors in js/css files. Ran automatically if you commit while inside the theme directory.
- `print.bundle` Bundle the print stylesheet for production.
- `theme.build.prod` Create the production build.
- `theme.build.dev` Create the development build.
- `theme.watch` Start the watch of the project in development mode (aliased to `npm start`)


## More Information
Please visit [the Wiki](https://github.com/thinkshout/thinkwp-starter-theme/wiki) to get started and for more information:

- [Setup Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Setup)
- [Development Strategy](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Development-Strategy)
- [Twig Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/TWIG-In-WordPress)
- [PHP Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/PHP-Guide)
- [Sass Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Sass-Guide)
- [Tailwind Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Tailwind-Guide)

## Other Resources
External docs for relevant theme technologies:

- [WordPress](https://wordpress.org)
- [Tailwind CSS](https://tailwindcss.com/)
- [Timber](https://timber.github.io/docs/)
