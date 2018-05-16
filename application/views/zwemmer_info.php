<?php
/**
 * @file zwemmer_info.php
 *
 * View waarin er informatie kan worden bekeken over een zwemmer
 * -Een gewone gebruiker kan alleen informatie bekijken
 * -Een zwemmer kan dit ook voor elke zwemmer maar kan zijn eigen informatie aanpassen
 */
$dt = new DateTime;
$jaar = $dt->format('o');
$geboortedatum = explode("-", $zwemmer->geboortedatum);
if ($geboortedatum[0] != null) {
    $leeftijd = $jaar - $geboortedatum[0];
}

$disciplines = "100m vlinderslag";
?>
<div class="container-fluid">

    <div class="row text-center">
        <div class="col-md-10 mt-2">
            <h3><?php echo $zwemmer->naam; ?></h3>
        </div>
    </div>

    <div class="row mt-4 pb-3">
      <div class="col-lg-3 col-md-3 offset-lg-2 offset-md-1">
      <?php if ($zwemmer->foto != "") {
    echo '<img class="img-fluid" width="250px" height="250px" src="' . base_url($zwemmer->foto) . '"/><br /><br />';
} else {
    echo '<img class="img-fluid" src="http://placehold.it/250x250" width="250px" height="250px"/><br /><br />';
}

       ?>

       <p class="text-center">
           <?php if ($this->session->has_userdata('gebruiker_id') && ($this->session->userdata('gebruiker_id') == $zwemmer->id || $gebruiker->soort == 'trainer')) {
           echo anchor('gebruiker/wijzig/' . $zwemmer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ");
           echo anchor('gebruiker/wijzigWachtwoord/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\">Wachtwoord wijzigen</button> ");
           if ($gebruiker-> soort == 'trainer') {
               echo anchor('gebruiker/maakInactief/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-lock\"></i></button>");
           }
       } ?>
       </p>
     </div>
     <div class="col-lg-5 col-md-5 offset-md-2 offset-lg-1 offset-xl-0">
       <br />
           <b>Leeftijd: </b><?php if (isset($leeftijd)) {
           echo $leeftijd;
       }?><br />
           <b>Woonplaats: </b><?php echo $zwemmer->woonplaats; ?><br />
           <b>Dsiciplines: </b><?php echo $disciplines; ?><br />
           <p class="bio"><b>Bio: </b><?php echo $zwemmer->beschrijving; ?></p>
           </div>
           </div>



    <div class="row text-left mt-5">
        <div class="col-md-4 offset-md-1 offset-sm-0">
            <h5>Aanstaande wedstrijden</h5>
            <?php
            if ($wedstrijden == null) {
                echo "Geen aanstaande wedstrijden";
            } else {
                foreach ($wedstrijden as $wedstrijd) {
                    echo "<p><b>" . zetOmNaarDDMMYYYY($wedstrijd->reeks->datum) . "</b><br />"
                  . $wedstrijd->wedstrijd->naam . "<br />"
                  . "te " . $wedstrijd->wedstrijd->plaats . " om " . $wedstrijd->reeks->uur . "<br />"
                  . $wedstrijd->afstand->afstand . " " . $wedstrijd->slag->soort . "</p><br />";
                }
            }


            ;?>
        </div>

        <div class="col-md-3 text-left offset-md-1 offset-sm-0">
            <h5>Laatste resultaten</h5>
            <?php
                if ($afgelopenWedstrijden == null) {
                    echo "Geen recente wedstrijden";
                } else {
                    $teller = 0;
                    foreach ($afgelopenWedstrijden as $afgelopen) {
                        if ($teller < 5) {
                            $resultaat = end($afgelopen->resultaat);

                            echo "<p><b>" . zetOmNaarDDMMYYYY($afgelopen->reeks->datum) . "</b><br />"
                        . $resultaat->naam . "<br/>" . $afgelopen->wedstrijd->naam . "<br />"
                        . "Eindplaats: " . $resultaat->eindRank . "<sup>e</sup> in " . $resultaat->tijdReeks . "<br />"
                        . $afgelopen->afstand->afstand . " " . $afgelopen->slag->soort . "</p><br />";
                        }
                        $teller++;
                    }
                }
            ;?>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-11">
            <?php echo anchor('gebruiker/toonZwemmers', 'Terug', "Class='btn btn-primary my-2 my-sm0'");?>
        </div>
    </div>
</div>
