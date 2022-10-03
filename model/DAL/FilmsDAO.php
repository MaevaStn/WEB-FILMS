<?php

// @author Elise

class FilmsDAO extends Dao
{
    //Récupérer :
    public function getAll($recherche)

    {
        $queryFilms = $this->_bdd->prepare("SELECT * FROM films WHERE UPPER(titre) like :recherche");
        $queryFilms->execute(array(':recherche' => "%" . strtoupper($recherche) . "%"));
        $films = array();

        while ($dataFilms = $queryFilms->fetch()) {

            $films[] = new Film($dataFilms['idFilm'], $dataFilms['titre'], $dataFilms["realisateur"], $dataFilms['affiche'], $dataFilms['annee']);
        }
        //print_r($films);
        return $films;
    }

    // En cours de tests/élaboration :
    // public function getRoles(){    
    // while ($dataFilms = $queryFilms->fetch()) {
    //  $queryRoles = $this->_bdd->prepare("SELECT * FROM acteurs INNER JOIN role ON acteurs.idActeur = role.idRole");
    // $queryRoles->execute();
    // //  tableau roles :
    // $roles = array();
    //  while ($dataRoles = $queryRoles->fetch()) {

    // $roles = new Role($dataRoles['personnage'], $dataRoles['idRole'].............;
    //     }
    // return $roles;
    // }



    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function add($data)
    {

        $valeurs = ['titre' => $data->get_title(), 'affiche' => $data->get_affiche(), 'annee' => $data->get_annee()];
        $requete = $this->_bdd->prepare("SELECT titre, affiche, annee FROM films");
        $requete->execute();
        if (!$requete->execute($valeurs)) {
            // print_r($requete->errorInfo());
            return false;
        } else {
            return true;
        }
    }
}


// public function addRole(){
    
// }
