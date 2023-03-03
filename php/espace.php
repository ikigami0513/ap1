<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!Doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8"/>
        <title>Espace personnel</title>
        <script src="../javascript/jquery.js"></script>
        <script src="../javascript/ajax.js"></script>
    </head>

    <body onload="ajaxOnLoad();">

        <?php
            require("../template/menu.php");
            require("../class/User.php");
            require("./form.php");
            require("../settings.php");
            require("../request/connexionBdd.php");
            require("../request/request.php");
            require("../../library/Fonction.php");
            require("../../library/Template.php");

            menu($root);

            if(isset($_SESSION["user"]))
            {
                $user = $_SESSION["user"];

                if($user->getRole() == "Utilisateur")
                {
                    echo "<center>";
                    createDemande();

                    if(isset($_SESSION["addDemande"]))
                    {
                        echo $_SESSION["addDemande"];
                        unset($_SESSION["addDemande"]);
                    }

                    echo "</center>";
                }

                else if($user->getRole() == "Responsable")
                {
                    echo "<br/><a href=\"$root/php/createPdf.php\" target=\"_blank\">Pdf des tâches en cours</a><br/>";

                    echo "<center>";
                    critereBdd();

                    echo "<div name=\"resultat\" id=\"resultat\"></div>";
                    echo "</center>";
                }

                else if($user->getRole() == "Employe")
                {
                    if(isset($_SESSION["success"]))
                    {
                        echo $_SESSION["success"];
                        unset($_SESSION["success"]);
                    }

                    echo "<center>";
                    $pdo = connexionBdd();
                    $data = getDemandeByUserId($pdo, $_SESSION["user"]->getId());

                    echo "<table><thead><tr>";

                    foreach($data[0] as $cle=>$value)
                    {
                        echo "<th>$cle</th>";
                    }

                    echo "<th>Modifier</th>";

                    echo "</tr></thead><tbody>";

                    foreach($data as $cle=>$value)
                    {
                        showAllDemande($value);
                    }

                    echo "</tbody></table>";

                    echo "</center>";
                }
            }
            else
            {
                echo "Vous n'êtes pas connectés. Vous pouvez vous connecter <a href=\"$root/html/connexion.php\">ici</a>.";
            }
        ?>

    </body>

</html>
