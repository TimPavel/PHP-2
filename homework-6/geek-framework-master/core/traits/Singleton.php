<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\traits;

/**
 * Singleton для повторного использования в других компонентах
 *
 * @package core\traits
 */
trait Singleton
{

    private static $_instance;

    private function __construct()
    {
        // proxy block
    }

    /**
     * Возвращает всегда активный объект класса
     * @return static
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone()
    {
        // proxy block
    }

    private function __wakeup()
    {
        // proxy block
    }

}