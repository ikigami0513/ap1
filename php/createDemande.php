<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../request/request.php");
    require("../request/connexionBdd.php");
    require("../class/User.php");
    require("../settings.php");

    if(isset($_POST["libelle"]) and isset($_POST["message"]))
    {
        foreach($_POST as $cle => $value)
        {
            $_POST[$cle] = htmlspecialchars($value);
        }

        session_start();
        $pdo = connexionBdd();
        requeteAjouterDemande(
            $pdo,
            $_POST["libelle"],
            $_POST["message"],
            $_SESSION["user"]->getId(),
        );

        $_SESSION["addDemande"] = "La demande a été envoyée avec succès.";

        header("Location: $root/php/espace.php");
    }
?>
