<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\models;

use core\base\ActiveRecord;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $last_access
 * @property string $username
 */
class User extends ActiveRecord
{

}