<?php


class Player {

    private array $cards;
    private bool $lost = false;
    //private int $blackjack = 21;
    public function __construct(Deck $deck)
    {

        for ($i=0; $i < 2; $i++){
            $this->cards[$i] = $deck->drawCard();
        }
    }

    public function hit(Deck $deck): void
    {
        $this->cards[] = $deck->drawCard();

        if($this->getScore($this->cards) > 21){
            $this->lost= true;
        }
    }
    public function surrender(): bool
    {
        return $this->lost = true;
    }
    public function getScore(): int
    {
        $score=0;
        foreach ($this->cards as $card){
                $score+= $card->getValue();
        }
        return $score;
    }
    public function hasLost(): bool
    {
       return $this->lost;
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}
class Dealer extends Player{

    public function hit(Deck $deck): void
    {
        if($this->getScore()<=15){
            parent::hit($deck);
        }
    }
}
