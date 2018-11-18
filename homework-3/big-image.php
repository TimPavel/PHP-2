<?php

require 'vendor/autoload.php';

use App\View\Page;

$page = new Page( 'big-image');

if (isset($_GET["id"])) {
	$id = $_GET["id"];
	// получаем из БД массив по id
	$link =  getItem("SELECT * FROM `geek_project`.`gallery` WHERE `id` = {$id}");
}

function getItem($sql) {
	// получение одной строки
	$result = mysqli_query(mysqli_connect("127.0.0.1", "root", "", "geek_project"), $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}


echo $page -> render(array(
'bigImage' => $link
));



