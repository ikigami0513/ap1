<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

    require("../../request/connexionBdd.php");
    require("../../request/request.php");
    require("../../class/User.php");
    require("../../settings.php");

    session_start();
    if(isset($_SESSION["user"]))
    {
        if($_SESSION["user"]->getRole() == "Responsable")
        {
            if(isset($_POST["employe"]) and isset($_POST["priorite"]) and isset($_POST["etat"]))
            {
                $employe = $_POST["employe"];
                $priorite = $_POST["priorite"];
                $etatPost = $_POST["etat"];

                $pdo = connexionBdd();

                $dataDb = showBdd($pdo, $employe, $priorite, $etatPost)->fetchall();

                echo "<table><thead><tr>";

                foreach($dataDb[0] as $cle=>$value)
                {
                  echo "<th>$cle</th>";
                }

                echo "<th>modification</th>";

                echo "</tr></thead></tbody>";

                foreach($dataDb as $cle=>$value)
                {
                  echo "<tr>";
                  foreach($value as $cle2=>$value2)
                  {
                    echo "<td>$value2</td>";
                  }

                  echo "
                    <td>
                      <a href=\"$root/php/modifierDemandeResponsable.php?id=" . $value["idDemande"] . "\"><button>Modifier</button></a>
                    </td>
                  ";
                  echo "</tr>";
                }

                echo "</tbody></table>";
            }
        }
    }

?>
