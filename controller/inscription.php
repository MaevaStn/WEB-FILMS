<?php

if (isset($_POST['mailInscr']) and isset($_POST['passInscr']) and isset($_POST['passConf']) and isset($_POST['userName'])) {
    $user =  new UsersDAO();
    $newUser = $user->get_user($_POST['mailInscr']);

    if ($newUser == null) { // si le user n'existe pas dans la bdd
        if ($_POST['passInscr'] == $_POST['passConf']) {
            $newAccount = new User(null, $_POST['userName'], $_POST['mailInscr'], $_POST['passInscr']); // ajout new user dans la bdd
            $user->add($newAccount);
            echo $twig->render('inscription.html.twig', ['requete' => "added"]);
        } else {
            echo $twig->render('inscription.html.twig', ['pass' => "invalide"]);
        }
    } else {
        echo $twig->render('inscription.html.twig', ['status' => "existe"]); // user déjà dans la bdd
    }
} else {
    echo $twig->render('inscription.html.twig');
}
