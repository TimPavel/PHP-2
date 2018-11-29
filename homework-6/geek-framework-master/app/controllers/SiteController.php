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

        	// одновременная проверка на наличие зарегистрир юзера и соотетсвие паролей
			if ($isRegisteredUser && $isRegisteredUser->password == $user->password){

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

//		$regUser = User::all(
//			User::find()
//				->where('id = :id')
//				->setParameter(':id', 1)
//		);
//
////        print_r($regUser);

		return $this->render('registration');
	}
}