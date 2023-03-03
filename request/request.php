<?php

    //Ce fichier contient plusieurs fonctions. Une fonction par requete. Cela permet de réunir toutes les requetes du serveur au même endroit afin d'avoir plus de visibilité et un débug simplifié.

    function requeteConnexionUser(PDO $pdo, String $login)
    {
        $stmt = $pdo->prepare("
            SELECT *
            FROM user u
            INNER JOIN role r
            ON u.role = r.idRole
            WHERE login=?
        ");
        $stmt->execute(array($login));
        return $stmt->fetchall();
    }

    function requeteAjouterDemande(PDO $pdo, String $libelle, String $message, int $userId)
    {
        $stmt = $pdo->prepare("
            INSERT INTO demande (user, libelle, text, employe, priorite, etat)
            VALUE (?, ?, ?, NULL, 1, 'non assignée')
        ");
        $stmt->execute(
            array(
                $userId,
                $libelle,
                $message
            )
        );
    }

    function getAllUser(PDO $pdo)
    {
        $stmt = $pdo->prepare("
            SELECT idUser, nom, prenom
            FROM user
            WHERE role = 3;
        "); // Sélectionner tous les utilisateurs Employés.

        $stmt->execute(array());
        return $stmt;
    }

    function showBdd(PDO $pdo, String $employe, String $priorite, String $etat)
    {

        if($employe == "NULL")
        {
            $employe = NULL;
            $employe_quote = "employe IS ?";
        }
        else
        {
            $employe = intval($employe);
            $employe_quote = "employe = ?";
        }

        if($priorite == "NULL")
        {
            $priorite = NULL;
            $priorite_quote = "priorite IS ?";
        }
        else
        {
            $priorite = intval($priorite);
            $priorite_quote = "priorite = ?";
        }

        if($etat == "NULL")
        {
            $etat = NULL;
            $etat_quote = "etat IS ?";
        }
        else
        {
            $etat_quote = "etat = ?";
        }

        if($employe == NULL and $priorite == NULL and $etat == NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
            ");
            $stmt->execute(array());
        }
        else if($employe == NULL and $priorite == NULL and $etat != NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $etat_quote
            ");
            $stmt->execute(array($etat));
        }
        else if($employe == NULL and $priorite != NULL and $etat == NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $priorite_quote
            ");
            $stmt->execute(array($priorite));
        }
        else if($employe == NULL and $priorite != NULL and $etat != NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $priorite_quote
                AND $etat_quote
            ");
            $stmt->execute(array($priorite, $etat));
        }
        else if($employe != NULL and $priorite == NULL and $etat == NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $employe_quote
            ");
            $stmt->execute(array($employe));
        }
        else if($employe != NULL and $priorite == NULL and $etat != NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $employe_quote
                AND $etat_quote
            ");
            $stmt->execute(array($employe, $etat));
        }
        else if($employe != NULL and $priorite != NULL and $etat == NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $employe_quote
                AND $priorite_quote
            ");
            $stmt->execute(array($employe, $priorite));
        }
        else if($employe != NULL and $priorite != NULL and $etat != NULL)
        {
            $stmt = $pdo->prepare("
                SELECT *
                FROM demande
                WHERE $employe_quote
                AND $priorite_quote
                AND $etat_quote
            ");
            $stmt->execute(array($employe, $priorite, $etat));
        }
        return $stmt;
    }

    function getUserById(PDO $pdo, int $id)
    {
        $stmt = $pdo->prepare("
            SELECT idUser, nom, prenom
            FROM user
            WHERE idUser = ?
        ");
        $stmt->execute(array($id));
        return $stmt->fetchall();
    }

    function getDemandeByUserId(PDO $pdo, $idUser)
    {
        $stmt = $pdo->prepare("
            SELECT idDemande, libelle, text, priorite, etat
            FROM demande
            WHERE employe = ?
        ");
        $stmt->execute(array($idUser));
        return $stmt->fetchall();
    }

    function updateDemande(PDO $pdo, int $idDemande, string $libelle, string $text, string $priorite, string $etat)
    {
        $stmt = $pdo->prepare("
            UPDATE demande
            SET
                libelle = ?,
                text = ?,
                priorite = ?,
                etat = ?
            WHERE idDemande = ?
        ");
        $stmt->execute(array(
            $libelle,
            $text,
            $priorite,
            $etat,
            $idDemande
        ));
    }

    function updateDemandeResponsable(PDO $pdo, int $id, int $employe, int $priorite, string $etat)
    {
      $stmt = $pdo->prepare("
        UPDATE demande
        SET
          employe = ?,
          priorite = ?,
          etat = ?
        WHERE idDemande = ?
      ");
      $stmt->execute(array($employe, $priorite, $etat, $id));
    }

    function getDemandeById(PDO $pdo, int $id)
    {
      $stmt = $pdo->prepare("
        SELECT *
        FROM demande
        WHERE idDemande = ?;
      ");
      $stmt->execute(array($id));
      return $stmt->fetchall();
    }

    function getAllDemandeEnCours(PDO $pdo){
        $stmt = $pdo->prepare("
            SELECT 
                d.libelle as \"Libelle\",
                d.text as \"Description\",
                u.nom as \"Nom\",
                u.prenom as \"Prenom\",
                d.priorite as \"Priorite\"
            FROM demande d
            INNER JOIN user u
            ON d.employe = u.idUser
            WHERE d.etat = \"en cours de realisation\";
        ");
        $stmt->execute(array());
        return $stmt->fetchall();
    }

?>
