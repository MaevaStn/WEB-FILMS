<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//On appelle la fonction getAll()
$acteursDao = new FilmsDAO();
/* @var $alloffers type */
$allacteurs = $acteursDao->getAll();
//On affiche le template Twig correspondant
echo $twig->render('acteur.html.twig', ['allacteurs' => $allacteurs]);
