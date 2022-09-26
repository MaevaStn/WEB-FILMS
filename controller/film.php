<?php
$filmsDAO = new FilmsDAO();
//  va tous chercher et stock ds un tableau :
$allfilms = $filmsDAO->getAll();
print_r($allfilms);

// On affiche le template Twig correspondant
echo $twig->render('film.html.twig', ['allfilms' => $allfilms]);

// crea form pour récup resultat de la recherche via bouton rechercher
// chame de recherche via son name 
// recup ds variable
// isset get all ou sinon  get av le recherche
