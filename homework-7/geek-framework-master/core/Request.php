<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core;

use core\base\BaseObject;

/**
 * Предназначен для обработки запросов к приложению
 * GET, POST, AJAX, Session, Cookie
 *
 * @package core
 *
 * @property-read string $path
 */
class Request extends BaseObject
{
    private $_redirectedFrom;

    /**
     * Инициализация данных запроса
     */
    public function __construct()
    {
        // запуск сессии
        session_start();

        // кешируем страницу, откуда пришел пользователь (для редиректа)
        $this->_redirectedFrom = isset($_SERVER['REDIRECT_URL'])
            ? $_SERVER['REDIRECT_URL']
            : false;
    }

    /**
     * Работа с $_GET массивом
     *
     * @param string|null $key
     * @param null $value
     *
     * @return mixed
     */
    public function get(string $key = null, $value = null)
    {
        return $this->workWithGlobals(
            $key, $value, $_GET
        );
    }

    /**
     * Работа с глобальным массивом
     *
     * @param string $key
     * @param $value
     * @param $global
     *
     * @return bool
     */
    private function workWithGlobals(string $key = null, $value = null, &$global)
    {
        /**
         * $request->get() // весь $_GET
         * $request->get('id') // $_GET['id']
         * $request->get('id', 10) // $_GET['id'] = 10
         */

        // если ключ запрошен
        if (!is_null($key)) {
            // если нужно только получить значение
            if (is_null($value)) {
                // возвращаем его при наличии или false
                return (isset($global[$key])) ? $global[$key] : false;
            } else {
                // иначе записываем новое значение
                $global[$key] = $value;
            }
        }

        // иначе отдаем весь глобальный массив
        return $global;
    }

    /**
     * Проверка соответствия GET запросу
     * @return bool
     */
    public function isGet()
    {
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }

    /**
     * Работа с $_POST массивом
     *
     * @param string|null $key
     * @param null $value
     *
     * @return bool|array
     */
    public function post(string $key = null, $value = null)
    {
        return $this->workWithGlobals(
            $key, $value, $_POST
        );
    }

    /**
     * Проверка соответствия POST запросу
     * @return bool
     */
    public function isPost()
    {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    /**
     * Проверка соответствия AJAX запросу
     * @return bool
     */
    public function isAjax()
    {
        $flag = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
            ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
            : 'normal';

        return ($flag == 'xmlhttprequest');
    }

    /**
     * Работа с $_SESSION массивом
     *
     * @param string|null $key
     * @param null $value
     *
     * @return bool
     */
    public function session(string $key = null, $value = null)
    {
        return $this->workWithGlobals(
            $key, $value, $_SESSION
        );
    }

    /**
     * Работа с $_COOKIE массивом
     *
     * @param string|null $key
     * @param null $value
     *
     * @return bool
     */
    public function cookie(string $key = null, $value = null)
    {
        if (!is_null($key)) {
            if (is_null($value)) {
                return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : false;
            } else {
                setcookie(
                    $key,
                    $value,
                    strtotime('+30 days'),
                    '/',
                    $_SERVER['HTTP_HOST'],
                    true,
                    true
                );
            }
        }

        return $_COOKIE;
    }

    /**
     * Перенаправление пользователя на другой маршрут (адрес)
     *
     * @param string $url
     * @param bool $isAbsolute
     */
    public function redirect(string $url, bool $isAbsolute = false)
    {
        // если был передан аргумент адреса
        if (!is_null($url)) {
            if (!$isAbsolute) {
                // добавляем / в начале адреса если не был передан
                $redirect = ($url[0] == '/') ? $url : "/{$url}";
            } else {
                $redirect = $url;
            }
        } else {
            // иначе просто редирект на текущий сайт
            $redirect = "//" . $_SERVER['HTTP_HOST'];
        }

        header('Location: ' . $redirect);
    }

    /**
     * Редирект на предыдущую страницу
     */
    public function goBack()
    {
        header('Location: ' . $this->_redirectedFrom);
    }

    /**
     * Получение текущего пути (без GET параметров)
     * @return string
     */
    protected function getPath()
    {
        /**
         * URI => /blog/article/view/10?type=guest
         * URI => /blog/article/view/10
         * URI => blog/article/view/10
         */

        $path = preg_replace("/\?(.*)$/", '', $_SERVER['REQUEST_URI']);

        return trim($path, '/');
    }
}