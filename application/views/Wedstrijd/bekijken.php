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
      .$wedstrijd->beginDatum.
      '</td>
      <td>'
      .$wedstrijd->eindDatum.
      '</td>';
        if (isset($gebruiker)) {
            if ($gebruiker->soort == "trainer") {
                $lijstWedstrijden .= '<td>'.
   anchor('wedstrijd/updateWedstrijd/' . $wedstrijd->id, 'Wijzig').
       '</td><td>'.
   anchor('wedstrijd/reeksenToevoegen/' . $wedstrijd->id, 'Reeksen toevoegen').
       '</td><td>'
       .anchor('wedstrijd/verwijder/' . $wedstrijd->id, 'Verwijder').
       '</td>';
            }
        }

        $lijstWedstrijden .= '</tr>';
    }
}
if (isset($gebruiker)) {
    if ($gebruiker->soort == "trainer") {
        echo '<p>'.anchor('wedstrijd/maakWedstrijd', 'Nieuwe Wedstrijd aanmaken').'</p>';
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
<?php echo anchor('Wedstrijd/toonAfgelopen', 'Toon afgelopen wedstrijden')?>
<br/><br/>
<p>
    <?php echo anchor('home/index', 'terug'); ?>
</p>
