<?php
$link = array('class' => 'nav-link');
?>
<!--Banner-->
<nav class="navbar navbar-light">
    <div class="container">   
        <div class="justify-content-start d-flex flex-row">
            <a class="navbar-brand" href="#">
                <?php echo toonAfbeelding("logo/teambelgium.png", 'width="110" height="150" class="d-inline-block align-top" alt="Logo Team Belgium"'); ?>
            </a>
            <a class="navbar-brand align-self-end" href="#">
                <span class="align-bottom display-4 d-none d-lg-block">Wezenberg trainingscentrum</span>
            </a>
        </div>
    </div>
</nav>

<!--Navigatiebalk-->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand display-1 d-lg-none mb-0 h1" href="#">Wezenberg trainingscentrum</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home/index">Startpagina <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <?php echo anchor('gebruiker/toonZwemmers', 'Zwemmers', $link);?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home/wedstrijden">Wedstrijden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home/overons">Over ons</a>
                </li>
            </ul>
            <?php
            // Indien niet ingelogd, toont loginformulier
            if (!$this->session->has_userdata('gebruiker_id')) {
                $dataInputEmail = array('class' => 'form-control mr-sm-2', 'type' => 'text', 'name' => 'email', 'id' => 'email', 'placeholder' => 'E-mail', 'aria-label' => 'E-mail');
                $dataInputWachtwoord = array('class' => 'form-control mr-sm-2', 'type' => 'password', 'name' => 'wachtwoord', 'id' => 'wachtwoord', 'placeholder' => 'Wachtwoord', 'aria-label' => 'Wachtwoord');
                $dataSubmit = array('class' => 'btn btn-outline-success my-2 my-sm0', 'value' => 'Inloggen');

                echo form_open('home/controleerAanmelden', 'class="form-inline my2 my-lg0"');
                echo form_input($dataInputEmail);
                echo form_input($dataInputWachtwoord);
                echo form_submit($dataSubmit);
                echo form_close();
            }
            //
            // Indien ingelogd, toont welkom bericht
            else if ($gebruiker != null) {
                switch ($gebruiker->soort) {
                    case 'zwemmer': // zwemmer
                        //echo "<p>Welkom zwemmer" . $gebruiker->naam . "</p>";
                        //echo divAnchor('product/bestel', 'Producten bestellen');
                        ?>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="home/supplementen">Supplementen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home/mijnagenda">Mijn Agenda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home/inschrijvingen">Inschrijvingen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home/account">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home/meldAf">Uitloggen</a>
                            </li>
                        </ul>

                        <?php
                        break;
                    case 'trainer': // trainer
                        
                        ?>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="home/account">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home/meldAf">Uitloggen</a>
                            </li>
                        </ul>

                        <?php
                        break;
                }
            }

            ;
            ?>
        </div>
    </div>
</nav>
