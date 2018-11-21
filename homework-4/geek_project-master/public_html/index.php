<?php

/**
 * начальная страница сайта
 */

// поключаем конфигурации приложения
require '../engine/core.php';

// вывод шаблона
echo render('site/home');