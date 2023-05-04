<?php

    class Voiture{
        private int $id;
        private string $marque;
        private string $modele;

        public function __construct(int $id, string $marque, string $modele){
            $this->id = $id;
            $this->marque = $marque;
            $this->modele = $modele;
        }

        public function getId(): int { return $this->id; }
        public function getMarque(): string { return $this->marque; }
        public function getModele(): string { return $this->modele; }

        public function __toString(){
            return $this->marque . ' ' . $this->modele;
        }
    }