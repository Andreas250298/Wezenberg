<script>
var plaats = 'Alle';
var tijd = "<?php echo $tijd?>";
var wedstrijdId = 0;

function haalWedstrijdenOp(plaats, tijd){
    $.ajax({type : "GET",
                url : site_url + "/wedstrijd/haalAjaxOp_bekijkenWedstrijden",
                data : { plaats: plaats,
                tijd : tijd},
                success : function(result){
                    $("#resultaat").html(result);
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
        });
}

function verwijderWedstrijd(id){
  $.ajax({type : "GET",
                url : site_url + "/wedstrijd/verwijder",
                data : { id: id,
                tijd : tijd},
                success : function(result){
                  $('#mijnDialoogscherm').modal('hide')
                  haalWedstrijdenOp(plaats, tijd);
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
        });
}


$(document).ready(function () {
    haalWedstrijdenOp(plaats, tijd);

         $("#resultaat").on('click','.modal-trigger',function() {
            wedstrijdId = $(this).parent().find('#wedstrijdId').val()
            if ($('#checkboxModal').is(':checked')){
                verwijderWedstrijd(wedstrijdId);
            }else {
                $('#mijnDialoogscherm').modal('show')
            }
        })

          $("#buttonDelete").click(function(){
            verwijderWedstrijd(wedstrijdId);
        })

        $('#plaats').on('change', function(){
            plaats = $('#plaats').val()
            haalWedstrijdenOp(plaats, tijd);
        })
})

</script>
<?php

if ($tijd === "na") {
    echo anchor('wedstrijd/bekijkenWedstrijden/voor', "<button type=\"button\" class=\"btn btn-primary mx-auto\">Toon afgelopen wedstrijden</button> ");
    if (isset($gebruiker)) {
        if ($gebruiker->soort == "trainer") {
            echo anchor('wedstrijd/maakWedstrijd/'.$tijd, "<button type=\"button\" class=\"btn btn-success mx-auto\">Nieuwe Wedstrijd aanmaken</button> ");
        }
    }
} else {
    echo anchor('wedstrijd/bekijkenWedstrijden/na', "<button type=\"button\" class=\"btn btn-primary mx-auto\">Toon aanstaande wedstrijden</button> ");
}

$plaatsen = [];

if ($wedstrijden != null) {
    foreach ($wedstrijden as $wedstrijd) {
        if (!in_array($wedstrijd->plaats, $plaatsen)) {
            array_push($plaatsen, $wedstrijd->plaats);
        }
    }
}

sort($plaatsen);

if ($tijd === "na") {
    echo "<h2 class=\"mx-auto\">Aanstaande wedstrijden</h2>";
} else {
    echo "<h2 class=\"mx-auto\">Afgelopen wedstrijden</h2>";
}
echo "<div class='form-group'>";
echo form_label("Plaats: ", 'plaats') . "\n";
echo "</br>";
echo "<select name='plaats' id='plaats' class='form-control'>";
echo '<option value=Alle>Alle Wedstrijden</option>';
foreach ($plaatsen as $plaats) {
    echo "<option value='" . $plaats . "'>" . $plaats . "</option>\n";
}
echo "</select>";
echo "<div>";
echo "<br/>";

if (isset($gebruiker)) {
    if ($gebruiker->soort == "trainer") {
        echo '<div class="form-check">
  <input class="form-check-input" type="checkbox" id="checkboxModal">
  <label class="form-check-label" for="checkboxModal">
    Uitzetten waarschuwing bij het verwijderen
  </label>
</div>';
    }
}

 echo ' <p>
        <div id="resultaat"></div>
        </p>';
?>
<br/><br/>
<p>
    <?php echo anchor('home/index', 'Terug', 'class="btn btn-primary"'); ?>
</p>
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
             Bent u zeker dat u deze wedstrijd wilt verwijderen?
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round btn-primary" data-dismiss="modal">Sluit</button>
                <button type="button" id="buttonDelete" class="btn btn-default btn-round btn-danger">Verwijder</button>
            </div>
        </div>

    </div>
</div>
</div>
