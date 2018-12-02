<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 30.11.2018
 * Time: 10:41
 */

namespace core\interfaces;

interface Validated
{
	public static function check($value) : bool;



}