<?php
$lijstReeksen = '';
foreach ($reeksen as $reeks) {
    $lijstReeksen .= '<tr>
  <td>'
  .$reeks->id.
  '</td>
  <td>'
  .$reeks->datum.
  '</td>
  <td>'
  .$reeks->tijdstip.
  '</td>
  </tr>';
}
echo '<p>'.anchor('wedstrijd/maakReeks', 'Reeks toevoegen').'
</p>';
?>
<table class="table">
  <thead>
    <tr>
      <td>
        Reeks
      </td>
    <td>
      Datum
    </td>
    <td>
      Tijdstip
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstReeksen;
    ?>
  </tbody>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
