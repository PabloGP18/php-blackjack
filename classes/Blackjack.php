<?php

require './Player.php';

class Blackjack {

    private string $player;
    private string $dealer;
    private float $deck;

    public function __construct()
    {
        $this->player = new Player();
        $this->dealer = new Player();
    }

    /**
     * @return string
     */
    public function getPlayer(): string
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getDealer(): string
    {
        return $this->dealer;
    }

    /**
     * @return float
     */
    public function getDeck(): float
    {
        return $this->deck;
    }


}