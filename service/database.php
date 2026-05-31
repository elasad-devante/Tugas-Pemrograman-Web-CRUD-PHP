<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = "ri_operator";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db->connect_error) {
    echo "Connection Failed";
    die("error!");
}
