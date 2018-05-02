<script type="text/javascript">
function haalWedstrijdenOp(week, jaar) {
    $.ajax({type: "GET",
        url: site_url + "/gebruiker/haalJsonOp_Wedstrijden",
        data: {huidigeWeek: week, huidigJaar: jaar},
        success: function (result) {
            try {
                // datum = .datum tijdstip = .tijdstip afstand = .afstand slag = .soort wedstrijd = .naam plaats = .plaats beschrijving = .beschrijving reeksid = .id
                var wedstrijdenWeek = jQuery.parseJSON(result);

                if (wedstrijdenWeek != null) {
                    $.each(wedstrijdenWeek, function(index) {
                        var tijd = wedstrijdenWeek[index].reeks.tijdstip;
                        var datum =  wedstrijdenWeek[index].reeks.datum;

                        $("tr[class=" + tijd + "]").find("[class=" + datum + "]").css("border", "2px solid #777777").css("background-color", "#94c3f7").addClass("font-weight-bold").addClass("text-dark").addClass("wedstrijd").attr('id', "wedstrijd_" + index).html(wedstrijdenWeek[index].wedstrijd.naam);
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
                // datum = .datum tijdstip = .tijdstip afstand = .afstand slag = .soort wedstrijd = .naam plaats = .plaats beschrijving = .beschrijving reeksid = .id
                var supplementenWeek = jQuery.parseJSON(result);

                if (supplementenWeek != null) {
                    $.each(supplementenWeek, function(index) {
                        var tijd = supplementenWeek[index].tijdstip;
                        var datum =  supplementenWeek[index].datumInname;

                        $("tr[class=" + tijd + "]").find("[class=" + datum + "]").css("border", "2px solid #777777").css("background-color", "#bfbfbf").addClass("font-weight-bold").addClass("text-dark").addClass("supplement").attr('id', "supplement_" + index).html(supplementenWeek[index].informatie.naam);
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
                // datum = .datum tijdstip = .tijdstip afstand = .afstand slag = .soort wedstrijd = .naam plaats = .plaats beschrijving = .beschrijving reeksid = .id
                var activiteitenWeek = jQuery.parseJSON(result);

                if (activiteitenWeek != null) {
                    $.each(activiteitenWeek, function(index) {
                        if (activiteitenWeek[index].andereActiviteit.soortId == 1 )
                        {
                          var datum = activiteitenWeek[index].andereActiviteit.beginDatum;
                            $("table").find("[class=" + datum + "]:not(:first)").remove();
                            $("[class=" + datum + "]").attr('rowspan', 18).css("border", "2px solid #777777").css("background-color", "#f9a557").addClass("font-weight-bold").addClass("text-dark").addClass("activiteit").attr('id', "activiteit_" + index).html(activiteitenWeek[index].andereActiviteit.naam);
                        } else {
                          var tijd = activiteitenWeek[index].andereActiviteit.tijdstip;
                          var datum = activiteitenWeek[index].andereActiviteit.beginDatum;

                          $("tr[class=" + tijd + "]").find("[class=" + datum + "]").css("border", "2px solid #777777").css("background-color", "#a9f285").addClass("font-weight-bold").addClass("text-dark").addClass("activiteit").attr('id', "activiteit_" + index).html(activiteitenWeek[index].andereActiviteit.naam);
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
    var output = "test";

    haalWedstrijdenOp(week, jaar);
    $("[class*=wedstrijd]").hide();

    haalSupplementenOp(week, jaar);
    $("[class*=supplement]").hide();

    haalActiviteitenOp(week, jaar);
    $("[class*=activiteit]").hide();


    $("table").on('click', '.wedstrijd', function () {
        $(".gebeurtenis").hide();
        var huidigeWedstrijd = $(this).attr("id");
        $("[id=" + huidigeWedstrijd + "]").show();
      });

    $("table").on('click', '.supplement', function () {
        $(".gebeurtenis").hide();
        var huidigSupplement = $(this).attr("id");
        $("[id=" + huidigSupplement + "]").show();
      });

      $("table").on('click', '.activiteit', function () {
          $(".gebeurtenis").hide();
          var huidigeActiviteit = $(this).attr("id");
          $("[id=" + huidigeActiviteit + "]").show();
        });

});

</script>

<?php
$maandag = new DateTime;
$maandag->setTime(0, 0, 0);
$maandag->setISODate(intval($jaar), intval($week));
$zondag = clone $maandag;
$zondag->modify('+6 day');

if ($week == 52)
{
    $volgendeWeek = 1;
    $volgendJaar  = $jaar + 1;
} else {
    $volgendeWeek = $week + 1;
    $volgendJaar = $jaar;
}

if ($week == 1)
{
    $vorigeWeek = 52;
    $vorigJaar  = $jaar - 1;
} else {
    $vorigeWeek = $week - 1;
    $vorigJaar = $jaar;
}

$dt = clone $maandag;



if (isset($_GET['y']) && isset($_GET['w']))
{
  $dt->setISODate($_GET['y'], $_GET['w']);
} else {
  $dt->setISODate($dt->format('o'), $dt->format('W'));
}



$y = $dt->format('o');
$w = $dt->format('W');
$dagen = array('0' => "", '1' => "Maandag", '2' => "Dinsdag", '3' => "Woensdag", '4' => "Donderdag",
                '5' => "Vrijdag", '6' => "Zaterdag", '7' => "Zondag");
$maanden = array('1' => "Januari", '2' => "Februari", '3' => "Maart", '4' => "April", '5' => "Mei", '6' => "Juni",
                  '7' => "Juli", '8' => "Augustus", '9' => "September", '10' => "Oktober", '11' => "November", '12' => "December");
$uren = array('1' => "07:00", '2' => "08:00", '3' => "09:00", '4' => "10:00", '5' => "11:00", '6' => "12:00",
              '7' => "13:00", '8' => "14:00", '9' => "15:00", '10' => "16:00", '11' => "17:00", '12' => "18:00",
              '13' => "19:00", '14' => "20:00", '15' => "21:00", '16' => "22:00", '17' => "23:00", '18' => "24:00");
;?>





<div class="container text-center">
  <div class="row">
    <div class="col-sm-12">
      <h2>Mijn agenda</h2>
      <h3>

          <?php
              echo $maandag->format('j') . ' ' . $maanden[$maandag->format('n')] . ' ' . $maandag->format('Y') . ' - '
                  . $zondag->format('j') . ' ' . $maanden[$zondag->format('n')] . ' ' . $zondag->format('Y');
              echo form_hidden('week', $week);
              echo form_hidden('jaar', $jaar);
              echo form_hidden('id', $gebruiker->id);
          ?>
      </h3>
      <p>Klik op een evenement om de details te bekijken</p>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-2 offset-3">
      <?php echo anchor('gebruiker/agenda/' . $vorigeWeek . '/' . $vorigJaar, 'Vorige week', 'class="nav-link"'); ?>
    </div>
    <div class="col-sm-2 offset-2">
      <?php echo anchor('gebruiker/agenda/' . $volgendeWeek . '/' . $volgendJaar, 'Volgende week', 'class="nav-link"'); ?>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered text-muted">
          <thead class="font-weight-bold">
            <?php
                $t = 1;

                do {
                    $maand = $dt->format('n');
                    echo "<td>" . $dagen[$t] . "<br>" . $dt->format('j') . " " . $maanden[$maand] . " " . $dt->format('Y') . "</td>\n";
                    $dt->modify('+1 day');
                    $t++;
                } while ($w == $dt->format('W'));
            ;?>
          </thead>
          <?php
              for ($i=1; $i < 19; $i++) {
                echo '<tr class="' . substr($uren[$i], 0, 2) . '">';
                $dt3 = clone $dt;
                $dt3->modify('-1 week');
                for ($j=1; $j < 8; $j++)
                {
                  echo '<td class="' . $dt3->format('Y-m-d'). '">' . '&nbsp;' . $uren[$i] .  '</td>';
                  $dt3->modify('+1 day');
                }
                echo '</tr>';
              }
          ;?>
        </table>
      </div>
    </div>
  </div>

  <div class="row">
      <div class="col-sm-12">
          <div class="text-left">
              <?php
                $teller = 0;
                if ($wedstrijden != null)
                {
                    foreach ($wedstrijden as $wedstrijd)
                    {
                            echo "<div class='wedstrijd gebeurtenis' id='wedstrijd_" . $teller . "'>";
                            echo "<span><b>" . $wedstrijd->wedstrijd->naam . " " . $wedstrijd->wedstrijd->plaats . "</b></span><br />";
                            echo "Beginuur: " . $wedstrijd->reeks->uur . "<br />";
                            echo "Slag: " . $wedstrijd->slag->soort . "<br />";
                            echo "Afstand: " . $wedstrijd->afstand->afstand . "<br />";
                            echo "Beschrijving: " . $wedstrijd->wedstrijd->beschrijving . "<br />";
                            echo "</div>";
                            $teller++;
                    }
                }

                $teller = 0;
                if ($supplementen != null)
                {
                    foreach ($supplementen as $supplement)
                    {
                            echo "<div class='supplement gebeurtenis' id='supplement_" . $teller . "'>";
                            echo "<span><b>" . $supplement->informatie->naam . "</b></span><br />";
                            echo "Tijdstip: " . $supplement->uur . "<br />";
                            echo "Hoeveelheid: " . $supplement->hoeveelheid . "g<br />";
                            echo "Beschrijving: " . $supplement->informatie->beschrijving . "<br />";
                            echo "</div>";
                            $teller++;
                    }
                }

                $teller = 0;
                if ($activiteiten != null)
                {
                    foreach ($activiteiten as $activiteit)
                    {
                            echo "<div class='activiteit gebeurtenis' id='activiteit_" . $teller . "'>";
                            echo "<span><b>" . $activiteit->andereActiviteit->naam . "</b></span><br />";
                            if ($activiteit->andereActiviteit->soortId == 1)
                            {
                              echo "Vertrek: " . zetOmNaarDDMMYYYY($activiteit->andereActiviteit->beginDatum) . "<br />";
                              echo "Terug: " . zetOmNaarDDMMYYYY($activiteit->andereActiviteit->eindDatum) . "<br />";
                            }
                            echo "Tijdstip: " . $activiteit->andereActiviteit->uur . "<br />";
                            echo "Locatie: " . $activiteit->andereActiviteit->plaats . "<br />";
                            echo "Beschrijving: " . $activiteit->andereActiviteit->beschrijving . "<br />";
                            echo "</div>";
                            $teller++;
                    }
                }
              ;?>
          </div>
      </div>
  </div>
</div>