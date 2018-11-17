<?php

require_once ('product.php');

class DigitalProduct extends Product
{
	private $price;
	private $quantity;

	public function __construct($price, $quantity)
	{
		$this ->price = $price;
		$this ->quantity = $quantity;
	}

	public function getUltimatePrice() {
		return ($this -> price / 2) * $this -> quantity;
	}
}

$digitalGood = new DigitalProduct(34, 5);
echo $digitalGood -> getUltimatePrice();