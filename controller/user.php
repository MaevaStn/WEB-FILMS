<?php
//On appelle la fonction getAll()
$userDao = new UsersDAO();
/* --@var $alloffers type */
$allusers = $userDao->getAll(); //changer alloffers

$connexion = $userDao->connexion();

//On affiche le template Twig correspondant
echo $twig->render('user.html.twig', ['allusers' => $allusers]);
echo $twig->render('user.html.twig', ['connexion' => $connexion]);
