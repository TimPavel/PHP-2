<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use app\controllers\HomeController;
use app\controllers\CheckController;

/**
 * Настройки маршрутов приложения
 */
return [
    'routes' => [
        //'website/path' => ['ControllerClass', 'actionName'],

        '/' => [HomeController::class, 'page'],
        'home/{name}' => [HomeController::class, 'hello'],
        'login' => [HomeController::class, 'login'],
        'result' => [CheckController::class, 'checkFormData'],
    ],
];