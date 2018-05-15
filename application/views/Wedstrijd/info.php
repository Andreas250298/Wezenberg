<?php
/**
 * @file Wedstrijd/info.php
 *
 * View waarin informatie te zien is over een bepaalde wedstrijd.
 */

$teller = 1;
$lijstWedstrijden = "";
$deelnameIds;
echo "<h1 class='title'>" . $wedstrijd->naam . "</h1>";
echo "<p>" . $wedstrijd->beschrijving . "</p>";

if (isset($reeksen)) {
    foreach ($reeksen as $reeks) {

        foreach ($deelnames as $deelname) {
            if ($deelname->reeksId == $reeks->id) {
                $deelnameIds[] = $reeks->id;
            }
        }

        if (!empty($deelnameIds) && in_array($reeks->id, $deelnameIds)) {
            // reeks tonen via $deelname
            foreach ($deelnames as $deelname) {
                if ($deelname->reeksId == $reeks->id) {
                    $lijstWedstrijden .= '<tr>
                                            <td>' . $teller . '</td>
                                            <td>' . $deelname->reeks->slag->soort . '</td>
                                            <td>' . $deelname->reeks->afstand->afstand . '</td>
                                            <td>' . verkortTijdstip($deelname->reeks->tijdstip) . '</td>';
                    switch ($deelname->statusId) {
                        case 1:
                            $lijstWedstrijden .= '<td>In behandeling</td>
                                                  <td>Inschrijven is op dit moment niet mogelijk</td>';
                            break;
                        case 2:
                            $lijstWedstrijden .= '<td>Geaccepteerd</td>
                                                  <td>Inschrijven is op dit moment niet mogelijk</td>';
                            break;
                        case 3:
                            $lijstWedstrijden .= '<td>Geweigerd</td>
                                                  <td>Inschrijven is op dit moment niet mogelijk</td>';
                            break;
                        case 4:
                            $lijstWedstrijden .= '<td>Open</td>
                                                  <td>' . anchor('Wedstrijd/inschrijven/' . $deelname->reeks->id . '/1', 'Inschrijven') . '</td>';
                            break;
                    }
                    $lijstWedstrijden .= '</tr>';
                    $teller++;
                }
            }
        } else {
            // reeks tonen via $reeks
            $lijstWedstrijden .= '<tr>
                                    <td>' . $teller . '</td>
                                    <td>' . $reeks->slag->soort . '</td>
                                    <td>' . $reeks->afstand->afstand . '</td>
                                    <td>' . verkortTijdstip($reeks->tijdstip) . '</td>
                                    <td>Open</td>
                                    <td>' . anchor('Wedstrijd/inschrijven/' . $reeks->id . '/1', 'Inschrijven') . '</td>
                                </tr>';
            $teller++;
        }
    }
}

if ($reeksen != null)
{
    echo "<div class=\"table-responsive\">
            <table class=\"table\">
                <thead>
                    <tr>
                        <th>Reeksnummer</th>
                        <th>Slag</th>
                        <th>Afstand</th>
                        <th>Tijdstip</th>
                        <th>Status</th>
                        <th>Inschrijving</th>
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
;?>

<a id="terug" href="javascript:history.go(-1);" class="btn btn-primary">Terug</a>
</br></br>
