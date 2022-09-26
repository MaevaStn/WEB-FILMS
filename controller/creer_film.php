<?php
$filmsDao = new FilmsDAO();
// * @var $alloffers type */
//  va tous chercher et stock ds un tableau :
$allfilms = $filmsDao->getAll();

print_r($allfilms);
// On affiche le template Twig correspondant
echo $twig->render('creer_film.html.twig', ['allfilms' => $allfilms]);
