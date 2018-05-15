<?php
/**
 * @file zwemmers_wachtwoord.php
 *
 * View waarin zwemmers hun wachtwoord kunnen worden aangepast
 */
$attributen = array('id' => 'mijnFormulier',
    'class' => 'form-inline my2 my-lg0',
    'data-toggle' => 'validator',
    'role' => 'form');
    $dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');
    $dataInputWachtwoord = array('class' => 'form-control mr-sm-2', 'type' => 'password', 'name' => 'wachtwoord', 'id' => 'wachtwoord', 'placeholder' => 'Wachtwoord', 'aria-label' => 'Wachtwoord', 'size' => '30', 'required' => 'required');
    $dataInputWachtwoordBevestig = array('class' => 'form-control mr-sm-2', 'type' => 'password', 'name' => 'wachtwoordBevestig', 'id' => 'wachtwoordBevestig', 'placeholder' => 'Wachtwoord', 'aria-label' => 'WachtwoordBevestig', 'size' => '30', 'required' => 'required');
    echo form_open_multipart('Gebruiker/registreerWachtwoord', 'class="form-group"', $attributen);
    echo "<div class='form-group'>";
    echo form_labelpro('Wachtwoord: ', 'wachtwoord');
    echo form_input($dataInputWachtwoord);
    echo "</div>";
    echo "<div class='form-group'>";
    echo form_labelpro('Wachtwoord bevestigen: ', 'wachtwoordBevestig');
    echo form_input($dataInputWachtwoordBevestig);
    echo "<div id='waarschuwingWachtwoorden' class='alert alert-danger'>Wachtwoorden komen niet overeen!</div>";
    echo "</div>";
    echo form_hidden('id', $zwemmer->id);
    echo form_submit($dataSubmit) . " ";
    if ($gebruiker->soort == 'trainer') {
        echo anchor('gebruiker/toonZwemmers', 'Terug', "Class='btn btn-primary my-2 my-sm0 buttonMargin'");
    } else {
        echo anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, 'Terug', "Class='btn btn-primary my-2 my-sm0 buttonMargin'");
    }
    echo form_close();

    echo "<script src='" . base_url() . "assets/js/registreren.js' type='text/javascript'></script>";
 ?>
