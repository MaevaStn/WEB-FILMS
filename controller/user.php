<?php
// Session en cours
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
    if (isset($_POST["mail"]) and isset($_POST["pass"])) {
        $userDao = new UsersDAO();
        $user = $userDao->get_user($_POST["mail"]);
        // Vérification de l'existence de l'utilisateur
        if ($user != null) {
            $userMail = $user->get_email();
            $userPass = $user->get_password();
            $userName = $user->get_userName();
            $id = $user->get_idUser();
            // Vérification du mail et password + hashage du password
            if (($userMail == $_POST["mail"]) && password_verify($_POST["pass"], $userPass)) {
                $_SESSION['mail'] = $userMail;
                $_SESSION['userName'] = $userName;
                $_SESSION['idUser'] = $id;
                // Cookie pour se souvenir de l'utilisateur
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
