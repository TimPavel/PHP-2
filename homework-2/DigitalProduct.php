<?php

require_once ('product.php');

class DigitalProduct extends Product
{

	public function __construct($price, $quantity)
	{
		return parent::__construct($price / 2, $quantity);
	}


}

$digitalGood = new DigitalProduct(34, 5);
echo $digitalGood -> getUltimatePrice();