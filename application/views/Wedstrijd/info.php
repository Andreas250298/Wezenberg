<?php
/**
 * @file Wedstrijd/info.php
 *
 * View waarin informatie te zien is over een bepaalde wedstrijd.
 */
$teller = 1;
$lijstWedstrijden = "";
  echo "<h1 class='title'>" . $wedstrijd->naam . "</h1>";
  echo "<p>" . $wedstrijd->beschrijving . "</p>";
  if (isset($reeksen)) {
      foreach ($reeksen as $reeks) {
          $lijstWedstrijden .= "<tr><td>" .
        $teller . "</td><td>";
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
          $teller++;
      }
  }
 if ($reeksen != null) {
     echo "<div class=\"table-responsive\"><table class=\"table\">
  <thead>
    <tr>
      <th>
        Reeksnummer
      </th>
      <th>
        Slag
      </th>
    <th>
      Afstand
    </th>
    <th>
      Tijdstip
    </th>
    </tr>
  </thead>
  <tbody>
     $lijstWedstrijden
  </tbody>
</table></div>";
 } else {
     echo "<p>Er zijn voor deze wedstrijd nog geen reeksen</p>";
 }?>
 <a id="terug" href="javascript:history.go(-1);" class="btn btn-primary">Terug</a>
