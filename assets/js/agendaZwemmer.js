function haalWedstrijdenOp(week, jaar) {
    $.ajax({type: "GET",
        url: site_url + "/gebruiker/haalJsonOp_Wedstrijden",
        data: {huidigeWeek: week, huidigJaar: jaar},
        success: function (result) {
            try {
                var wedstrijdenWeek = jQuery.parseJSON(result);

                if (wedstrijdenWeek != null) {
                    $.each(wedstrijdenWeek, function(index) {
                        var tijd = wedstrijdenWeek[index].reeks.tijdstip;
                        var datum =  wedstrijdenWeek[index].reeks.datum;
                        var td = $("tr[class=" + tijd + "]").find("." + datum);

                        td.addClass("font-weight-bold text-dark");
                        td.find(".event-rij").find(".1").addClass("event event-wed").attr('id', 'wed' + index);
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

function haalSupplementenOp(week, jaar) {
    $.ajax({type: "GET",
        url: site_url + "/gebruiker/haalJsonOp_Supplementen",
        data: {huidigeWeek: week, huidigJaar: jaar},
        success: function (result) {
            try {
                var supplementenWeek = jQuery.parseJSON(result);

                if (supplementenWeek != null) {
                    $.each(supplementenWeek, function(index) {
                        var tijd = supplementenWeek[index].tijdstip;
                        var datum =  supplementenWeek[index].datumInname;
                        var td = $("tr[class=" + tijd + "]").find("." + datum);

                        td.addClass("font-weight-bold text-dark");
                        td.find(".event-rij").find(".2").addClass("event event-supp").attr('id', 'supp' + index);
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

    haalWedstrijdenOp(week, jaar);
    haalSupplementenOp(week, jaar);
    haalActiviteitenOp(week, jaar);

    $("table").on('click', '.event', function () {
        $(".gebeurtenis").hide();
        var id = $(this).attr("id");
        var klasse = $(this).closest("tr").attr("class");
        $('#gebeurtenis-modal').modal('show');
        $("div." + id + "." + klasse).show();
      });
});
