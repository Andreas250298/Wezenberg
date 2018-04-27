<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($wedstrijd)) {
    $dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'value' => $wedstrijd->naam, 'name' => 'reeks', 'id' => 'reeks', 'placeholder' => 'Reeks', 'aria-label' => 'Reeks', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier de reeks van de wedstrijd in.');
    $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'value' => $wedstrijd->plaats,'name' => 'datum', 'id' => 'datum', 'placeholder' => 'Datum Wedstrijd', 'aria-label' => 'Datum', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul de datum van de reeks in.');
    $dataInputBeginDatum = array('class' => 'form-control mr-sm-2', 'value' => $wedstrijd->beginDatum,'type' => 'text', 'name' => 'tijdstip', 'id' => 'tijdstip','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier het tijdstip in van de reeks.');
    $dataInputEindDatum = array('class' => 'form-control mr-sm-2', 'value' => $wedstrijd->eindDatum,'type' => 'date', 'name' => 'eindDatum', 'id' => 'eindDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de einddatum in van de wedstrijd(deze kan verschillen van de begindatum).');
    $dataInputLaatseInschrijvingDatum = array('class' => 'form-control mr-sm-2', 'value' => $wedstrijd->laatsteInschrijvingDatum,'type' => 'date', 'name' => 'laatsteInschrijvingDatum', 'id' => 'laatsteInschrijvingDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de uiterste datum waarop zwemmers zich kunnen inschrijven voor deze wedstrijd.');
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'value' => $wedstrijd->beschrijving,'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier de beschrijving van de wedstrijd', 'aria-label' => 'beschrijving', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier een beschrijving voor deze wedstrijd.');
} else {
    $dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'reeks', 'id' => 'reeks', 'placeholder' => 'Reeks', 'aria-label' => 'Reeks', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier de reeks van de wedstrijd in.');
    $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'datum', 'id' => 'datum', 'placeholder' => 'Datum Wedstrijd', 'aria-label' => 'Datum', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul de datum van de reeks in.');
    $dataInputBeginDatum = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'tijdstip', 'id' => 'tijdstip','placeholder' => 'Tijdstip reeks','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Vul hier het tijdstip in van de reeks.');
    $dataInputEindDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'eindDatum', 'id' => 'eindDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de einddatum in van de wedstrijd(deze kan verschillen van de begindatum).');
    $dataInputLaatseInschrijvingDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'laatsteInschrijvingDatum', 'id' => 'laatsteInschrijvingDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de uiterste datum waarop zwemmers zich kunnen inschrijven voor deze wedstrijd.');
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier de beschrijving van de wedstrijd', 'aria-label' => 'beschrijving', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier een beschrijving voor deze wedstrijd.');
    $dataInputAfstand = array('class' => 'form-control mr-sm-2', 'name' => 'afstand', 'id' => 'afstand', 'placeholder' => 'Afstand', 'aria-label' => 'afstand', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de afstand van de wedstrijd.');
    $dataInputSlag = array('class' => 'form-control mr-sm-2', 'name' => 'slag', 'id' => 'slag', 'placeholder' => 'Slag', 'aria-label' => 'slag', 'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'Geef hier de slag van de reeks.');
}
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');
echo form_open('Wedstrijd/registreerReeks', 'class="form-group"');
echo "<div class='form-group'>";
echo form_label("Reeks", 'reeks') . "\n";
echo form_input($dataInputNaam) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Datum", 'datum') . "\n";
echo form_input($dataInputPlaats) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Tijdstip", 'tijdstip') . "\n";
echo form_input($dataInputBeginDatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Afstand ", 'afstand') . "\n";
echo "<select name='afstand' id='afstand'>";
foreach ($afstanden as $afstand) {
    echo "<option value='" . $afstand->id . "'>" . $afstand->afstand . "</option>\n";
}
echo "</select>";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Slag ", 'slag') . "\n";
echo "<select name='slag' id='slag'>";
foreach ($slagen as $slag) {
    echo "<option value='" . $slag->id . "'>" . $slag->soort . "</option>\n";
}
echo "</select>";
echo "</div>";
echo form_hidden('id', '6');
echo form_submit($dataSubmit) . " ";

echo form_close();
