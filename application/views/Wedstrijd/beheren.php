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
    .$wedstrijd->beginDatum.
    '</td>
    <td>'
    .$wedstrijd->eindDatum.
    '</td><td>'.
anchor('wedstrijd/updateWedstrijd/' . $wedstrijd->id, 'Wijzig').
    '</td><td>'.
anchor('wedstrijd/reeksenToevoegen/' . $wedstrijd->id, 'Reeksen toevoegen').
    '</td><td>'
    .anchor('wedstrijd/verwijder/' . $wedstrijd->id, 'Verwijder').
    '</td></tr>';
}

echo '<p>'.anchor('wedstrijd/maakWedstrijd', 'Nieuwe Wedstrijd aanmaken').'

</p>'
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
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
