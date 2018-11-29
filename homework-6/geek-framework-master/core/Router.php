<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core;

use core\base\BaseObject;

/**
 * Router предназначен для автоматизации
 * маршрутизации приложения по указанным правилам
 *
 * @package core
 *
 * @property-read string $controller
 * @property-read string $action
 */
class Router extends BaseObject
{
    public $route = [];
    public $params = [];

    private $_rules;

    /**
     * Инициализация роутера по текущему маршруту
     *
     * @param string $path
     * @param array $rules
     */
    public function __construct(string $path, array $rules)
    {
        $this->_rules = $rules;
        $this->handle($path);
    }

    /**
     * Запуск обработки валидации правил и подготовки аргументов запроса
     *
     * @param string $path
     */
    public function handle(string $path)
    {
        // если корневой маршрут, ставим /
        if ($path == '') $path = '/';

        // перебираем все правила маршрутизации до нахождения совпадения
        foreach ($this->_rules as $rule => $route) {
            // меняем в правиле placeholder'ы на паттерны поиска
            $pattern = preg_replace("/{[\w]+}/", "([\w]+)", $rule);
            $pattern = "~^" . $pattern . "$~";

            // если найдено точное совпадение
            if (preg_match($pattern, $path)) {
                // получаем из маршрута название аргументов
                $params = $this->getParamsFromRule($rule);
                // также извлекаем значения аргументов
                $values = $this->getValuesFromPath($path, $pattern);

                // сохраняем найденный маршрут к контроллеру
                $this->route = $route;
                // сохраняем найденные аргументы
                $this->params = $values;

                // записываем в GET массив аргументы в виде пар "ключ-значение"
                $_GET = array_merge(
                    array_combine($params, $values),
                    $_GET
                );

                // останавливаем цикл, чтобы не перезаписать правила
                break;
            }
        }
    }

    /**
     * Извлекакет названия параметров из переданного маршрута (например {id} -> id)
     *
     * @param string $path
     *
     * @return array
     */
    private function getParamsFromRule(string $path)
    {
        $matches = [];
        $params = [];

        preg_match_all("/{[\w]+}/", $path, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $params[] = preg_replace("/[\W]+/", '', $match[0]);
        }

        return $params;
    }

    /**
     * Извлекает значения аргументов по указанному регулярному выражению
     *
     * @param string $path
     * @param string $pattern
     *
     * @return array
     */
    private function getValuesFromPath(string $path, string $pattern)
    {
        $matches = [];
        $values = [];

        preg_match_all($pattern, $path, $matches, PREG_SET_ORDER);
        unset($matches[0][0]);

        foreach ($matches[0] as $match) {
            $values[] = $match;
        }

        return $values;
    }

    /**
     * Найденный контроллер по маршруту
     * @return bool|mixed
     */
    public function getController()
    {
        return ($this->route[0]) ? $this->route[0] : false;
    }

    /**
     * Найденное действие контроллера по маршруту
     * @return bool|mixed
     */
    public function getAction()
    {
        return ($this->route[1]) ? $this->route[1] : false;
    }
}