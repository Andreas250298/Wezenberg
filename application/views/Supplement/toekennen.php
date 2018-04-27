<?php
$supplementen = "";
$zwemmers = "";

echo "<div class='form-group'>";
echo form_label("Zwemmer: ", 'zwemmer') . "\n";
echo "<select name='zwemmer' id='zwemmer'>";
foreach ($zwemmers as $zwemmer) {
    echo "<option value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
}
echo "</select>";
echo "</div>";
