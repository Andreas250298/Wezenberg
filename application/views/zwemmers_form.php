<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<table>";
 echo form_open('trainer/controleerRegistratie', 'class="form-inline my2 my-lg0"');
$attributen = array('id' => 'mijnFormulier',
    'data-toggle' => 'validator',
    'role' => 'form');
echo form_open('brouwerij/registreer', $attributen);
?>
<tr>
    <td><div class="form-group">
    <?php
    echo form_labelpro('Naam', 'naam');
    echo form_input(array('name' => 'naam',
        'id' => 'naam', 
        'value' => $zwemmer->naam, 
        'class' => 'form-control', 
        'placeholder' => 'Naam', 
        'required' => 'required'));
    ?>
    <div class="help-block with-errors"></div>
        </div></td>
</tr>
<tr>
    <td>
<div class="form-group">
    <?php
    echo form_labelpro('Email', 'email');
    echo form_input(array('name' => 'email',
        'id' => 'email', 
        'value' => $zwemmer->email, 
        'class' => 'form-control', 
        'placeholder' => 'E-mail', 
        'required' => 'required'));
    ?>
    <div class="help-block with-errors"></div>
</div></td>
</tr>
<tr>
    <td><div class="form-group">
    <?php
    echo form_labelpro('Woonplaats', 'woonplaats');
    echo form_input(array('name' => 'werknemers',
        'id' => 'woonplaats', 
        'value' => $zwemmer->woonplaats, 
        'class' => 'form-control',
        'placeholder' => 'Woonplaats', 
        'required' => 'required'));
    ?>
    <div class="help-block with-errors"></div>
        </div></td>
</tr>
<tr>
    <td><div class="form-group">
    <?php
    echo form_labelpro('Adres', 'adres');
    echo form_input(array('name' => 'adres',
        'id' => 'adres', 
        'value' => $zwemmer->adres, 
        'class' => 'form-control',
        'required' => 'required'));
    ?>
    <div class="help-block with-errors"></div>
        </div></td>
</tr>
<tr>
    <td><div class="form-group">
    <?php echo form_submit('knop', 'Verzenden', "class='btn btn-primary'") ?>
        </div></td>
</tr>
<?php
echo form_close();
echo "</table>";

echo '<p>' . anchor('brouwerij', 'Terug') . '</p>';
?>
