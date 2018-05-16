<?php
/**
 * @file ajax_meldingTonen.php
 *
 * AJAX view waarin men meldingen kan tonen
 */
 ?>

<script>
    $(document).ready(function () {
        $(".meldingGezien").click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            maakMeldingGezien(id);
        });
    });

    function maakMeldingGezien(id)
    {
        $.ajax({type: "GET",
            url: site_url + "/Gebruiker/haalAjaxOp_MaakMeldingGezien",
            data: {id: id},
            success: function (result) {
                $("#meldingen_content_wrapper").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }
</script>
<?php
$knopGezien = form_button("knopGezien", '<i class="fas fa-eye"></i>', array('class'=>'meldingGezien', 'title' => 'Deze melding is gezien'));

if (count($meldingenPerGebruiker) != 0) {
    foreach ($meldingenPerGebruiker as $meldingPerGebruiker) {
        ?>
        <div class="melding">
            <?php
            echo $meldingPerGebruiker->melding->boodschap;
            if ($meldingPerGebruiker->gezien == 0) {
                echo anchor('', $knopGezien, array('class'=>'meldingGezien', 'data-id' => $meldingPerGebruiker->id));
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
