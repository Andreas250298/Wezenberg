<?php

function haalArtikelsOp($nieuwsArtikels) {
    echo '<h2>Laatste nieuws</h2>';
    echo '<ul class="list-unstyled">';
    foreach ($nieuwsArtikels as $artikel) {
        echo '<a class="nieuwsartikels" href="#"><li class="media">';
        echo toonAfbeelding("image-placeholder.png", 'width="100" height="100" class="mr-3" alt="Placeholder image"');
        echo '<div class="media-body">';
        echo '<h5 class="mt-0 mb-1">' . $artikel->titel . '</h5>';
        echo $artikel->beschrijving;
        echo '</div>';
        echo '</li></a>';
    }
    echo '</ul>';
}

function haalAgendaOp($agendaItems) {
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
}

function haalPaginaInhoudOp($nieuwsArtikels, $gebruiker) {
    if ($gebruiker != null) {
        switch ($gebruiker->soort) {
            case 'zwemmer': // zwemmer
                haalArtikelsOp($nieuwsArtikels);
                break;
            case 'trainer': // trainer
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo anchor('Nieuws/index', '<i class="far fa-newspaper fa-3x fa-fw"></i> Nieuws beheren', 'class="beheerknop"');
                echo anchor('wedstrijd/beheerWedstrijden', '<i class="fas fa-trophy fa-3x fa-fw"></i> Wedstrijden beheren', 'class="beheerknop"');
                echo anchor('gebruiker/toonZwemmers', '<i class="fas fa-users fa-3x fa-fw"></i> Zwemmers beheren', 'class="beheerknop"');
                echo anchor('Trainer/index', '<i class="fas fa-info fa-3x fa-fw"></i> Info aanpassen', 'class="beheerknop"');
                echo '</div>';
                echo '<div class="col-md-6">';
                echo anchor('Trainer/index', '<i class="far fa-calendar-alt fa-3x fa-fw"></i> Activiteiten beheren', 'class="beheerknop"');
                echo anchor('Supplementen/index', '<i class="fas fa-medkit fa-3x fa-fw"></i> Supplementen toekennen', 'class="beheerknop"');
                echo anchor('Nieuws/index', '<i class="fas fa-medkit fa-3x fa-fw"></i> Supplementen beheren', 'class="beheerknop"');
                echo '</div>';
                echo '</div>';
                break;
        }
    } else {
        haalArtikelsOp($nieuwsArtikels);
    }
}
?>
<style>
    .row-striped:nth-of-type(odd){
        background-color: #efefef;
    }

    .row-striped:nth-of-type(even){
        background-color: #ffffff;
    }

    .row-striped {
        padding: 10px 0;
    }
    .nieuwsartikels{
        color: black;
    }
    th {
        height: 30px;
        text-align: center;
        font-weight: 700;
    }
    td {
        height: 50px;
    }
    .today {
        background: orange;
    }

    .beheerknop{
        padding: 20px;
        background-color: black;
        color: white;
        display: block;
        margin: 10px;
        border-radius: 10px;
    }

    .beheerknop:hover{
        background-color: #253555;
        color: white;
    }
</style>

<div class="row">
    <div class="col-12 col-lg-8">
        <?php
        haalPaginaInhoudOp($nieuwsArtikels, $gebruiker)
        ?>
    </div>
    <div class="col-12 col-lg-4">
        <div>
            <h3>Agenda</h3>
            <br>
            <?php
            haalAgendaOp($wedstrijden);
            ?>           
        </div>
    </div>
</div>