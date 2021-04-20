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
class Form
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Welcome to 21!",
            "message" => "Enter how many dices you want to have:",
            "action" => url("/form/process"),
            "output" => $_SESSION["output"] ?? null,
            "output1" => $_SESSION["output1"] ?? null,
        ];

        $body = renderView("layout/form.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }


    public function process(): ResponseInterface
    {
        $_SESSION["output"] = $_POST["content"] ?? null;
        $_SESSION["totalsum"] = $_POST["content3"] ?? null;
        $_SESSION["test"] = $_POST["computerround"] ?? null;

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/dice"));
    }
}
