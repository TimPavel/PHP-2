<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\models;

use core\base\ActiveRecord;
use core\services\validators\LoginValidator;
use core\services\validators\NumberValidator;
/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $last_access
 * @property string $username
 */
class User extends ActiveRecord
{
	protected function validationRules()
	{
		return [
			'id' => NumberValidator::class,
			'login' => LoginValidator::class,
		];
	}
}