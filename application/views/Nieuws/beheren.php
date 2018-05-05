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
        verwijderNieuwsArtikel(id);
      })

      function verwijderNieuwsArtikel(id){
        $.ajax({type: "GET",
        url: site_url + "/nieuws/verwijder",
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
<h2 class="paginaTitel">Nieuws Beheren</h2>
<div class="alert alert-dark" role="alert">
  <i class="far fa-question-circle fa-2x"></i><span class="tab">Hoe nieuws beheren? <?php echo anchor('nieuws/tutorial', "Bekijk de tutorial", "")?>
</div>
<?php
/**
 *\file beheren.php
 *
 * View waarin men de nieuwsartikels kan beheren.
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<p>" . anchor('home/index', 'Terug', "Class='btn btn-primary my-2 my-sm0'")  . " ";
echo anchor('Nieuws/maakNieuwsArtikel', "nieuw artikel", "Class='btn btn-primary my-2 my-sm0'") . "</p>";

foreach ($nieuwsArtikels as $artikel) {
    echo '<p class="nieuwsartikel"><li class="media">';
    if ($artikel->foto != null) {
        echo "<img class='img-fluid mr-3' src='" . base_url($artikel->foto) . "' width='200' height='100'/>";
    }
    else{
        echo toonAfbeelding('neuws.png', 'class="img-fluid mr-3" width="80" maxheight="100"');
    }

    echo '<div class="media-body">';
    echo '<h5 class="mt-0 mb-1">' . $artikel->titel . '</h5>';
    echo substr($artikel->beschrijving, 0, 144) . '...';
    echo '<p>' . anchor('Nieuws/wijzig/' . $artikel->id, 'aanpassen', 'class="btn btn-primary"') . " ";
    echo anchor('Nieuws/bekijk/' . $artikel->id, 'bekijken', 'class="btn btn-primary"') . " ";
    echo "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round modal-trigger\"><i class=\"fas fa-times\"></i></button>";
    echo '</p></div>';
    echo '</li></p>';
}

echo "<p>" . $links . "</p>\n";


?>
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
              Bent u zeker dat u dit artikel wilt verwijderen?
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round btn-primary" data-dismiss="modal">Sluit</button>
                <button type="button" id="buttonDelete" class="btn btn-default btn-round btn-danger">Verwijder</button>
            </div>
        </div>

    </div>
</div>
