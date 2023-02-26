<?php
$dbhost = "localhost";
$dbuser = "clinton";
$dbpass = "root";
$dbname = "testdb";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect");
}
