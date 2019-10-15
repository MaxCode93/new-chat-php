<?php
session_start();
require_once('../xc_include/database.php');
require_once('functions/func.admin.php');

if(isset($_SESSION['admin']['id'])){
    echo '<script>window.location="escritorio"</script>';
}

$mysqli = db_connect($config);

if(isset($_POST['username']))
{
    $query = "SELECT * FROM users WHERE user_nick='" . addslashes($_POST['username']) . "' AND user_passw='" . addslashes(md5($_POST['password'])) . "' LIMIT 1";
    if ($query_result = mysqli_query($mysqli,$query)) {

    while ($info = mysqli_fetch_array($query_result))
    {
        $us_acp = $info['acp'];
		$us_priv = $info['user_priv'];
		
    	if($us_acp==1 && $us_priv==255){
        $admin_id = $info['id'];
		if(isset($admin_id))
    {
        $_SESSION['admin']['id'] = $admin_id;
        $_SESSION['admin']['username'] = $_POST['username'];
		$query_online = "UPDATE admins SET online  = '1' WHERE id_us = '$admin_id'";
        mysqli_query($mysqli,$query_online);		
            	$logs=fopen("../xc_error/admlogacces.txt","a+"); 
                $ip=getUserIP(); 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. "Accede ". $_POST['username']. " desde ". "[". $ip. "]" . PHP_EOL); 
                fclose($logs);
        echo '<script>window.location="escritorio"</script>';
        exit;
    }
        
 }else{
  $error = "Error: Usted no tiene permisos para acceder al panel.";
  $logs = fopen("../xc_error/accesfail.txt","a+"); 
                $ip=getUserIP(); 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. "Login fallido de ". $_POST["username"]. " desde ". "[". $ip. "]"  . PHP_EOL); 
                fclose($logs);
   
    }
    }
	}else
    {
        $error = "Error: Username & Password do not match";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../xc_static/img/favicon.png">
    <title>Administracion - Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="js/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style-light.css" rel="stylesheet">

    <link href="css/colors/blue.css" id="theme"  rel="stylesheet">

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box" style="border-radius: 5px;background: rgba(255, 255, 255, 0.81);">
        <div class="white-box" style="border-radius: 5px;background: rgba(255, 255, 255, 0.81);">
            <form class="form-horizontal form-material" id="loginform" method="post" action="#">
                <h3 class="box-title m-b-20 text-center">Admin Panel Login</h3>
                <span style="color:#df6c6e;">
                    <?php
                    if(!empty($error)){
                        echo '<div class="byMsg byMsgError">! '.$error.'</div>';
                    }
                    ?>
                </span>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Usuario" name="username" autofocus="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="login" type="submit">Acceder</button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>XenCuba Admin v4.1</p>
                     <p><a class="text-primary m-l-5"><b>Powered by Maxwell</b></a></p>      
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>
<!-- jQuery -->
<script src="js/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/custom.js"></script>
<!--Style Switcher -->
<script src="js/styleswitcher/jQuery.style.switcher.js"></script>
<!--Style Switcher -->
</body>
</html>
