# TODO

These items must be done before launching project:

* Remove `minimum-stability` from `composer.json` as soon as [ekandreas/bladerunner](https://github.com/ekandreas/bladerunner) is released with [the features we need](https://github.com/ekandreas/bladerunner/pull/63)
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
* Generate new favicons with [Favicon Generator](https://realfavicongenerator.net/), place them in [resources/assets/images/favicons](./resources/assets/images/favicons) and update theme paths in [browserconfig.xml](./resources/assets/images/favicons/browserconfig.xml) and [site.webmanifest](./resources/assets/images/favicons/site.webmanifest)
* Generate new [favicon.admin.png](./resources/assets/images/favicons/favicon.admin.png) (tip: `magick favicon.ico -channel RGB -negate favicon.admin.png`)
* Change or remove `theme-color` meta value in [header.blade.php](./resources/views/base/header.blade.php)
* Make sure `/sitemap.xml` contains valid content/URL's (this is controlled by [The SEO Framework](./PLUGINS.md) and can be configured in `wp-admin`)
* Create a user for the client with the user role **editor** or lower
* Set [Google Analytics](https://analytics.google.com/) Tracking ID (see call to `google_analytics_deploy` in [functions.php](./public/themes/project/functions.php))
* Set [Facebook Pixel](https://www.facebook.com/business/a/facebook-pixel) Tracking ID (see call to `pixel_deploy` in [functions.php](./public/themes/project/functions.php))
* Configure [Bugsnag](/wordpress/wp-admin/options-general.php?page=bugsnag) with the API key and set **Notify Bugsnag About** to "Crashes, errors & warnings" and remove `DISABLE_BUGSNAG` from deploy `.env` files
* Define browser support in [.browserslistrc](./.browserslistrc)
