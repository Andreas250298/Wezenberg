<?php
  echo "<H1 class='title'>" . $nieuwsArtikel->titel . "</h1>";
  echo "<p class='text-muted'>" . zetOmNaarDDMMYYYY($nieuwsArtikel->datumAangemaakt) . "</p>";
  echo "<p>" . $nieuwsArtikel->beschrijving . "</p>";

  if ($gebruiker != null) {
    echo anchor('Nieuws/index', 'terug', 'class="btn btn-primary"');
  } else {
    echo anchor('home/index', 'terug', 'class="btn btn-primary"');
  }
 ?>
