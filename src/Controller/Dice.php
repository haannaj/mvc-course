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
 * Controller for the session routes.
 */
class Dice
{
    public function index()
    {
        $callable = new \hajh20\Dice\Game();
        $callable->playGame();
        return;
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
