<?php
class Product {
  public $name;
  public $image;
  public $price;

  public function __construct(String $name, String $image, Float $price) {
    $this->name = $name;
    $this->image = $image;
    $this->price = $price;
  }

  public function render() {
    return "<div><h1>$this->name</h1><img src='$this->image' alt='$this->name'><p>$this->price kr</p>";
  }
}

class Food extends Product {
  private $expires;

  public function __construct(String $name, String $image, Float $price, DateTime $expires) {
    parent::__construct($name, $image, $price);
    $this->expires = $expires;
  }

  public function render() {
    $date = $this->expires->format('Y-m-d');
    return "<div><h1>$this->name</h1><img src='$this->image' alt='$this->name'><p>$this->price kr</p><p>$date</p>";
  }
}

class Movie extends Product {
  private $size;
  private $length;

  public function __construct(String $name, String $image, Float $price, Int $size, Int $length) {
    parent::__construct($name, $image, $price);
    $this->size = $size;
    $this->length = $length;
  }

  public function render() {
    return "<div><h1>$this->name</h1><img src='$this->image' alt='$this->name'><p>$this->price kr</p><p>$this->size kB</p><p>$this->length minuter</p>";
  }
}

$foodExpires = new DateTime();
$foodExpires->add(date_interval_create_from_date_string('10 days'));

$products = [
  new Food('Mjök', 'https://cdn.pixabay.com/photo/2019/10/22/07/45/milk-carton-4567937_960_720.png', 12.50, $foodExpires),
  new Movie('Joker', 'https://m.media-amazon.com/images/M/MV5BNGVjNWI4ZGUtNzE0MS00YTJmLWE0ZDctN2ZiYTk2YmI3NTYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SY1000_CR0,0,674,1000_AL_.jpg', 199.99, 1500000, 122)
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produkt klass</title>
</head>
<body>
  <?php foreach ($products AS $product) {
    echo $product->render();
  } ?>
</body>
</html>