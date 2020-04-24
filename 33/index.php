<?php
$products = [
  [
    "name" => "Tröja",
    "image" => "https =>//cdn.pixabay.com/photo/2016/03/16/21/43/t-shirt-1261820_960_720.png",
    "price" => 125
  ],
  [
    "name" => "Jeans",
    "image" => "https =>//cdn.pixabay.com/photo/2015/09/05/21/57/girl-925635_960_720.jpg",
    "price" => 565
  ],
  [
    "name" => "Munktröja",
    "image" => "https =>//cdn.pixabay.com/photo/2017/09/19/19/16/angry-2766265_960_720.jpg",
    "price" => 375
  ]
];

class Product {
  private $name;
  private $image;
  private $price;

  /**
   * Construct a product
   * 
   * @param {String} $name The name of the product
   * @param {String} $image A link to the product image
   * @param {Float} $price The price of the product
   */
  public function __construct(String $name, String $image, Float $price) {
    $this->name = $name;
    $this->image = $image;
    $this->price = $price;
  }

  /**
   * Render a HTML element of the product
   */
  public function render() {
    return "<div><h1>$this->name</h1><img src='$this->image' alt='$this->name'><p>$this->price kr</p>";
  }
}

$products = array_map(function($product) {
  return new Product($product['name'], $product['image'], $product['price']);
}, $products);

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