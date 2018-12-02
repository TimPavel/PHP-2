<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 29.11.2018
 * Time: 22:33
 */

namespace app\controllers;

use app\models\Cart;
use core\base\Controller;

class CartController extends Controller
{

	public function showCart()
	{
		var_dump($_POST);
		if ($this->request->isPost()) {
			$orderItem = $this->request->post();
			var_dump($orderItem);
		}

		return $this->render('cart', [
			'item' => $orderItem,
		]);
	}
}