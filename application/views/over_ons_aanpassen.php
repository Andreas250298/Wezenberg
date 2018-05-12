<?php
/**
 * @file over_ons_aanpassen.php
 *
 * View waarin de informatie over het trainingscentrum Wezenberg aangepast kan worden.
 * - Krijgt een $trainingscentrum-object binnen
 * - Wijzigingen gebeuren in de controller Trainingscentrum.php
 */
echo  "<h2 class=\"paginaTitel\">Over ons pagina aanpassen</h2>";
echo anchor('nieuws/index', 'Terug', "Class='btn btn-primary my-2 my-sm0'");
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');
?>

<div class="form-row col-12">
    <?php echo form_open_multipart('trainingscentrum/registreer', 'class="col-12"') ?>
    <div class=" col-12 overOns form-group">
        <?php
        echo form_label("Pas welkomtekst aan", 'welkom') . "\n";
        echo form_textarea('beschrijvingWelkom', $trainingscentrum->beschrijvingWelkom, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo '<input type="file" name="welkom" size="20" />'; ?>
    </div>
    <div class="col-12 overOns form-group">
        <?php
        echo form_label("Pas locatietekst aan", 'locatie') . "\n";
        echo form_textarea('beschrijvingLocatie', $trainingscentrum->beschrijvingLocatie, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo '<input type="file" name="locatie" size="20" />'; ?>
    </div>
    <div class="col-12 overOns form-group">
        <?php
        echo form_label("Pas teamtekst aan", 'team') . "\n";
        echo form_textarea('beschrijvingTeam', $trainingscentrum->beschrijvingTeam, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo '<input type="file" name="team" size="20" />'; ?>
    </div>
    <div class="col-12 overOns form-group">
        <?php
        echo form_label("Pas trainertekst aan", 'welkom') . "\n";
        echo form_textarea('beschrijvingTrainer', $trainingscentrum->beschrijvingTrainer, 'class="form-control"');
        ?>
    </div>
    <div class="col-12 form-group">
        <?php echo '<input type="file" name="trainer" size="20" />'; ?>
    </div>

    <?php echo form_submit($dataSubmit) . "";
    echo form_close();
    ?>
</div>
