<?php
// @author Elise

class Acteur
{
    private $idActor;
    private $nomActor;
    private $prenomActor;

    public function __construct($idActor = null, $nomActor = null, $prenomActor = null)
    {
        // j'appelle les setters       
        $this->set_idActor($idActor);
        $this->set_nomActor($nomActor);
        $this->set_prenomActor($prenomActor);
    }

    // getters :

    public function get_idActor()
    {
        return $this->idActor;
    }
    public function get_nomActor()
    {
        return $this->nomActor;
    }

    public function get_prenomActor()
    {
        return $this->prenomActor;
    }


    // setters :

    public function set_idActor($idActor)
    {
        $this->idActor = $idActor;
    }


    public function set_nomActor($nomActor)
    {
        $this->nomActor = $nomActor;
    }

    public function set_prenomActor($prenomActor)
    {
        $this->prenomActor = $prenomActor;
    }
}
