<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 30.11.2018
 * Time: 20:11
 */

namespace core\services\validators;

use core\interfaces\Validated;

class LoginValidator implements Validated
{
	public static function check($value): bool
	{
		return (mb_strlen($value) >= 8);
	}
}