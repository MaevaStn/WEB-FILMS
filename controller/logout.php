<?php
session_start();
if (session_destroy()) {
    //header("location:user.php");
    echo "vous êtes déconnecté";
}
