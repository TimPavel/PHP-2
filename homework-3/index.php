<?php

require 'vendor/autoload.php';

use App\View\Page;

$page = new Page( 'home');

echo $page -> render([
	'currentDate' => date('d-m-Y'),
	'error' => false,
	'users' => [
		[
			'login' => 'admin',
			'email' => 'example@dm.com'
		],
		[
			'login' => 'admin2',
			'email' => 'example2@dm.com'
		],
		[
			'login' => 'admin3',
			'email' => 'example3@dm.com'
		]
	]
]);