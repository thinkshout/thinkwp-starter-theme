
# The ThinkShout Timber Starter Theme for WordPress

This is forked from the "_s" for Timber: a dead-simple theme that you can build from. The primary purpose of this theme is to provide a file structure rather than a framework for markup or styles. Configure your css, scripts, and task runners however you would like!

## What's here?

After installation in the  `assets` directory you'll find `css/`, `js/`, and `static/` is where you can keep your static front-end scripts, styles, or images. In other words, your CSS files, JS files, fonts, and SVGs would live here.

`views/` contains all of your Twig templates. These are rendered by PHP files in the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where the data (`$context`) will be used.

## Installation
Getting started you will need to install theme dependencies with [nvm](https://github.com/nvm-sh/nvm#installing-and-updating), [npm](https://docs.npmjs.com/), and [composer](https://getcomposer.org/).

- [ ] Make sure you're running PHP >=8.1. (These instructions were tested with PHP 8.1.)
- [ ] Ensure your project has ACF installed and activated. This theme uses ACF for custom fields and options pages.
- [ ] Navigate to your project root (where your site's composer.json file lives), and pull in supporting composer packages: `composer require -W timber/timber palmiak/timber-acf-wp-blocks jjgrainger/posttypes`
- [ ] Commit the changes to composer.json & composer.lock
- [ ] Navigate to your theme folder `~/sites/YOURSITE/web/wp-content/themes/`
- [ ] Create a new folder `custom/`
- [ ] Download a copy of the [TS WP starter theme](https://github.com/thinkshout/thinkwp-starter-theme/archive/main.zip)
- [ ] Extract and rename it and then navigate to the newly added theme `mv thinkwp-starter-theme-main YOURSITE`, `cd YOURSITE`
- [ ] Optional - commit the theme files. This is a checkpoint commit for the base theme code.
- [ ] Pull in our base build assets: run `composer scaffold`
- [ ] Optional - commit the theme file updates. This is a checkpoint commit for the base assets.
- [ ] Update the theme name to your project name `./update_theme_name.sh YOURSITE`
- [ ] Commit all remaining code updates.
- [ ] Run `nvm install; npm install; npm run build`
- [ ] In your admin panel, go to Appearance > Themes
- [ ] Find your new theme and click Activate to use your new theme right away.

## ACF Setup
Our Timber-based theme requires ACF (Advanced Custom Fields) Pro. ACF requires a paid subscription -- you should set this up before further development. Some clients may purchase an ACF subscription, but if they don't you can use [ThinkShout's unlimited license]([url](https://docs.google.com/spreadsheets/d/13-aOPAxrdrQ_1cHhOAqQ_cRa457orIScLCwgtuB1SsU/edit?gid=0#gid=0)).
- [ ] Install ACF [via Composer](https://www.advancedcustomfields.com/resources/installing-acf-pro-with-composer/). Note that the "auth.json" file asks you to specify a URL. This is only informational on the ACF account side. Adding the pantheon live URL is a sensible default choice.
- [ ] Enable ACF through the WordPress UI (you'll need to do this on whatever database is going to become the install source for developers)
- [ ] Activate the ACF Pro license through the WP UI (again, this must be done on the source database so it can proliferate)

## Common Setup Tasks
The following is a list of common setup tasks. These are typically only needed when you’re not using an existing site database. They aren’t required steps, but they can be useful during development.

- [ ] Adjust Permalink settings: Go to `/wp/wp-admin/options-permalink.php` and change the Permalink structure to Post name.
- [ ] Create a style guide page: Add a new Page and set it's path to `/style-guide`. The style guide will automatically appear on that page.

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
