<?php
/**
 * Created by PhpStorm.
 * User: TPN
 * Date: 30.11.2018
 * Time: 10:15
 */


namespace tests;

use PHPUnit\Framework\TestCase;
use core\services\Convert;

class ConvertTest extends TestCase
{
	public function testClearString()
	{
		$this->assertEquals(
			'Artut145',
			Convert::clearString('Artut$$1-*4@5'),
			'not test'
		);
	}

}
