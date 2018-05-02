<?php

$namen = "";

foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
    $namen .= $supplementPerZwemmer->zwemmer->naam;
}
var_dump($namen);

foreach ($zwemmers as $zwemmer) {
    if (array_key_exists($zwemmer->naam, $supplementenPerZwemmer)) {
        echo $zwemmer->naam. "</br>";
    }
}
