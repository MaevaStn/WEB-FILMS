<?php

class User
{
    private $_id;
    private $_name;
    private $_email;
    private $_password;
    public $model;

    public function __construct($id = null, $name = null, $email = null, $password = null)
    {
        if (!is_null($id)) {
            $this->set_id($id);
        }
        $this->set_name($name);
        $this->set_email($email);
        $this->set_password($password);
    }

    public function get_name()
    {
        return $this->_name;
    }

    public function get_email()
    {
        return $this->_email;
    }

    public function get_password()
    {
        return $this->_password;
    }

    public function set_name($_name)
    {
        $this->_name = $_name;
    }

    public function set_email($_email)
    {
        $this->_email = $_email;
    }

    public function set_password($_password)
    {
        $this->_password = $_password;
    }

    /**
     * Get the value of _id
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     */
    public function set_id($_id)
    {
        $this->_id = $_id;
    }
}
