<?php 
session_start();
$_SESSION['zona']['home'] = null;

require_once('../xc_include/database.php');
require_once('functions/func.admin.php');

$mysqli = db_connect($config);

$admin = $_SESSION['admin']['username'];
$query_offline = "UPDATE admins SET online  = '0' WHERE user_nick = '$admin'";
if ($query_result = mysqli_query($mysqli,$query_offline)) {

session_destroy($_SESSION['admin']['id']);
session_destroy($_SESSION['admin']['username']);
unset($_SESSION["admin"]);


echo '<script>window.location="login"</script>';

}

?>

