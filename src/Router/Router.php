<?php

declare(strict_types=1);

namespace Mos\Router;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $callable = new \hajh20\Dice\Game();
            $callable->playGame();
            return;
        } else if ($method === "POST" && $path === "/dice/process") {
            $_SESSION["output1"] = $_POST["content"] ?? null;
            $_SESSION["round"] = $_POST["content1"] ?? null;
            $_SESSION["test"] = $_POST["computerround"] ?? null;
            redirectTo(url("/dice"));
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Welcome to 21!",
                "message" => "Enter how many dices you want to have:",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
                "output1" => $_SESSION["output1"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            $_SESSION["totalsum"] = $_POST["content3"] ?? null;
            $_SESSION["test"] = $_POST["computerround"] ?? null;
            redirectTo(url("/dice"));
            return;
        }
        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
