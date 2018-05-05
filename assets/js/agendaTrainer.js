function haalActiviteitenOp(week, jaar) {
    $.ajax({type: "GET",
        url: site_url + "/gebruiker/haalJsonOp_Activiteiten",
        data: {huidigeWeek: week, huidigJaar: jaar},
        success: function (result) {
            try {
                var activiteitenWeek = jQuery.parseJSON(result);

                if (activiteitenWeek != null) {
                    $.each(activiteitenWeek, function(index) {
                        var tijd = activiteitenWeek[index].andereActiviteit.tijdstip;
                        var datum = activiteitenWeek[index].andereActiviteit.beginDatum;
                        var td = $("tr[class=" + tijd + "]").find("." + datum);

                        td.addClass("font-weight-bold text-dark");

                        if (activiteitenWeek[index].andereActiviteit.soortId == 2)
                        {
                        td.find(".event-rij").find(".3").addClass("event event-ander").attr('id', 'ander' + index);
                        } else {
                        td.find(".event-rij").find(".4").addClass("event event-stage").attr('id', 'ander' + index);
                        }
                    });
                }
            } catch (error) {
                alert("-- ERROR IN JSON --\n" + result);
            }
        },
        error: function (xhr, status, error) {
            alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
        }
    });
};

$(document).ready(function () {

    var id = $("input[name=id]").val();
    var week = $("input[name=week]").val();
    var jaar = $("input[name=jaar]").val();
    var activiteitId = "";

    haalActiviteitenOp(week, jaar);

    $(".gebeurtenis").hide();

    $("table").on('click', '.event', function () {
        $(".gebeurtenis").hide();
        var id = $(this).attr("id");
        var klasse = $(this).closest('tr').attr("class");
        $("div." + id + "." + klasse).show();
      });

      $(".modal-trigger").click(function() {
        activiteitId = $(this).closest('div').attr('id');
        $('#mijnDialoogscherm').modal('show');
      })

      $("#buttonDelete").click(function(){
        verwijderActiviteit(activiteitId);
      })

      function verwijderActiviteit(id){
        $.ajax({type: "GET",
        url: site_url + "/activiteit/verwijder/" + id,
        data:{id : id},
          success: function(){
          window.location.reload();
         },
        error: function (xhr, status, error){
          alert("--ERROR IN AJAX --\n\n" + xhr.responseText);
        }
      });
      }
});
