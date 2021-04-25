<?php

declare(strict_types=1);

namespace hajh20\Dice;

use hajh20\Dice\Dice;
use hajh20\Dice\DiceHand;
use hajh20\Dice\GraphicalDice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url,
    destroySession
};

/**
 * Class Game
 */
class Game
{
    public function playGame(): void
    {
        $data = [
            "header" => "Game 21",
            "message" => "Dice",
            "action" => url("/dice/process"),
            "action2" => url("/form/view"),
            "output2" => $_SESSION["output2"] ?? null,
            "output1" => $_SESSION["output1"] ?? null,
            "computerround" => $_SESSION["test"] ?? null
        ];

        $die = new Dice();
        $die->roll();

        $diceHand = new DiceHand();
        $diceHand->roll();

        $data["dieLastRoll"] = $die->getLastRoll();
        $data["diceHandRoll"] = $diceHand->getLastRoll();

        $diceHand->roll();
        $data["diceHandRoll1"] = $diceHand->getLastRoll();

        $diegraphic = new GraphicalDice();
        $data["class"] = [];
        for ($i = 0; $i < $_SESSION["output2"]; $i++) {
            $diegraphic->roll();
            array_push($data["class"], $diegraphic->graphic());
        }

        $data["rullen"] = 0;
        $data["sum"] = 0;
        $data["kast"] = "";
        for ($i = 0; $i < $_SESSION["output2"]; $i++) {
            $_SESSION["gamedice"] = new Dice();
            $data["rullen"] = $_SESSION["gamedice"]->roll();
            $data["kast"] .= $data["rullen"] . " ";
            $data["sum"] += $data["rullen"];
        }

        $_SESSION["totalsum"] = $data["sum"] + ($_SESSION["totalsum"] ?? 0);


        if (((intval($data["output1"]) + $data["sum"]) ?? 0) > 21) :
            $data["gameover"] = "Game Over";
        elseif ((intval($data["output1"]) + $data["sum"]) == 21) :
            $data["gameover"] = "Congratulations, you got 21!";
        endif;

        if ($data["computerround"] !== null && $data["computerround"] !== "") :
            $data["sumC"] = 0;
            for ($i = 0; 21 >= $data["sumC"]; $i++) {
                $_SESSION["gamedice"] = new Dice();
                $data["rullen"] = $_SESSION["gamedice"]->roll();
                $data["sumC"] += $data["rullen"];
            }

            $data["sumP"] = intval($_SESSION["test"]);
            if ($data["sum"] > 21) :
                $data["computer"] = 21 - $data["sumC"];
            elseif ($data["sum"] <= 21) :
                $data["computer"] = $data["sumC"] - 21;
            endif;

            if ($data["sumP"] > 21) :
                $data["player"] = $data["sumP"] - 21;
            elseif ($data["sumP"] <= 21) :
                $data["player"] = 21 - $data["sumP"];
            endif;

            $_SESSION["counterC"] = $_SESSION["counterC"] ?? 0;
            $_SESSION["counterP"] = $_SESSION["counterP"] ?? 0;

            if ($data["computer"] == $data["player"] || $data["computer"] < $data["player"]) :
                $data["gameover"] = "Computer Won!";
                $_SESSION["counterC"] += 1;
            elseif ($data["computer"] > $data["player"]) :
                $data["gameover"] = "Player won!";
                $_SESSION["counterP"] += 1;
            endif;
        endif;

        $data["urltest"] = url("/form/view");
        $data["restart"] = url("/session/destroy");

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}
