<style>
    .melding{
        margin: 5px 0px ;
        padding: 5px;
        background-color: lightblue;
        border-bottom: 1px solid black;
        font-weight: bolder;
        border-radius: 10px;
    }
    .melding-gezien{
        background-color: lightgrey;
        font-weight: lighter
    }
</style>

<?php
$knopGezien = form_button("knopGezien", '<i class="fas fa-eye"></i>', array('class' => 'btn', 'title' => 'Deze melding is gezien'));

if (count($meldingenPerGebruiker) != 0) {
    foreach ($meldingenPerGebruiker as $meldingPerGebruiker) {
        if ($meldingPerGebruiker->gezien != 0) {
            $meldingGezien = 'melding-gezien';
        } else {
            $meldingGezien = '';
        }
        ?>
        <div class="melding <?php echo $meldingGezien; ?>">
            <?php
            echo $meldingPerGebruiker->melding->boodschap;
            if ($meldingPerGebruiker->gezien == 0) {
                echo anchor('', $knopGezien, array('class' => 'meldingGezien', 'data-id' => $meldingPerGebruiker->id));
            }
            ?>
        </div>

        <?php
    }
}
else{
    echo'<div>Geen meldingen</div>';
}
?>