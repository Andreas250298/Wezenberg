<?php
/**
 *\file Supplement/ajax_zwemmer.php
 *
 * AJAX view die wordt opgevraagd wanneer er een ander item in de combobox wordt aangeduid.
 */
$supplementIds = [];

if ($supplementenPerZwemmer == null) {
    echo '<div>Je moet momenteel geen supplementen innemen of de trainer heeft je supplementen nog niet toegevoegd.</div>';
} else {
    foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
        array_push($supplementIds, $supplementPerZwemmer->supplementId);
    }
    foreach ($supplementen as $supplement) {
        if (in_array($supplement->id, $supplementIds)) {
            echo "<h4>";
            echo $supplement->naam;
            echo "</h4>";
            echo "<h5>";
            echo "(".$supplement->beschrijving.")";
            echo "</h5>";
            echo "<div class=\"table-responsive\"><table class=\"table\">
        <thead>
          <tr>
          <th>
            Hoeveelheid
          </th>
          <th>
            Tijdstip
          </th>
          <th>
            Datum
          </th>
          </tr>
        </thead>
        <tbody>";
            foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
                if ($supplement->id === $supplementPerZwemmer->supplementId) {
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
      </table></div>";
    }
}
