<!DOCTYPE html>
<html lang="nl">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Wezenberg Testproject">
        <meta name="author" content="Team 12, Thomas More">

        <title><?php echo $titel; ?></title>

        <!-- Bootstrap Core CSS -->
        <?php echo pasStylesheetAan("bootstrap.css"); ?>
        <!-- Custom CSS -->
        <?php echo pasStylesheetAan("heroic-features.css"); ?>
        <!-- Buttons CSS -->
        <?php echo pasStylesheetAan("buttons.css"); ?>

        <?php echo haalJavascriptOp("jquery-3.1.0.min.js"); ?>
        <?php echo haalJavascriptOp("bootstrap.js"); ?>

        <script type="text/javascript">
            var site_url = '<?php echo site_url(); ?>';
            var base_url = '<?php echo base_url(); ?>';
        </script>

    </head>

    <body>
        <header id="hoofding">
            <?php echo $hoofding; ?>
        </header>
        <div id="inhoud">
            <?php echo $inhoud; ?>
        </div>
        <footer id="voetnoot">
            <?php echo $voetnoot; ?>
        </footer>
    </body>
</html>
