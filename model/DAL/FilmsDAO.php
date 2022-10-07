<?php
// @author Maeva/Elise

class FilmsDAO extends Dao
{
    //Récupérer :
    public function getAll($recherche)
    {
        //SQL : SELECT * FROM films INNER JOIN role INNER JOIN acteurs ON acteurs.idActeur = role.idActeur WHERE role.idFilm = films.idFilm AND UPPER(titre) LIKE UPPER('m%')
        // définir BDD :
        $queryFilms = $this->_bdd->prepare("SELECT * FROM films INNER JOIN role ON role.idFilm = films.idFilm  INNER JOIN acteurs ON acteurs.idActeur = role.idActeur WHERE UPPER(titre) LIKE UPPER(:recherche) ORDER BY films.idFilm ASC");
        // permet de rechercher toutes les lignes de “colonne” qui commence par (une lettre définie) / mais dans notre cas, en fonction de ($recherche) :
        $queryFilms->execute(array(':recherche' => $recherche . "%"));
        $tabfilms = array();

        $idFilm = 0;
        // parcours du resultat de la requete ligne apres ligne :
        // sachant qu'avec le (order by) les films se suivent les uns apres les autres.
        while ($dataFilms = $queryFilms->fetch()) {
            // detection changement film par idfilm :
            if ($idFilm != $dataFilms['idFilm']) {
                $film = new Film($dataFilms['idFilm'], $dataFilms['titre'], $dataFilms["realisateur"], $dataFilms['affiche'], $dataFilms['annee'], null);
                $acteur = new Acteur($dataFilms["idActeur"], $dataFilms["nom"], $dataFilms["prenom"]);
                $role = new Role($acteur, $dataFilms["personnage"], $dataFilms["idRole"]);
                // j'appellle addRole (), ( issu de la classe Film ds BO) et je place en paramètre ($role) (ci-dessus):
                $film->addRole($role);
                $tabfilms[] = $film;
            } else {
                // array_key_last — Récupère la dernière clé d'un tableau, 
                // récupère le dernier film stocké dans $tabFilm dans le but de lui ajouter un role et un acteur
                $film = $tabfilms[array_key_last($tabfilms)];
                // var_dump($film);
                $acteur = new Acteur($dataFilms["idActeur"], $dataFilms["nom"], $dataFilms["prenom"]);
                $role = new Role($acteur, $dataFilms["personnage"], $dataFilms["idRole"]);
                $film->addRole($role);
            }
            $idFilm = $dataFilms['idFilm'];
            // var_dump($idFilm);
        }
        return $tabfilms;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function add($data)
    {
    }

    public function get_one($id)
    {
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Elise :

// Partie pour titre, année, affiche :

//Récupérer :
//  public function getAll($recherche)
//  {
// LIKE est utilisé dans la clause WHERE des requêtes SQL. Ce mot-clé permet d’effectuer une recherche sur un modèle particulier. 
// Il est par exemple possible de rechercher les enregistrements dont la valeur d’une colonne commence par telle ou telle lettre. 

//      $queryFilms = $this->_bdd->prepare("SELECT * FROM films WHERE UPPER(titre) like :recherche");
// (ce modèle est utilisé pour rechercher tous les enregistrement qui utilisent le caractère “ ”.)
//      $queryFilms->execute(array(':recherche' => "%" . strtoupper($recherche) . "%"));
//      $films = array();

//      while ($dataFilms = $queryFilms->fetch()) {

//          $films[] = new Film($dataFilms['idFilm'], $dataFilms['titre'], $dataFilms["realisateur"], $dataFilms['affiche'], $dataFilms['annee']);
//      }
//      return $films;
//  }
