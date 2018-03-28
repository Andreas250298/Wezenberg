<?php
/**
*\file beheren.php
*
* View waarin men de supplementen kan beheren.
*/
echo '<p>'.anchor('supplement/maakSupplement', 'Nieuw supplement aanmaken').'

</p>';

foreach ($supplementen as $supplement) {
    echo "<div class='card'>";
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $supplement->naam . '</h5>';
    echo '<p class="card-text text">' . $supplement->beschrijving . '</p>';
    echo anchor('Supplement/wijzig/' . $supplement->id, 'aanpassen', 'class="btn btn-primary"') . " ";
    echo anchor('Supplement/verwijder/' . $supplement->id, 'verwijderen', 'class="btn btn-primary"');
    echo '</div></div>';
}

echo anchor('home', 'Terug', "Class='btn btn-primary my-2 my-sm0'");
