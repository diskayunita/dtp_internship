const { mix } = require('laravel-mix');

//Third party packages
const ImageminPlugin     = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin  = require('copy-webpack-plugin');
const imageminMozjpeg    = require('imagemin-mozjpeg');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
  plugins: [
    //Compress images
    new ImageminPlugin({
      test: /\.(jpe?g|png|gif|svg)$/i,
      pngquant: { quality: "65-80" },
      plugins: [
        imageminMozjpeg({
          quality: 65,
          //Set the maximum memory to use in kbytes
          maxmemory: 1000 * 512
        })
      ]
    })
  ]
});

mix
  .scripts(
    [
      "public/assets/js/jquery.min.js",
      "public/assets/js/bootstrap.js",
      "public/assets/js/js.cookie.min.js",
      "public/assets/js/jquery.slimscroll.js",
      "public/assets/js/jquery.blockui.min.js",
      "public/assets/js/jquery.cubeportfolio.js",
      "public/assets/js/bootstrap-switch.js",
      "public/assets/js/moment.min.js",
      "public/assets/js/fullcalendar.min.js",
      "public/assets/js/jquery-ui.min.js",
      "public/assets/js/DateTimePicker.js",
      "public/assets/js/daterangepicker.js",
      "public/js/select2.full.min.js",
      "public/js/owl.carousel.js",
      "public/js/jquery.magnific-popup.min.js",
      "public/packages/jquery-ui/jquery-ui.min.js",
      "public/assets/js/app.js",
      "public/js/profile.js",
      // "public/assets/js/galeri-home.js",
      "public/assets/js/layout.js",
      "public/assets/js/demo.js",
      "public/assets/js/quick-sidebar.js",
      "public/assets/js/quick-nav.js",
      "public/js/full-calender-modify-dds.js",
      "public/assets/js/jquery.scrollTo-min.js"
    ],
    "public/js/telkom-dtp.js"
  )
  .styles(
    [
      "public/assets/css/font-awesome.css",
      "public/assets/css/simple-line-icons.css",
      "public/assets/css/socicon.css",
      "public/assets/css/bootstrap.css",
      "public/assets/css/bootstrap-switch.css",
      "public/assets/css/owl.carousel.css",
      "public/assets/css/owl.theme.css",
      "public/assets/css/cubeportfolio.css",
      "public/css/magnific-popup.css",
      "public/css/full-calender-style.css",
      "public/assets/css/DateTimePicker.css",
      "public/assets/css/news-example.css",
      "public/assets/css/daterangepicker.min.css",
      "public/assets/css/bootstrap-datetimepicker.min.css",
      "public/css/select2.min.css",
      "public/css/product.css",
      "public/css/profile.css",
      "public/assets/css/style.css",
      "public/assets/css/style-patch.css",
      "public/packages/jquery-ui/jquery-ui.min.css"
    ],
    "public/css/telkom-dtp.css"
  )
  .copy("public/assets/img", "public/img")
  .minify("public/js/telkom-dtp.js")
  .minify("public/css/telkom-dtp.css")
  .options({
    processCssUrls: true,
    purifyCss: false
  })
  .version();