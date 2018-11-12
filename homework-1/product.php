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
  
  // 5. Дан код:
  // Что он выведет на каждом шаге? Почему?
  class A {
      public function foo() {
          static $x = 0;
          echo ++$x;
      }
  }
  $a1 = new A();
  $a2 = new A();
  $a1->foo(); // 1
  $a2->foo(); // 2
  $a1->foo(); // 3
  $a2->foo(); // 4
//  так как переменная х установлена как static то присваивание 0 произойдет только один раз, при первом вызове функции foo
// и при каждом ее вызове произойдет увеличение "х" на единицу и это значение сохранится при завершении функции.
// и также так как класс один, метод тоже один для всех объектов


//  6. Объясните результаты в этом случае.
  class B {
    public function foo() {
      static $x = 0;
      echo ++$x;
    }
  }
  class C extends B {
  }
  $a1 = new B();
  $b1 = new C();
  $a1->foo();  // 1
  $b1->foo();  // 1
  $a1->foo();  // 2
  $b1->foo();  // 2

// в отличие от пятого задание здесь происходит наследование класса и создается новый метод foo и соотвестственно
  //  вызываться будут два разных метода, с разными значениями "x"

