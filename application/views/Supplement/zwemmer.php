<?php
$lijstSupplementen = '';

foreach ($supplementen as $supplement) {
    $lijstSupplementen .= '<tr>
    <td>'
    .$supplement->naam.
    '</td>
    <td>'
    .$supplement->beschrijving.
    '</td>
    <td>'
    .$supplement->.
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
      Beschrijving
    </td>
    <td>
      Datum
    </td>
    <td>
      Tijdstip
    </td>
    <td>
      Hoeveelheid
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstSupplementen;
    ?>
  </tbody>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
