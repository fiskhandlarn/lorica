# Plugins

## Advanced Custom Fields PRO

Our go-to solution for adding fields to post, pages, settings pages and so on. Safe to remove if not used.

## Disable Embeds

Prevents others from embedding our site. Remove only if site should be embeddable by others.

## Disable Emojis

Removes WordPress emoji support and it's bloating in `<head>`. Remove only if the site needs to have emojis.

## iThemes Security

Minimizes the risk of being hacked. Is configured by `public/install.php` for our needs. Should not be removed.

## Mail

Reads SMTP credentials from `.env` files. Remove only if SMTP is not used.

## Normalizer

Makes åäö pasted in MacOS look good on Windows too by forcing to [NFC](http://unicode.org/reports/tr15/images/UAX15-NormFig3.jpg). Should not be removed.

## Plate

Simplifies hiding and customizing in wp-admin. Safe to remove if not used.

## Polylang (via wordplate/polylang)

Our go-to solution for multilingual sites. Safe to remove if not used.

## WP Migrate DB

Simplifies database migration between live, stage and development servers. Save to remove if not used.
