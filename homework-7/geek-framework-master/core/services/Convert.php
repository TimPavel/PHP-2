<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\services;

/**
 * Класс для упрощения конвертации и форматирования данных
 *
 * @package core\services
 */
class Convert
{
	public static function clearString($value)
	{
		$pattern = "/[^\w\d\s_]+/";
		$out = preg_replace($pattern, '', $value);
		return $out;
	}

	public static function errorMessage()
	{

	}
}

