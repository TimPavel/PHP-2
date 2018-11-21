<?php

require '../engine/core.php';

function routeIndex() {
    echo render('ajax/main');
}

function routeJsonitem() {
    $item = [
        'login' => 'Artur',
        'email' => 'test@example.com',
        'password' => '123123',
        'roles' => [
            'user', 'manager',' admin'
        ],
    ];
    renderJson($item);
}

function routeInput() {
    renderJson($_POST);
}

function routeObject() {
    renderJson($_POST['user']);
}

function routeAddProductToDB() {
	$i = 1;
	$price = null;
	while ($i <= 2002) {
		$price = 120 + $i;
		$sql = "INSERT INTO `geek_project`.`product` (`name`, `description`, `price`, `quantity`, `category_id`) VALUES ('product - {$i}', 'description for product - {$i}', '{$price}', '22', '5');";
		execute($sql);
		$i++;
	}
}

route();