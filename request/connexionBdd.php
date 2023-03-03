<?php

    //Connexion à la bdd
    function connexionBdd()
    {
        $host = "127.0.0.1";
        $db = "ap1";
        $user = "root";
        $pass = "root123?";
        $dsn = "mysql:host=$host;dbname=$db";
        $options =
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try
        {
            $pdo = new PDO($dsn, $user, $pass, $options);
        }
        catch (\PDOException $e)
        {
            print "ERREUR : $e";
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;
    }
    //Fin de la connexion à la bdd

?>
