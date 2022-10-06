<?php

// @author Elise

class Role
{
    private $actor;
    private $personnage;
    private $idRole;


    public function __construct($actor = null, $personnage = null, $idRole = null)
    {

        //j'appelle les setters       
        $this->set_actor($actor);
        $this->set_personnage($personnage);
        $this->set_idRole($idRole);
    }

    // getters :

    public function get_actor()
    {
        return $this->actor;
    }

    public function get_personnage()
    {
        return $this->personnage;
    }

    public function get_idRole()
    {
        return $this->idRole;
    }


    // setters :

    public function set_actor($actor)
    {
        $this->actor = $actor;
    }


    public function set_personnage($personnage)
    {
        $this->personnage = $personnage;
    }

    public function set_idRole($idRole)
    {
        $this->idRole = $idRole;
    }
}
