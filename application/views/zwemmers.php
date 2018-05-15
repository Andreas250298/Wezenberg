<?php
/**
 * @file zwemmers.php
 *
 * View waarin er een lijst wordt getoond met alle zwemmers
 * -Een gewone gebruiker kan alleen informatie bekijken
 * -Een zwemmer kan dit ook voor elke zwemmer maar kan zijn eigen informatie aanpassen via een extra knop
 * -Een zwemmer kan elke zwemmer aanpassen, inactief maken en verwijderen
 */

 ?>
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
          alert("--ERROR IN AJAX --\n\n" + xhr.responseText);
        }
      });
      }
    })

</script>
<style>
.zwem {
  float: left;
}
</style>
<?php
$teller = 0;
$zwemmersTabel = "";
$dt = new DateTime;
$jaar = $dt->format('o');

?>
            <h3>Zwemmers</h3>
            <p>Klik op een zwemmer voor meer info</p>

  <?php
  foreach ($zwemmers as $zwemmer) {
      $geboortedatum = explode("-", $zwemmer->geboortedatum);
      if ($geboortedatum[0] != null) {
          $leeftijd = $jaar - $geboortedatum[0];
      }
      echo "\n<p class=nieuwsartikel>\n\t<li class=\"media\">\n";
      echo "<div class=\"media-body\">\n";
      if ($zwemmer->foto != "") {
          echo anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, "<img class='img-fluid mr-3 zwem' width=200 height=200 src=" . base_url($zwemmer->foto) . ">") . "\n";
      } else {
          echo anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, "<img class='img-fluid mr-3 zwem' width=200 maxheight=200 src=\"http://placehold.it/200x200\">") . "\n";
      }
      echo "<h5 class=\"mt-0 mb-1\">\n\t". anchor('gebruiker/toonZwemmerInfo/' . $zwemmer->id, $zwemmer->naam) . "\n</h5>\n";
      echo "<p class=\"text-muted\">" . $leeftijd . " jaar</p>\n";
      // knoppen tonen indien ingelogd als trainer
      if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
          echo '<p id="' . $zwemmer->id .'">';
          echo anchor('gebruiker/wijzig/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ");
          echo anchor('gebruiker/maakInactief/'. $zwemmer->id, "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-lock\"></i></button> ");
          echo "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round modal-trigger\"><i class=\"fas fa-times\"></i></button>\n";
          echo "\t</p>\n";
      }
      //

      echo "\n\t\t</div>\n\t</li>\n</p>";
  } ?>
  <hr/>
  <h3>Trainers</h3>
  <p>Klik op een trainer voor meer info</p>

<?php
foreach ($trainers as $trainer) {
      $geboortedatum = explode("-", $trainer->geboortedatum);
      if ($geboortedatum[0] != null) {
          $leeftijd = $jaar - $geboortedatum[0];
      }
      echo "\n<p class=nieuwsartikel>\n\t<li class=\"media\">\n";
      echo "<div class=\"media-body\">\n";
      if ($trainer->foto != "") {
          echo anchor('gebruiker/toonZwemmerInfo/' . $trainer->id, "<img class='img-fluid mr-3 zwem' width=200 height=200 src=" . base_url($trainer->foto) . ">") . "\n";
      } else {
          echo anchor('gebruiker/toonZwemmerInfo/' . $trainer->id, "<img class='img-fluid mr-3 zwem' width=200 maxheight=200 src=\"http://placehold.it/200x200\">") . "\n";
      }
      echo "<h5 class=\"mt-0 mb-1\">\n\t". anchor('gebruiker/toonZwemmerInfo/' . $trainer->id, $trainer->naam) . "\n</h5>\n";
      echo "<p class=\"text-muted\">" . $leeftijd . " jaar</p>\n";
      // knoppen tonen indien ingelogd als trainer
      if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
          echo '<p id="' . $trainer->id .'">';
          echo anchor('gebruiker/wijzig/'. $trainer->id, "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\"><i class=\"fas fa-edit\"></i></button> ");
          echo "\t</p>\n";
      }
//

      echo "\n\t\t</div>\n\t</li>\n</p>";
  } ?>
        <div class="col-lg-12 mt-2 mb-2">
            <?php
            // link gebruiker maken tonen enkel indien als trainer ingelogd
            if ($this->session->has_userdata('gebruiker_id') && $gebruiker->soort == 'trainer') {
                echo "<p id='test'>" . anchor('gebruiker/maakGebruiker', "<button type=\"button\" class=\"btn btn-warning btn-xs btn-round\"><i class=\"fas fa-user-plus\"></i></button>") .
                "&nbsp;&nbsp;&nbsp;" . anchor('gebruiker/toonInactieveZwemmers', 'Toon inactieve zwemmers', "Class='btn btn-primary my-2 my-sm0'");
                echo " " . anchor('home', 'Terug', "Class='btn btn-primary my-2 my-sm0'")  ."</p>";
            } else {
                echo anchor('home', 'Terug', "Class='btn btn-primary my-2 my-sm0'");
            }
            ?>
        <!--</div>-->
    </div>

<!-- Dialoogvenster -->
<div class="modal fade" id="mijnDialoogscherm" role="dialog">
    <div class="modal-dialog">
        <!-- Inhoud dialoogvenster-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pas Op!</h4>
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
