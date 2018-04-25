<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// +----------------------------------------------------------
// | xxx - notation_helper
// +----------------------------------------------------------
// | 2 ITF - 201x-201x
// +----------------------------------------------------------
// | Notation Helper
// |
// +----------------------------------------------------------
// | Thomas More Kempen
// +----------------------------------------------------------

// databasedatum in juiste formaat zetten (van yyyy-mm-dd naar dd/mm/jjjj)

function zetOmNaarDDMMYYYY($input) {
    if ($input == "") {
        return "";
    } else {
        $datum = explode("-", $input);
        return $datum[2] . "-" . $datum[1] . "-" . $datum[0];
    }
}

// ingegeven datum in formaat van database plaatsen (van dd/mm/jjjj naar yyyy-mm-dd)

function zetOmNaarYYYYMMDD($input) {
    if ($input == "") {
        return "";
    } else {
        $datum = explode("/", $input);
        return $datum[2] . "-" . $datum[1] . "-" . $datum[0];
    }
}

// database decimaal getal tonen met komma (van 999.99 naar 999,99)

function zetOmNaarKomma($input) {
    if ($input == "") {
        return "";
    } else {
        $getal = explode(".", $input);
        if (count($getal) == 2) {
            return $getal[0] . ',' . $getal[1];
        } else {
            return $getal[0];
        }
    }
}

// ingegeven decimaal getal omzetten in databaseformaat (van 999,99 naar 999.99)

function zetOmNaarPunt($input) {
    if ($input == "") {
        return "";
    } else {
        $getal = explode(",", $input);
        if (count($getal) == 2) {
            return $getal[0] . '.' . $getal[1];
        } else {
            return $getal[0];
        }
    }
}

// ingegeven datum omzetten naar geschreven notatie (van 2018-12-31 naar 31 December 2018)

function zetOmNaarGeschreven($input) {
  $maanden = array("01" => "Januari", "02" => "Ferbuari", "03" => "Maart", "04" => "April", "05" => "Mei", "06" => "Juni",
                  "07" => "Juli", "08" => "Augustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "December");

  if ($input == "") {
      return "";
  } else {
    $datum = explode("-", $input);
    if (count($datum) == 3) {
      $maand = $datum[1];

      return $datum[2] . " " . $maanden[$maand] . " " . $datum[0];
    } else {
      return $datum[0];
    }
  }
}

// laat ms wegvallen bij tijdstip (08:30:00 naar 08:00)

function verkortTijdstip($input) {
  if ($input == "") {
      return "";
  } else {
      $string = (string) $input;
      $datum = explode(':', $string);
      $uit = $datum[0] . ':' . $datum[1];
      return $uit;
  }
}

// Laat dubbelpunt wegvallen bij tijdstip (08:00 naar 0800)

function verwijderDubbelpunt($input) {
    if ($input == "") {
        return "";
    } else {
        $uur = explode(":", $input);
        return $uur[0] . $uur[1];
    }
}

// Verhoogt uur van opgegeven tijdstip met 1 (09:00 naar 10:00)

function verhoogUur($input) {
  if ($input == "") {
    return "";
  } else {
    $uur = explode(":", $input);
    return (int)$uur[0] + 1 . ':' . $uur[1];
  }
}

/* End of file notation_helper.php */
/* Location: helpers/notation_helper.php */
