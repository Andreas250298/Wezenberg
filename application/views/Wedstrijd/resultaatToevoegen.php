<?php
$lijstZwemmers = '';
$teller = 1;
foreach ($zwemmers as $zwemmer) {
    $lijstZwemmers .= "<p>" . $zwemmer->naam . "</p>";
}
/*foreach ($reeksen as $reeks) {
    $lijstReeksen .= '<tr>
  <td>'
  .$teller.
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
        $lijstReeksen .= "<td>" . anchor('wedstrijd/verwijderReeks/' . $reeks->id, 'Reeks verwijderen', 'class="btn btn-danger"') . "</td></tr>";
    }
    $teller++;
}
    echo '<p>'.anchor('wedstrijd/maakReeks/' . $wedstrijdId, 'Reeks toevoegen', 'class="btn btn-success"').'
  </p>';

if ($reeksen != null) {
    echo "<div class=\"table-responsive\"><table class=\"table\">
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
  </tbody></table></div>";
} else {
    echo "<p>Er zijn voor deze wedstrijd nog geen reeksen</p>";
}*/
echo $lijstZwemmers;
echo anchor('Wedstrijd/index', 'Terug', 'class="btn btn-primary"');
