<?php

declare(strict_types=1);

// Require all the files with the classes
require './classes/Blackjack.php';
require './classes/Card.php';
require './classes/Deck.php';
require './classes/Player.php';
require './classes/Suit.php';

// SET THE GAME

/*If you don't write this line can't use $_Session global variable*/
session_start();

// Create a new `Blackjack` object.
// Put the `Blackjack` object in the session
// Initializing a session variable
//$blackjack = new Blackjack();
//$_SESSION['blackjack'] = $blackjack;
//echo $_SESSION['blackjack'];

if (!isset($_SESSION['blackjack'])){
    $_SESSION['blackjack'] = new Blackjack();
}

$blackJack = $_SESSION['blackjack'];

$player = $blackJack->getPlayer();
$dealer = $blackJack->getDealer();
$deck = $blackJack->getDeck();

$message = "";

//Make those buttons work

if (isset($_POST['action'])) {

    // HIT BUTTON
    if ($_POST['action'] === 'hit'){
        $player->hit($deck);
        if ($player->hasLost()){
            $message = '<div class="alert alert-danger" role="alert">You lose! Reset to try again!</div>';
        }
    }

    // STAND BUTTON
    elseif ($_POST['action'] === 'stand'){
        $dealer->hit($deck);
        // if dealer doesn't loose
        if (!$dealer->hasLost()) {
            if ($player->getScore() < $dealer->getScore()) {
                $message = '<div class="alert alert-danger" role="alert">The dealer wins! Reset for payback!</div>';
            } elseif ($player->getScore() == $dealer->getScore()) {
                $message = '<div class="alert alert-danger" role="alert">It is a tie! Too bad the House wins! Press reset to try again!</div>';
            } else {
                $message = '<div class="alert alert-success" role="alert">You are the winner! Reset the cards for another round!</div>';
            }
        } else {
            $message = '<div class="alert alert-success" role="alert">You are the winner! Reset the cards for another round!</div>';
        }
        $display= 'display: none;"';
    }

    // SURRENDER BUTTON
    elseif ($_POST['action'] === 'surrender'){
        $message = '<div class="alert alert-danger" role="alert">You surrendered! Sometimes it is the better option. Please reset the cards.</div>';
        $display1= 'display: none;"';
        $display2= 'display: none;"';
    }

    // RESET GAME
    elseif ($_POST['action'] === 'reset'){
        //Unset Session
        unset($_SESSION['blackjack']);
        $_SESSION['blackjack'] = new Blackjack();

        $blackJack = $_SESSION['blackjack'];

        $player = $blackJack->getPlayer();
        $dealer = $blackJack->getDealer();
        $deck = $blackJack->getDeck();

    }
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Blackjack the PHP OOP way</title>
</head>
<body>
<div class="container px-4">

    <div class="row">
        <p><?php echo $message ?></p>
    </div>

    <div class="row gx-5">
        <!-- PLAYER -->
        <div class="col" style="display: flex; flex-direction: column; align-items: center">
            <div>
            <h2>PLAYER</h2>
            <h5>Total: <?php echo $player->getScore()?></h5>
            </div>
            <div>
            <?php
            foreach($player->getCards() AS $card) {
                echo '<span style="font-size: 11rem">' . $card->getUnicodeCharacter(true) . '</span>';
            }
            ?>
            </div>
        </div>

        <!-- DEALER -->
        <div class="col" style="display: flex; flex-direction: column; align-items: center">
            <div>
            <h2>DEALER</h2>
            <h5>Total: <?php echo $dealer->getScore()?></h5>
            </div>
            <div>
            <?php

            foreach($dealer->getCards() AS $card) {
                echo '<span style="font-size: 11rem">' . $card->getUnicodeCharacter(true) . '</span>';
            }
            ?>
            </div>
        </div>
    </div>

    <form method="post" style="display: flex; flex-direction: column; margin-block: 75px;">
        <h2 style="align-self: center">What is your next move?</h2>
        <div style="align-self: center">
        <button style="width: 100px; <?php echo $display;?>; <?php echo $display1;?>" type="submit" name="action" value="hit" class="btn btn-outline-success">Hit</button>
        <button style="width: 100px; <?php echo $display2;?>" type="submit" name="action" value="stand" class="btn btn-outline-success">Stand</button>
        <button style="width: 100px;"type="submit" name="action" value="surrender" class="btn btn-outline-danger">Surrender</button>
        <button style="width: 100px;"type="submit" name="action" value="reset" class="btn btn-outline-dark">Reset</button>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>