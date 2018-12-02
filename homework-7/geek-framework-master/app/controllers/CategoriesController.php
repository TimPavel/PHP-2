<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 01.12.2018
 * Time: 11:14
 */

namespace app\controllers;

use app\models\Categories;
use core\base\Controller;

class CategoriesController extends Controller
{

	/**
	 * отображение категорий товаров
	 * @return string
	 */
	public function index()
	{
		$cats = Categories::all(
			Categories::find()
		);

		return $this->render('cats', [
			'cats' => $cats,
		]);
	}
}