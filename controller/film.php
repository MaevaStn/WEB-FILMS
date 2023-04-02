<?php
// @author Elise

$filmsDAO = new FilmsDAO();
// si utilisateur saisi un titre de film dans la barre de recherche :
if (isset($_POST["search"])) {
    // j'appelle fonction getAll()
    // getAll() param : (la saisie de l'utilisateur)
    // allfilms contiendra le resultat de recherche (comprenant titre, année, acteurs et leurs rôles) lié au film saisi par utilisateur :
    $allFilms = $filmsDAO->getAll($_POST['search']);
    // var_dump($allFilms);
    // sinon, (champ vide en param)
} else if (empty($_POST["search"])) {
    $allFilms = $filmsDAO->getAll('');
    // retourne tous les films av titre, année, acteurs et leurs rôles)
    // var_dump($allFilms);
}
// pour afficher le template Twig correspondant :
echo $twig->render('film.html.twig', ['allFilms' => $allFilms]);
