<?php
$lijstWedstrijden = '';

foreach ($wedstrijden as $wedstrijd) {
    if ($wedstrijd->beginDatum < date("Y-m-d")) {
        $lijstWedstrijden .= '<tr>
      <td>'
      .anchor('Wedstrijd/info/' . $wedstrijd->id, $wedstrijd->naam).
      '</td>
      <td>'
      .$wedstrijd->plaats.
      '</td>
      <td>'
      .$wedstrijd->beginDatum.
      '</td>
      <td>'
      .$wedstrijd->eindDatum.
      '</td></tr>';
    }
}
if (isset($gebruiker)) {
    if ($gebruiker->soort == "trainer") {
        echo '<p>'.anchor('wedstrijd/maakWedstrijd', 'Nieuwe Wedstrijd aanmaken').'</p>';
    }
}
?>

<table class="table">
  <thead>
    <tr>
      <td>
        Naam
      </td>
    <td>
      Plaats
    </td>
    <td>
      Start
    </td>
    <td>
      Einde
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstWedstrijden;
    ?>
  </tbody>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
