<?php
$supplementIds = [];

if ($supplementenPerZwemmer == null) {
    echo '<div>Je moet momenteel geen supplementen innemen of de trainer heeft je supplementen nog niet toegevoegd.</div>';
} else {
    foreach($supplementenPerZwemmer as $supplementPerZwemmer){
        array_push($supplementIds,$supplementPerZwemmer->supplementId);
    }
    foreach ($supplementen as $supplement){
        if (in_array($supplement->id, $supplementIds)){
        echo "<h4>";
        echo $supplement->naam;
        echo "</h4>";
        echo "<h5>";
        echo "(".$supplement->beschrijving.")";
        echo "</h5>";
        echo "<table class=\"table\">
        <thead>
          <tr>
          <td>
            Hoeveelheid
          </td>
          <td>
            Tijdstip
          </td>
          <td>
            Datum
          </td>
          </tr>
        </thead>
        <tbody>";
          foreach($supplementenPerZwemmer as $supplementPerZwemmer){
              if ($supplement->id === $supplementPerZwemmer->supplementId){
              echo "<tr>";
              echo "<td>";
              echo $supplementPerZwemmer->hoeveelheid." g";
              echo "</td><td>";
              echo $supplementPerZwemmer->tijdstipInname;
              echo "</td><td>";
              echo zetOmNaarDDMMYYYY($supplementPerZwemmer->datumInname);
              echo "</td></tr>";
              }
            }
          };
        echo "</tbody>
      </table>";
    }
}
?>