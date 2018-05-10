<?php
/**
 * @file Wedstrijd/inschrijvingen.php
 *
 * View waarop de zwemmer zich kan inschrijven.

 * - $wedstrijd-objecten waarvoor hij zich nog kan inschrijven.
 *
 * Als je als trainer bent ingelogd krijg je ook te zien:
 * - Extra menu opties om bepaalde functionaliteiten te beheren.
 */



$lijstWedstrijden = '';
$lijstAfgelopenWedstrijden = '';
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Inschrijven');
$attributen = array('id' => 'mijnFormulier',
    'class' => 'form-inline my2 my-lg0',
    'data-toggle' => 'validator',
    'role' => 'form');
$stat = "";

foreach ($wedstrijden as $wedstrijd) {
    if ($wedstrijd->beginDatum > date("Y-m-d")) {
        $lijstWedstrijden .= '<tr>
    <td>'
    .anchor('Wedstrijd/info/' . $wedstrijd->id."/na", $wedstrijd->naam).
    '</td>
    <td>'
    .$wedstrijd->plaats.
    '</td>
    <td>'
    .$wedstrijd->beginDatum.
    '</td>
    <td>'
    .$wedstrijd->eindDatum.
    '</td>';

        if (isset($status)) {
            foreach ($status as $deel) {
                if (isset($deel->naam)) {
                    $stat = $deel->naam;
                }
            }
        } else {
            $stat = "open";
        }
        $lijstWedstrijden .= "<td>" . $stat . "</td>";

        if ($stat == "open") {
            $lijstWedstrijden .= '<td>'.
  form_submit($dataSubmit);
            '</td>';
        }
        $lijstWedstrijden .= "</tr>";
    } else {
        $lijstAfgelopenWedstrijden .= '<tr>
  <td>'
  .anchor('Wedstrijd/info/' . $wedstrijd->id."/na", $wedstrijd->naam).
  '</td>
  <td>'
  .$wedstrijd->plaats.
  '</td>
  <td>'
  .$wedstrijd->beginDatum.
  '</td>
  <td>'
  .$wedstrijd->eindDatum.
  '</td>';

        if (isset($status)) {
            foreach ($status as $deel) {
                if (isset($deel->naam)) {
                    $stat = "afgelopen";
                }
            }
        } else {
            $stat = "afgelopen";
        }
        $lijstAfgelopenWedstrijden .= "<td>" . $stat . "</td></tr>";
    }
}
?>
<h2 class="startTitel">Open inschrijvingen</h2>
<div class="table-responsive">
<table class="table">
  <?php echo form_open('Wedstrijd/inschrijven', 'class="form-group"', $attributen);?>
  <thead>
    <tr>
      <th>
        Naam
      </th>
    <th>
      Plaats
    </th>
    <th>
      Start
    </th>
    <th>
      Einde
    </th>
    <th>
      Status
    </th>
    <th>
    </th>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstWedstrijden;
    ?>
  </tbody>
  <?php echo form_close();?>
</table>
</div>
<h2 class="startTitel">Voorbije inschrijvingen</h2>
<div class="table-responsive">
<table class="table">
<thead>
  <tr>
    <th>
      Naam
    </th>
  <th>
    Plaats
  </th>
  <th>
    Start
  </th>
  <th>
    Einde
  </th>
  <th>
    Status
  </th>
  </tr>
</thead>
<tbody>
  <?php
  echo $lijstAfgelopenWedstrijden;
  ?>
</tbody>
</table>
</div>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
