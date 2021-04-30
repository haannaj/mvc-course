<?php

declare(strict_types=1);

namespace hajh20\Dice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class DiceHand.
 */

class DiceHand
{
    private array $dices;
    private int $sum;
    private $hand = 6;

    public function __construct()
    {
        for ($i = 0; $i <= ($this->hand) - 1; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function getLength(): int
    {
        return $this->hand;
    }

    public function setLength(int $hand)
    {
        $this->hand = $hand;
    }

    public function roll(): void
    {
        $len = count($this->dices);

        $this->sum = 0;
        for ($i = 0; $i <= ($this->hand) - 1; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): string
    {
        $res = "";
        for ($i = 0; $i <= ($this->hand) - 1; $i++) {
            $res .= $this->dices[$i]->getLastRoll();
        }
        return $res;
    }
}
