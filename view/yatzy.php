<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$bonusYatzy = $bonusYatzy ?? 0;
$totSumYatzy = $totSumYatzy ?? 0;
?><h1><?= $header ?></h1>

<?php if ($totSumYatzy == 0) : ?>
  <form method="post" action="<?= $yatzyaction ?>">
      <p><?= $message ?></p>
      <?php if ($dice1 === null) : ?>
          <input type="checkbox" name="dice1" value="<?= $class[0] ?>">
          <label><?= $class[0] ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice1 ?></label>
          <input type="hidden" name="dice1" value="<?= $dice1 ?>"/>
      <?php endif; ?>

      <?php if ($dice2 === null) : ?>
          <input type="checkbox" name="dice2" value="<?= $class[1] ?>">
          <label><?= $class[1] ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice2 ?></label>
          <input type="hidden" name="dice2" value="<?= $dice2 ?>"/>
      <?php endif; ?>

      <?php if ($dice3 === null) : ?>
          <input type="checkbox" name="dice3" value="<?= $class[2] ?>">
          <label><?= $class[2] ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice3 ?></label>
          <input type="hidden" name="dice3" value="<?= $dice3 ?>"/>
      <?php endif; ?>

      <?php if ($dice4 === null) : ?>
          <input type="checkbox" name="dice4" value="<?= $class[3] ?>">
          <label><?= $class[3] ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice4 ?></label>
          <input type="hidden" name="dice4" value="<?= $dice4 ?>"/>
      <?php endif; ?>
      <?php if ($dice5 === null) : ?>
          <input type="checkbox" name="dice5" value="<?= $class[4] ?>">
          <label><?= $class[4] ?></label>
      <?php else : ?>
          <input type="checkbox" disabled>
          <label><?= $dice5 ?></label>
          <input type="hidden" name="dice5" value="<?= $dice5 ?>"/>
      <?php endif; ?>
      <p>
          <input type="hidden" name="counterYatzy" value="<?= $counterYatzy ?>"/>
          <input type="hidden" name="sumEtt" value="<?= $sumEtt ?>"/>
          <input type="hidden" name="sumTva" value="<?= $sumTva ?>"/>
          <input type="hidden" name="sumTre" value="<?= $sumTre ?>"/>
          <input type="hidden" name="sumFyra" value="<?= $sumFyra ?>"/>
          <input type="hidden" name="sumFem" value="<?= $sumFem ?>"/>
          <input type="hidden" name="sumSex" value="<?= $sumSex ?>"/>
          <input type="submit" value="<?= $diceMessage ?>">
      </p>
  </form>
<?php endif; ?>



<table>
  <tr>
    <th>Ettor:</th>
    <td><?= $sumEtt ?></td>
  </tr>
  <tr>
    <th>Tvåor:</th>
    <td><?= $sumTva ?></td>
  </tr>
  <tr>
    <th>Treor:</th>
    <td><?= $sumTre ?><td>
  </tr>
  <tr>
    <th>Fyror:</th>
    <td><?= $sumFyra ?></td>
  </tr>
  <tr>
    <th>Femmor:</th>
    <td><?= $sumFem ?></td>
  </tr>
  <tr>
    <th>Sexor:</th>
    <td><?= $sumSex ?></td>
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


<!-- Yatzy-spel: -->
<!-- Skapa 5 tärningar, som visar sig. -->
<!-- skapa roll-knapp (max 3 roll/runda) -->
<!-- Kunna välja vilka tärningar att spara, ev button/form med aktiv knapp  -->
<!-- Visa vilken "uppgift" man är på, och knapp för att gå på nästa kanske? Då nollställs rullen och alla tärningar roll -->

