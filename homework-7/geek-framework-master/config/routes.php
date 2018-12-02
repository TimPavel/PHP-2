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
		// страница регистрации нового пользователя
        'registration' => [SiteController::class, 'registration'],
		// страница приветствия пользователя
		'result' => [SiteController::class, 'index'],
		'logout' => [SiteController::class, 'logout'],

        'pages' => [PageController::class, 'index'],
        'pages/new' => [PageController::class, 'add'],
        'page/{id}' => [PageController::class, 'show'],

		// просмотр все товаров
		'catalog' => [CatalogController::class, 'index'],
		// просмотр товаров выбранной категории
		'cat/{id}' => [CatalogController::class, 'showGoods'],
		// просмотр товара
		'item/{id}' => [CatalogController::class, 'show'],

		// на страницу выбора категорий товара для просмотра
		'cats' => [CategoriesController::class, 'index'],

		// на страницу корзины
		'cart' => [CartController::class, 'showCart'],

    ],
];