<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\models\Page;
use core\base\Controller;

class PageController extends Controller
{
    /**
     * Просмотр списка всех страниц сайта
     * @return string
     */
    public function index()
    {
        $pages = Page::all();

        return $this->render('index', [
            'pages' => $pages,
        ]);
    }

    /**
     * Просмотр выбранной страницы
     *
     * @param $id
     *
     * @return string
     */
    public function show($id)
    {
        // просмотр одной
        $page = Page::findById($id);

        return $this->render('view', [
            'page' => $page,
        ]);
    }

    /**
     * Добавление новой страницы
     */
    public function add()
    {
        // создание записи
        $page = new Page();

        if ($this->request->isPost()) {
            if ($page->load($this->request->post())) {
                $page->save();

                $this->request->redirect('page/' . $page->id);
            } else {
                $page->addError('title', 'Что-то пошло не так');
            }
        }

        return $this->render('form', [
            'page' => $page,
        ]);
    }
}