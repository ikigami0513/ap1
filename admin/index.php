<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("../class/User.php");
    require_once("../settings.php");
    require_once("../request/request.php");
    require_once("../request/connexionBdd.php");

    session_start();

    if(!isset($_SESSION["user"])){ header("Location:$root/html/connexion.php"); }

    if(!$_SESSION["user"]->isAdmin()){ header("Location:$root/php/espace.php"); }

?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Administration</title>
        <style>
            .row{
                display: flex;
                width: 80%;
                border: 1px solid black;
                padding: 10px;
                margin-left: auto;
                margin-right: auto;
            }

            .row .nom, .row .prenom, .row .voiture, .row .action{
                width: 25%;
            }
        </style>
    </head>
    <body>
        <h1>Responsables</h1>
        <div class="row">
            <div class="nom">Nom</div>
            <div class="prenom">Prénom</div>
            <div class="voiture">Voiture</div>
            <div class="action">Action</div>
        </div>
        <?php
            $pdo = connexionBdd();
            $responsables = get_all_responsable($pdo);

            foreach($responsables as $responsable){
                $voiture = get_voiture($pdo, $responsable["voiture"]);
                if($voiture == null){
                    echo '
                        <div class="row">
                            <div class="nom">' . $responsable["nom"] . '</div>
                            <div class="prenom">' . $responsable["prenom"] . '</div>
                            <div class="voiture"></div>
                            <div class="action"><a href="' . $root . '/admin/modifier.php?id=' . $responsable['idUser'] . '"><button>Modifier</button></a></div>
                        </div>
                    ';
                }
                else{
                    echo '
                        <div class="row">
                            <div class="nom">' . $responsable["nom"] . '</div>
                            <div class="prenom">' . $responsable["prenom"] . '</div>
                            <div class="voiture">' . $voiture->__toString() . '</div>
                            <div class="action"><a href="' . $root . '/admin/modifier.php?id=' . $responsable['idUser'] . '"><button>Modifier</button></a></div>
                        </div>
                    ';
                }
            }
        ?>
    </body>
</html>