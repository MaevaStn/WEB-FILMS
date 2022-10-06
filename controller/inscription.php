<?php
// Inscription nouvel utilisateur 
if (isset($_POST['mailInscr']) and isset($_POST['passInscr']) and isset($_POST['passConf']) and isset($_POST['userName'])) {
    $user =  new UsersDAO();
    $newUser = $user->get_user($_POST['mailInscr']);
    // Si le user n'existe pas dans la bdd
    if ($newUser == null) {
        // Vérification de la correspondance des password
        if ($_POST['passInscr'] == $_POST['passConf']) {
            $newAccount = new User(null, $_POST['userName'], $_POST['mailInscr'], password_hash($_POST['passInscr'], PASSWORD_DEFAULT)); // ajout new user dans la bdd
            $user->add($newAccount);
            echo $twig->render('inscription.html.twig', ['requete' => "added"]);
        } else {
            // Inexactitude des password
            echo $twig->render('inscription.html.twig', ['pass' => "invalide"]);
        }
    } else {
        // User déjà dans la bdd
        echo $twig->render('inscription.html.twig', ['status' => "existe"]);
    }
} else {
    // Affichage form inscription
    echo $twig->render('inscription.html.twig');
}
