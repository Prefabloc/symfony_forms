<?php

namespace App\Service;

class UserDTO
{
    public $id ;
    public $societe;
    public $username;
    public $password;
    public $nom;
    public $prenom;

    public function __construct( $id , $societe , $username , $password , $nom , $prenom )
    {
        $this->id = $id;
        $this->societe = $societe;
        $this->username = $username;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
}