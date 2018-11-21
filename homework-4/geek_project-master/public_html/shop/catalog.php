<?php

require '../../engine/core.php';

/**
 * Выводим товары с ограничением показа 25 штук
 */
function routeIndex() {
		$products = getItemArray(
			"SELECT * FROM product LIMIT 0,24"
		);

		echo render('shop/catalog', [
			'products' => $products
		]);
}

/**
 * функция для запроса товаров из БД
 */
function routeMoreGoods(){
	// проверка на наличие в ГЕТ массиве num - позиции с которго нужно запросить товары из БД
	if (isset($_GET['num'])) {
		$num = $_GET['num'];
		$products = getItemArray(
			"SELECT * FROM product LIMIT {$num}, 25;"
		);
		renderJson($products);
	}
}

route();