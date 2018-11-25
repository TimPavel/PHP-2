<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\base;

/**
 * Класс базового объекта для наследования, содержащий магические методы
 *
 * @package core\base
 */
abstract class BaseObject
{
    /**
     * Магический метод геттер
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        // конвертируем имя атрибута name в название метода getName
        $method = "get" . ucfirst($name);

        // возвращаем результат выполнения метода
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
    }

    /**
     * Магический метод сеттер
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function __set($name, $value)
    {
        // конвертируем имя атрибута name в название метода setName
        $method = "set" . ucfirst($name);

        // вызываем метод и передаем туда аргумент $value
        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        } else {
            // установка значения как обычного свойства
            $this->{$name} = $value;
        }
    }
}