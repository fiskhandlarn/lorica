# TODO

These items must be done before launching project:

* Remove `minimum-stability` from `composer.json` as soon as [ekandreas/bladerunner](https://github.com/ekandreas/bladerunner) is released with [the features we need](https://github.com/ekandreas/bladerunner/pull/63)
* Change `public/favicon.ico` (or remove it and use icons from [RealFaviconGenerator](https://realfavicongenerator.net/))
* Make sure the site sends emails, preferably by adding a new domain to [Mailgun](https://www.mailgun.com/) and use Mailgun's SMTP credentials in your `.env` file
* Disable all permalinks the site doesn't need (`/attachment`, `/author` and so on)
* Change `theme-color` meta value in `public/themes/project/header.php`
* Make sure `/sitemap.xml` contains valid content/URL's (this is controlled by [The SEO Framework](./PLUGINS.md) and can be configured in `wp-admin`)
* Create a user for the client with the user role **editor** or lower
* Set [Google Analytics](https://analytics.google.com/) Tracking ID (see call to `google_analytics_deploy` in [functions.php](./public/themes/project/functions.php))
* Set [Facebook Pixel](https://www.facebook.com/business/a/facebook-pixel) Tracking ID (see call to `pixel_deploy` in [functions.php](./public/themes/project/functions.php))
