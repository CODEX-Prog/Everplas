const mix = require('laravel-mix');

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

mix
    /* CSS */
    .sass('resources/sass/main.scss', 'public/css/oneui.css')
    .sass('resources/sass/oneui/themes/amethyst.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/city.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/flat.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/modern.scss', 'public/css/themes/')
    .sass('resources/sass/oneui/themes/smooth.scss', 'public/css/themes/')

    /* JS */
    .js('resources/js/app.js', 'public/js/laravel.app.js')
    .js('resources/js/oneui/app.js', 'public/js/oneui.app.js')

    /* Page JS */
    // auth module
    .js('resources/js/pages/auth/signin.min.js', 'public/js/pages/auth/signin.min.js')
    .js('resources/js/pages/auth/signup.min.js', 'public/js/pages/auth/signup.min.js')
    .js('resources/js/pages/auth/reminder.min.js', 'public/js/pages/auth/reminder.min.js')

    // users module
    .js('resources/js/pages/users/tables_datatables.js', 'public/js/pages/users/tables_datatables.js')
    .js('resources/js/pages/users/user.js', 'public/js/pages/users/user.js')
    .js('resources/js/pages/users/group.js', 'public/js/pages/users/group.js')
    .js('resources/js/pages/users/dialogs.min.js', 'public/js/pages/users/dialogs.min.js')

    // crm module
    .js('resources/js/pages/crm/tables_datatables.js', 'public/js/pages/crm/tables_datatables.js')
    .js('resources/js/pages/crm/contact.js', 'public/js/pages/crm/contact.js')
    .js('resources/js/pages/crm/company.js', 'public/js/pages/crm/company.js')
    .js('resources/js/pages/crm/dialogs.min.js', 'public/js/pages/crm/dialogs.min.js')
    .js('resources/js/pages/crm/group.js', 'public/js/pages/crm/group.js')

    // inventory module
    .js('resources/js/pages/inventory/asset.js', 'public/js/pages/inventory/asset.js')
    .js('resources/js/pages/inventory/mainten.js', 'public/js/pages/inventory/mainten.js')

    // hrm module
    .js('resources/js/pages/hrm/tables_datatables.js', 'public/js/pages/hrm/tables_datatables.js')
    .js('resources/js/pages/hrm/employee.js', 'public/js/pages/hrm/employee.js')
    .js('resources/js/pages/hrm/edit.js', 'public/js/pages/hrm/edit.js')
    .js('resources/js/pages/hrm/create.js', 'public/js/pages/hrm/create.js')

    // calendar module
    .js('resources/js/pages/calendar/calendar.min.js', 'public/js/pages/calendar/calendar.min.js')
    .js('resources/js/pages/calendar/custom.js', 'public/js/pages/calendar/custom.js')

    // receiving module
    .js('resources/js/pages/receiving/receiving.js', 'public/js/pages/receiving/receiving.js')

    // purchasing module
    .js('resources/js/pages/purchasing/purchasing.js', 'public/js/pages/purchasing/purchasing.js')

    // sales module
    .js('resources/js/pages/sales/tables_datatables.js', 'public/js/pages/sales/tables_datatables.js')
    .js('resources/js/pages/sales/sales.js', 'public/js/pages/sales/sales.js')
    .js('resources/js/pages/sales/EditSales.js', 'public/js/pages/sales/EditSales.js')

    // products module
    .js('resources/js/pages/products/materials.js', 'public/js/pages/products/materials.js')
    .js('resources/js/pages/products/product.js', 'public/js/pages/products/product.js')

    // setting module
    .js('resources/js/pages/setting/setting.js', 'public/js/pages/setting/setting.js')

    /* Tools */
    .browserSync('localhost:8000')
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
    });
