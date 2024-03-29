<?php

    require_once("Voiture.php");

    class User
    {
        private int $id;
        private String $sessionId;
        private String $nom;
        private String $prenom;
        private String $role;
        private bool $isAdmin;
        private $voiture;
        private Bool $creerDemande;
        private Bool $modifierPriorite;
        private Bool $assignerEmploye;
        private Bool $modifierEtat;

        public function __construct(int $id, String $sessionId, String $nom, String $prenom, String $role,  $voiture, bool $isAdmin, Bool $creerDemande, Bool $modifierPriorite, Bool $assignerEmploye, Bool $modifierEtat)
        {
            $this->id = $id;
            $this->sessionId = $sessionId;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->role = $role;
            $this->voiture = $voiture;
            $this->isAdmin = $isAdmin;
            $this->creerDemande = $creerDemande;
            $this->modifierPriorite = $modifierPriorite;
            $this->assignerEmploye = $assignerEmploye;
            $this->modifierEtat = $modifierEtat;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getSessionId()
        {
            return $this->sessionId;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getPrenom()
        {
            return $this->prenom;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function isAdmin(){
            return $this->isAdmin;
        }

        public function getVoiture(){
            return $this->voiture;
        }

        public function getPermission()
        {
            $permission = array(
                "creerDemande" => $this->creerDemande,
                "modifierPriorite" => $this->modifierPriorite,
                "assignerEmploye" => $this->assignerEmploye,
                "modifierEtat" => $this->modifierEtat,
            );
            return $permission;
        }
    }
?>
