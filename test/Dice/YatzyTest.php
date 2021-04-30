<?php

declare(strict_types=1);

namespace hajh20\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the YatzyClass class.
 */
class YatzyTest extends TestCase
{
    public function testGetBonusClass()
    {
        $test = new Bonus();
        
        $res = $test->bonus(63);
        $exp = 50;
        $this->assertEquals($exp, $res);
    }

    public function testMessageYatzy()
    {
        $test = new Message();
        $res = $test->diceMessageYatzy(2);
        $exp = "Summera ettorna och kasta för tvåorna";
        $this->assertEquals($exp, $res);

        $test = new Message();
        $res = $test->diceMessageYatzy(5);
        $exp = "Summera tvåorna och kasta för treorna";
        $this->assertEquals($exp, $res);

        $test = new Message();
        $res = $test->diceMessageYatzy(8);
        $exp = "Summera treorna och kasta för fyrorna";
        $this->assertEquals($exp, $res);

        $test = new Message();
        $res = $test->diceMessageYatzy(11);
        $exp = "Summera fyrorna och kasta för femmorna";
        $this->assertEquals($exp, $res);

        $test = new Message();
        $res = $test->diceMessageYatzy(14);
        $exp = "Summera femmorna och kasta för sexorna";
        $this->assertEquals($exp, $res);

        $test = new Message();
        $res = $test->diceMessageYatzy(17);
        $exp = "Summera sexorna";
        $this->assertEquals($exp, $res);
    }

    public function testSumUpDicesYatzy()
    {
        $test = new YatzyClass();
        $sumUp = [0,1,2,1,1];
        $res = $test->sumUpDices("3", $sumUp);
        $exp = 3;
        $this->assertEquals($exp, $res);

        $test = new YatzyClass();
        $sumUp = [0,1,2,1,1];
        $res = $test->sumUpDices("6", $sumUp);
        $exp = 2;
        $this->assertEquals($exp, $res);

        $test = new YatzyClass();
        $sumUp = [0,1,2,3,3];
        $res = $test->sumUpDices("9", $sumUp);
        $exp = 6;
        $this->assertEquals($exp, $res);

        $test = new YatzyClass();
        $sumUp = [4,1,2,4,4];
        $res = $test->sumUpDices("12", $sumUp);
        $exp = 12;
        $this->assertEquals($exp, $res);

        $test = new YatzyClass();
        $sumUp = [0,5,2,1,1];
        $res = $test->sumUpDices("15", $sumUp);
        $exp = 5;
        $this->assertEquals($exp, $res);

        $test = new YatzyClass();
        $sumUp = [0,5,6,6,1];
        $res = $test->sumUpDices("18", $sumUp);
        $exp = 12;
        $this->assertEquals($exp, $res);

    }

}


