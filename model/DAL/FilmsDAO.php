<?php

// @author Elise

class FilmsDAO extends Dao
{
    //Récupérer :
    public function getAll($recherche)
    {

        // SELECT * FROM films INNER JOIN role INNER JOIN acteurs ON acteurs.idActeur = role.idActeur WHERE role.idFilm = films.idFilm AND UPPER(titre) LIKE UPPER('m%')

        $queryFilms = $this->_bdd->prepare("SELECT * FROM films INNER JOIN role ON role.idFilm = films.idFilm  INNER JOIN acteurs ON acteurs.idActeur = role.idActeur WHERE UPPER(titre) LIKE UPPER(:recherche) ORDER BY films.idFilm ASC");
        $queryFilms->execute(array(':recherche' => $recherche . "%"));
        // print_r($queryFilms);
        // $acteurs = array();
        $tabfilms = array();
        // $roles = array();
        // print_r($dataFilms);
        $idFilm = 0;
        while ($dataFilms = $queryFilms->fetch()) {


            if ($idFilm != $dataFilms['idFilm']) {
                $film = new Film($dataFilms['idFilm'], $dataFilms['titre'], $dataFilms["realisateur"], $dataFilms['affiche'], $dataFilms['annee'], null);
                $acteur = new Acteur($dataFilms["idActeur"], $dataFilms["nom"], $dataFilms["prenom"]);
                $role = new Role($acteur, $dataFilms["personnage"], $dataFilms["idRole"]);
                $film->addRole($role);
                $tabfilms[] = $film;
            } else {
                $film = $tabfilms[array_key_last($tabfilms)];
                $acteur = new Acteur($dataFilms["idActeur"], $dataFilms["nom"], $dataFilms["prenom"]);
                $role = new Role($acteur, $dataFilms["personnage"], $dataFilms["idRole"]);
                $film->addRole($role);
            }
            $idFilm = $dataFilms['idFilm'];
            // print_r($dataFilms);


            // // var_dump($films);

        }
        print_r($tabfilms);
        return $tabfilms;
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




    public function get_one($id)
    {
    }
}





// public function addRole(){
    
// }



        // while ($dataFilms = $queryFilms->fetch()) {
        //     $queryRoles = $this->_bdd->prepare("SELECT * FROM acteurs INNER JOIN role ON acteurs.idActeur = role.idActeur WHERE role.idFilm=films.idFilm");
        //     $queryRoles->execute();
        //     $roles = array();
        //     // $roles[] = new Role($dataFilms["$acteur,"])
        //     print_r($roles);

         // while ($data = $queryFilms->fetch()) {
        // $acteurs[] = new Acteur($dataFilms["idActeur"], $dataFilms["nom"], $dataFilms["prenom"]);
        // //     // print_r($acteurs);
        // $roles[] = new Role($dataFilms["personnage"], $dataFilms["idRole"], $acteurs);
        // print_r($roles);
        //     foreach ($roles as $key => $value) {
        //     }
        // }