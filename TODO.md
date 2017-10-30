# TODO

These items must be done before launching project:

* Change `public/favicon.ico` (or remove it and use icons from [RealFaviconGenerator](https://realfavicongenerator.net/))
* Make sure the site sends emails, preferably by adding a new domain to [Mailgun](https://www.mailgun.com/) and use Mailgun's SMTP credentials in your `.env` file
* Disable all permalinks the site doesn't need (`/attachment`, `/author` and so on)
* Change `theme-color` meta value in `public/themes/project/header.php`
* Create a user for the client with the user role **editor** or lower
* Set [Google Analytics](https://analytics.google.com/) Tracking ID (see call with `soil-google-analytics` in `library/soil.php`)
