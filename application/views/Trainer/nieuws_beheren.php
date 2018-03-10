<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!empty($nieuwsArtikels)) {
foreach ($nieuwsArtikels as $nieuwsArtikel) {
    echo "<div><p>" . $nieuwsArtikel->titel . "<p>" .
            "<p>" . $nieuwsArtikel->datumAangemaakt . "<p>" .
            "<p>" . $nieuwsArtikel->beschrijving . "<p></div>";
} 
}else {
    echo "niets";
}
?>