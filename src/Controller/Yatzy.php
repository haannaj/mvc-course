<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use hajh20\Dice\YatzyClass;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the Yatzy routes.
 */
class Yatzy
{
    public function index() : ResponseInterface
    {
        $callable = new \hajh20\Dice\YatzyClass();
        $callable->playYatzy();

        $psr17Factory = new Psr17Factory();

        $body = renderView("layout/yatzy.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        $_SESSION["dice1"] = $_POST["dice1"] ?? null;
        $_SESSION["dice2"] = $_POST["dice2"] ?? null;
        $_SESSION["dice3"] = $_POST["dice3"] ?? null;
        $_SESSION["dice4"] = $_POST["dice4"] ?? null;
        $_SESSION["dice5"] = $_POST["dice5"] ?? null;
        $_SESSION["counterYatzy"] = $_POST["counterYatzy"] ?? null;
        $_SESSION["sumEtt"] = $_POST["sumEtt"] ?? null;
        $_SESSION["sumTva"] = $_POST["sumTva"] ?? null;
        $_SESSION["sumTre"] = $_POST["sumTre"] ?? null;
        $_SESSION["sumFyra"] = $_POST["sumFyra"] ?? null;
        $_SESSION["sumFem"] = $_POST["sumFem"] ?? null;
        $_SESSION["sumSex"] = $_POST["sumSex"] ?? null;

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }
}
