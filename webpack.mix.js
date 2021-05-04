const mix = require('laravel-mix');

mix
    .sass('resources/views/admin/assets/scss/reset.scss', 'public/backend/assets/css/reset.css')
    .sass('resources/views/admin/assets/scss/boot.scss', 'public/backend/assets/css/boot.css')
    .sass('resources/views/admin/assets/scss/login.scss', 'public/backend/assets/css/login.css')
    .sass('resources/views/admin/assets/scss/style.scss', 'public/backend/assets/css/style.css')

    .styles([
            'resources/views/admin/assets/js/datatables/css/jquery.dataTables.min.css',
            'resources/views/admin/assets/js/datatables/css/responsive.dataTables.min.css',
            'resources/views/admin/assets/js/select2/css/select2.min.css',
        ],
        'public/backend/assets/css/libs.css'
    )
    .scripts([
        'resources/views/admin/assets/js/jquery.min.js'
    ],'public/backend/assets/js/jquery.js')

    .scripts([
        'resources/views/admin/assets/js/login.js'
    ],'public/backend/assets/js/login.js')

    .scripts([
        'resources/views/admin/assets/js/datatables/js/jquery.dataTables.min.js',
        'resources/views/admin/assets/js/datatables/js/dataTables.responsive.min.js',
        'resources/views/admin/assets/js/select2/js/select2.min.js',
        'resources/views/admin/assets/js/select2/js/i18n/pt-BR.js',
        'resources/views/admin/assets/js/jquery.form.js',
        'resources/views/admin/assets/js/jquery.mask.js',
    ],'public/backend/assets/js/libs.js')

    .scripts([
        'resources/views/admin/assets/js/scripts.js'
    ],'public/backend/assets/js/scripts.js')

    .copyDirectory('resources/views/admin/assets/js/tinymce','public/backend/assets/js/tinymce')
    .copyDirectory('resources/views/admin/assets/js/datatables','public/backend/assets/js/datatables')
    .copyDirectory('resources/views/admin/assets/js/select2','public/backend/assets/js/select2')

    .copyDirectory('resources/views/admin/assets/css/fonts','public/backend/assets/css/fonts')

    .copyDirectory('resources/views/admin/assets/images','public/backend/assets/images')


    /**
     *  web
     */
    .sass('resources/views/web/assets/scss/bootstrap_custom.scss', 'public/assets/css/bootstrap_custom.css')
    .sass('resources/views/web/assets/scss/app.scss', 'public/assets/css/app.css')

    .scripts([
        'node_modules/jquery/dist/jquery.min.js'
    ],'public/assets/js/jquery.min.js')

    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
    ],'public/assets/js/bootstrap.bundle.min.js')

    .scripts([
        'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
        'node_modules/bootstrap-select/dist/js/i18n/defaults-pt_BR.min.js'
    ],'public/assets/js/bootstrap-select-defaults-pt_BR.min.js')

    .scripts([
        'resources/views/web/assets/js/script.js'
    ],'public/assets/js/script.js')

    .copyDirectory('resources/views/web/assets/images','public/assets/images')
    .copyDirectory('resources/views/web/assets/css/fonts','public/assets/css/fonts')


    .options({
        processCssUrls: false
    })
    .version()
;

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
