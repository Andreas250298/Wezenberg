<?php
if ($supplementenPerAlleZwemmers != NULL){
$namen = [];
foreach ($supplementenPerAlleZwemmers as $supplementPerZwemmer) {
    array_push($namen, $supplementPerZwemmer->gebruikerIdZwemmer);
}

foreach ($zwemmers as $zwemmer) {
    if (in_array($zwemmer->id, $namen)) {
        echo "<h3>$zwemmer->naam</h3>";
        echo "</br>";
        echo "<table class='table'>
        <thead>
        <tr>
        <th>
        Supplement
        </th>
        <th>
        Hoeveelheid
        </th>
        <th>
        Tijdstip
        </th>
        <th>
        Datum
        </th>
        <th></th>
            </tr>
        </thead>
        <tbody>";
        foreach ($supplementenPerAlleZwemmers as $supplementPerZwemmer) {
            if ($supplementPerZwemmer->gebruikerIdZwemmer == $zwemmer->id) {
                $data = array('type' => 'hidden', 'name' => 'supplementPerZwemmerId', 'id' => 'id', 'value' => $supplementPerZwemmer->id);
                echo "<tr>
                  <td>
                  ".$supplementPerZwemmer->supplement->naam."
                  </td>
                  <td>
                  ".$supplementPerZwemmer->hoeveelheid." g
                  </td>
                  <td>
                  ".$supplementPerZwemmer->tijdstipInname."
                  </td>
                  <td>
                  ".zetOmNaarDDMMYYYY($supplementPerZwemmer->datumInname)."
                  </td>
                  <td>".form_input($data) . anchor('supplement/aanpassenSupplementPerZwemmer/'.$supplementPerZwemmer->id, '<button type="button" style="margin-right : 10px;" class="btn btn-success btn-xs btn-round"><i class="fas fa-edit"></i></button>')."<button type=\"button\" class=\"btn btn-danger btn-xs btn-round modal-trigger\"><i class=\"fas fa-times\"></i></button></td>
                </tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        echo "</br>";
    }
}
}else{
    echo "<h4 class=\"mx-auto\">Deze zwemmer heeft nog geen toegekende supplementen!</h4>";
    echo '</br>';
};