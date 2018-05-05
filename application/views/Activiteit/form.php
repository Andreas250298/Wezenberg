<?php

$dt = new DateTime;
$week = $dt->format('W');
$jaar = $dt->format('Y');


if (isset($activiteit))
{
    $dataInputSoort = array('class' => 'form-control mr-sm-2',  'type' => 'text',   'name' => 'soort',  'id' => 'soort',    'placeholder' => 'Soort',   'aria-label' => 'Soort',  'size' => '30', 'value' => $activiteit->soort->naam);
    $dataInputNaam = array('class' => 'form-control mr-sm-2',   'type' => 'text',   'name' => 'naam',   'id' => 'naam',     'placeholder' => 'Naam',    'aria-label' => 'Naam',   'size' => '30', 'value' => $activiteit->naam);
    $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'text',   'name' => 'plaats', 'id' => 'plaats',   'placeholder' => 'Plaats',  'aria-label' => 'Plaats', 'size' => '30', 'value' => $activiteit->plaats);
    $dataInputBeginDatum = array('class' => 'form-control mr-sm-2',   'type' => 'date',     'name' => 'begindatum',     'id' => 'begindatum',     'placeholder' => 'Begindatum',    'aria-label' => 'Begindatum',     'size' => '30', 'value' => $activiteit->beginDatum);
    $dataInputEindDatum = array('class' => 'form-control mr-sm-2',    'type' => 'date',     'name' => 'einddatum',      'id' => 'einddatum',      'placeholder' => 'Einddatum',     'aria-label' => 'Einddatum',      'size' => '30', 'value' => $activiteit->eindDatum);
    $dataInputTijdstip = array('class' => 'form-control mr-sm-2',     'type' => 'time',     'name' => 'tijdstip',       'id' => 'tijdstip',       'placeholder' => 'Tijdstip',      'aria-label' => 'Tijdstip',       'size' => '30', 'value' => $activiteit->tijdstip);
    $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'type' => 'textarea', 'name' => 'beschrijving',   'id' => 'beschrijving',   'placeholder' => 'Beschrijving',  'aria-label' => 'Beschrijving',   'size' => '30', 'value' => $activiteit->beschrijving);
    foreach ($zwemmersBijActiviteit as $zwemmer)
    {
      $ids[] = $zwemmer->gebruikerIdZwemmer;
    }
} else {
  $dataInputSoort = array('class' => 'form-control mr-sm-2',  'type' => 'text',   'name' => 'soort',  'id' => 'soort',    'placeholder' => 'Soort',   'aria-label' => 'Soort',  'size' => '30');
  $dataInputNaam = array('class' => 'form-control mr-sm-2',   'type' => 'text',   'name' => 'naam',   'id' => 'naam',     'placeholder' => 'Naam',    'aria-label' => 'Naam',   'size' => '30');
  $dataInputPlaats = array('class' => 'form-control mr-sm-2', 'type' => 'text',   'name' => 'plaats', 'id' => 'plaats',   'placeholder' => 'Plaats',  'aria-label' => 'Plaats', 'size' => '30');
  $dataInputBeginDatum = array('class' => 'form-control mr-sm-2',   'type' => 'date',     'name' => 'begindatum',     'id' => 'begindatum',     'placeholder' => 'Begindatum',    'aria-label' => 'Begindatum',     'size' => '30');
  $dataInputEindDatum = array('class' => 'form-control mr-sm-2',    'type' => 'date',     'name' => 'einddatum',      'id' => 'einddatum',      'placeholder' => 'Einddatum',     'aria-label' => 'Einddatum',      'size' => '30');
  $dataInputTijdstip = array('class' => 'form-control mr-sm-2',     'type' => 'time',     'name' => 'tijdstip',       'id' => 'tijdstip',       'placeholder' => 'Tijdstip',      'aria-label' => 'Tijdstip',       'size' => '30');
  $dataInputBeschrijving = array('class' => 'form-control mr-sm-2', 'type' => 'textarea', 'name' => 'beschrijving',   'id' => 'beschrijving',   'placeholder' => 'Beschrijving',  'aria-label' => 'Beschrijving',   'size' => '30');
}
  $dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan');

echo form_open_multipart('Activiteit/nieuw', 'class="form-group"');
echo "<div>Type activiteit</div>";
echo "<div class='form-group'>";
echo "<select class='form-control' name='soort' size='1'>";
echo "<option value='2'>Training</option>";
echo "<option value='1'>Stage</option>";
echo "</select>";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Naam", 'naam') . "\n";
echo form_input($dataInputNaam) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_label("Plaats", 'plaats') . "\n";
echo form_input($dataInputPlaats) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Begindatum", 'begindatum') . "\n";
echo form_input($dataInputBeginDatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Einddatum", 'einddatum') . "\n";
echo form_input($dataInputEindDatum) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Tijdstip (07:00 - 22:00)", 'tijdstip') . "\n";
echo form_input($dataInputTijdstip) . "\n";
echo "</div>";
echo "<div class='form-group'>";
echo form_labelpro("Beschrijving", 'beschrijving') . "\n";
echo form_textarea($dataInputBeschrijving) . "\n";
echo "</div>";
echo "<div>Zwemmers</div>";
echo "<div class='form-group'>";
echo "<select name='zwemmers[]' id='zwemmers' class='form-control' multiple required='true' size='10'>";

foreach ($zwemmers as $zwemmer)
{
    if (isset($activiteit))
    {
      if (in_array($zwemmer->id, $ids))
      {
        echo "<option selected value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
      } else {
        echo "<option value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
      }
    } else {
      echo "<option selected value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
    }
}
$dataHidden = array('name' => 'zwemmers[]', 'id' => '999', 'value' => '999', 'type' => 'hidden');
echo form_input($dataHidden);
echo "</select>";
echo "</div>";

if (isset($activiteit)) {
    echo form_hidden('id', $activiteit->id);
} else {
    echo form_hidden('id', null);
}
echo form_submit($dataSubmit) . " " . anchor('activiteit/index/' . $week . '/' . $jaar, 'Terug', "Class='btn btn-primary my-2 my-sm0'");
echo form_close();
echo "</table>";

?>
