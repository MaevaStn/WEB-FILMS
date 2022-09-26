<?php

class UsersDAO extends Dao
{
    /*public function getAll()
    {
        //On définit la bdd pour la fonction

        $query = $this->_bdd->prepare("SELECT idUser, userName, email, password FROM user");
        $query->execute();
        $userInfo = array();

        while ($data = $query->fetch()) {
            $userInfo[] = new User($data['idUser'], $data['userName'], $data['email'], $data['password']);
        }
        return ($userInfo);
    }*/

    //Ajouter un utilisateur
    public function add($data)
    {
        $valeurs = ['userName' => $data->get_name(), 'email' => $data->get_email(), 'password' => $data->get_password()];
        $requete = 'INSERT INTO user (name, email, password) VALUES (:name , :email, :password)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            //print_r($insert->errorInfo());
            return false;
        } else {
            return true;
        }
    }

    /*public function getOne($id_offer)
    {
        $query = $this->_bdd->prepare('SELECT * FROM offers WHERE offers.id = :id_offer')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':id_offer' => $id_offer));
        $data = $query->fetch();
        $offer = new Offres($data['id'], $data['title'], $data['description']);
        return ($offer);
    }*/

    public function compte()
    {
        if ($_POST['compte']) {
            header("location:user.php");
        }
    }

    public function connexion()
    {
        $connex = mysqli_connect("localhost", "root", "root", 'cinema') or die("Unable to connect");

        if (isset($_POST['form1'])) {

            $umail = $_POST['mail'];
            $upass = $_POST['pass'];

            $emailValidDb = ("SELECT COUNT(email) 
                AS total
                FROM user 
                WHERE email = '$umail'"
            );
            $result = mysqli_query($connex, $emailValidDb);
            $data = mysqli_fetch_assoc($result);

            if ($data['total'] == 0) { // 0 = non present dans la bdd
                echo "email invalide";
            } elseif ($data['total'] == 1) { // 1 = le compte existe dans la bdd
                //logique pour se connecter

                $connexValidDb  = ("SELECT `email`, `password`
                FROM  user
                WHERE `email` = '$umail' AND `password` = '$upass'");

                $req = mysqli_query(
                    $connex,
                    $connexValidDb
                );

                $row = mysqli_fetch_array($req);

                if (is_array($row)) {
                    $_SESSION["mail"] = $row['email'];
                    $_SESSION["pass"] = $row["password"];
                } else {
                    echo "invalid id or name";
                }
            }
        }

        if (isset($_SESSION["mail"])) {
            echo "Hello " . $_SESSION['mail'];
            //header("location:film.html.twig");
        }
    }

    public function deconnexion()
    {
        if (isset($POST_['logout'])) {
            echo "deconnecté";
            session_destroy();
            //header("location:index.php");            
        }
        /*if (session_destroy()) {
            //header("location:index.php");
            echo "vous êtes déconnecté";
        }*/
    }
}
