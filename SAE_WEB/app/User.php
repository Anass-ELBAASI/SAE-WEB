<?php

namespace Romai\SaeWeb;

class User {
    public function __construct(private string $email, private string $nom, private string $prenom, private string $mdp) { }
    public function getEmail() : string { return $this->email; }
    public function getPassword() : string { return $this->mdp; }
    public function getNom() : string { return $this->nom; }
    public function getPrenom() : string { return $this->prenom; }
    public function estAdherant() : bool { return true;}
    public function estAdmin() : bool { return false;}

}