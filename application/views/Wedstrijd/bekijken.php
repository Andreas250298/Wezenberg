<?php
$lijstWedstrijden = '';

foreach ($wedstrijden as $wedstrijd) {
    if ($wedstrijd->beginDatum > date("Y-m-d")) {
        $lijstWedstrijden .= '<tr>
    <td>'
    .anchor('Wedstrijd/info/' . $wedstrijd->id, $wedstrijd->naam).
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
<?php echo anchor('Wedstrijd/toonAfgelopen', 'Toon afgelopen wedstrijden')?>
<br/><br/>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
