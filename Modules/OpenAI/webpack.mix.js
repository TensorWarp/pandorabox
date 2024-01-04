const mix = require('laravel-mix');
mix.js("resources/assets/js/app.js", "resources/assets/tailwind/js")
  .postCss("resources/css/app.css", "resources/assets/tailwind/css", [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
    require('postcss-nested'),
  ]);