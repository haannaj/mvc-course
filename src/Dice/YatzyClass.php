<?php

declare(strict_types=1);

namespace hajh20\Dice;

use hajh20\Dice\Dice;
use hajh20\Dice\Bonus;
use hajh20\Dice\Message;

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
        $sumYatzy = new YatzyClass();
        $data["sum" . $data["countY"]] = $sumYatzy->sumUpDices($data["countY"], $data["sumUp"]);

        // Nollställ tärningar
        if ($data["countY"] == "3" || $data["countY"] == "6" || $data["countY"] == "9" || $data["countY"] == "12" || $data["countY"] == "15") :
            for ($i = 0; $i < 5; $i++) {
                $data["dice" . ($i + 1)] = null;
            }
        elseif ($data["countY"] == "18") :
            for ($i = 0; $i < 5; $i++) {
                $data["dice" . ($i + 1)] = null;
            }
            $data["totSumYatzy"] = $data["sum3"] + $data["sum6"] + $data["sum9"] + $data["sum12"] + $data["sum15"] + $data["sum18"];
        endif;

        // Kalkylera bonus
        $bonus = new Bonus();
        $data["bonusYatzy"] = $bonus->bonus($data["totSumYatzy"]);

        $data["countY"] += 1;
        $body = renderView("layout/yatzy.php", $data);
        sendResponse($body);
    }

    private $counter = 0;
    private $sumUp = [];

    public function sumUpDices($counter, $sumUp): int
    {
        $sumEtt = 0;
        $sumTva = 0;
        $sumTre = 0;
        $sumFyra = 0;
        $sumFem = 0;
        $sumSex = 0;

        if ($counter == "3") :
            for ($i = 0; $i < 5; $i++) {
                if ($sumUp[$i] == 1) :
                    $sumEtt += $sumUp[$i];
                endif;
            };
            return $sumEtt;
        elseif ($counter == "6") :
            for ($i = 0; $i < 5; $i++) {
                if ($sumUp[$i] == 2) :
                    $sumTva += $sumUp[$i];
                endif;
            };
            return $sumTva;
        elseif ($counter == "9") :
            for ($i = 0; $i < 5; $i++) {
                if ($sumUp[$i] == 3) :
                    $sumTre += $sumUp[$i];
                endif;
            };
            return $sumTre;
        elseif ($counter == "12") :
            for ($i = 0; $i < 5; $i++) {
                if ($sumUp[$i] == 4) :
                    $sumFyra += $sumUp[$i];
                endif;
            };
            return $sumFyra;
        elseif ($counter == "15") :
            for ($i = 0; $i < 5; $i++) {
                if ($sumUp[$i] == 5) :
                    $sumFem += $sumUp[$i];
                endif;
            };
            return $sumFem;
        elseif ($counter == "18") :
            for ($i = 0; $i < 5; $i++) {
                if ($sumUp[$i] == 6) :
                    $sumSex += $sumUp[$i];
                endif;
            };
            return $sumSex;
        else :
            return 0;
        endif;
    }
}
