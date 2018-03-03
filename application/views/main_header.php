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
                    <a class="nav-link" href="#">Startpagina <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Zwemmers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Wedstrijden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Over ons</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="E-mail" aria-label="E-mail">
                <input class="form-control mr-sm-2" type="password" placeholder="Wachtwoord" aria-label="Wachtwoord">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Inloggen</button>
            </form>
        </div>
    </div>
</nav>
