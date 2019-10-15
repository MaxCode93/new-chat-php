<?php
if($_SESSION['zona']['home'] == "escritorio" or $_SESSION['zona']['home'] == "email" or $_SESSION['zona']['home'] == "about")
{
include('../xc_include/database.php');
}else{
include('../../../xc_include/database.php');
}
require_once('functions/func.admin.php');

$mysqli = db_connect($config);

if(!isset($_GET['page']))
{
    $_GET['page'] = 1;
}
session_start();
checkloggedadmin();

$date_time=date("d/m/y  h:i");
$query1 = "SELECT * FROM users where id = '".$_SESSION['admin']['id']."'";
$result1 = $mysqli->query($query1);
$row1 = mysqli_fetch_assoc($result1);
$user_thumb = $row1['user_thumb'];

$s_admin = "SELECT * FROM admins WHERE user_nick='".$_SESSION['admin']['username']."'";
$s_admin_query = $mysqli->query($s_admin);
$row = mysqli_fetch_assoc($s_admin_query);
$s_admin_s = $row['user_nick'];
$tpl_name_s = $row['tpl_name'];
$tpl_color_s = $row['tpl_color'];
$transfer_filter_s = $row['transfer_filter'];

$v_reg_mail = "SELECT * FROM config";
$v_reg_mail_query = $mysqli->query($v_reg_mail);
$row_mail = mysqli_fetch_assoc($v_reg_mail_query);
$act_reg_mail = $row_mail['reg_mail'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Panel Admin - <?php echo $row1['user_nick'];?></title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Data Table CSS -->
    <link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="js/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!--alerts CSS -->
    <link href="js/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- morris CSS -->
    <link href="js/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/<?php echo $tpl_name_s; ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/<?php echo $tpl_color_s; ?>" id="theme"  rel="stylesheet">

</head>
<body class="fix-header fix-sidebar content-wrapper">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part"><a class="logo" href="escritorio"><b><img src="images/eliteadmin-logo.png" alt="home" /></b><span class="hidden-xs">Administracion</span></a></div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>

            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">


                <!-- /.dropdown -->
				  <li><a href="config_site"><i class="ti-settings fa-fw"></i></a></li>
                 <li> <a href="email"><i class="fa fa-envelope"></i></a></li>
				  <li> <a href="acp"><i class="fa fa-user"></i></a></li>
                <li class="dropdown"> <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> Hola: <img src="../xc_uploads/thumbs/0/<?php echo $user_thumb;?>" alt="<?php echo $row1['user_nick'];?>" width="36" class="img-circle"><b class="hidden-xs"><?php echo $row1['user_nick'];?><i class="icon-options-vertical"></i></b></a>
				  <ul class="dropdown-menu dropdown-user animated flipInY">
					<div class="dropdown-header text-center">
                      <img class="img-circle" src="../xc_uploads/thumbs/0/<?php echo $user_thumb;?>" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $row1['user_nick'];?></p>
                        <p class="font-weight-light text-muted mb-0"><?php echo $row1['user_email'];?></p>
                        </div>
                        <li role="separator" class="divider"></li>
						<li><a href="users_edit?id=<?php echo $_SESSION['admin']['id'];?>"><i class="ti-user"></i> Editar Perfil</a></li>
						<li><a href="config"><i class="ti-settings"></i> Ajustes de Perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="salir"><i class="fa fa-power-off"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">

                <li class="nav-small-cap m-t-10">--- Main Menu</li>
                <li><a href="escritorio" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu">Escritorio</span></a></li>
				
				 <li> <a href="#" class="waves-effect"><i data-icon="/" class="icon-user fa-fw"></i> <span class="hide-menu">Usuarios<span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="fa fa-circle-o" href="users"> Todos</a></li>
						<li><a class="fa fa-circle-o" href="ban_users"> Baneados</a></li>
						<?php if($act_reg_mail == 1){ ?>
						<li><a class="fa fa-circle-o" href="act_view"> No Activados</a></li>
						<?php
                        }
                        ?> 
                        <!-- <li><a class="fa fa-circle-o" href="export_users"> Exportar Usuarios</a></li> -->
                    </ul>
                </li>
				<li> <a href="adm" class="waves-effect"><i  class="icon-people fa-fw"></i> <span class="hide-menu">Admins</span></a></li>
				<?php if ($s_admin_s == $_SESSION['admin']['username']){?>
				 <!-- <li><a href="messages" class="waves-effect"><i class="icon-envelope fa-fw"></i> <span class="hide-menu">Mensajes</span></a></li>-->
				<?php } ?>
                <li><a href="files" class="waves-effect"><i class="fa fa-file linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Archivos</span></a></li>
				<li> <a href="#" class="waves-effect"><i data-icon="/" class="fa fa-pencil fa-fw"></i> <span class="hide-menu">Logs<span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="fa fa-circle-o" href="logs_adm"> Accesos</a></li>
						<li><a class="fa fa-circle-o" href="logs_access"> Errores</a></li>
						</ul>
                </li>
				   <li class="nav-small-cap">--- Actualizaciones</li>
                <li><a href="update" class="waves-effect"><i class="fa-fw fa fa-cloud-download"></i> <span class="hide-menu">Actualizar</span></a></li>
                
                <li class="nav-small-cap">--- Info</li>
                <li><a href="about" class="waves-effect"><i class="fa-fw fa fa-smile-o text-success"></i> <span class="hide-menu">Acerca de</span></a></li>
              
            </ul>
        </div>
    </div>