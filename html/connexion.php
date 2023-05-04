<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!Doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
    </head>

    <body>

        <center>
                <?php
                    /**
                     * Pourquoi ce fichier .php est dans le dossier html ?
                     * Au début du developpement, j'ai crée cette page en html car il n'y avait aucune nécéssité d'utiliser du php.
                     * Puis j'en ai eu besoin pour boucler sur la page si le mot de passe ou le login est faux.
                     */

                    require("../settings.php");
                    require("../template/menu.php");
                    require("../../library/Template.php");
                    require("../class/User.php");
                    menu($root);
                    require("../php/form.php");
                    connexionForm();

                ?>
            </form>
        </center>

    </body>
</html>
