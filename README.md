
# The ThinkShout Timber Starter Theme for WordPress

This is forked from the "_s" for Timber: a dead-simple theme that you can build from. The primary purpose of this theme is to provide a file structure rather than a framework for markup or styles. Configure your Sass, scripts, and task runners however you would like!

## What's here?

`sass/`, `js/`, `static/` is where you can keep your static front-end scripts, styles, or images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`views/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data [or `$context`] will be used. Just an FYI.

## Getting Started
Please visit [the Wiki](https://github.com/thinkshout/thinkwp-starter-theme/wiki) to get started and for more information:

- [Setup Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Setup)
- [Development Strategy](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Development-Strategy)
- [Twig Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/TWIG-In-WordPress)
- [PHP Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/PHP-Guide)
- [Sass Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Sass-Guide)
- [Tailwind Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Tailwind-Guide)

## Other Resources
| ![WordPress Logo](https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/WordPress_blue_logo.svg/1024px-WordPress_blue_logo.svg.png)  | ![TailwindCSS logo](https://camo.githubusercontent.com/76fc893540a16d0acb4967472a5195511ec64fd8d98f377cb00dc8fa73ffb67b/68747470733a2f2f7265666163746f72696e6775692e6e7963332e63646e2e6469676974616c6f6365616e7370616365732e636f6d2f7461696c77696e642d6c6f676f2d737469636b65722e737667) | ![Timber Logo](https://timber.github.io/docs/build/img/timber-logo.svg) | ![Alpine Logo](https://alpinejs.dev/alpine_long.svg) |
- [WordPress](https://wordpress.org)
- [Tailwind CSS](https://tailwindcss.com/)
- [Timber](https://timber.github.io/docs/)
- [Alpine.js](https://alpinejs.dev/)