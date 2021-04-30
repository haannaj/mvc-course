<?php

declare(strict_types=1);

namespace hajh20\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the Dice classes.
 */
class DiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testDiceHandClass()
    {
        $test = new DiceHand();
        $test->roll();
        $res = $test->getLastRoll();
    
        $exp = $test->getLength();
        $this->assertEquals($exp, strlen($res));
    }

    public function testGraphicDiceClass()
    {
        $test = new GraphicalDice();
        $test->roll();
        $res = $test->graphic();

        $exp = 6;
        $this->assertEquals($exp, strlen($res));
    }

}


