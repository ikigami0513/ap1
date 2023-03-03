<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../class/User.php");
    require("../request/connexionBdd.php");
    require("../request/request.php");
    require("../settings.php");

    session_start();

    if(isset($_SESSION["user"]))
    {
        if($_SESSION["user"]->getRole() == "Employe" or $_SESSION["user"]->getRole() == "Responsable")
        {
            if(isset($_POST["idDemande"]) and isset($_POST["libelle"]) and isset($_POST["text"]) and isset($_POST["priorite"]) and isset($_POST["etat"]))
            {
                $idDemande = $_POST["idDemande"];
                $libelle = $_POST["libelle"];
                $text = $_POST["text"];
                $priorite = $_POST["priorite"];
                $etat = $_POST["etat"];

                $pdo = connexionBdd();

                updateDemande(
                    $pdo,
                    $idDemande,
                    $libelle,
                    $text,
                    $priorite,
                    $etat,
                );

                $_SESSION["success"] = "<script>alert(\"La tâche a bien été modifiée.\");</script>";

                header("Location: $root/php/espace.php");
            }
        }
    }

?>
