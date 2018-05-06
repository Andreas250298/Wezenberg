<?php
$lijstReeksen = '';
foreach ($reeksen as $reeks) {
    $lijstReeksen .= '<tr>
  <td>'
  .$reeks->id.
  '</td>
  <td>'
  .$reeks->datum.
  '</td>
  <td>'
  .$reeks->tijdstip.
  '</td><td>';
    if (isset($slagen)) {
        foreach ($slagen as $slag) {
            if (isset($slag->soort)) {
                $lijstReeksen .= $slag->soort;
            }
        }

        $lijstReeksen .= "</td><td>";
        foreach ($afstanden as $afstand) {
            if (isset($afstand->afstand)) {
                $lijstReeksen .= $afstand->afstand;
            }
        }
    }
    if (isset($reeks->id)) {
        $lijstReeksen .= "<td>" . anchor('wedstrijd/verwijderReeks/' . $reeks->id, 'Reeks verwijderen') . "</td></tr>";
    }
}
    echo '<p>'.anchor('wedstrijd/maakReeks/' . $wedstrijdId, 'Reeks toevoegen').'
  </p>';

if ($reeksen != null) {
    echo "<table class=\"table\">
  <thead>
    <tr>
      <td>
        Reeks
      </td>
    <td>
      Datum
    </td>
    <td>
      Tijdstip
    </td>
    <td>
      Slag
    </td>
    <td>
      Afstand
    </td>
    <td>
    </td>
    </tr>
  </thead>
  <tbody>
   $lijstReeksen
  </tbody></table>";
} else {
    echo "<p>Er zijn voor deze wedstrijd nog geen reeksen</p>";
}
echo anchor('Wedstrijd/index', 'terug', 'class="btn btn-primary"');
