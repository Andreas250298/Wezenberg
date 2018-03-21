<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dataInputNaam = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam', 'aria-label' => 'Naam', 'size' => '30', 'required' => 'required');
$dataInputEmail = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'email', 'id' => 'email', 'placeholder' => 'E-mail', 'aria-label' => 'E-mail', 'size' => '30', 'required' => 'required', 'data-error' => 'Ongeldig e-mailadres');
$dataInputWachtwoord = array('class' => 'form-control mr-sm-2', 'type' => 'password', 'name' => 'wachtwoord', 'id' => 'wachtwoord', 'placeholder' => 'Wachtwoord', 'aria-label' => 'Wachtwoord', 'size' => '30', 'required' => 'required');
$dataInputWoonplaats = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'woonplaats', 'id' => 'woonplaats', 'placeholder' => 'Woonplaats', 'aria-label' => 'Woonplaats', 'size' => '30', 'required' => 'required');
$dataInputAdres = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'adres', 'id' => 'adres', 'placeholder' => 'Adres', 'aria-label' => 'Adres', 'size' => '30', 'required' => 'required');
$dataSubmit = array('class' => 'btn btn-outline-success my-2 my-sm0', 'value' => 'Registreren');
echo haalJavascriptOp("validator.js");
?>
<table>
    <?php echo form_open('trainer/controleerRegistratie', 'class="form-inline my2 my-lg0"'); ?>
    <tr>
        <td>
            <div class="form-group">
                <?php echo form_labelpro('Naam: ', 'naam'); 
                echo '</td><td>';
                echo form_input($dataInputNaam); 
                ?>
            </td>
                <div class="help-block with-errors"></div>
            </div>
    </tr>
    <tr>
        <div class="form-group">
        <td><?php echo form_labelpro('E-mail: ', 'email'); ?></td>
        <td><?php echo form_input($dataInputEmail); ?></td>
        <div class="help-block with-errors"></div>
        </div>
    </tr>
    <tr>
        <td><?php echo form_labelpro('Wachtwoord: ', 'wachtwoord'); ?></td>
        <td><?php echo form_input($dataInputWachtwoord); ?></td>
    </tr>
    <tr>
        <td><?php echo form_labelpro('Woonplaats: ', 'woonplaats'); ?></td>
        <td><?php echo form_input($dataInputWoonplaats); ?></td>
    </tr>
    <tr>
        <td><?php echo form_labelpro('Adres: ', 'adres'); ?></td>
        <td><?php echo form_input($dataInputAdres); ?></td>
    </tr>
    <tr>
        <td><?php echo form_submit($dataSubmit); ?></td>
    </tr>
    <?php echo form_close(); ?>
</table>

<?php echo '<p>' . anchor('gebruiker/toonZwemmers', 'Terug') . '</p>';?>