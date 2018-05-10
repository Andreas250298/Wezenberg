<?php
/**
* @file Supplement/beheren.php
*
* View waarin men de supplementen kan beheren.
*/
echo '<p>'.anchor('supplement/maakSupplement', 'Nieuw supplement aanmaken', 'class="btn btn-success"').'

</p>';

foreach ($supplementen as $supplement) {
    echo "<div class='card'>";
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $supplement->naam . '</h5>';
    echo '<p class="card-text text">' . $supplement->beschrijving . '</p>';
    echo anchor('Supplement/wijzig/' . $supplement->id, 'Aanpassen', 'class="btn btn-info"') . " ";
    echo anchor('Supplement/verwijder/' . $supplement->id, 'Verwijderen', 'class="btn btn-danger"');
    echo '</div></div>';
}

echo anchor('supplement/supplementenPerZwemmerTrainer', 'Terug', "Class='btn btn-primary my-2 my-sm0'");
