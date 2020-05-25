# TODO

These items must be done before launching project:

* Make sure the site sends emails, preferably by adding a new domain to [Mailgun](https://www.mailgun.com/) and use Mailgun's SMTP credentials in your `.env` file
* Disable all permalinks the site doesn't need (`/attachment`, `/author` and so on). One way to do this is by creating `public/themes/project/index.php` with the following content:
```php
<?php

declare(strict_types=1);

// disable permalinks without page templates (/author, /attachment and so on)
if (!is_home()) {
    wp_redirect(home_url('/'));
}
```
* Configure which favicons and what background color should be generated in [webpack.mix.js](./webpack.mix.js)
* Change `msapplication-TileColor` in [favicons.blade.php](./resources/views/partials/favicons.blade.php) if needed
* Generate new [favicon.admin.png](./resources/assets/images/favicons/favicon.admin.png) (tip: `magick favicon.ico -channel RGB -negate favicon.admin.png`)
* Change or remove `theme-color` meta value in [header.blade.php](./resources/views/header.blade.php)
* Make sure `/sitemap.xml` contains valid content/URL's (this is controlled by [The SEO Framework](./PLUGINS.md) and can be configured in `wp-admin`)
* Create a user for the client with the user role **editor** or lower
* Set [Google Analytics](https://analytics.google.com/) Tracking ID (see call to `google_analytics_deploy` in [functions.php](./public/themes/project/functions.php))
* Set [Facebook Pixel](https://www.facebook.com/business/a/facebook-pixel) Tracking ID (see call to `pixel_deploy` in [functions.php](./public/themes/project/functions.php))
* Set your `BUGSNAG_API_KEY` in the `.env` file, set **Notify Bugsnag About** to "Crashes, errors & warnings" in the [Bugsnag settings](/wordpress/wp-admin/options-general.php?page=bugsnag) and either remove `BUGSNAG_SET_EXCEPTION_HANDLERS` or set it to `true` in the production `.env` files
* Define browser support in [.browserslistrc](./.browserslistrc)
