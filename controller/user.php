<?php
//On appelle la fonction getAll()
$userDao = new UsersDAO();
/* --@var $alloffers type */
//$allusers = $userDao->getAll(); //changer allusers

$connexion = $userDao->connexion();

$deconnexion = $userDao->deconnexion();

//$compte = $userDao->compte();

//$inscription = $userDao->add($data);

//On affiche le template Twig correspondant
//echo $twig->render('user.html.twig', ['allusers' => $allusers]);
echo $twig->render('user.html.twig', ['connexion' => $connexion]);

//echo $twig->render('inscription.html.twig', ['inscription' => $inscription]);
