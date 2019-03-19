# Coding conventions

Make sure your editor respects `.editorconfig`.

## JavaScript

JavaScript should be written in EcmaScript 6 and is then automatically linted via npm.

Please think twice before using JavaScript for things that can be made with CSS instead (CSS is loaded in `<head>` and is therefore executed faster than JavaScript). Good resources:

* http://youmightnotneedjs.com/
* https://github.com/you-dont-need/You-Dont-Need-JavaScript

## CSS

CSS should

* follow [rscss](http://rscss.io/)
* be written as [Sass](http://sass-lang.com/) and is then automatically linted via npm.
* not be written inline in HTML
* not set fixed `height` for inline elements containing text (since text can change in length/size depending on database content, screen widths and browser zoom)
* not use `padding-top` for vertically centering inline elements containing text, please use [other methods for centering](https://css-tricks.com/centering-css-complete-guide/)

### SCSS

SCSS should

* use multiples of Bootstrap's `$spacer` or `$grid-gutter-width` instead of fixed pixel values for `padding`/`margin`/`position` rather than trying to achieve "pixel perfection" (sometimes the design is sloppy, but by using these variables we hopefully achieve something more pleasant for the human eye)
* use variables for CSS transitions to ensure the same experience for the whole site, for example: `transition: opacity $transition-duration-hover $transition-easing-default;`
* use Bootstrap's [flex extends](https://getbootstrap.com/docs/4.3/utilities/flex/) whenever possible
* define and use color variables and *not* rely on Bootstrap's color variables (for example, define and use `$color-white` instead of `$white`)
* use Bootstrap's `make-container` and `make-container-max-widths` mixins for container components (this trumps the rule below for margins/dimensions in rscss)
* define `line-height` as a simple fraction instead of a decimal fraction (for example, for a text with font-size set to 28px and line-height set to 34px the `line-height` should be declared as `(34 / 28)` instead of `1.21`)
* use variables for `font-weight` to ensure that the loaded weights are used (also see *Fonts* below)
* never use `:hover` or `:focus`, but instead use mixins from [_no-touch.scss](./resources/assets/styles/mixins/_no-touch.scss) (or Bootstrap's mixins if touch screens should have hover/focus effects)

### rscss

rscss components should

* be placed in [their own file](http://rscss.io/css-structure.html#one-component-per-file), with the same filename as the component prepended with an underscore (so that SCSS only includes it if needed); the declaration for `.a-component` should for example be placed in the file `_a-component.scss` and *only* contain the declaration for that component
* [not have any declarations for margin and/or dimensions](http://rscss.io/layouts.html#avoid-positioning-properties) (this also goes for Bootstrap helpers such as `.m-auto`) unless they fulfill [the exceptions specified by rscss](http://rscss.io/layouts.html#fixed-dimensions); these should instead be placed in a parent component

### Responsive design

If the site needs to be responsive you should style mobile first. The use of `max-width` in media queries is thus strongly discouraged.

Only write **one** media query for each screen width in each rscss component, place them after each other (with mobile first) and use Bootstrap's variables and mixins:
```scss
.a-component {
  background: #f00;

  @include media-breakpoint-up(md) {
    background: #0f0;
  }

  @include media-breakpoint-up(lg) {
    background: #00f;
  }
}
```

If the site needs to have a grid system, please use the one provided in [Bootstrap 4](https://getbootstrap.com/docs/4.3/layout/grid/) (included by default in [app.css](./resources/assets/styles/app.scss#app.scss-23)).

### Lint errors/warnings

`stylelint-rscss` sometimes generates somewhat unclear errors/warnings:

* too deep nesting sometimes triggers a "Component too deep" error, either rewrite your SCSS as [recommended by rscss](http://rscss.io/css-structure.html#avoid-over-nesting) or (if you for example are using Bootstrap's grid and thus must declare `> .row > .col`) use `// stylelint-disable-line rscss/class-format` to circumvent this
* `// stylelint-disable-line` directives on multiline declarations [triggers an error](https://github.com/stylelint/stylelint/issues/3111), disable the line like this instead:
```scss
// stylelint-disable
&:checked ~ .single-steward-header,
// stylelint-enable
&:checked ~ .toggle {
  //
}
```

### Browser support

All CSS is run through `autoprefixer` with the queries defined in [.browserslistrc](./.browserslistrc). Remove the [.browserslistrc](./.browserslistrc) file to use [browserslist defaults](https://github.com/browserslist/browserslist#queries) or [define the queries yourself](https://github.com/browserslist/browserslist#config-file).

## Images

SVG images should

* be optimized with `svgo` before being added to the repo (easiest to achieve by copying the file optimized by npm from the [assets](./public/themes/project/assets) directory)
* be included with [`require_image()`](./public/themes/sotplate/library/assets.php#assets.php-29) in the theme PHP

Other images should

* be included with [`image_url()`](./public/themes/sotplate/library/assets.php#assets.php-24) in the theme PHP

## Fonts

Fonts should

* explicitly be defined in the CSS to ensure correct loading for all users (if they're not loaded with Google Fonts or similar)
* be defined with and used in conjuction with `font-weight` variables (these could be reused from Bootstrap's default variables)

## Other assets

Other assets should

* be placed in relevant sub directories in [/resources/assets](./resources/assets) (`/resources/assets/videos` for example)
* be included with [`asset_url()`](./public/themes/sotplate/library/assets.php#assets.php-14) in the theme PHP
