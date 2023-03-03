<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!Doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Bienvenue</title>
    </head>

    <body>
        <?php

            require("../settings.php");
            require("../class/User.php");
            require("../../library/Template.php");
            require("../template/menu.php");

            menu($root);

            if(isset($_SESSION["user"]))
            {
                $user = $_SESSION["user"];
                echo "Bienvenue " .  $user->getNom() . " "  . $user->getPrenom() . ". Vous êtes un " .  $user->getRole() . ".<br/>";
                echo "<ul>Liste des permissions";
                $permissions = $user->getPermission();
                foreach($permissions as $cle => $value)
                {
                    if($value == 1)
                    {
                        echo "<li>$cle => $value</li>";
                    }
                }
                echo "</ul>";
            }
            else
            {
                echo "Vous n'êtes pas encore connecté.<br/>";
                echo "<a href=\"$root/html/connexion.html\">Connexion</a>";
            }

        ?>
    </body>

</html>
