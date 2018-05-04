<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo haalJavascriptOp("validator.js");
echo "<table>";
$attributen = array('id' => 'mijnFormulier',
    'class' => 'form-inline my2 my-lg0',
    'data-toggle' => 'validator',
    'role' => 'form');

if (isset($zwemmer)) {
    $dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam', 'aria-label' => 'Naam', 'size' => '30', 'value' => $zwemmer->naam);
    $dataInputEmail = array('class' => 'form-control mr-sm-2', 'name' => 'email', 'id' => 'email', 'placeholder' => 'E-mail', 'aria-label' => 'Email', 'size' => '30', 'value' => $zwemmer->email);
    $dataInputWoonplaats = array('class' => 'form-control mr-sm-2', 'name' => 'woonplaats', 'id' => 'woonplaats', 'placeholder' => 'Woonplaats', 'aria-label' => 'Woonplaats', 'size' => '30', 'value' => $zwemmer->woonplaats);
    $dataInputAdres = array('class' => 'form-control mr-sm-2', 'name' => 'adres', 'id' => 'adres', 'placeholder' => 'Adres', 'aria-label' => 'Adres', 'size' => '30', 'value' => $zwemmer->adres);
    $dataInputGeboortedatum = array('class' => 'form-control mr-sm-2', 'type' => 'date','name' => 'geboortedatum', 'id' => 'geboortedatum', 'placeholder' => 'Geboortedatum', 'aria-label' => 'Geboortedatum', 'size' => '30', 'value' => $zwemmer->geboortedatum);
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'type' => 'textarea','name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Beschrijving', 'aria-label' => 'Beschrijving', 'size' => '30', 'value' => $zwemmer->beschrijving);
} else {
    $dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam', 'aria-label' => 'Naam', 'size' => '30');
    $dataInputEmail = array('class' => 'form-control mr-sm-2', 'name' => 'email', 'id' => 'email', 'placeholder' => 'E-mail', 'aria-label' => 'Email', 'size' => '30');
    $dataInputWoonplaats = array('class' => 'form-control mr-sm-2', 'name' => 'woonplaats', 'id' => 'woonplaats', 'placeholder' => 'Woonplaats', 'aria-label' => 'Woonplaats', 'size' => '30');
    $dataInputAdres = array('class' => 'form-control mr-sm-2', 'name' => 'adres', 'id' => 'adres', 'placeholder' => 'Adres', 'aria-label' => 'Adres', 'size' => '30');
    $dataInputGeboortedatum = array('class' => 'form-control mr-sm-2', 'type' => 'date','name' => 'geboortedatum', 'id' => 'geboortedatum', 'placeholder' => 'Geboortedatum', 'aria-label' => 'Geboortedatum', 'size' => '30');
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'type' => 'textarea','name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Beschrijving', 'aria-label' => 'Beschrijving', 'size' => '30');
}
    $dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');

echo form_open_multipart('Gebruiker/registreer', 'class="form-group"', $attributen);
echo "<div class='form-group'>";
echo form_labelpro("Naam", 'naam') . "\n";
echo form_input($dataInputNaam) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("E-mail", 'email') . "\n";
echo form_input($dataInputEmail) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Woonplaats", 'woonplaats') . "\n";
echo form_input($dataInputWoonplaats) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Adres", 'adres') . "\n";
echo form_input($dataInputAdres) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Geboortedatum", 'geboortedatum') . "\n";
echo form_input($dataInputGeboortedatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Beschrijving", 'beschrijving') . "\n";
echo form_textarea($dataInputBeschrijving) . "\n";
echo '<input type="file" name="userfile" size="20" />';
echo "</div>";
if (isset($zwemmer)) {
    echo form_hidden('id', $zwemmer->id);
} else {
    echo form_hidden('id', null);
}

echo form_submit($dataSubmit) . " ";
if ($gebruiker->soort == 'trainer') {
  echo '<p>' . anchor('gebruiker/toonZwemmers', 'Terug', "Class='btn btn-primary my-2 my-sm0'") . '</p>';
} else {
echo '<p>' . anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, 'Terug', "Class='btn btn-primary my-2 my-sm0'") . '</p>';
}
echo form_close();
echo "</table>";
