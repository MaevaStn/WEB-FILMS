<?php
if (isset($_SESSION['mail'])) {
    echo $twig->render('header.html.twig', ['username' => $_SESSION['mail']]); //affichage du mail du user connecté
} else {
    echo $twig->render('header.html.twig', ['username' => 'Connexion']);
}
echo "a";
