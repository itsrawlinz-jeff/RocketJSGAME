<?php
$dbhost = "localhost";
$dbuser = "clinton";
$dbpass = "root";
$dbname = "rocketjs_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect");
}
