<div class="row">
    <div class="col-sm-8 overOns">
        <h2>Welkom</h2>
        <?php echo $trainingscentrum->beschrijvingWelkom; ?>
    </div>
    <div class="col-sm-12 overOns">
        <?php echo toonAfbeelding('trainingscentrum/' . $trainingscentrum->fotoWelkom, 'width="100%"') ?>
    </div>
    <div class="col-sm-4 overOns">
        <?php echo toonAfbeelding('trainingscentrum/' . $trainingscentrum->fotoLocatie, 'width="100%"') ?>
    </div> 
    <div class="col-sm-8 overOns">
        <h2>Locatie Wezenberg</h2>
        <?php echo $trainingscentrum->beschrijvingLocatie; ?>
    </div>
    <div class="col-sm-8 overOns">
        <h2>Het nationaal zwemteam</h2>
        <?php echo $trainingscentrum->beschrijvingTeam; ?>
    </div>
    <div class="col-sm-4 overOns">
        <?php echo toonAfbeelding('trainingscentrum/' . $trainingscentrum->fotoTeam, 'width="100%"') ?>
    </div>
    <div class="col-sm-4 overOns">
        <?php echo toonAfbeelding('trainingscentrum/' . $trainingscentrum->fotoTrainer, 'width="100%"') ?>
    </div> 
    <div class="col-sm-8 overOns">
        <h2>De trainers</h2>
        <?php echo $trainingscentrum->beschrijvingTrainer; ?>
    </div>
</div>