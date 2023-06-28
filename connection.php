<?php
$dbhost = "localhost";
$dbuser = "clinton";
$dbpass = "root";
$dbname = "rocketjs_db";

if(!$con = new mysqli($dbhost,$dbuser,$dbpass,$dbname)) //mysqli_connect()
{
    die("failed to connect");
}
?>