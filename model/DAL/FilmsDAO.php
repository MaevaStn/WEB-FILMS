<?php
// Le but du DAO est de tranformer les données gérées par le DAL en objets facilement manipulable.
//  Quand on dit objet, on parle de classes instanciées...
// Il crée ainsi un objet en faisant correspondre les attributs de cet objet avec les données lues par le DAL.
class FilmsDAO extends Dao
{
    //Récupérer :
    public function getAll($recherche)

    {
        // public function getAll($recherche)
        $queryFilms = $this->_bdd->prepare("SELECT * FROM films WHERE UPPER(titre) like :recherche");
        $queryFilms->execute(array(':recherche' => "%" . strtoupper($recherche) . "%"));
        $films = array();
        // tant que $dataFilms est égal à ma requête queryFilms( tant que que je vais chercher, selectionner
        // //  un/des éléments contenus dans ma table sql film)
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
