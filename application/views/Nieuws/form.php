<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($nieuwsArtikel)) {
    $dataInputTitel = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'titel', 'id' => 'titel', 'placeholder' => 'Titel', 'aria-label' => 'Titel', 'size' => '30', 'value' => $nieuwsArtikel->titel);
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier je artikel', 'aria-label' => 'beschrijving', 'size' => '30', 'value' => $nieuwsArtikel->beschrijving);
}
else {
    $dataInputTitel = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'titel', 'id' => 'titel', 'placeholder' => 'Titel', 'aria-label' => 'Titel', 'size' => '30');
$dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'name' => 'beschrijving', 'id' => 'beschrijving', 'placeholder' => 'Schrijf hier je artikel', 'aria-label' => 'beschrijving', 'size' => '30');

}
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');

echo form_open('Nieuws/registreer', 'class="form-group"');
echo "<div class='form-group'>";
echo form_label("Titel", 'titel') . "\n";
echo form_input($dataInputTitel) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Beschrijving", 'beschrijving') . "\n";
echo form_textarea($dataInputBeschrijving) . "\n";
echo "</div>";
if(isset($nieuwsArtikel)){
    echo form_hidden('id', $nieuwsArtikel->id);
}

echo form_submit($dataSubmit) . "";
echo anchor('Nieuws/index', "Terug", "Class='btn btn-primary my-2 my-sm0'");
echo form_close();