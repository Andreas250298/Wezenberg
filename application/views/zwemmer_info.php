<?php
$leeftijd = 18;
$disciplines = "100m vlinderslag";
?>

<div class="container">

    <div class="row text-center">
        <div class="col-md-10 mt-2">
            <h3><?php echo $zwemmer->naam; ?></h3>
        </div>
    </div>

    <div class="row text-center mt-4 pb-3">
      <?php if ($zwemmer->foto != ""){
        echo '<div class="col-md-3 offset-1"><img width=250 height=250 src="' . base_url($zwemmer->foto) . '"/><br /><br />';
      } else {
        echo '<div class="col-md-3 offset-1"><img src="http://placehold.it/250x250"/><br /><br />';
      }

       ?>

        <p>
            <?php if ($this->session->has_userdata('gebruiker_id') && ($this->session->userdata('gebruiker_id') == $zwemmer->id || $gebruiker->soort == 'trainer')) {
    echo anchor('gebruiker/wijzig/' . $zwemmer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ");
    if ($gebruiker-> soort == 'trainer') {
        echo anchor('gebruiker/maakInactief/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\"><i class=\"fas fa-lock\"></i></button>");
    }
} ?>
        </p>
        </div>
        <div class="col-md-6 text-left">
            <p><b>Leeftijd: </b><?php echo $leeftijd; ?></p>
            <p><b>Woonplaats: </b><?php echo $zwemmer->woonplaats; ?></p>
            <p><b>Dsiciplines: </b><?php echo $disciplines; ?></p>
            <p><b>Bio: </b><?php echo $zwemmer->beschrijving; ?></p>
        </div>
    </div>

    <div class="row text-left mt-5">
        <div class="col-md-3 offset-2">
            <h5>Aanstaande wedstrijden</h5>
            <?php
            if ($wedstrijden == null) {
                echo "Geen aanstaande wedstrijden";
            } else {
                foreach ($wedstrijden as $wedstrijd) {
                    echo "<p><b>" . zetOmNaarGeschreven($wedstrijd['datum']) . "</b><br />"
                  . $wedstrijd['wedstrijd'] . "<br />"
                  . "te " . $wedstrijd['plaats'] . " om " . $wedstrijd['tijdstip'] . "<br />"
                  . $wedstrijd['afstand'] . " " . $wedstrijd['slag'] . "</p><br />";
                }
            }


            ;?>
        </div>

        <div class="col-md-3 offset-1">
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
