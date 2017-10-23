# We Are Hiring

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

3: Configure your web server setting the web root to the `public/` folder or configure Homestead (see below).

4: If you want to use a custom domain you should update your `/etc/hosts` file.

5: Edit the `.env` file with your credentials and [WordPress salts](https://wordplate.github.io/salt/).

### Homestead

If you want to use [Homestead](https://laravel.com/docs/homestead#per-project-installation) vagrant box (optional) run the command below:

```bash
$ vendor/bin/homestead make
```

This will create a `Homestead.yaml` file which you need to update with your credentials.

Make sure you've [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/) installed on your computer.

Then start you vagrant box with the command below:

```bash
$ vagrant up
```

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

Deploy with [DeployBot](https://hoymultimedia.deploybot.com/NNNNNN-NNNNN-project/) to:

* [d.domain.tld](http://d.domain.tld)
* [q.domain.tld](http://q.domain.tld)
* [domain.tld](http://domain.tld)
