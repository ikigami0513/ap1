<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!Doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8"/>
        <title>Maison des League</title>
        <?php
            require("./settings.php");
            require("../library/Template.php");
            require("./template/menu.php");
            require("./class/User.php");
        ?>
    </head>

    <body>
        <?php
            menu($root);
        ?>
    </body>

</html>
