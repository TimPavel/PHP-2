<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 30.11.2018
 * Time: 19:45
 */
namespace tests;

use PHPUnit\Framework\TestCase;
use core\services\validators\NumberValidator;

class NumberValidatorTest extends TestCase
{

	public function numbersArray()
	{
		return [
			[4], ['10,5'], [15]
		];
	}

	/**
	 * @dataProvider numbersArray
	 */
	public function testCheck($number)
	{
		$this->assertTrue(
			NumberValidator::check($number)
		);
	}
}
