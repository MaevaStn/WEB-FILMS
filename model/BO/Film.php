<?php
// @author Elise
class Film
{
    private $idFilm;
    private $title;
    private $realisateur;
    private $affiche;
    private $annee;
    // liste des rôles du film sous forme de tableau :
    private $tabRoles = array();

    public function __construct($idFilm = null, $title = null, $realisateur = null, $affiche = null, $annee = null, $tabRoles = [])
    {

        // j'initialise $idFilm seulement si il est différent de null :
        if (!is_null($idFilm)) {
            $this->set_idFilm($idFilm);
        }
        $this->set_title($title);
        $this->set_realisateur($realisateur);
        $this->set_affiche($affiche);
        $this->set_annee($annee);
        $this->set_tabRoles($tabRoles);
    }

    // getters :

    public function get_idFilm()
    {
        return $this->idFilm;
    }
    public function get_title()
    {
        return $this->title;
    }

    public function get_realisateur()
    {
        return $this->realisateur;
    }

    public function get_affiche()
    {
        return $this->affiche;
    }

    public function get_annee()
    {
        return $this->annee;
    }

    public function get_tabRoles()
    {
        return $this->tabRoles;
    }

    // setters :

    public function set_idFilm($idFilm)
    {
        $this->idFilm = $idFilm;
    }


    public function set_title($title)
    {
        $this->title = $title;
    }

    public function set_realisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }

    public function set_affiche($affiche)
    {

        if ($affiche == null) {
            // mettre img par défaut :
            $this->affiche = "https://www.artmajeur.com/medias/standard/a/n/andriymarkivart/artwork/14233586_2aaaaaaaaaa.jpg";
        } else {
            $this->affiche = $affiche;
        }
    }

    public function set_annee($annee)
    {
        $this->annee = $annee;
    }

    public function set_tabRoles($tabRoles)
    {
        $this->tabRoles = $tabRoles;
    }

    // //méthode pour ajouter un rôle :
    public function addRole(Role $roles)
    {
        $this->tabRoles[] = $roles;
    }
}
