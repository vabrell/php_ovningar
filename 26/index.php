<?php
$products = json_decode(file_get_contents('products.json'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Butik</title>

  <style>
    body {
      padding-left: 1rem;
      padding-right: 4rem;
    }
    .products {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 1rem;
      width: 100%;
      padding: 1.5rem;
    }

    .product {
      box-shadow: 0 0 8px 2px rgba(0, 0, 0, .3);
      border-radius: 5px;
    }

    .product > img {
      height: 250px;
      width: 100%;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }

    .product > .product-body {
      padding-left: 1rem;
      padding-bottom: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="products">
    <?php
      foreach($products AS $product) {
        $name = $product->name;
        $image = $product->image;
        $price = $product->price;
        $popularity = $product->popularity;

        echo <<<HTML
        <div class="product">
          <img src="$image" alt="$name">
          <div class="product-body">
            <h3>$name</h3>
            <p><strong>Pris:</strong> $price kr</p>
            <p><strong>Popularitet:</strong> $popularity</p>
          </div>
        </div>
HTML;
      }
    ?>
  </div>
</body>
</html>