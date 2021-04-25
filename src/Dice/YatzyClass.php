<?php

declare(strict_types=1);

namespace hajh20\Dice;

use hajh20\Dice\Dice;

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
            "header" => "Yatzy",
            "message" => "Välj vilka tärningar du vill behålla, kasta därefter tärningarna igen.",
            "diceMessage" => "Kasta tärningarna",
            "yatzyaction" => url("/yatzy/process"),
            "dice1" => $_SESSION["dice1"] ?? null,
            "dice2" => $_SESSION["dice2"] ?? null,
            "dice3" => $_SESSION["dice3"] ?? null,
            "dice4" => $_SESSION["dice4"] ?? null,
            "dice5" => $_SESSION["dice5"] ?? null,
            "counterYatzy" => $_SESSION["counterYatzy"] ?? 0,
            "sumEtt" => $_SESSION["sumEtt"] ?? 0,
            "sumTva" => $_SESSION["sumTva"] ?? 0,
            "sumTre" => $_SESSION["sumTre"] ?? 0,
            "sumFyra" => $_SESSION["sumFyra"] ?? 0,
            "sumFem" => $_SESSION["sumFem"] ?? 0,
            "sumSex" => $_SESSION["sumSex"] ?? 0,
        ];

        // Rulla fem tärningar
        $data["class"] = "";
        $die = new Dice();
        for ($i = 0; $i < 5; $i++) {
            $die->roll();
            $data["class"] .= $die->getLastRoll();
        }

        $data["sumUp"] = [];
        for ($i = 1; $i < 6; $i++) {
            array_push($data["sumUp"], intval($data["dice" . $i]));
        };

        if ($data["counterYatzy"] == "2") :
            $data["diceMessage"] = "Summera ettorna och kasta för tvåorna";
        elseif ($data["counterYatzy"] == "3") :
            for ($i = 0; $i < 5; $i++) {
                if ($data["sumUp"][$i] == 1) :
                    $data["sumEtt"] += $data["sumUp"][$i];
                endif;
                $data["dice" . ($i + 1)] = null;
            };
        elseif ($data["counterYatzy"] == "5") :
            $data["diceMessage"] = "Summera tvåorna och kasta för treorna";
        elseif ($data["counterYatzy"] == "6") :
            for ($i = 0; $i < 5; $i++) {
                if ($data["sumUp"][$i] == 2) :
                    $data["sumTva"] += $data["sumUp"][$i];
                endif;
                $data["dice" . ($i + 1)] = null;
            };
        elseif ($data["counterYatzy"] == "8") :
            $data["diceMessage"] = "Summera treorna och kasta för fyrorna";
        elseif ($data["counterYatzy"] == "9") :
            for ($i = 0; $i < 5; $i++) {
                if ($data["sumUp"][$i] == 3) :
                    $data["sumTre"] += $data["sumUp"][$i];
                endif;
                $data["dice" . ($i + 1)] = null;
            };
        elseif ($data["counterYatzy"] == "11") :
            $data["diceMessage"] = "Summera fyrorna och kasta för femmorna";
        elseif ($data["counterYatzy"] == "12") :
            for ($i = 0; $i < 5; $i++) {
                if ($data["sumUp"][$i] == 4) :
                    $data["sumFyra"] += $data["sumUp"][$i];
                endif;
                $data["dice" . ($i + 1)] = null;
            };
        elseif ($data["counterYatzy"] == "14") :
            $data["diceMessage"] = "Summera femmorna och kasta för sexorna";
        elseif ($data["counterYatzy"] == "15") :
            for ($i = 0; $i < 5; $i++) {
                if ($data["sumUp"][$i] == 5) :
                    $data["sumFem"] += $data["sumUp"][$i];
                endif;
                $data["dice" . ($i + 1)] = null;
            };
        elseif ($data["counterYatzy"] == "17") :
            $data["diceMessage"] = "Summera sexorna";
        elseif ($data["counterYatzy"] == "18") :
            for ($i = 0; $i < 5; $i++) {
                if ($data["sumUp"][$i] == 6) :
                    $data["sumSex"] += $data["sumUp"][$i];
                endif;
                $data["dice" . ($i + 1)] = null;
            };
            $data["totSumYatzy"] = $data["sumSex"] + $data["sumFem"] + $data["sumFyra"] + $data["sumTre"] + $data["sumTva"] + $data["sumEtt"];
            if ($data["totSumYatzy"] >= 63) :
                $data["bonusYatzy"] = 50;
            endif;
        endif;

        $data["counterYatzy"] += 1;
        $body = renderView("layout/yatzy.php", $data);
        sendResponse($body);
    }
}
