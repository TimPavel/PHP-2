<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 25.11.2018
 * Time: 21:03
 */
namespace app\controllers;

use core\base\Controller;

class CheckController extends Controller
{
	private $user = ['name' => 'Garry', 'password' => '123123'];

	public function checkFormData()
	{
		if (!empty($_POST['name']) && !empty($_POST['password'])) {
			if(($_POST['name'] == $this->user['name']) && ($_POST['password'] == $this->user['password'])) {
				// в случае успешной идентификации, рендерим страницу и передаем имя
				return $this->render('result', array(
					'name' => $_POST['name']
				));
			}
			else {
				echo 'данные неверны';
			}
		} else {
			echo 'нет такого пользователя';
		}

	}
}