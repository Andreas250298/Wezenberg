<?php
/**
 * @file Wedstrijd/maakReeks.php
 *
 * View waarin een reeks kan gemaakt worden voor een bepaalde wedstrijd
 */
if (isset($reeks)) {
    $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'value' => $reeks->datum,'name' => 'datum', 'id' => 'datum', 'placeholder' => 'Datum Wedstrijd', 'aria-label' => 'Datum', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul de datum van de reeks in.');
    $dataInputBeginDatum = array('class' => 'form-control mr-sm-2', 'value' => $reeks->tijdstip,'type' => 'time', 'name' => 'tijdstip', 'id' => 'tijdstip','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier het tijdstip in van de reeks.');
    $dataInputEindDatum = array('class' => 'form-control mr-sm-2', 'value' => $reeks->datum,'type' => 'date', 'name' => 'eindDatum', 'id' => 'eindDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de einddatum in van de wedstrijd(deze kan verschillen van de begindatum).');
    $dataInputLaatseInschrijvingDatum = array('class' => 'form-control mr-sm-2', 'value' => $wedstrijd->laatsteInschrijvingDatum,'type' => 'date', 'name' => 'laatsteInschrijvingDatum', 'id' => 'laatsteInschrijvingDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de uiterste datum waarop zwemmers zich kunnen inschrijven voor deze wedstrijd.');
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'value' => $wedstrijd->beschrijving,'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier de beschrijving van de wedstrijd', 'aria-label' => 'beschrijving', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier een beschrijving voor deze wedstrijd.');
} else {
    $dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'reeks', 'id' => 'reeks', 'placeholder' => 'Reeks', 'aria-label' => 'Reeks', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier de reeks van de wedstrijd in.');
    $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'datum', 'id' => 'datum', 'placeholder' => 'Datum Wedstrijd', 'aria-label' => 'Datum', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul de datum van de reeks in.');
    $dataInputBeginDatum = array('class' => 'form-control mr-sm-2', 'type' => 'time', 'name' => 'tijdstip', 'id' => 'tijdstip','placeholder' => 'Tijdstip reeks','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier het tijdstip in van de reeks.');
    $dataInputEindDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'eindDatum', 'id' => 'eindDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de einddatum in van de wedstrijd(deze kan verschillen van de begindatum).');
    $dataInputLaatseInschrijvingDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'laatsteInschrijvingDatum', 'id' => 'laatsteInschrijvingDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de uiterste datum waarop zwemmers zich kunnen inschrijven voor deze wedstrijd.');
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier de beschrijving van de wedstrijd', 'aria-label' => 'beschrijving', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier een beschrijving voor deze wedstrijd.');
    $dataInputAfstand = array('class' => 'form-control mr-sm-2', 'name' => 'afstand', 'id' => 'afstand', 'placeholder' => 'Afstand', 'aria-label' => 'afstand', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de afstand van de wedstrijd.');
    $dataInputSlag = array('class' => 'form-control mr-sm-2', 'name' => 'slag', 'id' => 'slag', 'placeholder' => 'Slag', 'aria-label' => 'slag', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de slag van de reeks.');
}
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');
echo form_open('Wedstrijd/registreerReeks/'.$tijd, 'class="form-group"');
echo "<div class='form-group'>\n";
echo form_label("Datum", 'datum') . "\n";
echo form_input($dataInputPlaats) . "\n";
echo "</div\n>";
echo "<div class='form-group'>\n";
echo form_label("Tijdstip", 'tijdstip') . "\n";
echo form_input($dataInputBeginDatum) . "\n";
echo "</div>\n";
echo "<div class='form-group'>\n\t";
echo form_label("Afstand ", 'afstand') . "\n\t";
echo "<select name='afstand' id='afstand'>\n";
foreach ($afstanden as $afstand) {
    echo "\t\t<option value='" . $afstand->id . "'>" . $afstand->afstand . "</option>\n";
}
echo "\t</select>\n";
echo "</div>\n";
echo "<div class='form-group'>\n\t";
echo form_label("Slag ", 'slag') . "\n\t";
echo "<select name='slag' id='slag'>\n";
foreach ($slagen as $slag) {
    echo "\t\t<option value='" . $slag->id . "'>" . $slag->soort . "</option>\n";
}
echo "\t</select>\n";
echo "</div>\n";
if (isset($reeks)) {
    echo form_hidden('id', $reeks->id);
}
echo form_hidden('wedstrijdId', $wedstrijd->id);
echo form_submit($dataSubmit) . " ";

echo form_close();
