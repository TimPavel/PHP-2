<?php

require 'vendor/autoload.php';

use App\View\Page;

$page = new Page( 'gallery');

$host = '127.0.0.1';
$db   = 'geek_project';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host; dbname=$db";
$opt = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$stmt = $pdo->query('SELECT * FROM `geek_project`.`gallery`');
while ($row = $stmt->fetch()) {
	$arraySmallImages[] = $row;
}

print_r($arraySmallImages['0']['linkSmallImg']);
//function getItemArray($sql) {
//
//	$result = mysqli_query(mysqli_connect("127.0.0.1", "root", "", "geek_project"), $sql);
//	$rows = [];
//	while ($row = mysqli_fetch_assoc($result)) {
//		$rows[] = $row['nameImg'];
//	}
//	return $rows;
//}
//
//$arraySmallImages = getItemArray('SELECT `nameImg` FROM `geek_project`.`gallery`');


echo $page -> render(array(
	'smallImages' => $arraySmallImages
));

