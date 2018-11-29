<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\base;

use core\Request;

/**
 * Управляющий класс-контроллер, соединяющий модель и представление
 * Обрабатывает действия по указанным маршрутам
 *
 * @package core\base
 *
 * @property string $name
 * @property Request $request
 */
abstract class Controller extends BaseObject
{
    public $name;
    public $request;

    /**
     * @var View $view
     */
    protected $view;

    /**
     * Создание контроллера по указанному маршруту и шаблону
     *
     * @param Request $request
     * @param View $view
     */
    public function __construct(Request $request, View $view)
    {
        // получаем имя контроллера для поиска шаблонов
        $className = explode('\\', static::class);
        $this->name = strtolower(str_replace('Controller', '', array_pop($className)));

        // кешируем $request для работы
        $this->request = $request;

        // кешируем $view для отображения страниц
        $this->view = $view;
    }

    /**
     * Вызов запрошенного метода в маршруте
     *
     * @param string $method
     * @param array $params
     *
     * @return mixed
     * @throws \Exception
     */
    public function runAction(string $method, array $params)
    {
        if (method_exists($this, $method)) {
            // распаковываем аргументы метода из массива
            return $this->{$method}(...$params);
        } else {
            throw new \Exception('Invalid action');
        }
    }

    /**
     * Генерация ответа с определением формата
     *
     * @param string $view
     * @param array $data
     *
     * @return string
     */
    public function render(string $view, array $data = [])
    {
        return ($this->request->isAjax())
            ? $this->json($data)
            : $this->view($view, $data);
    }

    /**
     * Формируем JSON массив для возврата из контроллера
     *
     * @param array $data
     *
     * @return string
     */
    private function json(array $data)
    {
        header('Content-Type: application/json');

        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * Генерация шаблона через Twig по заданному пути и данным
     *
     * @param string $view
     * @param array $data
     *
     * @return string
     */
    private function view(string $view, array $data = [])
    {
        try {
            $view = "/pages/{$this->name}/{$view}.twig";

            return $this->view->render($view, $data);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}