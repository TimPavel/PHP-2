<?php

/**
 * Основные настройки приложения
 */
return [
    'app' => [
        'name' => 'GeekBrains MVC App',
        'basePath' => dirname(__DIR__),
    ],

    'view' => [
        'templates' => dirname(__DIR__) . '/app/views',
        'params' => [
            //'cache' => dirname(__DIR__) . '/runtime/cache',
        ],
    ],
];
