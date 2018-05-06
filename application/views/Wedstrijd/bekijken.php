<?php
$lijstWedstrijden = '';

foreach ($wedstrijden as $wedstrijd) {
    if ($wedstrijd->beginDatum > date("Y-m-d")) {
        $lijstWedstrijden .= '<tr>
      <td>'
      .anchor('Wedstrijd/info/' . $wedstrijd->id, $wedstrijd->naam, 'class="btn btn-link"').
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
        if (isset($gebruiker)) {
            if ($gebruiker->soort == "trainer") {
                $lijstWedstrijden .= '<td>'.
   anchor('wedstrijd/updateWedstrijd/' . $wedstrijd->id, 'Wijzig', 'class="btn btn-info"').
       '</td><td>'.
   anchor('wedstrijd/reeksenToevoegen/' . $wedstrijd->id, 'Reeksen toevoegen', 'class="btn btn-success"').
       '</td><td>'
       .anchor('wedstrijd/verwijder/' . $wedstrijd->id, 'Verwijder', 'class="btn btn-danger"').
       '</td>';
            }
        }

        $lijstWedstrijden .= '</tr>';
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
    <td>
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
<?php echo anchor('Wedstrijd/toonAfgelopen', 'Toon afgelopen wedstrijden', 'class="btn btn-primary"')?>
<br/><br/>
<p>
    <?php echo anchor('home/index', 'Terug', 'class="btn btn-primary"'); ?>
</p>
