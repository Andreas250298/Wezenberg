<?php
/**
 * @file SupplementPerZwemmer/aanpassen.php
 *
 * View supplementen per zwemmer kan aanpassen
 */
$dataHoeveelheid = array('class' => 'form-control mr-sm-2','type' => 'number', 'name' => 'hoeveelheid', 'id' => 'hoeveelheid', 'value' => $supplementPerZwemmer->hoeveelheid, 'aria-label' => 'Titel', 'size' => '5', 'data-toggle' => 'tooltip', 'title' => 'Vul hier de hoeveelheid voor de iname in.', 'min' => '1', 'max' => '1000','required' => 'required');
$dataDatumInname = array('class' => 'form-control mr-sm-2','type' => 'date', 'name' => 'datum', 'id' => 'datum','value' => $supplementPerZwemmer->datumInname,'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de datum in dat het supplement moet worden ingenomen.','required' => 'required');
$dataTijdstipInname = array('class' => 'form-control mr-sm-2','type' => 'time', 'name' => 'tijdstip', 'id' => 'tijdstip','value' => $supplementPerZwemmer->tijdstipInname,'size' => '30', 'data-toggle' => 'tooltip', 'title' => 'vul hier de datum in dat het supplement moet worden ingenomen.','required' => 'required');
$dataId = array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => $supplementPerZwemmer->id);
$dataZwemmer = array('type' => 'hidden', 'name' => 'zwemmer', 'id' => 'zwemmer', 'value' => $supplementPerZwemmer->gebruikerIdZwemmer);

$dataSubmit = array('class' => 'btn btn-primary my-2 my-sm0', 'value' => 'Opslaan', 'id' => 'opslaan');
echo form_open('Supplement/aanpassen', 'class="form-group"');

echo '<h3>';
echo $supplementPerZwemmer->zwemmer->naam;
echo '</h3>';
echo "<div class='form-group'>";
echo form_label("Supplement: ", 'supplement') . "\n";
echo "<select name='supplement' id='supplement' class='form-control' required='true'>";
foreach ($supplementen as $supplement) {
    if ($supplement->id === $supplementPerZwemmer->supplementId){
        echo "<option value='" . $supplement->id . "'selected>" . $supplement->naam . "</option>\n";
    }else{
        echo "<option value='" . $supplement->id . "'>" . $supplement->naam . "</option>\n";
    }
}
echo "</select>";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Hoeveelheid (g):", 'hoeveelheid') . "\n";
echo form_input($dataHoeveelheid) . "\n";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Datum:", 'datum') . "\n";
echo form_input($dataDatumInname) . "\n";
echo "</div>";

echo "<div class='form-group'>";
echo form_label("Tijdstip:", 'tijdstip') . "\n";
echo form_input($dataTijdstipInname) . "\n";
echo "</div>";

echo form_input($dataId);
echo form_input($dataZwemmer);

echo form_submit($dataSubmit) . "\n";
echo anchor('supplement/supplementenPerZwemmerTrainer',"<button type=\"button\" class=\"btn btn-primary mx-auto\">Terug</button>");

echo form_close();
