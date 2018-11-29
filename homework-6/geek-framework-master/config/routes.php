<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use app\controllers\PageController;
use app\controllers\SiteController;
use app\controllers\CatalogController;

/**
 * Настройки маршрутов приложения
 */
return [
    'routes' => [
        //'website/path' => ['ControllerClass', 'actionName'],
        '/' => [SiteController::class, 'index'],
        'registration' => [SiteController::class, 'registration'],
		'result' => [SiteController::class, 'index'],

        'pages' => [PageController::class, 'index'],
        'pages/new' => [PageController::class, 'add'],
        'page/{id}' => [PageController::class, 'show'],

		'catalog' => [CatalogController::class, 'index'],

    ],
];