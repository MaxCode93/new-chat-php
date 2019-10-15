<?php
ob_start();
session_start();
error_reporting(0);
$errors = array();
$ver_install = 'xc_include/INSTALL_YES';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Asistente de Instalación XenCuba</title>
		    <meta charset="UTF-8">
              <link rel="shortcut icon" type="image/png" href="xc_static/img/favicon.png" />
              <link href="xc_static/css/bootstrap.v2.min.css" rel="stylesheet" media="screen">
              <script src="xc_static/js/jquery.min.js"></script>
              <script src="xc_static/js/bootstrap.min.js"></script>
</head>
	<body>
		<div class="container">
			<h2>Asistente de Instalación XenCuba</h2>

			<div class="panel panel-default">
				<div class="panel-body">
					<?php
					if(!empty($_POST)) {
						//Server MySQL
						$server     = $_POST['database_server'];
						$username   = $_POST['database_username'];
						$password   = $_POST['database_password'];
						$database   = $_POST['database_name'];
						//Server SMTP
						$host_smtp   = $_POST['host_smtp'];
						$smtp_secure = $_POST['smtp_secure'];
						$user_smtp   = $_POST['user_smtp'];
						$pass_smtp   = $_POST['pass_smtp'];
						$port_smtp   = $_POST['port_smtp']; 
						//Limpiar achivo ini bd anterior
						$dir_ini = "xc_signup/clases";    
                        foreach(glob($dir_ini."/*.ini") as $ini_to_del) 
                        { 
						unlink($ini_to_del);     
						} 
                        //Generar nombre aleatorio
                        function generar_ini($length = 15) {
                                     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                     $charactersLength = strlen($characters);
                                     $randomString = '';
                                     for ($i = 0; $i < $length; $i++) {
                                     $randomString .= $characters[rand(0, $charactersLength - 1)];
                                    }
                                return $randomString;
                        }
						//Generar nombre aleatorio archivo ini bd y crear ini bd
						$nombre_ini = generar_ini()."_db_".".ini";
						$nombre_ini_new = fopen("xc_signup/clases/".$nombre_ini, "w+");
						
						$mysqli = new mysqli($server, $username, $password, $database);
						$connect_file = "xc_include/database.php";
                        $connect_file2 = "xc_include/config.php";
						$connect_file3 = "xc_signup/DataCorreo.php";
						$connect_file4 = "xc_signup/clases/".$nombre_ini;
						$connect_file5 = "xc_signup/clases/config.php";
						$connect_file6 = "xc_admin/email.php";
						
						$ver_install = "xc_include/INSTALL_YES";
						$xc_error_p = "xc_error/admlog.txt";
                        $xc_uploads_p= "xc_uploads/thumbs/default.png";
						 
						if(file_exists($ver_install)) {
							$errors[] = 'El sistema ha compobado que existe una instalacion, para iniciar una nueva, elimine el fichero xc_include/INSTALL_YES';
						}
						if($mysqli->connect_error) {
							$errors[] = 'Imposible conectar con la base de datos !';
						}
						if(!is_readable($connect_file) || !is_writable($connect_file) && !is_readable($connect_file2) || !is_writable($connect_file2) && !is_readable($connect_file3) || !is_writable($connect_file3) && !is_readable($connect_file4) || !is_writable($connect_file4) && !is_readable($connect_file5) || !is_writable($connect_file5) && !is_readable($connect_file6) || !is_writable($connect_file6)){
							$errors[] = 'Faltan permisos de escritura en los directorios no tiene permisos CHMOD 777';
						}
						if(!is_readable($xc_error_p) || !is_writable($xc_error_p)){
							$errors[] = 'El directorio <u><strong>xc_error</strong></u> no tiene permisos CHMOD 777';
						}
						if(!is_readable($xc_uploads_p) || !is_writable($xc_uploads_p)){
							$errors[] = 'El directorio <u><strong>xc_uploads</strong></u> no tiene permisos CHMOD 777';
						}

						if(empty($errors)) {
					

						$connect_content = <<<PHP
<?php
//Clases y funciones extras
\$config['db']['host'] = '$server';
\$config['db']['name'] = '$database';
\$config['db']['user'] = '$username';
\$config['db']['pass'] = '$password';

//Admin Panel
\$server  = "$server";
\$username = "$username";
\$password = "$password";
\$database = "$database";


\$mysqli = new mysqli(\$server, \$username, \$password, \$database);


if (\$mysqli->connect_error) {
    die('error'.\$mysqli->connect_error);
}

\$config['tpl_name'] = 'style-light';
\$config['tpl_color'] = 'blue-dark';

?>

PHP;
							
						$command = fopen($connect_file, w);
						fwrite($command, $connect_content);
						fclose($command);
							

						$connect_content2 = <<<PHP
<?php  
session_id(\$_POST['sess']); 
session_start();
\$now = time(); 
\$db = mysqli_connect('$server', '$username', '$password', '$database'); 
\$db->set_charset("utf8"); 
if (!\$db) { exit('No se pudo conectar al servidor...'); 
} 
?>

PHP;
						
						$command2 = fopen($connect_file2, w);
						fwrite($command2, $connect_content2);
						fclose($command2);
						
												$connect_content3 = <<<PHP
<?php  
require '../xc_include/Mailer/PHPMailerAutoload.php';
\$mail = new PHPMailer;
\$mail->isSMTP();                                      
\$mail->Host = '$host_smtp';                      
\$mail->SMTPAuth = true;                               
\$mail->Username = '$user_smtp';        
\$mail->Password = '$pass_smtp';                
\$mail->SMTPSecure = '$smtp_secure';                            
\$mail->Port = '$port_smtp';                                    
\$mail->From = '$user_smtp';
\$mail->FromName = 'XenCuba Team';                       
\$mail->isHTML(true); 
\$mail->CharSet = 'UTF-8'; 

function enviarMail(\$destinatarios,\$asunto,\$mensaje){
	global \$mail;

	
	\$mail->addAddress(\$destinatarios);
	
	\$mail->Subject = \$asunto; 

	\$mail->Body    = \$mensaje;

	if(!\$mail->send()) {
		return false;
	} else {
		return true;
	} 
} 
?>

PHP;
						
						$command3 = fopen($connect_file3, w);
						fwrite($command3, $connect_content3);
						fclose($command3);
						
						$connect_content4 = <<<PHP
[database]
driver = mysql
host = $server
port = 3306
schema = $database
username = $username
password = $password

PHP;
						
						$command4 = fopen($connect_file4, w);
						fwrite($command4, $connect_content4);
						fclose($command4);
						
						
						$connect_content5 = <<<PHP
<?php
abstract class config {
	
	protected \$datahost;
	protected function conectar(\$archivo = '$nombre_ini'){
		
		if(!\$ajustes = parse_ini_file(\$archivo, true)) throw new exception ('No se puede abrir el archivo ' . \$archivo . '.');
			\$controlador = \$ajustes["database"]["driver"]; 
			\$servidor 	 = \$ajustes["database"]["host"]; 
			\$puerto 	 = \$ajustes["database"]["port"]; 
			\$basedatos	 = \$ajustes["database"]["schema"]; 

		try{
			return \$this->datahost = new PDO (
										"\$controlador:host=\$servidor;port=\$puerto;dbname=\$basedatos",
										\$ajustes['database']['username'], 
										\$ajustes['database']['password'], 
										array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
										);
			}
		catch(PDOException \$e){
				echo "Error en la conexión: ".\$e->getMessage();
			}
	}
}
?>

PHP;
						
						$command5 = fopen($connect_file5, w);
						fwrite($command5, $connect_content5);
						fclose($command5);
						
												$connect_content6 = <<<PHP
<?php
session_start();
\$_SESSION['zona']['home'] = "email";

include('header.php');
if(isset(\$_POST['Submit']))
{

    if(!check_allow()){
        ?>
        <script src="js/jquery/dist/jquery.min.js"></script>
        <script>
            \$(document).ready(function(){
                \$('#sa-title').trigger('click');
            });
        </script>
    <?php

    }
    else{
	require '../xc_include/Mailer/PHPMailerAutoload.php';
    \$email =  \$_POST["email"];
    \$sms   =  \$_POST["sms"];
    \$de    =  \$_POST["adm_name"];
    
    \$mail = new PHPMailer;
    \$mail->isSMTP();                                      
    \$mail->Host = '$host_smtp';                      
    \$mail->SMTPAuth = true;                              
    \$mail->Username = '$user_smtp';       
    \$mail->Password = '$pass_smtp';                
    \$mail->SMTPSecure = '$smtp_secure';                           
    \$mail->Port = '$port_smtp';                                    
    \$mail->From = '$user_smtp';
    \$mail->FromName = 'XenCuba Team - '.\$de;                       
    \$mail->isHTML(true); 
    \$mail->CharSet = 'UTF-8'; 
 

    \$mail->addAddress(\$email); 

    \$mail->Subject = 'XenCuba - Informacion';
    \$mail->Body    = \$sms;
    \$mail->AltBody = 'XenCuba - Informacion';
	
	if(!\$mail->send()) {
		  \$success = "Error Mensaje No Enviado, intenta mas tarde";
	} else {
		 \$success = "Mensaje Enviado Correctamente";
	}

 
    }

}

?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Enviar Mensaje</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
              <li><a href="escritorio">Escritorio</a></li>
                        <li class="active">Enviar Mensaje</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <span style="color:#31df0c;">
                    <?php
                    if(!empty(\$success)){
                        echo '<div class="byMsg byMsgSuccess">! '.\$success.'</div>';
                    }
                    ?>
                </span>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <form action="" method="post" name="f1" id="f1">
                            <h3 class="box-title">El mensaje sera recibido con su nombre de usuario</h3>
                            <hr>
                            <input type="hidden" name="adm_name" id="adm_name" value="<?php echo \$_SESSION['admin']['username']; ?>">
                            <div class="panel-body" style="width:70%; margin-left:15%">

                                <div class="form-group" align="center">
                                    <h2>Enviar correo a un usuario<h2>
									<hr>
                                    <div class="col-sm-8 col-sm-offset-2">
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
									<select name="email">
                                     <?php
									 \$sql_mail = "select * from users";
									 \$query_mail_result = mysqli_query(\$mysqli,\$sql_mail);
                                     while (\$row_mail = mysqli_fetch_assoc(\$query_mail_result))
                                          {           
                                     ?>
                                     <option value="<?php echo \$row_mail['user_email']?>"> <?php echo \$row_mail['user_nick']?> </option>
                                     <?php
									 } 
									 ?>  
									</select>
									
                                      </div><b style="font-size: 12px;left: -60px;position: relative;">* El correo se le enviara al email de registro del usuario.</b><hr>
                                         <textarea id="sms" name="sms" placeholder="Escriba su mensaje"></textarea>
                                        <br></br>
                                        <input name="Submit" type="submit" class="btn btn-danger" value="Enviar Mensaje">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<?php include('footer.php'); ?>

PHP;
						
						$command6 = fopen($connect_file6, w);
						fwrite($command6, $connect_content6);
						fclose($command6);

							$mysqli->query("
CREATE TABLE `admins` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_us` int(255) NOT NULL,
  `user_nick` varchar(255) NOT NULL,
  `user_priv` int(255) NOT NULL,
  `user_group` int(255) NOT NULL,
  `user_start` int(255) NOT NULL,
  `tpl_name` varchar(255) NOT NULL DEFAULT 'style-light.css',
  `tpl_color` varchar(255) NOT NULL DEFAULT 'defecto.css',
  `transfer_filter` int(1) NOT NULL DEFAULT '0',
  `online` int(1) NOT NULL DEFAULT '0',
  `zona` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL DEFAULT '00:00:00 00:00',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
							");
							
							$mysqli->query("
 INSERT INTO `admins` (`id`, `id_us`, `user_nick`, `user_priv`, `user_group`, `user_start`, `tpl_name`, `tpl_color`, `transfer_filter`, `online`, `zona`, `fecha`) VALUES
(1, 1, 'admin', 255, 17, 5, 'style-light.css', 'defecto.css', 1, 1, 'Viendo los Admines Conectados', '27/05/19  01:58');
							");
							
							$mysqli->query("
CREATE TABLE IF NOT EXISTS `activaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `codigo_activacion` text NOT NULL,
  `fecha_generacion` varchar(20) NOT NULL,
  `fecha_activacion` varchar(20) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
							");
							
							$mysqli->query("
CREATE TABLE IF NOT EXISTS `blokings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `bloking` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
							");

							$mysqli->query("
CREATE TABLE IF NOT EXISTS `cmds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(3) NOT NULL,
  `mfrom` int(11) NOT NULL,
  `mdest` int(11) NOT NULL,
  `cmd` varchar(600) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
							");

							$mysqli->query("
CREATE TABLE IF NOT EXISTS `config` (
    `chat_root_pass` varchar(150) NOT NULL,
	`reg_mail` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
							");
							
							$mysqli->query("
INSERT INTO `config` (`chat_root_pass`, `reg_mail`) VALUES
('', '0');
							");

                             $mysqli->query("
CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
							");
					         $mysqli->query("
CREATE TABLE IF NOT EXISTS `ip_ban` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `oper` varchar(20) NOT NULL,
  `motivo` varchar(400) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
							");

							$mysqli->query("
CREATE TABLE IF NOT EXISTS `system` (
  `item` varchar(40) NOT NULL,
  `content` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
							");
							
							$mysqli->query("
CREATE TABLE IF NOT EXISTS `mess` (
  `id` smallint(255) NOT NULL,
  `de` varchar(255) NOT NULL,
  `para` varchar(255) NOT NULL,
  `mess` varchar(255) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
							");

                     $mysqli->query("
INSERT INTO `system` (`item`, `content`) VALUES
('topic', 'Sean%20bienvenidos%20a%20Nuestro%20Chat.'),
('mudo', '1544715634');
							");

							$mysqli->query("
CREATE TABLE IF NOT EXISTS `visitas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `act` varchar(8) NOT NULL,
  `stats` varchar(8) NOT NULL,
  `max` int(8) NOT NULL,
  `total` int(11) NOT NULL,
  `visitas` int(11) NOT NULL,
  `fecha` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
							");

							$mysqli->query("
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_nick` varchar(20) NOT NULL,
  `user_email` varchar(255) NOT NULL DEFAULT 'sin_email@chat.cu',
  `user_passw` varchar(50) NOT NULL,
  `user_sexo` varchar(1) NOT NULL,
  `user_age` varchar(2) NOT NULL,
  `acp` int(1) NOT NULL DEFAULT '0',
  `user_priv` int(11) NOT NULL,
  `user_mess` int(50) NOT NULL,
  `user_thumb` varchar(14) NOT NULL DEFAULT 'default.png',
  `user_group` int(11) NOT NULL DEFAULT '1',
  `firma` text NOT NULL,
  `mudo` int(1) NOT NULL,
  `user_last` int(11) NOT NULL,
  `user_ip` varchar(50) NOT NULL,
  `ip_long` varchar(255) NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_online` int(70) NOT NULL,
  `user_cou` varchar(50) NOT NULL,
  `user_start` int(11) NOT NULL DEFAULT '1',
  `user_register` varchar(255) NOT NULL,
  `estatus` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_nick` (`user_nick`),
  KEY `user_online` (`user_online`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
							");

                            $mysqli->query("
INSERT INTO `users` (`id`, `user_nick`, `user_passw`, `user_email`, `user_sexo`, `user_age`, `acp`, `user_priv`, `user_mess`, `user_thumb`, `user_group`, `firma`, `mudo`, `user_last`, `user_ip`, `ip_long`, `user_status`, `user_online`, `user_cou`, `user_start`, `user_register`, `estatus`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@xencuba.cu', 'm', '26', 1, 255, 0, 'default.png', 16, '', 0, 0, '7f000001', '', 0, 0, '', 5, '2019-01-06 00:00:00', '1');
							");
							echo '<div class="alert alert-info">Instalación terminada con éxito, usuario: <strong>admin</strong> password: <strong>123456</strong>. Cambia este password en tu primer entrada. xD</div>
							<a href=""><button class="btn btn-primary">Ir al Sitio</button></a>';
							//unlink('install.php');
							fopen('xc_include/INSTALL_YES', 'w');
						} else {
                                 echo '<span>Errores encontrados!!</span>';
							foreach($errors as $nr => $error) {
								
								echo '<div class="alert alert-warning">' . $error . '</div>';
							}

							echo '<a href=""><button class="btn btn-primary">Regresar !</button></a>';
						}
					} else {
					?>
					<div class="alert alert-info">Antes de instalar, asegúrese de que todos los directorios del chat tienen permisos de escritura y lectura (CHMOD 777)</div>
                        <hr>
						<div class="alert alert-info">Ajustes del Servidor Base de Datos</div>
					<form action="" method="post" role="form">
						<div class="form-group">
							<label>Servidor</label>
							<input type="text" class="form-control" name="database_server" value="localhost" required/>
						</div>
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" class="form-control" name="database_username" placeholder="Usuario MySQL" required/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control" name="database_password" placeholder="Password"/>
						</div>
						<div class="form-group">
							<label>Base de Datos</label>
							<input type="text" class="form-control" name="database_name" placeholder="Base de Datos MySQL" required/>
						</div>
						<hr>
						<div class="alert alert-info">Ajustes del Servidor de Correo</div>
						<div class="form-group">
							<label>Servidor SMTP</label>
							<input type="text" class="form-control" name="host_smtp" placeholder="Se recomienda IP" required/>
						</div>
						<div class="form-group">
							<label>Seguridad SMTP(Recomendado TLS)</label>
							 <select class="form-control" name="smtp_secure">
                             <option value="tls">TLS</option>
                             <option value="ssl">SSL</option>
							 <option value="starttls">STARTTLS</option>
                             </select>
						</div>
						<div class="form-group">
							<label>Puerto SMTP(Recomendado 587)</label>
							<input type="number" class="form-control" name="port_smtp" placeholder="Eje: 587" required/>  
						</div>
						<div class="form-group">
							<label>Usuario SMTP</label>
							<input type="text" class="form-control" name="user_smtp" placeholder="Formato: usuario@dominio.cu" required/>
						</div>
						<div class="form-group">
							<label>Password SMTP</label>
							<input type="password" class="form-control" name="pass_smtp" placeholder="Su Password" required/>
						</div>

						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary col-lg-4">Configurar</button>
						</div>
					</form>
					<?php } ?>
				</div>

				<div class="panel-footer">
					<span>Created by <a>Maxwell</a> @2019 v1.2.1</span>
				</div>

			</div>

		</div>
	</body>
</html>
