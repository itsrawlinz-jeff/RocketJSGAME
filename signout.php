
<?php

session_start();

if(isset($_SESSION['user_id']))
{
    //unset($_SESSION['user_id']);
    //unset($_SESSION['loggedin']);
    //$_SESSION['loggedin'] = false;
    //session_abort();
    $_SESSION = array();
    session_destroy();
}

header("Location: index.php");
die;

