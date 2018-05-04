<?php
$lijstWedstrijden = "";
  echo "<h1 class='title'>" . $wedstrijd->naam . "</h1>";
  echo "<p>" . $wedstrijd->beschrijving . "</p>";
  foreach ($reeksen as $reeks) {
      $lijstWedstrijden .= "<tr><td>" .
      $reeks->id . "</td><td>";
      foreach ($slagenPerReeks as $slag) {
          if (isset($slag->soort)) {
              $lijstWedstrijden .= $slag->soort;
          }
      }

      $lijstWedstrijden .= "</td><td>";
      foreach ($afstanden as $afstand) {
          if (isset($afstand->afstand)) {
              $lijstWedstrijden .= $afstand->afstand;
          }
      }

      $lijstWedstrijden .= "</td><td>" . $reeks->tijdstip ."</td></tr>";
  }
?>
<table class="table">
  <thead>
    <tr>
      <td>
        Reeksnummer
      </td>
      <td>
        Slag
      </td>
    <td>
      Afstand
    </td>
    <td>
      Tijdstip
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstWedstrijden;
    ?>
  </tbody>
</table>
<?php
        echo anchor('Wedstrijd/index', 'terug', 'class="btn btn-primary"');
?>
