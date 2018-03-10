<?php
echo "<p>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-plus-circle\"></i></button>") . 
        "&nbsp;&nbsp;&nbsp;" . anchor('gebruiker/toonInactieveZwemmers', 'Toon inactieve zwemmers') ."</p>";
foreach ($zwemmers as $zwemmer) {
    echo "<p>" . $zwemmer->naam . " " . anchor('gebruiker/wijzig/' . 
                    $gebruiker->id,"<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ") . 
            anchor('gebruiker/maakInactief/'. 
                    $gebruiker->id,"<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\"><i class=\"fas fa-trash\"></i></button>") . "</p>";
}
?>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>