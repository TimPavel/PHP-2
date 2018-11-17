<?php

require_once ('product.php');

class PhysicalProduct extends Product
{


}

$good = new PhysicalProduct(21, 2);
print_r($good -> getUltimatePrice());