# Empty Wordplate starter

Sot's boilerplate for WordPress sites, based on [WordPlate](https://github.com/wordplate/wordplate).

## Structure

The `public` folder is the web root. Most of the project's code will reside in your project [theme](https://codex.wordpress.org/Themes) in `public/themes`.

WordPress plugins are added via composer from [WordPress Packagist](https://wpackagist.org/) and automatically placed in `public/mu-plugins` where they are [automatically enabled](https://codex.wordpress.org/Must_Use_Plugins). Please see [WordPlate documentation](https://github.com/wordplate/wordplate#plugins) for more information on how to add plugins. This repo comes with [some plugins already installed](./PLUGINS.md). Please read up on these before removing them.

WordPress translations are added via composer from [this repository](https://wp-languages.github.io/) and automatically placed in `public/languages`.

Static resources (JavaScript, CSS, images, fonts etc) is added to the `resources` folder and is automatically compiled/copied into your theme folder. These resources should follow our [coding conventions](./CONVENTIONS.md).

## Setup

Merge this repo into your own:

```bash
$ git remote add wordplate-empty {clone-url}
$ git pull wordplate-empty master
```

(where `{clone-url}` is something like https://user@bitbucket.org/sotdigital/wordplate-empty.git)

Open `composer.json` and change the `name` and `description` properties.

Rename the example theme and use it as the base for your project's theme:
```bash
$ git mv public/themes/project/ public/themes/your-project/
```

Update `public/themes/your-project/style.css` with your project's name and description.

Change `WP_THEME` and `BROWSER_SYNC_HOST` in `.env.example` to reflect your new theme/project name.

Update `advanced-custom-fields-pro` to the latest version:

```bash
$ composer update-acf-plugin
```

Follow the *Install* instructions below.

Visit your project in the browser and run the WordPress installation wizard with these values:

* *Username*: sot
* *Your Email*: service@sot.se
* *Search Engine Visibility*: <unchecked>

Do not click the ''Log in'' button in the final step, instead use the URL `/wordpress/sot-admin' to log into wp-admin. Send the login url and credentials to the 1password administrator.

Add languages for Polylang in wp-admin (*Languages* in the side menu) so you can start using the [wordplate/translator](https://github.com/wordplate/translator) functions, or remove `wordplate/translator` from composer if your project is monolingual (optionally remove `koodimonni-language` packages if not needed).

Read [TODO.md](./TODO.md) so you now what must be done before launching your project.

Change "domain.tld" in this README.md below to reflect your project's name and domain name.

Setup done! Remove everything in this README.md above this line:

----


# Project

[TODO.md](./TODO.md)

## Install

1: Install the node dependencies and build the resources:

```bash
$ npm install
$ npm run dev
```

2: Install the composer dependencies:

```bash
$ composer install
```

3: Configure your web server setting the web root to the `public/` folder or configure Valet.

4: If you want to use a custom domain you should update your `/etc/hosts` file.

5: Edit the `.env` file with your database and mail credentials, and [WordPress salts](https://wordplate.github.io/salt/).

## Develop

Build CSS & JS files one time:

```bash
$ npm run dev
```

Build CSS & JS files and watch for file changes:

```bash
$ npm run watch
```

Build minified CSS & JS files one time:

```bash
$ npm run prod
```

## Deploy

Deploy with [Envoyer](https://envoyer.io/projects/NNNNN) to:

* [d.domain.tld](http://d.domain.tld)
* [q.domain.tld](http://q.domain.tld)
* [domain.tld](http://domain.tld)
