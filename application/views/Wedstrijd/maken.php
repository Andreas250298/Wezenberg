<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam Wedstrijd', 'aria-label' => 'Titel', 'size' => '30');
    $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'plaats', 'id' => 'plaats', 'placeholder' => 'Plaats Wedstrijd', 'aria-label' => 'Plaats', 'size' => '30');
    $dataInputBeginDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'beginDatum', 'id' => 'beginDatum','size' => '30');
    $dataInputEindDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'eindDatum', 'id' => 'eindDatum','size' => '30');
    $dataInputLaatseInschrijvingDatum = array('class' => 'form-control mr-sm-2', 'type' => 'date', 'name' => 'laatsteInschrijvingDatum', 'id' => 'laatsteInschrijvingDatum','size' => '30');
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier de beschrijving van de wedstrijd', 'aria-label' => 'beschrijving', 'size' => '30');
    $dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');

echo form_open('Wedstrijd/registreer', 'class="form-group"');
echo "<div class='form-group'>";
echo form_label("Naam", 'naam') . "\n";
echo form_input($dataInputNaam) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Plaats", 'plaats') . "\n";
echo form_input($dataInputPlaats) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Start datum wedstrijd", 'beginDatum') . "\n";
echo form_input($dataInputBeginDatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Eind datum wedstrijd", 'eindDatum') . "\n";
echo form_input($dataInputEindDatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Laaste datum inschrijving", 'laatsteInschrijvingDatum') . "\n";
echo form_input($dataInputLaatseInschrijvingDatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Beschrijving", 'beschrijving') . "\n";
echo form_textarea($dataInputBeschrijving) . "\n";
echo "</div>";

echo form_submit($dataSubmit) . "";

echo form_close();
