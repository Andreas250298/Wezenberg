<?php
$lijstReeksen = '';
foreach ($reeksen as $reeks) {
    $lijstReeksen .= '<tr>
  <td>'
  .$reeks->id.
  '</td>
  <td>'
  .$reeks->datum.
  '</td>
  <td>'
  .$reeks->tijdstip.
  '</td>';
    if (isset($slag)) {
        foreach ($slag as $sl) {
            if (isset($sl->soort)) {
                if ($sl != null) {
                    $lijstReeksen .= "<td>"
      . $sl->soort . "</td>";
                }
            }
        }
    }
    if (isset($afstand)) {
        foreach ($afstand as $afst) {
            if (isset($afst->afstand)) {
                if ($afst != null) {
                    $lijstReeksen .= "<td>"
      . $afst->afstand . "</td>";
                }
            }
        }
    }

    $lijstReeksen .= '</tr>';
}
echo '<p>'.anchor('wedstrijd/maakReeks', 'Reeks toevoegen').'
</p>';
?>
<table class="table">
  <thead>
    <tr>
      <td>
        Reeks
      </td>
    <td>
      Datum
    </td>
    <td>
      Tijdstip
    </td>
    <td>
      Slag
    </td>
    <td>
      Afstand
    </td>
    </tr>
  </thead>
  <tbody>
    <?php
    echo $lijstReeksen;
    ?>
  </tbody>
</table>
<p>
    <a id="terug" href="javascript:history.go(-1);">Terug</a>
</p>
