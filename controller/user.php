<?php
// Session en cours
// $_SESSION Un tableau associatif des valeurs stockées dans les sessions, et accessible au script courant. 
// si session en cours existe, si bouton deconnexion existe, si utilisateur se deconnecte, on detruit la session, rafraichissment page
// sinon on affiche message comme quoi utilisateur est connecté
// sinon pour la connexion utilisateur si un mail et un mot de passe existe (sont entrés par utilisateur)
// j'instancie UsersDAO()
// je récupère
// je vérifie l'existence de l'utilisateur
if (isset($_SESSION['mail'])) {
    // Déconnexion
    if (isset($_POST['logout'])) {
        session_destroy();
        // rafraichir la page :
        header('location:user');
    } else {
        // Affichage du message de connexion
        echo $twig->render('user.html.twig', ['status' => 'conected']);
    }
} else {
    // Connexion
    // sinon pour la connexion utilisateur si un mail et un mot de passe existe (sont entrés par utilisateur)
    // j'instancie UsersDAO() dans var $userDAO
    if (isset($_POST["mail"]) and isset($_POST["pass"])) {
        $userDao = new UsersDAO();
        // j'appelle get_user()la mail entré par l'utilisateur en param (de userDAO() ) ds var $user
        $user = $userDao->get_user($_POST["mail"]);
        // Vérification de l'existence de l'utilisateur
        // si le mail récupéré est diff de null
        if ($user != null) {
            $userMail = $user->get_email();
            $userPass = $user->get_password();
            $userName = $user->get_userName();
            $id = $user->get_idUser();
            // Vérification du mail et password + hashage du password
            // si le mail entré par l'utilisateur est égal au mail contenu ds $userMail
            if (($userMail == $_POST["mail"]) && password_verify($_POST["pass"], $userPass)) {
                // les données stockées ds $_SESSION = à....
                $_SESSION['mail'] = $userMail;
                $_SESSION['userName'] = $userName;
                $_SESSION['idUser'] = $id;
                // Cookie pour se souvenir de l'utilisateur
                // setcookie — Envoie un cookie
                // Une fois que les cookies ont été placés, ils seront accessibles lors du prochain chargement de page dans le tableau $_COOKIE.
                // 'remember' ds users.html.twig input remenber
                if (isset($_POST["remember"])) {
                    setcookie("email", $mail);
                }
                header('location:user');
            } else {
                // Affichage du message mot de passe incorrect
                echo $twig->render('user.html.twig', ['pass' => 'true']);
            }
        } else {
            // Affichage du message si l'utilisateur est déjà connecté
            echo $twig->render('user.html.twig', ['pass' => 'true']);
        }
    } else {
        // Affichage du form de connection selon le cookie
        if (isset($_COOKIE["email"])) {
            echo $twig->render('user.html.twig', ['mail' => $_COOKIE["email"]]);
        } else {
            echo $twig->render('user.html.twig');
        }
    }
}
