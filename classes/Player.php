<?php


class Player {

    private array $cards;
    private bool $lost = false;
    private int $blackjack = 21;
    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
    }

    private function hit(Deck $deck): void
    {
        $this->cards[] = $deck->drawCard();

        if($this->getScore() > $this->blackjack){
            $this->lost= true;
        }
    }
    private function surrender(): bool
    {
        return $this->lost = true;
    }
    private function getScore(): int
    {
        $score=0;
        foreach ($this->cards as $card){
                $score+= $card->getValue();
        }
        return $score;
    }
    private function hasLost(): bool
    {
       return $this->lost;
    }
}