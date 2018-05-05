<?php
foreach ($nieuwsArtikels as $artikel) {
    if ($artikel->foto != null) {
        $fotoLocatie = base_url($artikel->foto);
    } else {
        $fotoLocatie = base_url('assets/images/nieuws.png');
    }

    echo '<div class="latest-news-all">';
    echo '<div class="latest-news-left"><img class="img-fluid mr-3" src="' . $fotoLocatie . '" width="150" height="100" alt="' . $artikel->titel . '"/></div>';
    echo '<div class="latest-news-right">';
    echo '<h5 class="mt-0 mb-1">' . substr($artikel->titel, 0, 50) . '...</h5>
        <p>' . substr($artikel->beschrijving, 0, 130) . ' ... ' . anchor('nieuws/bekijk/' . $artikel->id, 'verder lezen') . '</p>
        <div class="news"> <span class="news-right">' . zetOmNaarDDMMYYYY($artikel->datumAangemaakt) . '</span> </div>';
    echo '</div>';
    echo '</div>';
}
