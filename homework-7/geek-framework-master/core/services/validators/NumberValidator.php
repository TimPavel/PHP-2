<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 30.11.2018
 * Time: 19:42
 */

namespace core\services\validators;

use core\interfaces\Validated;

class NumberValidator implements Validated
{

	public static function check($value): bool
	{
		if (is_integer($value) || is_float($value)) {
			return true;
		} elseif (intval($value) > 0 || floatval($value) > 0) {
			return true;
		}
		return false;
	}
}