<?php
echo "<div class='form-group'>";
echo form_label("Zwemmer: ", 'zwemmer') . "\n";
echo "<select name='zwemmer' id='zwemmer' multiple>";
foreach ($zwemmers as $zwemmer) {
    echo "<option value='" . $zwemmer->id . "'>" . $zwemmer->naam . "</option>\n";
}
echo "</select>";
echo "\t";
echo form_label("Supplement: ", 'supplement') . "\n";
echo "<select name='supplement' id='supplement' multiple>";
foreach ($supplementen as $supplement) {
    echo "<option value='" . $supplement->id . "'>" . $supplement->naam . "</option>\n";
}
echo "</select>";
echo "</div>";
