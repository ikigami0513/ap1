<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../class/User.php");
    require("../request/connexionBdd.php");
    require("../request/request.php");
    require("../settings.php");

    session_start();

    if(!isset($_SESSION["user"])){ header("Location:$root/html/connexion.php"); }
    if(!$_SESSION["user"]->isAdmin()){ header("Location:$root/php/espace.php"); }
    if(!isset($_GET["id"])){ header("Location:$root/admin/index.php"); }

    $pdo = connexionBdd();
    $id = htmlspecialchars($_GET["id"]);
    $user = getUserById($pdo, $id);
    if(count($user) == 0){
        $error = true;
    }
    else{
        $error = false;
        $user = $user[0];
        $voiture = get_voiture($pdo, $user["id_voiture"]);
    }

    if(isset($_POST["submit"])){
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $email = htmlspecialchars($_POST["email"]);
        $voiture = htmlspecialchars($_POST["voiture"]);
        updateUser($pdo, $id, $nom, $prenom, $email, $voiture);
        $success = true;
    }
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Modifier</title>
    </head>
    <body>
        <?php
            if($error){
                echo "Aucun utilisateur ne correspond à l'id $id";
            }
            else{
                echo '
                    <form action="" method="post">
                        <input type="text" name="nom" id="nom" placeholder="nom" value="' . $user["nom"] . '"/><br/>
                        <input type="text" name="prenom" id="prenom" placeholder="nom" value="' . $user["prenom"] . '"/><br/>
                        <input type="email" name="email" id="email" placeholder="nom" value="' . $user["email"] . '"/><br/>
                        <select name="voiture" id="voiture">
                            <option value="0">-------</option>
                ';
                $voitures = get_all_voitures_disponibles($pdo);
                foreach($voitures as $dispo){
                    echo '<option value="' . $dispo['id'] . '">' . $dispo['marque'] . ' ' . $dispo['modele'] . '</option>';
                }
                echo '
                    </select><br/>
                    <input type="submit" value="Modifier" name="submit" id="submit"/><br/>
                ';
                if(isset($success)){
                    if($success){
                        echo $user["nom"] . " " . $user["prenom"] . " a bien été mis à jour.";
                    }
                }
            }
        ?>
    </body>
</html>