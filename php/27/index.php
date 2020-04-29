<?php
session_start();

function createDeck() {
  $suits = ['HEARTS', 'DIAMONDS', 'CLUBS', 'SPADES'];
  $deck = [];

  foreach( $suits AS $suit ) {
    for( $i = 1; $i <= 13; $i++) {
      switch($i) {
        case 1:
          $name = 'Ace';
          $value = 11;
        break;

        case 11:
          $name = 'Jack';
          $value = 10;
        break;

        case 12:
          $name = 'Queen';
          $value = 10;
        break;

        case 13:
          $name = 'King';
          $value = 10;
        break;

        default:
          $name = $i;
          $value = $i;
      }
      array_push($deck, [
        'suit' => $suit,
        'name' => $name,
        'value' => $value
      ]);
    }
  }

  $_SESSION['deck'] = $deck;
}

function drawCard($player) {
  $_SESSION["players"][$player]["hand"][] = array_pop($_SESSION['deck']);
}

function calculateScore($player) {
  $hand = $_SESSION["players"][$player]["hand"];

  $totalValue = array_sum(array_map(function($card) {
    return $card["value"];
  }, $hand));

  $totalAces = count(array_filter($hand, function($card) {
    return $card["name"] === "Ace";
  }));

  if ($totalAces > 0 && $totalValue > 21) {
    for ($i = 0; $i < $totalAces; $i++) {
      $totalValue -= 10;
      if ($totalValue <= 21) {
        break;
      }
    }
  }

  $_SESSION["players"][$player]["score"] = $totalValue;
}

function startGame($player) {
  // Create a new deck
  createDeck();

  // Shuffle the deck
  shuffle($_SESSION['deck']);

  // Create player and dealer
  $_SESSION['players'] = [
    "player" => [
      "name" => $player,
      "hand" => [],
      "score" => 0
    ],
    "dealer" => [
      "name" => "Dealer",
      "hand" => [],
      "score" => 0
    ]
  ];

  // Draw two cards for the player
  drawCard("player");
  drawCard("player");

  // Calculate the score
  calculateScore("player");
}

function dealersTurn() {
  // Draw two cards
  drawCard("dealer");
  drawCard("dealer");

  // Calculate the score
  calculateScore("dealer");

  do {
    // Draw card
    drawCard("dealer");

    // Calculate the score
    calculateScore("dealer");
  } while ($_SESSION["players"]["dealer"]["score"] < 17);

  endGame();
}

function cardsToDisplay($player) {
  // Return array of cards
  return array_map(function($card) {
    $name = $card['name'];
    $suit = $card['suit'];
    return "$name of $suit";
  }, $_SESSION["players"][$player]["hand"]);

}

function endGame() {
  $playerScore = $_SESSION["players"]["player"]["score"];
  $dealerScore = $_SESSION["players"]["dealer"]["score"];

  // If the player busts
  if ($playerScore > 21) {
    $_SESSION['message'] = 'You bust!';
  }

  // If the player won
  else if (($playerScore === 21
        && $dealerScore <> 21)
      || ($playerScore > $dealerScore
          && $playerScore < 21)) {
            $_SESSION['message'] = 'You win!';
  }

  // If the dealer won
  else if ($dealerScore === 21
      || ($dealerScore > $playerScore
          && $dealerScore <= 21)) {
            $_SESSION['message'] = 'Dealer wins!';
  }

  header('Location: ./');
}

if (isset($_POST['start'])) {
  startGame($_POST['name']);
}

if (isset($_POST['hit'])) {
  // Draw another card
  drawCard("player");

  // Calculate the score
  calculateScore("player");

  if ($_SESSION["players"]["player"]["score"] > 21) {
    endGame();
  }
}

if (isset($_POST['stand'])) {
  dealersTurn();
}

if (isset($_POST['restart'])) {
  session_destroy();
  header('Location: ./');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blackjack</title>
</head>
<body>
  <h1>Blackjack</h1>
  <?php if (!empty($_SESSION['message'])) { ?>
    <h2><?php echo $_SESSION['message'] ?></h2>
    <form method="post">
      <input type="submit" name="restart" value="Restart game">
    </form>
  <?php } ?>
  <?php if (empty($_SESSION['deck'])) { ?>
    <form method="post">
      <input type="text" name="name" placeholder="Ditt namn">
      <input type="submit" name="start" value="Starta spelet">
    </form>
  <?php } else { ?>

    <div style="display: grid; grid-template-columns: 1fr 1fr; width:100%; padding: 1rem;">
      <div>
        <h3><?php echo $_SESSION["players"]["player"]["name"] ?></h3>
        <p><strong>Poäng:</strong> <?php echo $_SESSION["players"]["player"]["score"] ?></p>
        <p>
          <strong>Kort</strong><br>
          <?php echo implode('<br>', cardsToDisplay("player")) ?>
        </p>

        <?php if (empty($_SESSION['message'])) { ?>
        <form method="post">
          <input type="submit" name="hit" value="Hit">
          <input type="submit" name="stand" value="Stand">
        </form>
        <?php } ?>
      </div>

      <div>
        <h3><?php echo $_SESSION["players"]["dealer"]["name"] ?></h3>
        <p><strong>Poäng:</strong> <?php echo $_SESSION["players"]["dealer"]["score"] ?></p>
        <p>
          <strong>Kort</strong><br>
          <?php echo implode('<br>', cardsToDisplay("dealer")) ?>
        </p>
      </div>
    </div>
  
  <?php } ?>

</body>
</html>