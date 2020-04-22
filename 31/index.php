<?php

class Dog {
  /**
   * Public variables
   */
  public $color;
  public $name;
  public $age;

  /**
   * Construct the Dog
   * 
   * @param {String} $color The color of the dog
   * @param {String} $name The name of the dog
   * @param {Int} $age The age of the dog
   */
  public function __construct(String $color, String $name, Int $age) {
    $this->color = $color;
    $this->name = $name;
    $this->age = $age;
  }
}

$dog1 = new Dog('Gray', 'Grayhound', 12);
$dog2 = new Dog('Gold', 'Goldenretriver', 5);
$dog3 = new Dog('Brown', 'Dachshund', 8);

echo "<h2>", $dog1->name, "</h2>", "<p>Color: ", $dog1->color, "</p><p>Age: ", $dog1->age, "</p>";

echo "<h2>", $dog2->name, "</h2>", "<p>Color: ", $dog2->color, "</p><p>Age: ", $dog2->age, "</p>";

echo "<h2>", $dog3->name, "</h2>", "<p>Color: ", $dog3->color, "</p><p>Age: ", $dog3->age, "</p>";