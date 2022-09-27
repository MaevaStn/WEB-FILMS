<?php
$filmsDAO = new FilmsDAO();

if (isset($_POST["search"])) {;
    $allfilms = $filmsDAO->getAll($_POST['search']);
} else {
    $allfilms = $filmsDAO->getAll('');
}
echo $twig->render('film.html.twig', ['allfilms' => $allfilms]);
