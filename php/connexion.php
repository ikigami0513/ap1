<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../class/User.php");
    require("../request/connexionBdd.php");
    require("../request/request.php");
    require("../settings.php");

    if(isset($_POST["login"]) and isset($_POST["password"]))
    {
        $pdo = connexionBdd();

        foreach($_POST as $cle => $value)
        {
            $_POST[$cle] = htmlspecialchars($value);
        }

        $login = $_POST["login"];
        $password = $_POST["password"];
        $isAuthent = false;

        $data = requeteConnexionUser($pdo, $login);
        if(count($data) > 0)
        {
            $isAuthent = true;
            $dataDb = $data[0];
        }

        if($isAuthent == true)
        {
            if(md5(htmlspecialchars_decode($password)) == $dataDb["password"])
            {
                session_set_cookie_params(0);
                session_start();
                $user = new User(
                    $dataDb["idUser"],
                    session_id(),
                    $dataDb["nom"],
                    $dataDb["prenom"],
                    $dataDb["libelle"],
                    $dataDb["creerDemande"],
                    $dataDb["modifierPriorite"],
                    $dataDb["assignerEmploye"],
                    $dataDb["modifierEtat"],
                );
                $_SESSION["user"] = $user;
                header("Location:$root/php/bienvenue.php");
            }
            else
            {
                session_start();
                $_SESSION["erreur"] = "Le login et/ou le mot de passe sont incorrects.";
                header("Location:$root/html/connexion.php");
            }
        }
        else
        {
            session_start();
            $_SESSION["erreur"] = "Le login et/ou le mot de passe sont incorrects.";
            header("Location:$root/html/connexion.php");
        }
    }
?>
