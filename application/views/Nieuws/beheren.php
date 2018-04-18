<?php
/**
 *\file beheren.php
 *
 * View waarin men de nieuwsartikels kan beheren.
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<p>" . anchor('Nieuws/maakNieuwsArtikel', "nieuw artikel") . "</p>";
echo "<p>" . anchor('home/index', 'Terug', "Class='btn btn-primary my-2 my-sm0'") . "</p>";
foreach ($nieuwsArtikels as $nieuwsArtikel) {
    echo "<div class='card'>";
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $nieuwsArtikel->titel . '</h5>';
    echo '<p class="card-text text-muted">' . $nieuwsArtikel->datumAangemaakt . '</p>';
    echo '<p class="card-text">' . substr($nieuwsArtikel->beschrijving, 0, 144) . '...</p>';
    echo anchor('Nieuws/wijzig/' . $nieuwsArtikel->id, 'aanpassen', 'class="btn btn-primary"') . " ";
    echo anchor('Nieuws/verwijder/' . $nieuwsArtikel->id, 'verwijderen', 'class="btn btn-primary"');
    echo '</div></div>';
}

echo "<p>" . $links . "</p>\n";
/* if(!empty($nieuwsArtikels)) {
foreach ($nieuwsArtikels as $nieuwsArtikel) {
    echo "<div><p>" . $nieuwsArtikel->titel . "</p>" .
            "<p>" . $nieuwsArtikel->datumAangemaakt . "</p>" .
            "<p>" . $nieuwsArtikel->beschrijving . "</p></div>";
}
}else {
    echo "niets";
} */
?>
