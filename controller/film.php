<?php

//  $filmsDAO = new FilmsDAO();
//  $allfilms = $filmsDAO->getAll();

$filmsDAO = new FilmsDAO();
$allfilms = $filmsDAO->getAll();

// print_r($allfilms);
foreach ($allfilms as $value) {
    if (!isset($_POST['titre'])) {
        echo $twig->render('film.html.twig');
    } else {
        echo $twig->render('creer_film.html.twig');
    }
    break;
}
