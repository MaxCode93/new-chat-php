<?php  
session_id($_POST['sess']); 
session_start();
$now = time(); 
$db = mysqli_connect('localhost', 'root', '123456789', 'chat'); 
$db->set_charset("utf8"); 
if (!$db) { exit('No se pudo conectar al servidor...'); 
} 
?>
