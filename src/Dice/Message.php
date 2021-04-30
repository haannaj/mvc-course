<?php

declare(strict_types=1);

namespace hajh20\Dice;

/**
 * Class Message
 */
class Message
{
    private int $totSum = 0;
    private $counter = 0;

    public function getGameOver21Message(int $totSum): string
    {
        if ($totSum > 21) :
            return "Game Over";
        elseif ($totSum == 21) :
            return "Congratulations, you got 21!";
        else :
            return"";
        endif;
    }

    public function diceMessageYatzy($counter): string
    {
        if ($counter == "2") :
            return "Summera ettorna och kasta för tvåorna";
        elseif ($counter == "5") :
            return "Summera tvåorna och kasta för treorna";
        elseif ($counter == "8") :
            return "Summera treorna och kasta för fyrorna";
        elseif ($counter == "11") :
            return "Summera fyrorna och kasta för femmorna";
        elseif ($counter == "14") :
            return "Summera femmorna och kasta för sexorna";
        elseif ($counter == "17") :
            return "Summera sexorna";
        else :
            return "Kasta tärningarna";
        endif;
    }
}