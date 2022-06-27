<?php

require './Player.php';

class Blackjack {

    private Player $player;
    private Player $dealer;
    private Deck $deck;

    public function __construct()
    {
        $this->player = new Player($this->deck);
        $this->dealer = new Player($this->deck);

        $this->deck = new Deck();

        $this->deck -> shuffle();
    }

    /**
     * @return string
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getDealer(): Player
    {
        return $this->dealer;
    }

    /**
     * @return float
     */
    public function getDeck(): Deck
    {
        return $this->deck;
    }


}
