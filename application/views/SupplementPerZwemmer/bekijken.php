<script>
var id = "";
    $(document).ready(function () {
        $(".modal-trigger").click(function() {
          id = $(this).parent().find('#id').val()
          $('#mijnDialoogscherm').modal('show')
        })

      $("#buttonDelete").click(function(){
        verwijderSupplementPerZwemmer(id);
      })

      function verwijderSupplementPerZwemmer(id){
        $.ajax({type: "GET",
        url: site_url + "/supplement/verwijderSupplementPerZwemmer",
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
<?php

$namen = [];
foreach ($supplementenPerAlleZwemmers as $supplementPerZwemmer) {
    array_push($namen, $supplementPerZwemmer->zwemmer->id);
}

echo anchor(
    "supplement/supplementenToekennen",
    "<button type=\"button\" class=\"btn btn-primary mx-auto\">Supplement toekennen</button>"
);

foreach ($zwemmers as $zwemmer) {
    if (in_array($zwemmer->id, $namen)) {
        echo "<h3>$zwemmer->naam</h3>";
        echo "</br>";
        echo "<table class='table'>
        <thead>
        <tr>
        <th>
        Supplement
        </th>
        <th>
        Hoeveelheid
        </th>
        <th>
        Tijdstip
        </th>
        <th>
        Datum
        </th>
        <th></th>
            </tr>
        </thead>
        <tbody>";
        foreach ($supplementenPerAlleZwemmers as $supplementPerZwemmer) {
            if ($supplementPerZwemmer->zwemmer->id == $zwemmer->id) {
                $data = array('type' => 'hidden', 'name' => 'supplementPerZwemmerId', 'id' => 'id', 'value' => $supplementPerZwemmer->id);
                echo "<tr>
                  <td>
                  ".$supplementPerZwemmer->supplement->naam."
                  </td>
                  <td>
                  ".$supplementPerZwemmer->hoeveelheid." g
                  </td>
                  <td>
                  ".$supplementPerZwemmer->tijdstipInname."
                  </td>
                  <td>
                  ".zetOmNaarDDMMYYYY($supplementPerZwemmer->datumInname)."
                  </td>
                  <td>".form_input($data)."<button type=\"button\" class=\"btn btn-danger btn-xs btn-round modal-trigger\"><i class=\"fas fa-times\"></i></button></td>
                </tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        echo "</br>";
    }
}
?>
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
              Bent u zeker dat u het geven supplement wilt verwijderen?
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round btn-primary" data-dismiss="modal">Sluit</button>
                <button type="button" id="buttonDelete" class="btn btn-default btn-round btn-danger">Verwijder</button>
            </div>
        </div>

    </div>
</div>