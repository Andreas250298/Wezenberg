<script>
var id = "";
    $(document).ready(function () {
        $(".modal-trigger").click(function() {
          id = $(this).parent().prop('id')
          // $("#zwemmerID").html(id);
          // $("#zwemmerID").hide();
          $('#mijnDialoogscherm').modal('show')
        })

      $("#buttonDelete").click(function(){
        verwijderZwemmer(id);
      })

      function verwijderZwemmer(id){
        $.ajax({type: "GET",
        url: site_url + "/gebruiker/verwijder",
        data:{id : id},
        success: function(){
          window.location.reload();
        },
        error: function (xhr, status, error){
          aler("--ERROR IN AJAX --\n\n" + xhr.responseText);
        }
      });
      }
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
                echo "<p id='test'>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-user-plus\"></i></button>") .
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
              <h4 class="modal-title">Pas Op</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <!-- <p id="zwemmerID"></p> -->
            <p>
              Bent u zeker dat u deze zwemmer wilt verwijderen?
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round btn-primary" data-dismiss="modal">Sluit</button>
                <button type="button" id="buttonDelete" class="btn btn-default btn-round btn-danger">Verwijder</button>
            </div>
        </div>

    </div>
</div>
