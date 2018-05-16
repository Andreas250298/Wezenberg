<?php
/**
 * @file Wedstrijd/reeksen.php
 *
 * View waarin alle reeksen voor een bepaalde wedstrijd kan worden bekeken
 */
 echo "<h2 class=\"paginaTitel\">Reeksen beheren</h2>";
$lijstWedstrijden = '';
$teller = 1;

if (isset($reeksen)) {
    foreach ($reeksen as $reeks) {
        if (isset($deelnames)) {
            foreach ($deelnames as $deelname) {
                if ($deelname->reeksId == $reeks->id) {
                    $deelnameIds[] = $reeks->id;
                }
            }
        }

        if (!empty($deelnameIds) && in_array($reeks->id, $deelnameIds)) {
            // reeks tonen via $deelname
            foreach ($deelnames as $deelname) {
                if ($deelname->reeksId == $reeks->id) {
                    $lijstWedstrijden .= '<tr>
                                            <td>' . $teller . '</td>
                                            <td>' . zetOmNaarDDMMYYYY($deelname->reeks->datum) . '</td>
                                            <td>' . verkortTijdstip($deelname->reeks->tijdstip) . '</td>
                                            <td>' . $deelname->reeks->slag->soort . '</td>
                                            <td>' . $deelname->reeks->afstand->afstand . '</td></tr>';
                }
            }
        } else {
            // reeks tonen via $reeks
            $lijstWedstrijden .= '<tr>
                                    <td>' . $teller . '</td>
                                    <td>' . zetOmNaarDDMMYYYY($reeks->datum) . '</td>
                                    <td>' . verkortTijdstip($reeks->tijdstip) . '</td>
                                    <td>' . $reeks->slag->soort . '</td>
                                    <td>' . $reeks->afstand->afstand . '</td></tr>';
        }
        $teller++;
    }
}
    echo '<p>'.anchor('wedstrijd/maakReeks/' . $wedstrijdId."/".$tijd, 'Reeks toevoegen', 'class="btn btn-success"').'
  </p>';
  if ($reeksen != null) {
      echo "<div class=\"table-responsive\">
              <table class=\"table\">
                  <thead>
                      <tr>
                          <th>Reeksnummer</th>
                          <th>Datum</th>
                          <th>Tijdstip</th>
                          <th>Slag</th>
                          <th>Afstand</th>
                      </tr>
                  </thead>
                  <tbody>
                      $lijstWedstrijden
                  </tbody>
              </table>
          </div>";
  } else {
      echo "<p>Er zijn voor deze wedstrijd nog geen reeksen</p>";
  }
echo anchor('Wedstrijd/bekijkenWedstrijden/' .$tijd, 'Terug', 'class="btn btn-primary"');
  echo "<br/><br/>";
