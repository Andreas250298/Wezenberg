<?php
$lijstWedstrijden = "";
  echo "<h1 class='title'>" . $wedstrijd->naam . "</h1>";
  echo "<p>" . $wedstrijd->beschrijving . "</p>";
  foreach ($reeksen as $reeks) {
      $lijstWedstrijden .= "<tr><td>" .
      $reeks->id . "</td>";
      foreach ($slagen as $slag) {
          $lijstWedstrijden .= "<td>".
    $slag->soort . "</td><td>";
          foreach ($afstanden as $afstand) {
              $lijstWedstrijden .= $afstand->afstand . "</td><td>";
          }

          $lijstWedstrijden .= $reeks->tijdstip . "</td></tr>";
      }
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
if ($gebruiker != null) {
        echo anchor('Wedstrijd/index', 'terug', 'class="btn btn-primary"');
    } else {
        echo anchor('home/index', 'terug', 'class="btn btn-primary"');
    }
?>
