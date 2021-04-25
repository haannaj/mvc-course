<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$output2 = $output2 ?? null;
$computerround = "";
$sum = 0;

?><h1><?= $header ?></h1>
<p><?= $message ?></p>

<form method="post" action="<?= $action ?>">
    <p>
        <input type="text" name="content" placeholder="Enter 1 or 2 dices">
    </p>
    <p>
        <input type="hidden" name="content3" value="<?= $sum ?>"/>
    </p>
    <p>
        <input type="hidden" name="computerround" value="<?= $computerround ?>"/>
    </p>
    <p>
        <input type="submit" value="Start round">
    </p>
</form>


