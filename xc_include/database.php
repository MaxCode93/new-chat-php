<?php
//Clases y funciones extras
$config['db']['host'] = 'localhost';
$config['db']['name'] = 'chat';
$config['db']['user'] = 'root';
$config['db']['pass'] = '123456789';

//Admin Panel
$server  = "localhost";
$username = "root";
$password = "123456789";
$database = "chat";


$mysqli = new mysqli($server, $username, $password, $database);


if ($mysqli->connect_error) {
    die('error'.$mysqli->connect_error);
}

$config['tpl_name'] = 'style-light';
$config['tpl_color'] = 'blue-dark';

?>
