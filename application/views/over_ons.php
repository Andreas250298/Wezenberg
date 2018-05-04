<?php
/**
 * @file over_ons.php
 *
 * View waarin de informatie over het trainingscentrum Wezenberg getoond wordt.
 * - krijgt een $trainingscentrum-object binnen
 */
?>

<div class="row">
    <div class="col-lg-12 overOns">
        <h2>Welkom</h2>
        <?php echo $trainingscentrum->beschrijvingWelkom; ?>
    </div>
    <div class="col-lg-12 overOns">
        <?php echo '<img src="' . base_url('uploads/info/' . $trainingscentrum->fotoWelkom) . '" width="100%"/>'; ?>
    </div>
    <div class="col-lg-4 d-none d-lg-block overOns">
        <?php echo '<img src="' . base_url('uploads/info/' .$trainingscentrum->fotoLocatie) . '" width="100%"/>'; ?>
    </div>
    <div class="col-lg-8 overOns">
        <h2>Locatie Wezenberg</h2>
        <?php echo $trainingscentrum->beschrijvingLocatie; ?>
    </div>
    <div class="col-lg-8 overOns">
        <h2>Het nationaal zwemteam</h2>
        <?php echo $trainingscentrum->beschrijvingTeam; ?>
    </div>
    <div class="col-lg-4 overOns">
        <?php echo '<img src="' . base_url('uploads/info/' .$trainingscentrum->fotoTeam) . '" width="100%"/>'; ?>
    </div>
    <div class="col-lg-4 d-none d-lg-block overOns">
        <?php echo '<img src="' . base_url('uploads/info/' .$trainingscentrum->fotoTrainer) . '" width="100%"/>'; ?>
    </div>
    <div class="col-lg-8 overOns">
        <h2>De trainers</h2>
        <?php echo $trainingscentrum->beschrijvingTrainer; ?>
    </div>
</div>
