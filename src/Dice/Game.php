<?php

declare(strict_types=1);

namespace hajh20\Dice;

use hajh20\Dice\Dice;
use hajh20\Dice\GraphicalDice;
use hajh20\Dice\Message;

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
            "message" => "Dice",
            "action" => url("/dice/process"),
            "action2" => url("/form/view"),
            "kast" => "",
            "output2" => $_SESSION["output2"] ?? null,
            "output1" => $_SESSION["output1"] ?? null,
            "computerround" => $_SESSION["test"] ?? null
        ];

        // Bestäm antal tärningar.
        $gamedice = new DiceHand();
        $gamedice->setLength(intval($data["output2"]));
        $gamedice->roll();
        $data["kast"] = $gamedice->getLastRoll();
        $data["sum"] = 0;
        for ($i = 0; $i < strlen($data["kast"]); $i++) {
            $data["sum"] += intval($data["kast"][$i]);
        }

        // Summera tärningskasten
        $_SESSION["totalsum"] = $data["sum"] + ($_SESSION["totalsum"] ?? 0);

        // Få fram gameover-meddelande
        $getMessage = new Message();
        $data["gameover"] = $getMessage->getGameOver21Message($_SESSION["totalsum"]);

        // var_dump($data["computerround"]);
        $getPoints = new Game();
        $points = $getPoints->PointsGame($data["computerround"]);

        $data["sumP"] = $points[1];
        $data["sumC"] = $points[0];

        $getWinner = new Game();
        $winner = $getWinner->ResultGame($points[2], $points[3]);

        $data["result"] = $winner[0];

        $_SESSION["counterC"] = $_SESSION["counterC"] ?? 0;
        $_SESSION["counterP"] = $_SESSION["counterP"] ?? 0;

        $data["urltest"] = url("/form/view");
        $data["restart"] = url("/session/destroy");

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }


    public function PointsGame($playersPoint): array
    {
        $playersPoint = intval($playersPoint);

        if ($playersPoint != 0) :
            $computerPoint = 0;

            // Rulla tärning för computer
            for ($i = 0; 21 >= $computerPoint; $i++) {
                $die = new Dice();
                $rolls = $die->roll();
                $computerPoint += $rolls;
            }

            // Summera om Computer eller Player är närmst 21
            $CP = $computerPoint - 21;

            if ($playersPoint > 21) :
                $PP = $playersPoint - 21;
            else :
                $PP = 21 - $playersPoint;
            endif; 
            
            return [$computerPoint, $playersPoint, $CP, $PP];
        else: 
            return [0, 0, "", ""];
        endif;
    }

    public function ResultGame($CP, $PP): array
    {
        $_SESSION["counterC"] = $_SESSION["counterC"] ?? 0;
        $_SESSION["counterP"] = $_SESSION["counterP"] ?? 0;
        
        // Dela ut poäng
        if ($PP !== "") :
            if ($CP == $PP || $CP < $PP) :
                $message = "Computer Won!";
                $_SESSION["counterC"] += 1;
            elseif ($CP > $PP) :
                $message = "Player won!";
                $_SESSION["counterP"] += 1;
            endif;
            return [$message, $_SESSION["counterP"], $_SESSION["counterC"]];
        else : 
            return [""];
        endif;
    }
}
