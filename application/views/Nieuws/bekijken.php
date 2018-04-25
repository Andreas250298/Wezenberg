<?php
  echo "<H1 class='title'>" . $nieuwsArtikel->titel . "</h1>";
  echo "<p class='text-muted'>" . zetOmNaarDDMMYYYY($nieuwsArtikel->datumAangemaakt) . "</p>";

  echo "<p>" . $nieuwsArtikel->beschrijving . "</p>";
 ?>
