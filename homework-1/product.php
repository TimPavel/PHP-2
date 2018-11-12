<?php
  
    class Product
  {
    public $id;
    public $vendorCode;
    public $name;
    public $description;
    public $price;
    public $imagePath;
    public $madeIn;
    public $discount;
    
    public function countTotalPrice() {
      return $this -> price - $this -> price * ($this -> discount / 100);
    }
    
    public function showCountryManufactured() {
      return $this -> madeIn;
    }
  }
  
  class Electronics extends Product
  {
    public $model;
    public $inputPower;
    public $voltage;
  }
  
  class Books extends Product
  {
    public $author;
    public $publishingHouse;
  }
  