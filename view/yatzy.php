<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = "Yatzy";
$message = $message ?? null;
$diceMessage = $diceMessage ?? null;
$bonusYatzy = $bonusYatzy ?? 0;
$totSumYatzy = $totSumYatzy ?? 0;
$yatzyaction = $yatzyaction ?? null;
$dice1 = $dice1 ?? null;
$dice2 = $dice2 ?? null;
$dice3 = $dice3 ?? null;
$dice4 = $dice4 ?? null;
$dice5 = $dice5 ?? null;
$sum3 = $sum3 ?? 0;
$sum6 = $sum6 ?? 0;
$sum9 = $sum9 ?? 0;
$sum12 = $sum12 ?? 0;
$sum15 = $sum15 ?? null;
$sum18 = $sum18 ?? null;
$class = $class ?? "";
$countY = $countY ?? 0
?><h1><?= $header ?></h1>



<?php if ($totSumYatzy == 0) : ?>
  <form method="post" action="<?= $yatzyaction ?>">
      <p><?= $message ?></p>

      <?php if ($dice1 === null) : ?>
          <input type="checkbox" name="dice1" value="<?= substr($class, 0, 1) ?>">
          <label><?= substr($class, 0, 1) ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice1 ?></label>
          <input type="hidden" name="dice1" value="<?= $dice1 ?>"/>
      <?php endif; ?>

      <?php if ($dice2 === null) : ?>
          <input type="checkbox" name="dice2" value="<?= substr($class, 1, 1) ?>">
          <label><?= substr($class, 1, 1) ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice2 ?></label>
          <input type="hidden" name="dice2" value="<?= $dice2 ?>"/>
      <?php endif; ?>

      <?php if ($dice3 === null) : ?>
          <input type="checkbox" name="dice3" value="<?= substr($class, 2, 1) ?>">
          <label><?= substr($class, 2, 1) ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice3 ?></label>
          <input type="hidden" name="dice3" value="<?= $dice3 ?>"/>
      <?php endif; ?>

      <?php if ($dice4 === null) : ?>
          <input type="checkbox" name="dice4" value="<?= substr($class, 3, 1) ?>">
          <label><?= substr($class, 3, 1) ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice4 ?></label>
          <input type="hidden" name="dice4" value="<?= $dice4 ?>"/>
      <?php endif; ?>

      <?php if ($dice5 === null) : ?>
          <input type="checkbox" name="dice5" value="<?= substr($class, 4, 1) ?>">
          <label><?= substr($class, 4, 1) ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice5 ?></label>
          <input type="hidden" name="dice5" value="<?= $dice5 ?>"/>
      <?php endif; ?>

      <p>
          <input type="hidden" name="counterYatzy" value="<?= $countY ?>"/>
          <input type="hidden" name="sum3" value="<?= $sum3 ?>"/>
          <input type="hidden" name="sum6" value="<?= $sum6 ?>"/>
          <input type="hidden" name="sum9" value="<?= $sum9 ?>"/>
          <input type="hidden" name="sum12" value="<?= $sum12 ?>"/>
          <input type="hidden" name="sum15" value="<?= $sum15 ?>"/>
          <input type="hidden" name="sum18" value="<?= $sum18 ?>"/>
          <input type="submit" value="<?= $diceMessage ?>">
      </p>
  </form>
<?php endif; ?>



<table>
  <tr>
    <th>Ettor:</th>
    <td><?= $sum3 ?></td>
  </tr>
  <tr>
    <th>Tvåor:</th>
    <td><?= $sum6 ?></td>
  </tr>
  <tr>
    <th>Treor:</th>
    <td><?= $sum9 ?><td>
  </tr>
  <tr>
    <th>Fyror:</th>
    <td><?= $sum12 ?></td>
  </tr>
  <tr>
    <th>Femmor:</th>
    <td><?= $sum15 ?></td>
  </tr>
  <tr>
    <th>Sexor:</th>
    <td><?= $sum18 ?></td>
  </tr>
  <tr>
    <th>Summa:</th>
    <td><?= $totSumYatzy ?></td>
  </tr>
  <tr>
    <th>Bonus:</th>
    <td><?= $bonusYatzy ?></td>
  </tr>
</table>

