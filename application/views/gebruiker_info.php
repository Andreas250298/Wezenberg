<?php
/**
 * @file gebruiker_info.php
 *
 * View waarin men info kan zien over een gebruiker
 */
$leeftijd = 18;
?>

<div class="container">

    <div class="row text-center">
        <div class="col-md-10 mt-2">
            <h3><?php echo $gebruikerInfo->naam; ?></h3>
        </div>
    </div>

    <div class="row text-center mt-4 pb-3">
        <div class="col-md-3 offset-1"><img src="http://placehold.it/250x250"/><br /><br />
        <p>
            <?php if ($this->session->has_userdata('gebruiker_id') && ($this->session->userdata('gebruiker_id') == $gebruikerInfo->id || $gebruiker->soort == 'trainer'))
            {
                echo anchor('gebruiker/wijzig/' . $gebruikerInfo->id,"<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ");
            } ?>
        </p>
        </div>
        <div class="col-md-6 text-left">
            <p><b>Leeftijd: </b><?php echo $leeftijd; ?></p>
            <p><b>Woonplaats: </b><?php echo $gebruikerInfo->woonplaats; ?></p>
            <p><b>Bio: </b><?php echo $gebruikerInfo->beschrijving; ?></p>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-11">
            <?php echo anchor('home', 'Terug', "Class='btn btn-primary my-2 my-sm0'");?>
        </div>
    </div>
</div>
