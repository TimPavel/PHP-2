<?php
require_once ('product.php');

/**
 * Class WeightProduct
 *
 */
class WeightProduct extends Product
{
	private $price;
	private $quantity;
	private $weight;

	public function __construct($price, $quantity, $weight)
	{
		$this ->price = $price;
		$this ->quantity = $quantity;
		$this -> weight = $weight;
	}

	public function getUltimatePrice() {
		return $this -> price * $this -> quantity * $this -> weight;
	}
}

$weightGood = new WeightProduct(31, 1, 10);
echo $weightGood -> getUltimatePrice();
