<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the dice routes.
 */
class Dice
{
    public function index(): ResponseInterface
    {
        $callable = new \hajh20\Dice\Game();
        $callable->playGame();

        $psr17Factory = new Psr17Factory();

        $body = renderView("layout/dice.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }


    public function process(): ResponseInterface
    {
        $_SESSION["output1"] = $_POST["content"] ?? null;
        $_SESSION["round"] = $_POST["content1"] ?? null;
        $_SESSION["test"] = $_POST["computerround"] ?? null;

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/dice"));
    }
}
