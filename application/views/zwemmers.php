<?php
echo "<p>" . anchor('gebruiker/');
foreach ($zwemmers as $zwemmer) {
    echo "<p>" . $zwemmer->naam . "</p>";
}
?>
