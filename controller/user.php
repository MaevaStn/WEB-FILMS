<?php
if (isset($_SESSION['mail'])) {
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:user');
    } else {
        echo $twig->render('user.html.twig', ['status' => 'conected']);
    }
} else {
    if (isset($_POST["mail"]) and isset($_POST["pass"])) {
        $userDao = new UsersDAO();
        $user = $userDao->get_user($_POST["mail"]);
        if ($user != null) {
            $userMail = $user->get_email();
            $userPass = $user->get_password();
            $userName = $user->get_userName();
            $id = $user->get_idUser();
            if (($userMail == $_POST["mail"]) && ($userPass == $_POST["pass"])) {
                $_SESSION['mail'] = $userMail;
                $_SESSION['userName'] = $userName;
                $_SESSION['idUser'] = $id;
                if (isset($_POST["remember"])) {
                    setcookie("email", $mail);
                }
                header('location:user');
            } else {
                echo $twig->render('user.html.twig', ['pass' => 'true']);
            }
        } else {
            echo $twig->render('user.html.twig', ['pass' => 'true']);
        }
    } else {
        if (isset($_COOKIE["email"])) {
            echo $twig->render('user.html.twig', ['mail' => $_COOKIE["email"]]);
        } else {
            echo $twig->render('user.html.twig');
        }
    }
}
echo "a";
