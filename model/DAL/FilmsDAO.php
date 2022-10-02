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
        return $films;
    }




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
