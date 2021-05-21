<?php

declare(strict_types=1);

namespace hajh20\Dice;

/**
 * Class SumUp
 */
class SumUp
{
    public function sumUpDices($counter, $dices): int
    {
        $sum = 0;

        for ($i = 0; $i < 5; $i++) {
            if ($dices[$i] == ($counter/3)) :
                $sum += $dices[$i];
            endif;
        };
        return $sum;

    }
}
