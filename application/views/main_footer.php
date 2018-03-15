<?php
$link = array('class' => 'nav-link');
?>
<!--Navigatiebalk-->
<nav class="navbar navbar-expand-lg navbar-light fixed-bottom">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <?php echo anchor('gebruiker/index', 'Startpagina', $link);?>
                </li>
                <li class="nav-item">
                    <?php echo anchor('gebruiker/toonZwemmers', 'Zwemmers', $link);?>
                </li>
                <li class="nav-item">
                      <?php echo anchor('wedstrijd/index', 'Wedstrijden', $link);?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Over ons</a>
                </li>
            </ul>
        </div>
        <span class="navbar-text">
            &COPY; Wezenberg, Team-12, 2018
        </span>
    </div>
</nav>
