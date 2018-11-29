<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 29.11.2018
 * Time: 13:08
 */

namespace app\controllers;

use app\models\Catalog;
use core\base\Controller;

class CatalogController extends Controller
{

	public function index()
	{


		$items = Catalog::all(
			Catalog::find()

		);


		return $this->render('index', [
			'items' => $items,
		]);
	}
}