<script>

    $(document).ready(function () {
        $(".modal-trigger").click(function() {
          var id = $(this).parent().prop('id')
          $("#resultaat").html(id);
          $('#mijnDialoogscherm').modal('show')
        })
      })

</script>
<?php
$teller = 0;
$zwemmersTabel = "";
?>


<div class="container text-center">
    <div class="row">
        <div class="col-lg-10 offset-md-1">
            <h3>Zwemmers</h3>
            <p>Klik op een zwemmer voor meer info</p>
            <table class="mt-3">
                <?php foreach ($zwemmers as $zwemmer) {
    if ($teller == 4 || $teller == 0) { // nieuwe rij tabel maken bij start foreach en na elke 4de zwemmer
        echo "<tr>";
    }

    echo '<td id="' .$zwemmer->id.'" class="p-3">'
                        . anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, "<img src=\"http://placehold.it/200x200\"")
                        . "<br/>"
                        . anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, $zwemmer->naam);

    // knoppen tonen indien ingelogd als trainer
    if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
        echo "<br/>" . anchor('gebruiker/wijzig/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ")
                            . anchor('gebruiker/maakInactief/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-lock\"></i></button> ")
                            . "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round modal-trigger\"><i class=\"fas fa-times\"></i></button>";
    }
    //

    echo "</td>";

    if ($teller == 4) { // teller resetten
        $teller = 0;
    }
    $teller++;
}; ?>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mt-2 mb-2">
            <?php
            // link gebruiker maken tonen enkel indien als trainer ingelogd
            if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
                echo "<p>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-user-plus\"></i></button>") .
                "&nbsp;&nbsp;&nbsp;" . anchor('gebruiker/toonInactieveZwemmers', 'Toon inactieve zwemmers') ."</p>";
            } else {
                echo "<p>" . anchor('gebruiker/toonInactieveZwemmers', 'Toon inactieve zwemmers') ."</p>";
            };
            ?>

            <?php echo '<p>' . anchor('home', 'Terug', "Class='btn btn-primary my-2 my-sm0'") . '</p>';?>
        </div>
    </div>
</div>

<!-- Dialoogvenster -->
<div class="modal fade" id="mijnDialoogscherm" role="dialog">
    <div class="modal-dialog">
        <!-- Inhoud dialoogvenster-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pas Op</h4>
            </div>
            <div class="modal-body">
                <p><div id="resultaat"></div></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
            </div>
        </div>

    </div>
</div>
