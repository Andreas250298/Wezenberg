<?php
$lijstSupplementenPerZwemmer = '';
if ($supplementenPerZwemmer != null) {
    foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
        $lijstSupplementenPerZwemmer .= '<tr>
    <td>'.$supplementPerZwemmer->supplement->naam.'</td>
    <td>'.$supplementPerZwemmer->supplement->beschrijving.'</td>
    <td>
    '.zetOmNaarDDMMYYYY($supplementPerZwemmer->datumIname).'
    </td><td>
      '.$supplementPerZwemmer->tijdstipIname.'
      </td><td>
      '.$supplementPerZwemmer->hoeveelheid.' g
      </td>
    </tr>';
    }
}
<<<<<<< HEAD
if($supplementenPerZwemmer == null){
  echo "<div>Je moet momenteel geen supplementen innemen of de trainer heeft je supplementen nog niet toegevoegd.</div>";
=======
?>

<?php
if ($supplementenPerZwemmer == null) {
    echo '<div>Je moet momenteel geen supplementen innemen of de trainer heeft je supplementen nog niet toegevoegd.</div>';
>>>>>>> a4364f58c161afa02f8336cb29cb4da4acb8a3fc
} else {
    echo "<table class=\"table\">
    <thead>
      <tr>
        <td>
          Naam
        </td>
      <td>
        Beschrijving
      </td>
      <td>
        Datum
      </td>
      <td>
        Tijdstip
      </td>
      <td>
        Hoeveelheid
      </td>
      </tr>
    </thead>
    <tbody>
      $lijstSupplementenPerZwemmer
    </tbody>
  </table>";
}
?>
<br/>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
