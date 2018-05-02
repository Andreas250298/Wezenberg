<?php
/**
 * @file over_ons_aanpassen.php
 * 
 * View waarin de informatie over het trainingscentrum Wezenberg aangepast kan worden.
 * - Krijgt een $trainingscentrum-object binnen
 * - Wijzigingen gebeuren in de controller Trainingscentrum.php
 */

$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');
?>

<div class="form-row col-12">
    <?php echo form_open('trainingscentrum/registreer', 'class="col-12"') ?>
    <div class=" col-12 overOns form-group">
        <?php
        echo form_label("Pas welkomtekst aan", 'welkom') . "\n";
        echo form_textarea('beschrijvingWelkom', $trainingscentrum->beschrijvingWelkom, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="btn-primary btn"'); ?>
    </div>
    <div class="col-12 overOns form-group">
        <?php
        echo form_label("Pas locatietekst aan", 'locatie') . "\n";
        echo form_textarea('beschrijvingLocatie', $trainingscentrum->beschrijvingLocatie, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="btn-primary btn"'); ?>
    </div>
    <div class="col-12 overOns form-group">
        <?php
        echo form_label("Pas teamtekst aan", 'team') . "\n";
        echo form_textarea('beschrijvingTeam', $trainingscentrum->beschrijvingTeam, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="btn-primary btn"'); ?>
    </div>
    <div class="col-12 overOns form-group">
        <?php
        echo form_label("Pas trainertekst aan", 'welkom') . "\n";
        echo form_textarea('beschrijvingTrainer', $trainingscentrum->beschrijvingTrainer, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="btn-primary btn"'); ?>
    </div>

    <?php echo form_submit($dataSubmit) . "";
    echo form_close();
    ?>
</div>
