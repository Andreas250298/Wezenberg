<?php
/**
 * @file Wedstrijd/afgelopen.php
 *
 * View waarin alle afgelopen wedstrijden te zien zijn.
 */
$lijstWedstrijden = '';

foreach ($wedstrijden as $wedstrijd) {
    if ($wedstrijd->beginDatum < date("Y-m-d")) {
        $lijstWedstrijden .= '<tr>
      <td>'
      .anchor('Wedstrijd/info/' . $wedstrijd->id, $wedstrijd->naam).
      '</td>
      <td>'
      .$wedstrijd->plaats.
      '</td>
      <td>'
      .$wedstrijd->beginDatum.
      '</td>
      <td>'
      .$wedstrijd->eindDatum.
      '</td><td>';
        if (isset($gebruiker)) {
            if ($gebruiker->soort == "trainer") {
                $lijstWedstrijden .= anchor('wedstrijd/voegResultatenToe', 'Resultaten toevoegen', 'class="btn btn-success"');
            }
        }
        $lijstWedstrijden .= '</td></tr>';
    }
}
if (isset($gebruiker)) {
    if ($gebruiker->soort == "trainer") {
        echo '<p>'.anchor('wedstrijd/maakWedstrijd', 'Nieuwe Wedstrijd aanmaken', 'class="btn btn-success"').'</p>';
    }
}
?>
<div class="table-responsive">
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
    <td>
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstWedstrijden;
    ?>
  </tbody>
</table>
</div>
<p>
    <a id="terug" href="javascript:history.go(-1);" class="btn btn-primary">Terug</a>
</p>
