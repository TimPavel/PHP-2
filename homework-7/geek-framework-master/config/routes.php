<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use app\controllers\PageController;
use app\controllers\SiteController;
use app\controllers\CatalogController;
use app\controllers\CartController;
use app\controllers\CategoriesController;

/**
 * Настройки маршрутов приложения
 */
return [
    'routes' => [
        //'website/path' => ['ControllerClass', 'actionName'],
        '/' => [SiteController::class, 'index'],
        'registration' => [SiteController::class, 'registration'],
		'result' => [SiteController::class, 'index'],
		'logout' => [SiteController::class, 'logout'],

        'pages' => [PageController::class, 'index'],
        'pages/new' => [PageController::class, 'add'],
        'page/{id}' => [PageController::class, 'show'],

		'catalog' => [CatalogController::class, 'index'],
		'cat/{id}' => [CatalogController::class, 'showGoods'],
		'item/{id}' => [CatalogController::class, 'show'],

		'cats' => [CategoriesController::class, 'index'],

		'cart' => [CartController::class, 'showCart'],

    ],
];