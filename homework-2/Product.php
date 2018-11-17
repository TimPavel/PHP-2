<?php



abstract class Product
{
	private $price;
	private $quantity;

	public function __construct($price, $quantity)
	{
		$this -> price = $price;
		$this -> quantity = $quantity;
	}

	public function getUltimatePrice() {
		return $this -> price * $this -> quantity;
	}

}