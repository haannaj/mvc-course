<?php

declare(strict_types=1);

namespace hajh20\Dice;

// use function Mos\Functions\{
//     redirectTo,
//     renderView,
//     sendResponse,
//     url
// };

/**
 * Class GraphicalDice
 */
class GraphicalDice
{
    private array $dices;
    private int $sum;
    const HAND = 6;

    public function __construct()
    {
        for ($i = 0; $i <= (self::HAND) - 1; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function roll(): void
    {
        $len = count($this->dices);

        $this->sum = 0;
        for ($i = 0; $i <= (self::HAND) - 1; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): string
    {
        $res = "";
        for ($i = 0; $i <= (self::HAND) - 1; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . " ";
        }
        return $res . " = " . $this->sum;
    }

    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
