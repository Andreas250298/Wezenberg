<script>
var id = "";

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

function haalSupplementenOp(id){
    $.ajax({type : "GET",
                url : site_url + "/supplement/haalAjaxOp_supplementenPerZwemmerTrainer",
                data : { id : id },
                success : function(result){
                    $("#resultaat").html(result);
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
        });
}

    $(document).ready(function () {
        haalSupplementenOp(0);

        $(".modal-trigger").click(function() {
            id = $(this).parent().find('#id').val()
            $('#mijnDialoogscherm').modal('show')
        })

        $("#buttonDelete").click(function(){
            verwijderSupplementPerZwemmer(id);
        })

        $('#zwemmer').on('change', function(){
            id = $('#zwemmer').val()
            haalSupplementenOp(id);
        })
    }
)
</script>
<?php

echo anchor(
    "supplement/supplementenToekennen",
    "<button type=\"button\" class=\"btn btn-primary mx-auto\">Supplement toekennen</button> "
);

echo "<div class='form-group'>";
echo form_label("Zwemmers: ", 'zwemmer') . "\n";
echo "</br>";
echo "<select name='zwemmer' id='zwemmer' class='form-control'>";
echo '<option value=0>Alle Zwemmers</option>';
foreach ($zwemmers as $zwemmer) {
    echo "<option value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
}
echo "</select>";
echo "<div>";
echo "</br>";

 echo ' <p>
        <div id="resultaat"></div>
        </p>';

echo anchor('home/index', "<button type=\"button\" class=\"btn btn-primary mx-auto\">Terug</button>");
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
