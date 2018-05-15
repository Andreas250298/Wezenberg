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



foreach ($wedstrijden as $wedstrijd)
{
    if ($wedstrijd->beginDatum > date("Y-m-d"))
    {
        $lijstWedstrijden .= '<tr>
                                <td>' . anchor('Wedstrijd/info/' . $wedstrijd->id."/na", $wedstrijd->naam).'</td>
                                <td>' . $wedstrijd->plaats . '</td>
                                <td>' . zetOmNaarDDMMYYYY($wedstrijd->beginDatum) . '</td>
                                <td>' . zetOmNaarDDMMYYYY($wedstrijd->eindDatum) . '</td>
                            </tr>';
    } else {
        $lijstAfgelopenWedstrijden .= '<tr>
                                          <td>' . anchor('Wedstrijd/info/' . $wedstrijd->id."/voor", $wedstrijd->naam) . '</td>
                                          <td>' . $wedstrijd->plaats . '</td>
                                          <td>' . zetOmNaarDDMMYYYY($wedstrijd->beginDatum) . '</td>
                                          <td>' . zetOmNaarDDMMYYYY($wedstrijd->eindDatum) . '</td>
                                        </tr>';
    }
}
?>

<h2 class="startTitel">Open inschrijvingen</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Plaats</th>
                <th>Start</th>
                <th>Einde</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $lijstWedstrijden; ?>
        </tbody>
    </table>
</div>


<h2 class="startTitel">Voorbije inschrijvingen</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Plaats</th>
                <th>Start</th>
                <th>Einde</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $lijstAfgelopenWedstrijden; ?>
        </tbody>
    </table>
</div>

<p><a id="terug" href="javascript:history.go(-1);">Terug</a></p>
