<?php

return [
    //  Настройки приложения
    'app' => [
        'name' => 'Geekbrains PHP 2',
        'logPath' => ROOT . "/data/logs",
        'templatesPath' => ROOT . '/templates',

        'assets' => [
            'css' => [
                '/css/bootstrap.min.css',
                '/css/style.css',
            ],
            'js' => [
                '/js/vendor/jquery-3.3.1.min.js',
                '/js/vendor/popper.min.js',
                '/js/vendor/bootstrap.min.js',
                '/js/app.js',
            ],
        ],
    ]
];