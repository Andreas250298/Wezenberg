<?php

function haalArtikelsOp($nieuwsArtikels)
{
    echo '<h2 class="startTitel">Laatste nieuws</h2>';
    echo '<a href="#" class="scrollknop text-center"><i class="fas fa-caret-up fa-2x"></i></a>';
    echo '<ul class="list-unstyled">';
    foreach ($nieuwsArtikels as $artikel) {
        echo '<p class="nieuwsartikel"><li class="media">';
        echo toonAfbeelding("image-placeholder.png", 'width="100" height="100" class="mr-3" alt="Placeholder image"');
        echo '<div class="media-body">';
        echo '<h5 class="mt-0 mb-1">' . $artikel->titel . '</h5>';
        echo substr($artikel->beschrijving, 0, 144) . '...';
        echo anchor('Nieuws/bekijk/' . $artikel->id, 'verder lezen');
        echo '</div>';
        echo '</li></p>';
    }
    echo '</ul>';
    echo '<a href="#" class="scrollknop text-center"><i class="fas fa-caret-down fa-2x"></i></a>';
}

function haalAgendaOp($agendaItems)
{
    echo '<a href="#" class="scrollknop text-center"><i class="fas fa-caret-up fa-2x"></i></a>';
    echo '<div class="col">';
    foreach ($agendaItems as $agendaItem) {
        echo '<div class="row row-striped">';
        echo '<div class="col-3 text-right">';
        echo '<h2><span class="badge badge-secondary">' . date('d', strtotime($agendaItem->beginDatum)) . '</span></h2>';
        echo '<h4>' . strtoupper(date('M', strtotime($agendaItem->beginDatum))) . '</h4>';
        echo '</div>';
        echo '<div class="col-9">';
        echo '<h5 class="text-uppercase">' . $agendaItem->naam . '</h5>';
        echo '<ul class="list-inline">';
        echo '<li class="list-inline-item"><i class="fa fa-calendar" aria-hidden="true"></i> ' . date('l', strtotime($agendaItem->beginDatum)) . '</li>';
        echo '<li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> ' . $agendaItem->plaats . '</li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<a href="#" class="scrollknop text-center"><i class="fas fa-caret-down fa-2x"></i></a>';
}

function haalOpenInschrijvingenOp($wedstrijden)
{
    echo '<h2 class="startTitel">Openstaande Inschrijvingen</h2>';
    echo '<ul class="list-unstyled">';
    $dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Inschrijven');
    $attributen = array('id' => 'mijnFormulier',
        'class' => 'form-inline my2 my-lg0',
        'data-toggle' => 'validator',
        'role' => 'form');
    $i = 0;
    foreach ($wedstrijden as $wedstrijd) {
        $i++;
        echo '<li class="media inschrijving">';
        echo '<div class="row media-body">';
        echo '<div class="col-2 text-right">';
        echo '<h2><span class="badge badge-secondary">' . date('d', strtotime($wedstrijd->beginDatum)) . '</span></h2>';
        echo '<h4>' . strtoupper(date('M', strtotime($wedstrijd->beginDatum))) . '</h4>';
        echo '</div>';
        echo '<div class="col-8">';
        echo '<h5 class="mt-0 mb-1">' . $wedstrijd->naam . '</h5>';
        echo $wedstrijd->beginDatum . ' - ' . $wedstrijd->eindDatum;
        echo '</div>';
        echo '<div class="col-2">';
        echo form_open('Wedstrijd/inschrijven', 'class="form-group"', $attributen);
        echo form_submit($dataSubmit);
        echo form_close();
        echo '</div>';
        echo '</div>';
        echo '</li>';

        if ($i == 2) {
            break;
        }
    }
    echo '</ul>';
    echo anchor('wedstrijd/inschrijvingen', 'Alle openstaande inschrijvingen bekijken', 'class="scrollknop text-center"');
}

function haalPaginaInhoudOp($trainingscentrum, $nieuwsArtikels, $gebruiker, $wedstrijden)
{
    if ($gebruiker != null) {
        switch ($gebruiker->soort) {
            case 'zwemmer': // zwemmer
                haalOpenInschrijvingenOp($wedstrijden);
                haalArtikelsOp($nieuwsArtikels);
                break;
            case 'trainer': // trainer
                echo '<h2 class="startTitel">Dashboard Trainer</h2>';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo anchor('Nieuws/index', '<i class="far fa-newspaper fa-3x fa-fw"></i> Nieuws beheren', 'class="beheerknop"');
                echo anchor('wedstrijd/beheerWedstrijden', '<i class="fas fa-trophy fa-3x fa-fw"></i> Wedstrijden beheren', 'class="beheerknop"');
                echo anchor('gebruiker/toonZwemmers', '<i class="fas fa-users fa-3x fa-fw"></i> Zwemmers beheren', 'class="beheerknop"');
                echo anchor('trainingscentrum/aanpassen', '<i class="fas fa-info fa-3x fa-fw"></i> Info aanpassen', 'class="beheerknop"');
                echo '</div>';
                echo '<div class="col-md-6">';
                echo anchor('Activiteiten/index', '<i class="far fa-calendar-alt fa-3x fa-fw"></i> Activiteiten beheren', 'class="beheerknop"');
                echo anchor('supplement/supplementenPerZwemmerTrainer', '<i class="fas fa-medkit fa-3x fa-fw"></i> Supplementen toekennen', 'class="beheerknop"');
                echo anchor('Supplement/beheerSupplementen', '<i class="fas fa-medkit fa-3x fa-fw"></i> Supplementen beheren', 'class="beheerknop"');
                echo '</div>';
                echo '</div>';
                break;
        }
    } else {
        echo '<div><h2 class="startTitel">Welkom</h2>';
        echo $trainingscentrum->beschrijvingWelkom;
        echo '</div>';
        haalArtikelsOp($nieuwsArtikels);
    }
}
?>
<style>
    .helpBar{
        margin: 20px 0 10px 0;
        display: block;
        padding: 10px;
        background-color: lightgray;
        border: 1px solid darkgray;
        border-radius: 10px;
    }
    .tab {
        display:inline-block;
        margin-left: 20px;
    }
</style>
<div class="row">
    <div class="col-12 col-lg-8">
        <?php
        haalPaginaInhoudOp($trainingscentrum, $nieuwsArtikels, $gebruiker, $wedstrijden)
        ?>
    </div>
    <div class="col-12 col-lg-4">
        <h2 class="startTitel">Agenda</h2>
        <?php
        haalAgendaOp($wedstrijden);
        ?>
        <div class="alert alert-dark" role="alert">
            <i class="far fa-question-circle fa-2x"></i><span class="tab">Nieuw hier? <?php echo anchor('home/demo', "Bekijk de demo", "") ?>
        </div>
    </div>

</div>
