<?php
echo "<p>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-plus-circle\"></i></button>");
foreach ($zwemmers as $zwemmer) {
    echo "<p>" . $zwemmer->naam . " " . anchor('gebruiker/wijzig/' . 
                    $gebruiker->id,"<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ") . 
            anchor('gebruiker/schrap/'. 
                    $gebruiker->id,"<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\"><i class=\"fas fa-trash\"></i></button>") . "</p>";
}
?>