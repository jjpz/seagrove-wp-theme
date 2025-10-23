const mix = require('laravel-mix');

mix
    .js(
        [
            'src/js/navigation.js',
            'src/js/skip-link-focus-fix.js',
            'src/js/main.js'
        ],
        'dist/js/main.mix.js'
    )
    .js('src/js/maps.js', 'dist/js/maps.mix.js')
    .setPublicPath('dist');

mix
    .combine(
        [
            'src/css/style.css',
            'src/css/maps.css',
            'src/css/custom.css'
        ],
        'dist/css/main.mix.css',
        [
            require('postcss-custom-properties')
        ]
    )
    .copy('dist/css/main.mix.css', '../style.mix.css');

mix.disableNotifications();