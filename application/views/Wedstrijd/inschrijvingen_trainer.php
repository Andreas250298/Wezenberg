<?php
    $inschrijvingen = "";
    foreach ($deelnames as $deelname) {
        $inschrijvingen .=
                '<tr>
                     <td>' . anchor('Gebruiker/toonZwemmerInfo/' . $deelname->zwemmer->id, $deelname->zwemmer->naam) . '</td>
                     <td>' . anchor('Wedstrijd/info/' . $deelname->reeks->wedstrijd->id . '/' . $deelname->tijd, $deelname->reeks->wedstrijd->naam) . '</td>
                     <td>' . $deelname->reeks->slag->soort . '</td>
                     <td>' . $deelname->reeks->afstand->afstand . '</td>
                     <td>' . $deelname->status->naam . '</td>
                     <td>
                        <button type="button" class="btn btn-success btn-xs btn-round btn-goedkeuren" title="Goedkeuren"><i class="fas fa-check"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn-round btn-afkeuren" title="Weigeren"><i class="fas fa-times"></i></button>
                    </td>
                </tr>';
    }
?>

<br />
<h2 class="mx-auto">Overzicht inschrijvingen</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Zwemmer</th>
                <th>Wedstrijd</th>
                <th>Slag</th>
                <th>Afstand</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $inschrijvingen; ?>
        </tbody>
    </table>
</div>
