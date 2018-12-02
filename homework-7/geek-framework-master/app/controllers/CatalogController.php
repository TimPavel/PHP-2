<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 29.11.2018
 * Time: 13:08
 */

namespace app\controllers;

use app\models\Catalog;
use app\models\Categories;
use core\base\Controller;

class CatalogController extends Controller
{
	/**
	 * просмотр все товаров
	 * @return string
	 */
	public function index()
	{
		$items = Catalog::all(
			Catalog::find()
				-> from('shop_product')
		);

		return $this->render('index', [
			'items' => $items,
		]);
	}

	/**
	 * просмотр товаров в выбранной категории
	 */
	public function showGoods($id) {
		$goods = Catalog::all(
			Catalog::find()
				->where('shop_category_id = '. $id)
		);

		$cat = Categories::all(
			Categories::find()
				->select('name')
				->from('shop_category')
				->where('id = '.$id)
		);

		return $this->render('products', [
			'goods' => $goods,
			'catName' => $cat[0],
		]);
	}

	/**
	 * Просмотр выбранного товара
	 *
	 * @param $id
	 *
	 * @return string
	 */
	public function show($id)
	{
		// просмотр одной
		$item = Catalog::findById($id);

		return $this->render('view', [
			'item' => $item,
		]);
	}


}