<?php

  require("../settings.php");
  require("../class/User.php");
  require("../request/connexionBdd.php");
  require("../request/request.php");
  require("./form.php");
  require("../../library/Template.php");
  require("../template/menu.php");

  Template::header(
    "Modifier une demande",
    array()
  );

  menu($root);

  if(isset($_GET["id"]))
  {
    if(isset($_SESSION["user"]))
    {
      if($_SESSION["user"]->getRole() == "Responsable")
      {
        $pdo = connexionBdd();
        $data = getDemandeById($pdo, $_GET["id"]);

        echo "<center>";

        if($data[0]["employe"] != null)
        {
          modifierDemandeResponsableForm($pdo, $data[0], getUserById($pdo, $data[0]["user"])[0], getUserById($pdo, $data[0]["employe"]), getAllUser($pdo));
        }
        else
        {
          modifierDemandeResponsableForm($pdo, $data[0], getUserById($pdo, $data[0]["user"])[0], null, getAllUser($pdo));
        }

        if(isset($_SESSION["success"]))
        {
          echo $_SESSION["success"];
          unset($_SESSION["success"]);
        }

        echo "</center>";

      }
    }
  }

  Template::footer();

?>
