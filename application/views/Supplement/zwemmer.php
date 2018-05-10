<?php
/**
 *\file Supplement/zwemmer.php
 *
 * View waarin men supplementen kan bekijken per zwemmer
 */
 ?>
<script>
var supplementId = 0;

function haalSupplementenOp(supplementId){
    $.ajax({type : "GET",
                url : site_url + "/supplement/haalAjaxOp_supplementenPerZwemmer",
                data : { supplementId : supplementId },
                success : function(result){
                    $("#resultaat").html(result);
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
        });
}

  $(document).ready(function () {
    haalSupplementenOp(supplementId)

    $('#supplement').on('change', function(){
        supplementId = $('#supplement').val()
        haalSupplementenOp(supplementId)
    })
  })

</script>
<?php
echo "<div class='form-group'>";
echo form_label("Supplementen: ", 'supplement') . "\n";
echo "</br>";
echo "<select name='supplement' id='supplement' class='form-control'>";
echo '<option value=0>Alle Supplementen</option>';
foreach ($supplementen as $supplement) {
    echo "<option value='" . $supplement->id . "'>" . $supplement->naam . "</option>\n";
}
echo "</select>";
echo "<div>";
echo "</br>";
?>

<p><div id ="resultaat"></div></p>
<?php
echo anchor('home/index', "<button type=\"button\" class=\"btn btn-primary mx-auto\">Terug</button>");
