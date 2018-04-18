<?php
$lijstWedstrijden = '';

foreach ($wedstrijden as $wedstrijd) {
    $lijstWedstrijden .= '<tr>
    <td>'
    .$wedstrijd->naam.
    '</td>
    <td>'
    .$wedstrijd->plaats.
    '</td>
    <td>'
    .zetOmNaarDDMMYYYY($wedstrijd->beginDatum).
    '</td>
    <td>'
    .zetOmNaarDDMMYYYY($wedstrijd->eindDatum).
    '</td>
    </tr>';
}
?>

<table class="table">
  <thead>
    <tr>
      <td>
        Naam
      </td>
    <td>
      Plaats
    </td>
    <td>
      Start
    </td>
    <td>
      Einde
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstWedstrijden;
    ?>
  </tbody>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
