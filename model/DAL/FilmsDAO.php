<?php
// Le but du DAO est de tranformer les données gérées par le DAL en objets facilement manipulable.
//  Quand on dit objet, on parle de classes instanciées...
// Il crée ainsi un objet en faisant correspondre les attributs de cet objet avec les données lues par le DAL.
class FilmsDAO extends Dao
{
    //Récupérer :
    public function getAll()
    {
        // selection de tous les éléments de la table films de la BDD film :
        $queryFilms = $this->_bdd->prepare("SELECT * FROM films");
        $queryFilms->execute();
        // tableau de films :
        $films = array();
        // $dataFilms = $queryFilms->fetch();
        // tant que $dataFilms est égal à ma requête queryFilms( tant que que je vais chercher, selectionner
        // //  un/des éléments contenus dans ma table sql film)
        while ($dataFilms = $queryFilms->fetch()) {
            //     // nous possédons une table role qui contient les roles(personnage) joués chacun par 1 acteur et une table acteurs avec nom,prénom des acteurs
            //     // donc une table acteur et une table role qui elle contient tous les roles(personnages)joués par les acteurs
            //     // Pour afficher les roles(personnages) associés aux acteurs , faire cette requête (av inner join)
            //     // et je l'execute (tjrs "tant que" je vais chercher un élément dans ma table sql films)
            //     // La syntaxe ci-dessus stipule qu’il faut sélectionner les enregistrements des tables table1 et table2 
            //     // lorsque les données de la colonne “id” de table1 est égal aux données de la colonne fk_id de table2.
            $queryRoles = $this->_bdd->prepare("SELECT * FROM acteurs INNER JOIN role ON acteurs.idActeur = role.idRole");
            $queryRoles->execute();
            //  tableau roles :
            $roles = array();

            while ($dataRoles = $queryRoles->fetch()) {

                $roles = new Role($dataRoles['personnage'], $dataRoles['idRole']);
            }
            $films[] = new Film($dataFilms['idFilm'], $dataFilms['titre'], $dataFilms["realisateur"], $dataFilms['affiche'], $dataFilms['annee'], $roles);
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



    //   public function addRole(){

    //  }

    // //Récupérer plus d'info sur 1 film à partir/à l'aide de son id :
    // Collection::getOne — Récupère un document
    public function getOne($id_film)
    {
        $query = $this->_bdd->prepare('SELECT * FROM films WHERE films.idFilm = :id_film')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':id_film' => $id_film));
        $data = $query->fetch();
        $film = new Film($data['idFilm'], $data['titre'], $data['affiche'], $data['annee']);
        return ($film);
    }
}
