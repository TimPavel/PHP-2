<?php

require_once ('product.php');

class PhysicalProduct extends Product
{
	private $price;
	private $quantity;

	public function __construct($price, $quantity)
	{
		$this ->price = $price;
		$this ->quantity = $quantity;
	}

	public function getUltimatePrice() {
		return $this -> price * $this -> quantity;
	}
}

$good = new PhysicalProduct(21, 2);
print_r($good -> getUltimatePrice());