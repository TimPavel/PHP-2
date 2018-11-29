<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 29.11.2018
 * Time: 14:09
 */

namespace app\models;

use core\base\ActiveRecord;

class Catalog extends ActiveRecord
{

	protected static function tableName()
	{

		return 'shop_product';
	}
}