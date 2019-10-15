<?php
session_start();
require_once('../../../xc_include/database.php');
require_once('../../functions/func.admin.php');

checkloggedadmin();

$mysqli = db_connect($config);

if (isset($_GET['id_to_del'])) {
			$id_user = $_GET['id_to_del'];
$query = "SELECT * FROM users WHERE id = '$id_user'";
$query_result = mysqli_query($mysqli,$query);                                     
$dir0="../../../xc_uploads/thumbs/0/";
$dir1="../../../xc_uploads/thumbs/1/";
$dir2="../../../xc_uploads/thumbs/2/";
while ($data = mysqli_fetch_array($query_result)) {		
		if ($data['user_thumb']=='default.png'){ transfer($config,'users_edit?id='.$id_user,'Error: No se puede eliminar la foto por defecto!');
        exit;
			}else{
		  unlink($dir0.$data['user_thumb']);
		  unlink($dir1.$data['user_thumb']);
		  unlink($dir2.$data['user_thumb']);
          
		  $query2 = "UPDATE users SET user_thumb  = 'default.png'
                                                          WHERE id = '$id_user'";
mysqli_query($mysqli,$query2);
		  $sql2 = "UPDATE users SET user_online  = '0'
                                                          WHERE id = '$id_user'";
mysqli_query($mysqli,$sql2);

            $logs=fopen("../../../xc_error/admlog.txt","a+"); 
                $ip=$_SERVER['REMOTE_ADDR']; 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. $_SESSION['admin']['username']. " Elimina foto de perfil de ". "[".$data['user_nick']."]" . PHP_EOL); 
                fclose($logs);
    
transfer($config,'users_edit?id='.$id_user,'Foto de Perfil Eliminada!');
        exit;

}
  }

    }
?>