<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use core\base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo 'TEST';
    }

    public function hello($name)
    {
        echo "Hello, {$name}!";
    }

    public function page()
    {
        return $this->render('index');
    }

    public function login()
	{
		return $this->render('login');
	}
}