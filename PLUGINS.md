# Plugins

## [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/pro/)

Our go-to solution for adding fields to post, pages, settings pages and so on. Safe to remove if not used or replace with [free version](https://wordpress.org/plugins/advanced-custom-fields/) if pro features are not needed. If removed the [wordplate/acf](https://github.com/wordplate/acf/) helper can be removed as well.

## [Bugsnag](https://wordpress.org/support/plugin/bugsnag)

Send all crashes, errors and warnings to [Bugsnag](https://app.bugsnag.com/). Should not be removed.

## [Classic Editor](https://wordpress.org/plugins/classic-editor/)

Disables the Gutenberg editor. Safe to remove.

## [Disable Embeds](https://wordpress.org/plugins/disable-embeds/)

Prevents others from embedding our site. Remove only if site should be embeddable by others.

## [Disable Emojis](https://wordpress.org/plugins/disable-emojis/)

Removes WordPress emoji support and it's bloating in `<head>`. Remove only if the site needs to have emojis.

## [Disable Feeds](https://wordpress.org/plugins/disable-feeds/)

Removes WordPress atom/rss feeds. Remove only if the site needs to have feeds.

## [Fly Dynamic Image Resizer](https://wordpress.org/plugins/fly-dynamic-image-resizer/)

Helper for easily setting custom image sizes.

## [iThemes Security](https://wordpress.org/plugins/better-wp-security/)

Minimizes the risk of being hacked. Is configured by `public/install.php` for our needs. Should not be removed.

## [Mail](https://github.com/wordplate/mail)

Reads SMTP credentials from `.env` files. Remove only if SMTP is not used.

## [Normalizer](https://wordpress.org/plugins/normalizer/)

Makes åäö pasted in MacOS look good on Windows too by forcing to [NFC](http://unicode.org/reports/tr15/images/UAX15-NormFig3.jpg). Should not be removed.

## [Plate](https://github.com/wordplate/plate)

Simplifies hiding and customizing in wp-admin. Safe to remove if not used.

## [Polylang](https://wordpress.org/plugins/polylang/) (via [wordplate/polylang](https://github.com/wordplate/polylang))

Our go-to solution for multilingual sites. Safe to remove if not used.

## [roots/soil](https://github.com/roots/soil/)

"WordPress plugin which contains a collection of modules to apply theme-agnostic front-end modifications". Cleans up head and adds Google Analytics tracking code. Please see [library/soil.php](./public/themes/project/library/soil.php).

## [Simple History](https://wordpress.org/plugins/simple-history/)

Keeps a log of everything done in wp-admin. Especially useful when we let clients into wp-admin. Save to remove if not used.

## [The SEO Framework](https://wordpress.org/plugins/autodescription/)

"Easy SEO for beginners, an awesome API for experts." Our go-to solution for SEO optimizations and for setting OG meta etc.

## [WP Migrate DB](https://wordpress.org/plugins/wp-migrate-db/)

Simplifies database migration between live, stage and development servers. Save to remove if not used.

# Composer packages

## [fiskhandlarn/blade](https://github.com/fiskhandlarn/blade)

Adds Laravel Blade support. Used in [parent theme](./public/themes/lorica) and can be used in your project theme.

## [johnbillion/extended-cpts](https://github.com/johnbillion/extended-cpts)

"A library which provides extended functionality to WordPress custom post types and taxonomies". Highly recommended if you're using custom post types and taxonomies.

## [spatie/image-optimizer](https://github.com/spatie/image-optimizer)

Used to automatically optimize uploaded SVG files with [svgo](https://github.com/svg/svgo). Please see  [library/svg.php](./public/themes/project/library/svg.php) and (src/Optimizers/CustomSvgo.php)[./src/Optimizers/CustomSvgo.php].
