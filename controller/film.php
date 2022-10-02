<?php
// @author Elise

$filmsDAO = new FilmsDAO();

if (isset($_POST["search"])) {
    $allFilms = $filmsDAO->getAll($_POST['search']);
} else if (empty($_POST["search"])) {
    $allFilms = $filmsDAO->getAll('');
}

echo $twig->render('film.html.twig', ['allFilms' => $allFilms]);
