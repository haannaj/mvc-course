<?php

declare(strict_types=1);

namespace Mos\Router;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class RouteTest extends TestCase
{
    public function testGetRoute()
    {
        $test = new Router();
        $res = $test->dispatch("GET", "/");
        $this->assertEmpty($res);

        $test = new Router();
        $res = $test->dispatch("GET", "/debug");
        $this->assertEmpty($res);

        $test = new Router();
        $res = $test->dispatch("GET", "/twig");
        $this->assertEmpty($res);
        $test = new Router();
        $res = $test->dispatch("GET", "/some/where");
        $this->assertEmpty($res);
    }
}
