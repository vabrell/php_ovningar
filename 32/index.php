<?php

class Dog {
  /**
   * Public variables
   */
  public $color;
  public $name;
  private $age;

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

  /**
   * Get the age of the dog
   * 
   * @return {Int} Age of the dog
   */
  public function getAge() {
    return $this->age;
  }

  /**
   * Add one year to the dogs age
   * 
   * @return void
   */
  public function addOneYear() {
    $this->age++;
  }
}

$dog1 = new Dog('Gray', 'Grayhound', 12);
$dog2 = new Dog('Gold', 'Goldenretriver', 5);
$dog3 = new Dog('Brown', 'Dachshund', 8);
$dog3->addOneYear();

echo "<h2>", $dog1->name, "</h2>", "<p>Color: ", $dog1->color, "</p><p>Age: ", $dog1->getAge(), "</p>";

echo "<h2>", $dog2->name, "</h2>", "<p>Color: ", $dog2->color, "</p><p>Age: ", $dog2->getAge(), "</p>";

echo "<h2>", $dog3->name, "</h2>", "<p>Color: ", $dog3->color, "</p><p>Age: ", $dog3->getAge(), "</p>";