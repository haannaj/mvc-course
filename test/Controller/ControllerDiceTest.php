<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Dice.
 */
class ControllerDiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Dice();
        $this->assertInstanceOf("\Mos\Controller\Dice", $controller);
    }

    /**
     * Check the controller action.
     * @runInSeparateProcess
     */
    public function testControllerIndexAction()
    {
        $controller = new Dice();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }


    /**
    * Check the controller action.
     * @runInSeparateProcess
     */
    public function testControllerProcessAction()
    {
        $controller = new Dice();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
    }
}
