<?php

declare(strict_types=1);

namespace hajh20\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the Game21 class.
 */
class DiceGameTest extends TestCase
{
    public function testSetNumberOfDicesDiceHand()
    {
        $test = new DiceHand();
        $test->setLength(4);
        $test->roll();
        $res = $test->getLastRoll();

        $exp = 4;
        $this->assertEquals($exp, strlen($res));
    }

    public function testMessageGame21()
    {
        $test = new Message();
        $res = $test->getGameOver21Message(24);
        $exp = "Game Over";
        $this->assertEquals($exp, $res);

        $test = new Message();
        $res = $test->getGameOver21Message(21);
        $exp = "Congratulations, you got 21!";
        $this->assertEquals($exp, $res);
    }

    public function testPointsGame21()
    {
        $test = new Game();
        $res = $test->PointsGame(20);
        $this->assertNotEmpty($res);

        $test = new Game();
        $res = $test->PointsGame(30);
        $this->assertNotEmpty($res);
    }

    public function testWinnerGame21()
    {
        $test = new Game();
        $res = $test->ResultGame(21, 22);
        $exp = "Computer Won!";
        $this->assertEquals($exp, $res[0]);

        $test = new Game();
        $res = $test->ResultGame(25, 22);
        $exp = "Player won!";
        $this->assertEquals($exp, $res[0]);
    }
}
