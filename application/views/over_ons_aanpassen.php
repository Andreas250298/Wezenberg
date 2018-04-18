<?php
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');
?>

<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway');

    .overOns{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .overOns h2{
        font-family: 'Raleway', sans-serif;
        font-weight: bold;
    }
</style>
<div class="form-row">
    <?php echo form_open('trainingscentrum/registreer', '') ?>
    <div class=" col-sm-8 overOns form-group">
        <?php
        echo form_label("Pas welkomtekst aan", 'welkom') . "\n";
        echo form_textarea('beschrijvingWelkom', $trainingscentrum->beschrijvingWelkom, 'class="form-control"');
        ?>
    </div>
    <div class="col-sm-4 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="form-control"'); ?>
        <?php echo form_button('wijzig', 'Wijzigen', 'class="form-control"'); ?>
    </div>
    <div class="col-sm-8 overOns form-group">
        <?php
        echo form_label("Pas locatietekst aan", 'locatie') . "\n";
        echo form_textarea('beschrijvingLocatie', $trainingscentrum->beschrijvingLocatie, 'class="form-control"');
        ?>
    </div>
    <div class="col-sm-4 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="form-control"'); ?>
        <?php echo form_button('wijzig', 'Wijzigen', 'class="form-control"'); ?>
    </div>
    <div class="col-sm-8 overOns form-group">
        <?php
        echo form_label("Pas teamtekst aan", 'team') . "\n";
        echo form_textarea('beschrijvingTeam', $trainingscentrum->beschrijvingTeam, 'class="form-control"');
        ?>
    </div>
    <div class="col-sm-4 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="form-control"'); ?>
        <?php echo form_button('wijzig', 'Wijzigen', 'class="form-control"'); ?>
    </div>
    <div class="col-sm-8 overOns form-group">
        <?php
        echo form_label("Pas trainertekst aan", 'welkom') . "\n";
        echo form_textarea('beschrijvingTrainer', $trainingscentrum->beschrijvingTrainer, 'class="form-control"');
        ?>
    </div>
    <div class="col-sm-4 form-group">
        <?php echo form_button('afbeelding', 'Nieuwe afbeelding', 'class="form-control"'); ?>
        <?php echo form_button('wijzig', 'Wijzigen', 'class="form-control"'); ?>
    </div>

    <?php echo form_submit($dataSubmit) . "";
    echo form_close();
    ?>
</div>