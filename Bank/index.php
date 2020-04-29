<?php
session_start();

require_once('Bank.php');

if (!isset($_SESSION['saldo'])) {
  $bank = new Bank(3000);
  $_SESSION['saldo'] = $bank->getSaldo();
} else {
  $bank = new Bank($_SESSION['saldo']);
}

if (isset($_POST['d-submit'])) {
  $bank->deposit($_POST['deposit']);
  $_SESSION['saldo'] = $bank->getSaldo();
}

if (isset($_POST['w-submit'])) {
  $bank->withdraw($_POST['withdraw']);
  $_SESSION['saldo'] = $bank->getSaldo();
}

$exchangeRates = Bank::getExchangeRates();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank</title>
  <style>
    input[type=number] {
      padding: .5rem 1rem;
      border: none;
      border-bottom: 1px solid lightblue;
      border-radius: 5px;
      margin: 1rem 0 .5rem 0;
    }

    input[type=number]:focus {
      background-color: lightblue;
    }

    input[type=submit] {
      border: none;
      margin-bottom: .5rem;
      padding: .5rem 1rem;
      background-color: lightblue;
      color: darkcyan;
      border-radius: 10px;
      font-weight: bold;
    }

    input[type=submit]:hover {
      background-color: darkcyan;
      color: lightblue;
    }
  </style>
</head>
<body>
  <div>
    <h2>Bank konto</h2>
    <p><strong>Saldo:</strong> <?php echo $bank->getSaldo() ?></p>
  </div>
  <form method="post">
    <div>
      <label for="deposit">Insättning</label>
      <br>
      <input type="number" min="0" name="deposit" id="deposit">
      <br>
      <input type="submit" name="d-submit" value="Sätt in">
    </div>
  </form>

  <form method="post">
    <div>
      <label for="withdraw">Uttag</label>
      <br>
      <input type="number" min="0" name="withdraw" id="withdraw">
      <br>
      <input type="submit" name="w-submit" value="Ta ut">
    </div>
  </form>

  <div>
    <h2>Valutakurs</h2>
    <?php
      foreach ($exchangeRates AS $currency => $rate) {
        echo "<p>$currency: $rate</p>";
      }
    ?>
  </div>
</body>
</html>