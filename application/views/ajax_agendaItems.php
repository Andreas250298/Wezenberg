<?php
/**
 * @file ajax_agendaItems.php
 *
 * AJAX view waarin men agenda items kan zien op de startpagina
 */
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
