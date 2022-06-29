<?php


class Player {

    private array $cards;
    private bool $lost = false;
    //private int $blackjack = 21;
    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
    }

    public function hit(Deck $deck): void
    {
        $this->cards[] = $deck->drawCard();

        if($this->getScore() > 21){
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
        if($this->getScore()<15){
            parent::hit($deck);
        }
    }
}
