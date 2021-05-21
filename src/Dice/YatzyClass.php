<?php

declare(strict_types=1);

namespace hajh20\Dice;

use hajh20\Dice\Dice;
use hajh20\Dice\Bonus;
use hajh20\Dice\Message;
use hajh20\Dice\SumUp;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url,
    destroySession
};

/**
 * Class YatzyClass
 */
class YatzyClass
{
    public function playYatzy(): void
    {
        $data = [
            "message" => "Välj vilka tärningar du vill behålla, kasta därefter tärningarna igen.",
            "yatzyaction" => url("/yatzy/process"),
            "dice1" => $_SESSION["dice1"] ?? null,
            "dice2" => $_SESSION["dice2"] ?? null,
            "dice3" => $_SESSION["dice3"] ?? null,
            "dice4" => $_SESSION["dice4"] ?? null,
            "dice5" => $_SESSION["dice5"] ?? null,
            "countY" => $_SESSION["counterYatzy"] ?? 0,
            "sum3" => $_SESSION["sum3"] ?? 0,
            "sum6" => $_SESSION["sum6"] ?? 0,
            "sum9" => $_SESSION["sum9"] ?? 0,
            "sum12" => $_SESSION["sum12"] ?? 0,
            "sum15" => $_SESSION["sum15"] ?? 0,
            "sum18" => $_SESSION["sum18"] ?? 0,
            "totSumYatzy" => null ?? 0,
        ];

        // Rulla fem tärningar
        $data["class"] = "";
        $die = new Dice();
        for ($i = 0; $i < 5; $i++) {
            $die->roll();
            $data["class"] .= $die->getLastRoll();
        }

        // Fixa meddelande på knapp
        $mess = new Message();
        $data["diceMessage"] = $mess->diceMessageYatzy($data["countY"]);

        // Förbered för att summera tärningar
        $data["sumUp"] = [];
        for ($i = 1; $i < 6; $i++) {
            array_push($data["sumUp"], intval($data["dice" . $i]));
        };

        // Summera tärningar
        $sumYatzy = new SumUp();
        $data["sum" . $data["countY"]] = $sumYatzy->sumUpDices($data["countY"], $data["sumUp"]);

        // Nollställ tärningar
        if ($data["countY"] % 3 == 0) :
            for ($i = 0; $i < 5; $i++) {
                $data["dice" . ($i + 1)] = null;
            }
            if ($data["countY"] == "18") :
                $data["totSumYatzy"] = $data["sum3"] + $data["sum6"] + $data["sum9"] + $data["sum12"] + $data["sum15"] + $data["sum18"];
            endif;
        endif;

        // Kalkylera bonus
        $bonus = new Bonus();
        $data["bonusYatzy"] = $bonus->bonus($data["totSumYatzy"]);

        $data["countY"] += 1;
        $body = renderView("layout/yatzy.php", $data);
        sendResponse($body);
    }

}