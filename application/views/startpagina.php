<?php

function haalArtikelsOp($nieuwsArtikels) {
    echo '<h2>Laatste nieuws</h2>';
    echo '<ul class="list-unstyled">';
    foreach ($nieuwsArtikels as $artikel) {
        echo '<a class="nieuwsartikels" href="#"><li class="media">';
        echo '<img class="mr-3" src="..." alt="Placeholder image">';
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
        echo '<h5 class="text-uppercase">Belgisch kampioenschap</h5>';
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
                echo '<div class="col-6">';
                echo anchor('Nieuws/index', '<i class="far fa-newspaper fa-3x fa-fw"></i> Nieuws beheren', 'class="beheerknop"');
                echo anchor('wedstrijd/beheerWedstrijden', '<i class="fas fa-trophy fa-3x fa-fw"></i> Wedstrijden beheren', 'class="beheerknop"');
                echo anchor('Trainer/index', '<i class="fas fa-users fa-3x fa-fw"></i> Zwemmers beheren', 'class="beheerknop"');
                echo anchor('Trainer/index', '<i class="fas fa-info fa-3x fa-fw"></i> Info aanpassen', 'class="beheerknop"');
                echo '</div>';
                echo '<div class="col-6">';
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

// Set your timezone!!
date_default_timezone_set('Europe/Brussels');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $timestamp = time();
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 0, date('Y', $timestamp)));


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ($day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym . '-' . $day;

    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';

    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
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

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            haalPaginaInhoudOp($nieuwsArtikels, $gebruiker)
            ?>
        </div>
        <div class="col-lg-4">
            <div>
                <h3>Agenda <a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>M</th>
                        <th>D</th>
                        <th>W</th>
                        <th>D</th>
                        <th>V</th>
                        <th>Z</th>
                        <th>Z</th>
                    </tr>
                    <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                    ?>
                </table>
            </div>
            <div>

            </div>
            <?php
            haalAgendaOp($wedstrijden);
            ?>           
        </div>
    </div>
</div>