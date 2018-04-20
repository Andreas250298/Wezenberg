<?php

function haalArtikelsOp($nieuwsArtikels) {
    echo '<h2 class="startTitel">Laatste nieuws</h2>';
    echo '<a href="#" class="scrollknop text-center"><i class="fas fa-caret-up fa-2x"></i></a>';
    echo '<ul class="list-unstyled">';
    foreach ($nieuwsArtikels as $artikel) {
        echo '<a class="nieuwsartikel" href="#"><li class="media">';
        echo toonAfbeelding("image-placeholder.png", 'width="100" height="100" class="mr-3" alt="Placeholder image"');
        echo '<div class="media-body">';
        echo '<h5 class="mt-0 mb-1">' . $artikel->titel . '</h5>';
        echo substr($artikel->beschrijving, 0, 144). '...';
        echo '</div>';
        echo '</li></a>';
    }
    echo '</ul>';
    echo '<a href="#" class="scrollknop text-center"><i class="fas fa-caret-down fa-2x"></i></a>';
}

function haalAgendaOp($agendaItems) {
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

function haalPaginaInhoudOp($trainingscentrum, $nieuwsArtikels, $gebruiker) {
    if ($gebruiker != null) {
        switch ($gebruiker->soort) {
            case 'zwemmer': // zwemmer
                echo '<div><h2 class="startTitel">Welkom</h2>';
                echo $trainingscentrum->beschrijvingWelkom;
                echo '</div>';
                haalArtikelsOp($nieuwsArtikels);
                break;
            case 'trainer': // trainer
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo anchor('Nieuws/index', '<i class="far fa-newspaper fa-3x fa-fw"></i> Nieuws beheren', 'class="beheerknop"');
                echo anchor('wedstrijd/beheerWedstrijden', '<i class="fas fa-trophy fa-3x fa-fw"></i> Wedstrijden beheren', 'class="beheerknop"');
                echo anchor('gebruiker/toonZwemmers', '<i class="fas fa-users fa-3x fa-fw"></i> Zwemmers beheren', 'class="beheerknop"');
                echo anchor('trainingscentrum/aanpassen', '<i class="fas fa-info fa-3x fa-fw"></i> Info aanpassen', 'class="beheerknop"');
                echo '</div>';
                echo '<div class="col-md-6">';
                echo anchor('Trainer/index', '<i class="far fa-calendar-alt fa-3x fa-fw"></i> Activiteiten beheren', 'class="beheerknop"');
                echo anchor('Supplement/index', '<i class="fas fa-medkit fa-3x fa-fw"></i> Supplementen toekennen', 'class="beheerknop"');
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
    .row-striped:nth-of-type(odd){
        background-color: #efefef;
    }

    .row-striped:nth-of-type(even){
        background-color: #ffffff;
    }

    .row-striped {
        padding: 10px 0;
    }
    .nieuwsartikel{
        color: black;
    }
    .nieuwsartikel:hover{
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

    .startTitel{
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .media{
        margin-bottom: 20px;
    }

    .scrollknop{
        background-color: lightgray;
        display: block;
        margin-bottom: 5px;
        margin-top: 5px;
        color: black;
    }
    .scrollknop:hover{
        background-color: gray;
        display: block;
        margin-bottom: 5px;
        margin-top: 5px;
        color: white;
    }
</style>

<div class="row">
    <div class="col-12 col-lg-8">
        <?php
        haalPaginaInhoudOp($trainingscentrum, $nieuwsArtikels, $gebruiker)
        ?>
    </div>
    <div class="col-12 col-lg-4">
        <div>
            <h2 class="startTitel">Agenda</h2>
            <br>
            <?php
            haalAgendaOp($wedstrijden);
            ?>
        </div>
    </div>
</div>
