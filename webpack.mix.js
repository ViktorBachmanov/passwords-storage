const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix
// .webpackConfig({
//   output: {
//       chunkFilename: "js/[name].[chunkhash].js",
//     },
//   })
    .js('resources/vue/passwords-storage-app-vue', 'public/js')
    .extract(["vue", "pinia", "vuetify", "formkit"])
   .vue()
   .version();
  //  .copy('node_modules/@mdi/font/fonts/', 'public/dist/fonts/');