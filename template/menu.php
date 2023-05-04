<?php

    function menu($root)
    {
        session_start();
        $logo = array("url"=>$root, "text"=>"Maison des Ligues");
        if(isset($_SESSION["user"]))
        {
            if($_SESSION["user"]->isAdmin()){
                Template::menu(
                    $logo,
                    array(
                        "Administration" => "$root/admin/index.php",
                        "Bienvenue"=>"$root/php/bienvenue.php",
                        "Espace"=>"$root/php/espace.php",
                        "Déconnexion"=>"$root/php/deconnexion.php",
                        $_SESSION["user"]->getNom() . " " . $_SESSION["user"]->getPrenom() . "<br/>" . $_SESSION["user"]->getRole() => "#"
                    )
                );
            }
            else{
                Template::menu(
                    $logo,
                    array(
                        "Bienvenue"=>"$root/php/bienvenue.php",
                        "Espace"=>"$root/php/espace.php",
                        "Déconnexion"=>"$root/php/deconnexion.php",
                        $_SESSION["user"]->getNom() . " " . $_SESSION["user"]->getPrenom() . "<br/>" . $_SESSION["user"]->getRole() => "#"
                    )
                );
            }
        }
        else
        {
            Template::menu(
                $logo,
                array("Connexion"=>"$root/html/connexion.php")
            );
        }
    }

?>
