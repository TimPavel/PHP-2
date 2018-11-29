<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\models;

use core\base\ActiveRecord;

/**
 * Class Page
 * @package app\models
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $content
 */
class Page extends ActiveRecord
{

}