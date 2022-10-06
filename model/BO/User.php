<?php

class User
{
    private $idUser;
    private $userName;
    private $userMail;
    private $userPass;

    public function __construct($idUser = null, $userName = null, $userMail = null, $userPass = null)
    {
        $this->idUser = $idUser;
        $this->userName = $userName;
        $this->userMail = $userMail;
        $this->userPass = $userPass;
    }

    public function get_idUser()
    {
        return $this->idUser;
    }

    public function get_userName()
    {
        return $this->userName;
    }

    public function get_email()
    {
        return $this->userMail;
    }

    public function get_password()
    {
        return $this->userPass;
    }

    public function set_userName($userName)
    {
        $this->userName = $userName;
    }

    public function set_email($userMail)
    {
        $this->userMail = $userMail;
    }

    public function set_password($userPass)
    {
        $this->userPass = $userPass;
    }

    public function set_idUser($idUser)
    {
        $this->idUser = $idUser;
    }
}
