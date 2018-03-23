<?php
$leeftijd = 18;
$disciplines = "100m vlinderslag";
?>

<div class="container">

    <div class="row text-center">
        <div class="col-md-10 mt-2">
            <h3><?php echo $zwemmer->naam; ?></h3>
        </div>
    </div>

    <div class="row text-center mt-4 pb-3">
        <div class="col-md-3 offset-1"><img src="http://placehold.it/250x250"/></div>
        <div class="col-md-6 text-left">
            <p><b>Leeftijd: </b><?php echo $leeftijd; ?></p>
            <p><b>Woonplaats: </b><?php echo $zwemmer->woonplaats; ?></p>
            <p><b>Dsiciplines: </b><?php echo $disciplines; ?></p>
            <p><b>Bio: </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad at autem delectus, distinctio explicabo illum iusto laborum laudantium maiores, maxime minima minus natus possimus reprehenderit repudiandae rerum temporibus veniam veritatis?</p>
        </div>
    </div>

    <div class="row text-left mt-5">
        <div class="col-md-3 offset-2">
            <h5>Aanstaande wedstrijden</h5>
            <p>To-do</p>
        </div>

        <div class="col-md-3 offset-1">
            <h5>Laatste resultaten</h5>
            <p>To-do</p>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-11">
            <?php echo anchor('gebruiker/toonZwemmers', 'Terug', "Class='btn btn-primary my-2 my-sm0'");?>
        </div>
    </div>
</div>

