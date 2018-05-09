<?php
if ($wedstrijden != null){
    echo '<table class="table">
    <thead>
    <tr>
    <th>Naam</th>
    <th>Plaats</th>
    <th>Begin datum</th>
    <th>Eind datum</th>
    <th></th>
    </tr>
    <thead>
    <tbody>';
    foreach ($wedstrijden as $wedstrijd) {
        $data = array('type' => 'hidden', 'name' => 'wedstrijdId', 'id' => 'wedstrijdId', 'value' => $wedstrijd->id);
    echo '<tr>
      <td>'
      .anchor('Wedstrijd/info/' . $wedstrijd->id, $wedstrijd->naam, 'class="btn btn-link"').
      '</td>
      <td>'
      .$wedstrijd->plaats.
      '</td>
      <td>'
      .zetOmNaarDDMMYYYY($wedstrijd->beginDatum).
      '</td>
      <td>'
      .zetOmNaarDDMMYYYY($wedstrijd->eindDatum).
      '</td>';
        if (isset($gebruiker)) {
            if ($gebruiker->soort == "trainer") {
               echo '<td>'. form_input($data) .
   anchor('wedstrijd/updateWedstrijd/' . $wedstrijd->id, 'Wijzig', 'class="btn btn-info" style="margin-right : 10px;"').
   anchor('wedstrijd/reeksenToevoegen/' . $wedstrijd->id, 'Reeksen toevoegen', 'class="btn btn-success" style="margin-right : 10px;"').
   '<button type="button" class="btn btn-danger btn-xs btn-round modal-trigger"><i class="fas fa-times"></i></button></td>';
            }
        }
    }
    echo '</tbody>
    </table>';
}
