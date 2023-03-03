<?php

    //fonction permettant à un utilisateur de se connecter (html/connexion.php)
    function connexionForm()
    {
        require("../settings.php");

        echo '<form name="connexionForm" action="'. $root . '/php/connexion.php" method="post">';

        echo '<label for="login">Login</label><br/>';
        echo '<input type="text" name="login" id="login"/><br/>';

        echo '<label for="password">Mot de passe</label><br/>';
        echo '<input type="password" name="password" id="password"/><br/>';

        echo '<input type="submit" name="submit" id="submit" value="Connexion"/><br/>';

        echo '</form>';
        if(isset($_SESSION["erreur"]))
        {
            echo $_SESSION["erreur"];
            unset($_SESSION["erreur"]);
        }
    }

    function createDemande()
    {
        require("../settings.php");

        echo '<h2>Créer une demande</h2>';

        echo '<form name="createDemande" action="'. $root . '/php/createDemande.php" method="post">';

        echo '<label for="libelle">Objet</label><br/>';
        echo '<input type="text" name="libelle" id="libelle"/><br/>';

        echo '<label for="text">Texte</label></br>';
        echo '<textarea name="message" id="message" rows="5" cols="33"></textarea><br/>';

        echo '<input type="submit" name="submit" id="submit" value="Envoyer">';

        echo '</form>';
    }

    function critereBdd()
    {
        require("../settings.php");

        echo "<h2>Afficher les demandes</h2>";

        $pdo = connexionBdd();
        $employes = getAllUser($pdo);

        echo "<table>";

        echo "<tr>"; //ligne des labels

        echo "<td><label for=\"employe\">Employé</label></td>";
        echo "<td><label for=\"priorite\">Niveau de priorité</label></td>";
        echo "<td><label for=\"etat\">État</label></td>";

        echo "</tr>";

        echo "<tr>"; //ligne des critères (alignés avec leurs labels respectifs)

        echo "<td><select name=\"employe\" id=\"employe\">";

        echo "<option value=\"NULL\">-----------</option>";

        while($row = $employes->fetch())
        {
            echo "<option value=\"" . $row["idUser"] . "\">" . $row["nom"] . " " . $row["prenom"] . "</select>";
        }

        echo "</select></td>";

        echo "<td><select name=\"priorite\" id=\"priorite\">";
        echo "<option value=\"NULL\">-----------</option>";

        for($i=0; $i<3; $i++)
        {
            echo "<option value=\"" . $i+1 . "\">" . $i+1 . "</option>";
        }

        echo "</select></td>";

        echo "<td>";

        echo "<select name=\"etat\" id=\"etat\">";

        echo "<option value=\"NULL\">-----------</option>";

        for($i = 0; $i<count($etat); $i++)
        {
            echo "<option value=\"$etat[$i]\">$etat[$i]</option>";
        }

        echo "</select>";

        echo "</tr></table>";

        echo "<button id=\"ajaxButton\">Rechercher</button> ";

    }

    function showAllDemande(array $value)
    {
        require("../settings.php");

        echo "<tr>";

        echo "<form method=\"post\" action=\"$root/php/modifierDemandeEmploye.php\">";

        foreach($value as $cle2=>$value2)
        {
            if($value2 != end($value))
            {
                echo "<td>$value2</td>";
                echo "<input type=\"hidden\" name=\"$cle2\" id=\"$cle2\" value=\"$value2\">";
            }
            else
            {
                echo "
                    <td>

                        <select id=\"etat\" name=\"etat\">

                            <option value=\"$value2\">$value2</option>

                ";

                foreach($etat as $value3)
                {
                    if($value3 != $value2)
                    {
                        echo "<option value=\"$value3\">$value3</option>";
                    }
                }

                echo "

                        </select>

                    </td>
                ";
            }
        }

        echo "<td><input type=\"submit\" value=\"Modifier\"/></td>";

        echo "</form>";

        echo "</tr>";
    }

    function modifierDemandeResponsableForm(PDO $pdo, array $data, $user, $employe, $allEmploye)
    {
      require("../settings.php");

      echo "<form name=\"modifierDemandeResponsableForm\" action=\"$root/php/modifierDemandeResponsableScript.php\" method=\"post\">";

      echo "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"" . $data["idDemande"] . "\"/>";

      echo "<label for=\"user\">Utilisateur</label><br/>";
      echo "<input type=\"text\" id=\"user\" name=\"user\" value=\"" . $user["nom"] . " " . $user["prenom"] . "\" disabled/><br/>";

      echo "<br/>";

      echo "<label for=\"libelle\">Libelle</label><br/>";
      echo "<input type=\"text\" id=\"libelle\" name=\"libelle\" value=\"" . $data["libelle"] . "\" disabled/><br/>";

      echo "<br/>";

      echo "<label for=\"text\">Description</label><br/>";
      echo "<textarea name=\"text\" id=\"text\" rows=\"5\" columns=\"33\" disabled>";
      echo $data["text"];
      echo "</textarea><br/>";

      echo "<br/>";

      echo "<label for=\"employe\">Employé</label><br/>";
      echo "<select name=\"employe\" id=\"employe\">";
      if($employe != null)
      {
        echo "<option value=\"" . $employe[0]["idUser"] . "\">" . $employe[0]["nom"] . " " . $employe[0]["prenom"] . "</option>";
        echo "<option>----------</option>";
        foreach($allEmploye as $cle=>$value)
        {
          if($employe[0]["idUser"] != $value["idUser"])
          {
            echo "<option value=\"" . $value["idUser"] . "\">" . $value["nom"] . " " . $value["prenom"] . "</option>";
          }
        }
      }
      else
      {
        echo "<option>----------</option>";
        foreach($allEmploye as $cle=>$value)
        {
          echo "<option value=\"" . $value["idUser"] . "\">" . $value["nom"] . " " . $value["prenom"] . "</option>";
        }
      }
      echo "</select><br/>";

      echo "<br/>";

      echo "<label for=\"priorite\">Priorité</label><br/>";
      echo "<select name=\"priorite\" id=\"priorite\">";
      echo "<option>" . $data["priorite"] . "</option>";

      for($i=1; $i<4; $i++)
      {
        if($i != $data["priorite"])
        {
          echo "<option>$i</option>";
        }
      }

      echo "</select><br/>";

      echo "<br/>";

      echo "<label for=\"etat\">État</label><br/>";
      echo "<select name=\"etat\" id=\"etat\">";
      echo "<option>" . $data["etat"] . "</option>";

      foreach($etat as $cle=>$value)
      {
        if($value != $data["etat"])
        {
          echo "<option>$value</option>";
        }
      }

      echo "</select><br/>";

      echo "<br/>";

      echo "<input type=\"submit\" value=\"Modifier\"/>";
      echo "</form>";
    }

?>
