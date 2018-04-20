<?php
$lijstWedstrijden = '';
$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Inschrijven');
$attributen = array('id' => 'mijnFormulier',
    'class' => 'form-inline my2 my-lg0',
    'data-toggle' => 'validator',
    'role' => 'form');

foreach ($wedstrijden as $wedstrijd) {
    $lijstWedstrijden .= '<tr>
    <td>'
    .$wedstrijd->naam.
    '</td>
    <td>'
    .$wedstrijd->plaats.
    '</td>
    <td>'
    .$wedstrijd->beginDatum.
    '</td>
    <td>'
    .$wedstrijd->eindDatum.
    '</td><td>'. 
    form_submit($dataSubmit);
    '</td><td></tr>';

}
  foreach ($status as $deel) {
    if (isset($status)) {
  if ($deel->naam != null) {
  $lijstWedstrijden .= "<tr><td>" .
  $deel->naam ."</td></tr>";
}
}
}
?>
<table class="table">
  <?php echo form_open('Wedstrijd/inschrijven', 'class="form-group"', $attributen);?>
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
  <?php echo form_close();?>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
