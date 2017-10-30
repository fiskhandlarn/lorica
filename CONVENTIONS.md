# Coding conventions

Make sure your editor respects `.editorconfig`.

## JavaScript

JavaScript should be written in EcmaScript 6 and is automatically linted via node/yarn.

## CSS

CSS should

* follow [rscss](http://rscss.io/)
* be written as [Sass](http://sass-lang.com/) and is then automatically linted via node/yarn.

### Responsive design

If the site needs to be responsive you should style mobile first. The use of `max-width` in media queries is thus strongly discouraged.

If the site needs to have a grid system, please use [Bootstrap](https://getbootstrap.com/css/#grid). See [app.css](./resources/assets/styles/app.scss) for an include example.
