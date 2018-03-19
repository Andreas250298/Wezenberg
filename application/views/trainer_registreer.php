<?php
/**
 * Created by PhpStorm.
 * User: jordi
 * Date: 9-3-2018
 * Time: 13:12
 */

$dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam', 'aria-label' => 'Naam', 'size' => '30');
$dataInputEmail = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'email', 'id' => 'email', 'placeholder' => 'E-mail', 'aria-label' => 'E-mail', 'size' => '30');
$dataInputWachtwoord = array('class' => 'form-control mr-sm-2', 'type' => 'password', 'name' => 'wachtwoord', 'id' => 'wachtwoord', 'placeholder' => 'Wachtwoord', 'aria-label' => 'Wachtwoord', 'size' => '30');
$dataInputWoonplaats = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'woonplaats', 'id' => 'woonplaats', 'placeholder' => 'Woonplaats', 'aria-label' => 'Woonplaats', 'size' => '30');
$dataInputAdres = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'adres', 'id' => 'adres', 'placeholder' => 'Adres', 'aria-label' => 'Adres', 'size' => '30');
$dataInputSoortZwemmer = array('class' => 'form-control mr-sm-2', 'type' => 'radio', 'name' => 'soort', 'id' => 'soort', 'value' => 'zwemmer');
$dataInputSoortTrainer = array('class' => 'form-control mr-sm-2', 'type' => 'radio', 'name' => 'soort', 'id' => 'soort', 'value' => 'trainer');
$dataSubmit = array('class' => 'btn btn-outline-success my-2 my-sm0', 'value' => 'Registreren');

?>
<table>
    <?php echo form_open('trainer/controleerRegistratie', 'class="form-inline my2 my-lg0"'); ?>
    <tr>
        <td><?php echo form_label('Naam: ', 'naam'); ?></td>
        <td><?php echo form_input($dataInputNaam); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('E-mail: ', 'email'); ?></td>
        <td><?php echo form_input($dataInputEmail); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Wachtwoord: ', 'wachtwoord'); ?></td>
        <td><?php echo form_input($dataInputWachtwoord); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Woonplaats: ', 'woonplaats'); ?></td>
        <td><?php echo form_input($dataInputWoonplaats); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Adres: ', 'adres'); ?></td>
        <td><?php echo form_input($dataInputAdres); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Type gebruiker: ', 'soort'); ?></td>
        <td><?php echo form_input($dataInputSoortZwemmer); ?>Zwemmer</td>
        <td><?php echo form_input($dataInputSoortTrainer); ?>Trainer</td>
    </tr>
    <tr>
        <td><?php echo form_submit($dataSubmit); ?></td>
    </tr>
    <?php echo form_close(); ?>
</table>