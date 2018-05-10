<?php /**
 * @file Nieuws/tutorial.php
 *
 * View waarop de trainer een tutorial kan bekijken.
 */
 ?>
<h2 class="paginaTitel"><i class="fas fa-angle-left"></i> Tutorial : Nieuws beheren</h2>
<div class="row">
    <div class="col-sm-12">
        <h3 class="paginaTitel">Inleiding</h3>
        <p>
            Met deze nieuws functie kan je de bezoekers van de website informeren met de laatste bezigheden van het trainingscentrum en wedstrijd informatie.
            Met deze kleine tutorial maken we je wegwijs op de '<?php echo anchor('nieuws/index', 'Nieuws beheren'); ?>' pagina.
        </p>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">Het Overzicht</h3>
        <p>
            In het overzicht vind je alle nieuws artikellen gesorteerd op meest recent terug.
            Bij elk artikel krijg je de mogelijkheid om hem aan te passen, te bekijken of te verwijderen.
            <br>
            Een artikel in dit overzicht ziet er uit als volgt:
        </p>

        <div class='card'>
            <div class="card-body">
                <h5 class="card-title">Breaking news!</h5>
                <p class="card-text text-muted">27/04/2018</p>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam nisl mauris, vitae hendrerit felis sagittis et. Nunc ultrices suscipit t...</p>
                <a class="btn btn-primary my-2 my-sm0">aanpassen</a>
                <a class="btn btn-primary my-2 my-sm0">bekijken</a>
                <button type="button" class="btn btn-danger btn-xs btn-round modal-trigger"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">Een nieuw artikel toevoegen</h3>
        <p>
            Om een nieuw artikel toe te voegen klik je op <a class="btn btn-primary my-2 my-sm0">nieuw artikel</a> bovenaan het overzicht.
            Dit opent een nieuwe pagina waardat je een titel en beschrijving kan invullen.
            Als je denk dat je nieuwsartikel volledig is kan je op <a class="btn btn-primary my-2 my-sm0">opslaan</a> klikken om het op te slaan. Bij het opslaan wordt ook het tijdstip meegegeven zodat het artikel bovenaan de lijst komt te staan.
        </p>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">Een artikel aanpassen</h3>
        <p>
            Om een artikel aan te passen klik je op <a class="btn btn-primary my-2 my-sm0">aanpassen</a> onderaan het artikel dat je wil aanpassen.
            Dit opent een nieuwe pagina waardat je de titel en beschrijving kan aanpassen naar wens.
            Als je gedaan hebt met aanpassen kan je op <a class="btn btn-primary my-2 my-sm0">opslaan</a> klikken om het gewijzigd artikel op te slaan.
        </p>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">Een artikel verwijderen</h3>
        <p>
            Om een artikel te verwijderen klik je op <button type="button" class="btn btn-danger btn-xs btn-round modal-trigger"><i class="fas fa-times"></i></button> onderaan het artikel dat je wil aanpassen.
            Nu verschijnt er een waarschuwing en krijg je de kans om nog te annuleren of het te verwijderen.
            Als je het wilt verwijderen kan je op <a class="btn btn-danger my-2 my-sm0">Verwijder</a> klikken om het artikel te verwijderen.
        </p>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">Slot</h3>
        <p>
            Zo dit was de tutorial van '<?php echo anchor('nieuws/index', 'Nieuws beheren'); ?>'.<br>
            Nu kan je zelf aan de slag, succes!
        </p>
    </div>
    <p><?php echo anchor('nieuws/index', 'Terug', "Class='btn btn-primary my-2 my-sm0'"); ?></p>
</div>
