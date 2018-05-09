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
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Inschrijven');
$attributen = array('id' => 'mijnFormulier',
    'class' => 'form-inline my2 my-lg0',
    'data-toggle' => 'validator',
    'role' => 'form');
$stat = "";

foreach ($wedstrijden as $wedstrijd) {
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
}
?>
<h2 class="startTitel">Open inschrijvingen</h2>
<table class="table">
  <?php echo form_open('Wedstrijd/inschrijven', 'class="form-group"', $attributen);?>
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
      Status
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
  <?php echo form_close();?>
</table>

<h2 class="startTitel">Voorbije inschrijvingen</h2>

<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
