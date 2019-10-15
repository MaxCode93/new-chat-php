<?php
session_start();
// función para comprobar el estado del usuario conectado
// si el usuario no está conectado, cambie a la página de inicio de sesión y envie mensaje en pantalla = 1
if (empty($_SESSION['admin']['username'])){
    echo "<meta http-equiv='refresh' content='0; url=../../'>";
}
// si el usuario ya ha iniciado sesión, a continuación, ejecutar el comando para actualizar y borrar
else {
switch ($_GET['accion']) {
case 'clear_enteruser':
			$file='../../../xc_error/admlogacces.txt';
            @unlink($file);
            $crear = fopen('../../../xc_error/admlogacces.txt', 'w');
            if ($crear) {
header("location:logs_adm");
            } else {
header("location:logs_adm");
            }
break;
case 'clear_admlog':
			$file='../../../xc_error/admlog.txt';
            @unlink($file);
            $crear = fopen('../../../xc_error/admlog.txt', 'w');
            if ($crear) {
header("location:logs_adm");
            }else {
header("location:logs_adm");
            }
break;
case 'clear_anuncioslog':
			$file='../../../xc_error/anuncios.log';
            @unlink($file);
            $crear = fopen('../../../xc_error/anuncios.log', 'w');
            if ($crear) {
header("location:logs_adm");
            } else {
header("location:logs_adm");
            }
break;
case 'clear_mudolog':
			$file='../../../xc_error/logs/mudo.log';
            @unlink($file);
            $crear = fopen('../../../xc_error/mudo.log', 'w');
            if ($crear) {
header("location:logs_adm");
            } else {
header("location:logs_adm");
            }
break;
case 'clear_topic':
			$file='../../../xc_error/topic.log';
            @unlink($file);
            $crear = fopen('../../../xc_error/topic.log', 'w');
            if ($crear) {
header("location:logs_adm");
            } else {
header("location:logs_adm");
            }
break;	
case 'clear_adm':
			$file='../../../xc_error/admlog.txt';
            @unlink($file);
            $crear = fopen('../../../xc_error/admlog.txt', 'w');
            if ($crear) {
header("location:logs_adm");
            } else {
header("location:logs_adm");
            }
break;
case 'clear_error':
			$file='../../../xc_error/php-error.log';
            @unlink($file);
            $crear = fopen('../../../xc_error/php-error.log', 'w');
            if ($crear) {
header("location:logs_access");
            } else {
header("location:logs_access");
            }
break;
case 'clear_afail':
			$file='../../../xc_error/accesfail.txt';
            @unlink($file);
            $crear = fopen('../../../xc_error/accesfail.txt', 'w');
            if ($crear) {
header("location:logs_access");
            } else {
header("location:logs_access");
            }
break;
 
}
       
}       
?>