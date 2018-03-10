<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<p>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-user-plus\"></i></button>") . 
        "&nbsp;&nbsp;&nbsp;" . anchor('gebruiker/toonZwemmers', 'Toon actieve zwemmers') ."</p>";
foreach ($zwemmers as $zwemmer) {
    echo "<p>" . $zwemmer->naam . " " . anchor('gebruiker/wijzig/' . 
                    $zwemmer->id,"<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ") . 
    anchor('gebruiker/maakActief/'. 
                    $zwemmer->id,"<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\"><i class=\"fas fa-lock-open\"></i></button>") . "</p>";
}
?>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
