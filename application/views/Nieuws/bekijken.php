<?php
/**
 * @file Nieuws/bekijken.php
 *
 * View waarop een nieuwsartikel kan worden bekeken.
 */
  if($nieuwsArtikel->foto != ""){
    echo "<img class='img-fluid' src='" . base_url($nieuwsArtikel->foto) . "'/>";
  }

  echo "<H1 class='title'>" . $nieuwsArtikel->titel . "</h1>";
  echo "<p class='text-muted'>" . zetOmNaarDDMMYYYY($nieuwsArtikel->datumAangemaakt) . "</p>";
  echo "<p>" . $nieuwsArtikel->beschrijving . "</p>";
if(isset($gebruiker->soort)) {
  if ($gebruiker->soort == 'trainer') {
      echo anchor('Nieuws/index', 'terug', 'class="btn btn-primary"');
    }
} else {
    echo anchor('home/index', 'terug', 'class="btn btn-primary"');
  }
 ?>
