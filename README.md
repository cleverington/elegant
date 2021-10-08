# Elegant, a WordPress theme

Elegant is a (with permission) fork of an in-development WordPress theme.

## Unnamespacing TODO list

- [x] Port enough `.twig` files from `border-beagle/` to 'load' the site.
- [x] Create a temporary `gulpfile.js` setup, so there is minimal theming.
- [x] Generate and update example code for custom post types and custom taxonomies.
- [x] Turn off `Texas-Sans` temporarily.
- [ ] Add needed `todo` items throughout the PHP-side codebase.
- [ ] Add a Screenshot here, once initial site is built.
- [ ] Convert **back** to Gutenberg and disable Classic Editor.
- [ ] Delete current `gulpfile.js` and rebuild for ESNext standards.
- [ ] Update `main.js` to comply with ESNext standards.
- [ ] Update `helpers.php` with function(s) for updating/altering metaboxes (For helper instructions).
- [ ] Delete or use contents of `/Unused-Code` directory.
- [ ] Complete `Core\Events::class` build with required fields.
- [ ] For `Core\Events`: Alter the 'Tags' metabox with instructions pulled from 'EVENT TAGS' field.
- [ ] Add `Location` subfields to the `Locations` taxonomy (eg: address, street, etc.)
- [ ] Generate `Block\Profiles::class` file.
- [x] Generate `Core\Events::class` file (if needed).
- [ ] Generate `Core\Profiles::class` file (if needed).
- [ ] Integrate `texas-news/` 'External Posts' formatting, but as **part** of the default `post`.

### Not Doing

Removed these items because they are unnecessary.

- ~Generate `Core\ExternalPosts::class` file (if needed).~
- ~Generate `Block\ExternalPosts::class` file.~

### Texas-Sans Issues

Tempoarily shut it down until the root-cause can be addressed.

As its a front-end only piece of tooling, I just flat replaced it with `Open Sans`.

1. It was renamed to `1883-Sans`, which means the files need replacement (try importing from `texas-connect/` from UC).
2. Chrome and FireFox are now refusing to load it, referecing the error noted here: [https://support.mozilla.org/nl/questions/913498](https://support.mozilla.org/nl/questions/913498)

## Background

The University of Texas at Austin's College of Education needs a full-featured CMS which is flexible and future-ready, while not requiring high level of knowledge for long-term maintenance and updates.

Though Drupal *does* these things, the tools available to WordPress for quick flexibility, rapid ACF creation (CCK, for Drupalists), and leveraging WPML for multilingual make WordPress a more ideal choice. Add in the ability to use [WordPress Site Network](https://wordpress.org/support/article/create-a-network/) feature [on Pantheon](https://pantheon.io/docs/guides/multisite/) and the various departments within the College of Education can reach a much smoother mainteance window. (e.g.: Maintaining multiple sites, yes, but only one Pantheon instance, one codebase, and one maintenance window.)

Much of the code inspiration for this theme was drawn from three sources:

- Flynt - [https://github.com/flyntwp/flynt](https://github.com/flyntwp/flynt)
- LeagleCup - [https://github.com/19h47/leaglecup](https://github.com/19h47/leaglecup)
- Border Beagle - [https://github.austin.utexas.edu/pres-ucomm/border-beagle](https://github.austin.utexas.edu/pres-ucomm/border-beagle)

### Linting and Coding Standards

Elegant Education is a future-forward WordPress theme built with PHP 7.x in mind.  (PHP 8.x would be nice, but Pantheon does not currently support it.)

With that in mind, Elegant Education PHP linting is accomplished via a combination of both [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/) **and** WordPress' [PHP Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/).

Custom plugins, if required, will be completed using WordPress' Coding Standards (Extra), but the theme-engine itself will attempt to use **industry** standard Best Practices, as opposed to WordPress' outdated standards when possible.

#### Theme Engine Constraints

The *current* 'Timber' engine used for TWIG Templating and WordPress theme-engine requires code to be formated in certain manners which are non-standard.

**Functional, but against PSR12 Standard:**
`functions.php:11:` --> `Elegant\Init::run_services();`
`inc/Init.php:25:` --> `Setup\Theme::class`

**Correct Usage for PSR12:**
`functions.php:11:` --> `use function Elegant\Init\run_services;`
`inc/Init.php:25:` --> `use Setup\Theme\class`

## Install

```bash
composer Install
```

```bash
npm install
```

## Build

@todo: Setup build configuration, once ready.

## Instructions

@todo Clean up instructions and references for future coders. @todo Compare `leaglecup` with Flynt for naming conventions. Flynt is more standardized, and the documentation easier to reference. That said, `leaglecup` appears to have been the better codebase.

1. Custom Post Types are declared within the `inc/Core` folder.
2. If ACF-based Gutenberg blocks are needed to display content, they are generated within the `inc/Block` folder.
