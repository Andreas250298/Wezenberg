<?php
$lijstSupplementenPerZwemmer = '';

foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
    $lijstSupplementenPerZwemmer .= '<tr>
    <td>'.$supplementPerZwemmer->supplement->naam.'</td>
    <td>'.$supplementPerZwemmer->supplement->beschrijving.'</td>
    <td>
    '.zetOmNaarDDMMYYYY($supplementPerZwemmer->datumIname).'
    </td><td>
      '.$supplementPerZwemmer->tijdstipIname.'
      </td><td>
      '.$supplementPerZwemmer->hoeveelheid.' g
      </td>
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
    echo $lijstSupplementenPerZwemmer;
    ?>
  </tbody>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
