<?php
/**
 * @file zwemmer_demo.php
 *
 * View waarin de zwemmer een demo kan bekijken doorheen de applicatie
 */
 ?>
<h2 class="paginaTitel"><i class="fas fa-angle-left"></i> Demo : zwemmer</h2>
<div class="row">
    <div class="col-sm-12">
        <h3 class="paginaTitel">Inleiding</h3>
        <p>
            Met deze demo proberen wij u wegwijs te maken in deze applicatie. Als zwemmer heb je een tal van mogelijkheden om uit te proberen.
        </p>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">De demo</h3>
        <p>
            <?php echo toonVideo('zwemmer_demo.mp4')?>
        </p>
    </div>
    <div class="col-sm-12">
        <h3 class="paginaTitel">Slot</h3>
        <p>
            Zo dit was de demo voor de zwemmer.<br>
            Nu kan je zelf aan de slag, succes!
        </p>
    </div>
    <p><?php echo anchor('home/index', 'Terug', "Class='btn btn-primary my-2 my-sm0'"); ?></p>
</div>
