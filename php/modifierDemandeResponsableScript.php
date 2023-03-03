<?php

  require("../settings.php");
  require("../class/User.php");
  require("../request/connexionBdd.php");
  require("../request/request.php");

  if(
    isset($_POST["id"]) and
    isset($_POST["employe"]) and
    isset($_POST["priorite"]) and
    isset($_POST["etat"])
  )
  {
    session_start();
    if(isset($_SESSION["user"]))
    {
      if($_SESSION["user"]->getRole() == "Responsable")
      {
        $id = $_POST["id"];
        $employe = $_POST["employe"];
        $priorite = $_POST["priorite"];
        $etat = $_POST["etat"];

        $pdo = connexionBdd();
        updateDemandeResponsable($pdo, $id, $employe, $priorite, $etat);

        $_SESSION["success"] = "La demande a bien été mise à jour!";

        header("Location:$root/php/modifierDemandeResponsable.php?id=" . $id);
      }
    }
  }

?>
