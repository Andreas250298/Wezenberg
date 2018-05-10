<?php
/**
 * @file SupplementPerZwemmer/toekennen.php
 *
 * View een supplement kan worden toegevoegd aan een zwemmer.
 */
    $dataHoeveelheid = array('class' => 'form-control mr-sm-2','type' => 'number', 'name' => 'hoeveelheid', 'id' => 'hoeveelheid', 'placeholder' => '', 'aria-label' => 'Titel', 'size' => '5', 'data-toggle' => 'tooltip', 'title' => 'Vul hier de hoeveelheid voor de iname in.', 'min' => '1', 'max' => '1000','required' => 'required');
    $dataStartDatumInname = array('class' => 'form-control mr-sm-2','type' => 'date', 'name' => 'startDatum', 'id' => 'startDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de datum in dat het supplement moet worden ingenomen.','required' => 'required');
    $dataEindeDatumInname = array('class' => 'form-control mr-sm-2','type' => 'date', 'name' => 'eindeDatum', 'id' => 'eindeDatum','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de datum in dat het supplement moet worden ingenomen.','required' => 'required');
    $dataTijdstipInname = array('class' => 'form-control mr-sm-2','type' => 'time', 'name' => 'tijdstip', 'id' => 'tijdstip','size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier het tijdstip in dat het supplement moet worden ingenomen.','required' => 'required');


$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan', 'id' => 'opslaan');
echo form_open('Supplement/toekennen', 'class="form-group"');
echo "<div class='form-group'>";
echo form_label("Zwemmers: ", 'zwemmer') . "\n";
echo "</br>";
echo "<select name='zwemmers[]' id='zwemmers' class='form-control' multiple required='true'>";
foreach ($zwemmers as $zwemmer) {
    echo "<option value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
}
echo "</select>";
echo "<div>";
echo "</br>";

echo "<div class='form-group'>";
echo form_label("Supplement: ", 'supplement') . "\n";
echo "<select name='supplement' id='supplement' class='form-control' required='true'>";
foreach ($supplementen as $supplement) {
    echo "<option value='" . $supplement->id . "'>" . $supplement->naam . "</option>\n";
}
echo "</select>";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Hoeveelheid (g):", 'hoeveelheid') . "\n";
echo form_input($dataHoeveelheid) . "\n";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Start Datum:", 'startDatum') . "\n";
echo form_input($dataStartDatumInname) . "\n";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Einde Datum:", 'eindeDatum') . "\n";
echo form_input($dataEindeDatumInname) . "\n";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Tijdstip:", 'tijdstip') . "\n";
echo form_input($dataTijdstipInname) . "\n";
echo "</div>";

echo form_submit($dataSubmit) . "\n";
echo anchor('supplement/supplementenPerZwemmerTrainer',"<button type=\"button\" class=\"btn btn-primary mx-auto\">Terug</button>");

echo form_close();
