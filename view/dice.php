<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$_SESSION["round"] = $_SESSION["round"] ?? null;
$_SESSION["totalsum"] = $_SESSION["totalsum"] ?? null;
?>
<h1><?= $header ?></h1>

<?php if ($computerround == "") : ?>
    <?php if ($_SESSION["output"] == 2) : ?>
        <h3>Players turn</h3>
        <p class="dice-utf8">
            <i class="dice-<?=$kast[0]?>"></i>
            <i class="dice-<?=$kast[2]?>"></i>
        </p>
    <?php else : ?>
        <p class="dice-utf8">
            <i class="dice-<?=$kast[0]?>"></i>
        </p>
    <?php endif; ?>
    <?php if ($_SESSION["round"] !== null) : ?>
        <h3>You stopped at <?= $_SESSION["round"] ?>.</h3>
        <form method="post" action="<?= $action ?>">
        <p>
            <input type="hidden" name="computerround" value="<?= $_SESSION["round"] ?>"/>
        </p>
        <p>
            <input type="submit" value="Computers turn">
        </p>
        </form>
    <?php elseif ($_SESSION["totalsum"] > 21) :?>
        <h3><?= $gameover ?></h3>
        <p>Total sum of dices: <?= $_SESSION["totalsum"] ?></p>
        <form method="post" action="<?= $action ?>">
        <p>
            <input type="hidden" name="computerround" value="<?= $_SESSION["totalsum"] ?>"/>
        </p>
        <p>
            <input type="submit" value="Computers turn">
        </p>
        </form>
    <?php elseif ($_SESSION["totalsum"] < 21) :?>
        <p>Total sum of dices: <?= $_SESSION["totalsum"] ?></p>
        <form method="post" action="<?= $action ?>">
            <p>
                <input type="hidden" name="content" value="<?= $_SESSION["totalsum"] ?>"/>
            </p>
            <p>
                <input type="submit" value="Roll">
            </p>
        </form>

        <form method="post" action="<?= $action ?>">
            <p>
                <input type="hidden" name="content1" value="<?= $_SESSION["totalsum"] ?>"/>
            </p>
            <p>
                <input type="submit" value="Stop">
            </p>
        </form>
    <?php elseif ($_SESSION["totalsum"] == 21) :?>
        <h3><?= $gameover ?></h3>
        <p>Total sum of dices: <?= $_SESSION["totalsum"] ?></p>
        <form method="post" action="<?= $action ?>">
        <p>
            <input type="hidden" name="computerround" value="<?= $_SESSION["totalsum"] ?>"/>
        </p>
        <p>
            <input type="submit" value="Computers turn">
        </p>
        </form>
    <?php endif; ?>
<?php else : ?> 
    <h3><?= $gameover ?></h3>
    <p>Player got: <?= $sumP ?></p>
    <p>Computer got: <?= $sumC ?></p>


    <br><p><b>Score: </b></p>
    <p>Computer: <?= $_SESSION["counterC"] ?> </p>
    <p>Player: <?= $_SESSION["counterP"] ?> </p>
    
    <div class="buttons">
    <a href="<?= $urltest ?>">Start new round</a>
    <a href="<?= $restart ?>">Reset score</a>
    </div>
</p>
<?php endif; ?>
