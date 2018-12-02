<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\models\User;
use core\base\Controller;

class SiteController extends Controller
{

    public function index()
    {
    	if (!$_SESSION['user']) {

			session_start();

			$user = new User();

			if ($this->request->isPost()) {
				$user->load($this->request->post());

				// выполняем запрос в БД по введенному логину
				// в случае успеха получаем массив зарегистр юзера, иначе - false
				$isRegisteredUser = User::one(
					User::find()
						->where('login = :login')
						->setParameter(':login', $user->login)
				);

				// одновременная проверка на наличие зарегистрир юзера и соответствие паролей
				if ($isRegisteredUser && $isRegisteredUser->password == $user->password){

					$_SESSION['user'] = $user->login;

					return $this->render('result', [
						'login' => $user->login
					]);
					// иначе выводим в твиг шаблон ошибку авторизации
				} else {
					$user->addError('login', 'Неверный логин и/или пароль');
				}
			}
			return $this->render('index', [
				'user' => $user
			]);
		} else {
			$user = $_SESSION['user'];
			return $this->render('result', [
				'login' => $user
			]);
		}
    }


	public function registration()
	{
		$user = new User();

		if ($this->request->isPost()) {
			if ($user->load($this->request->post())) {
                $user->save();

				var_dump($user);
			} else {
				echo 'NOT LOADED';
			}
		}

		return $this->render('registration');
	}

	public function logout() {
		unset($_SESSION['user']);
		header("Location: /");
	}
}
