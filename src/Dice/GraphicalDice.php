<?php

declare(strict_types=1);

namespace hajh20\Dice;

/**
 * Class GraphicalDice
 */
class GraphicalDice extends DiceHand
{
    /**
     * @var integer SIDES Number of sides of the Dice.
     */
    const SIDES = 6;

    /**
     * Constructor to initiate the dice with six number of sides.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function graphic()
    {
        return $this->getLastRoll();
    }
}
