<?php

declare(strict_types=1);

namespace hajh20\Dice;

/**
 * Class Bonus
 */
class Bonus
{
    private int $totSum = 0;

    public function bonus(int $totSum): int
    {
        if (63 <= $totSum) :
            return 50;
        else :
            return 0;
        endif;
    }

}
