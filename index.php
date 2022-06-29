<?php
    require 'classes/Blackjack.php';
    require 'classes/Deck.php';
    require 'classes/Player.php';
    require 'classes/Suit.php';
    require 'classes/Card.php';

    // starting php session
    session_start();

    // if empty session "blackjack"
    if(!isset($_SESSION["Blackjack"]))
    {
        //instantiate new object blackjack
        //echo "variable blackjack not found, creating new object";
        $blackjack = new Blackjack();
        //put the blackjack in the session
        $_SESSION["Blackjack"] = $blackjack;
    }
    else if(isset($_SESSION["Blackjack"]))
    {
        //echo "variable blackjack using stored game information";
        $blackjack = $_SESSION["Blackjack"];
    }
$deck= $blackjack->getDeck();
$dealer=$blackjack->getDealer();
$player = $blackjack->getPlayer();
?>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
foreach($player->getCards() AS $card) {
    echo '<span style="font-size: 6rem">' . $card->getUnicodeCharacter(true) .'</span>'; echo '<br>';
}?>
<h3>Player</h3>

<?php
foreach($dealer->getCards() AS $card) {
    echo '<span style="font-size: 6rem">' . $card->getUnicodeCharacter(true) .'</span>'; echo '<br>';
}?>
<h3>Dealer</h3>

<?php
if($_POST["action"] === "hit" ) {

$player->hit($deck);

echo 'You: ' .$player->getScore() .'<br>';

echo 'Dealer: '.$dealer->getScore().'<br>'
;}
?>
<form action="index.php" method="post">
      <h3>What is your move?</h3>
    <input type="submit"  value="hit" name="action">
    <input type="submit"  value="stand" name="action">
    <input type="submit"  value="surrender" name="action">
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
