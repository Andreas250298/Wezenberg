<?php
$dt = new DateTime;
$jaar = $dt->format('o');
$geboortedatum = explode("-", $zwemmer->geboortedatum);
$leeftijd = $jaar - $geboortedatum[0];
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
      <?php if ($zwemmer->foto != ""){
        echo '<img width="250px" height="250px" src="' . base_url($zwemmer->foto) . '"/><br /><br />';
      } else {
        echo '<img src="http://placehold.it/250x250" width="250px" height="250px"/><br /><br />';
      }

       ?>

       <p class="text-center">
           <?php if ($this->session->has_userdata('gebruiker_id') && ($this->session->userdata('gebruiker_id') == $zwemmer->id || $gebruiker->soort == 'trainer')) {
   echo anchor('gebruiker/wijzig/' . $zwemmer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ");
   if ($gebruiker-> soort == 'trainer') {
       echo anchor('gebruiker/maakInactief/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\"><i class=\"fas fa-lock\"></i></button>");
   }
} ?>
       </p>
     </div>
     <div class="col-lg-3 col-md-3 offset-md-2 offset-lg-1 offset-xl-0">
       <br />
           <b>Leeftijd: </b><?php echo $leeftijd; ?><br />
           <b>Woonplaats: </b><?php echo $zwemmer->woonplaats; ?><br />
           <b>Bio: </b><?php echo $zwemmer->beschrijving; ?><br />
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
                  . "te " . $wedstrijd->wedstrijd->plaats . " om " . verkortTijdstip($wedstrijd->reeks->tijdstip) . "<br />"
                  . $wedstrijd->afstand->afstand . " " . $wedstrijd->slag->soort . "</p><br />";
                }
            }


            ;?>
        </div>

        <div class="col-md-3 text-left offset-md-1 offset-sm-0">
            <h5>Laatste resultaten</h5>
            <p>To-do</p>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-11">
            <?php echo anchor('gebruiker/toonZwemmers', 'Terug', "Class='btn btn-primary my-2 my-sm0'");?>
        </div>
    </div>
</div>
