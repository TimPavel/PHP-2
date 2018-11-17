<?php
require_once ('product.php');

/**
 * Class WeightProduct
 *
 */
class WeightProduct extends Product
{
	private $weight;

	public function __construct($price, $quantity, $weight)
	{
		$this -> weight = $weight;
		return parent::__construct($price, $quantity);
	}


	public function getUltimatePrice()
	{
		return (parent::getUltimatePrice()) * $this->weight;
	}
}

$weightGood = new WeightProduct(31, 2, 10);
echo $weightGood -> getUltimatePrice();
