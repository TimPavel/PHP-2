<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 01.12.2018
 * Time: 11:15
 */

namespace app\models;
use core\base\ActiveRecord;

class Categories extends ActiveRecord
{
	protected static function tableName()
	{

		return 'shop_category';
	}
}