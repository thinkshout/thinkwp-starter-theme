
# The ThinkShout Timber Starter Theme for WordPress

This is forked from the "_s" for Timber: a dead-simple theme that you can build from. The primary purpose of this theme is to provide a file structure rather than a framework for markup or styles. Configure your Sass, scripts, and task runners however you would like!

## What's here?

`sass/`, `js/`, `static/` is where you can keep your static front-end scripts, styles, or images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`views/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data [or `$context`] will be used. Just an FYI.

## Getting Started
Please visit the Wiki to get started and for more information:

[Setup Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/Setup)
[Twig Guide](https://github.com/thinkshout/thinkwp-starter-theme/wiki/TWIG-In-WordPress)
[PHP Guide]()
[Sass Guide]()
[TailWind Guide]()

## Other Resources
[TailWind CSS](https://tailwindcss.com/)
[Timber](https://timber.github.io/)
[Alpine.js](https://alpinejs.dev/)