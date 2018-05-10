<?php
/**
 * @file inactieveZwemmers.php
 *
 * View waarin de trainer de inactieve zwemmers kan bekijken en opnieuw actief maken
 */

// link gebruiker maken tonen enkel indien als trainer ingelogd
if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
    echo "<p>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-user-plus\"></i></button>") .
        "&nbsp;&nbsp;&nbsp;" . anchor('gebruiker/toonZwemmers', 'Toon actieve zwemmers') ."</p>";
} else {
    echo "<p>" . anchor('gebruiker/toonZwemmers', 'Toon actieve zwemmers') ."</p>";
}
//
if ($zwemmers == null) {
    echo "<h5>Er zijn geen inactieve zwemmers</h5>";
}
// zwemmers tonen
foreach ($zwemmers as $zwemmer) {
    echo "<p>"
        . $zwemmer->naam;

    // knoppen tonen indien ingelogd als trainer
    if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
        echo anchor('gebruiker/wijzig/' . $zwemmer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ")
                . anchor('gebruiker/maakActief/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\"><i class=\"fas fa-lock-open\"></i></button>");
    }
    //

    echo "</p>";
}
//

?>
<p>
    <a id="terug" href="javascript:history.go(-1);" class="btn btn-primary">Terug</a>
</p>
