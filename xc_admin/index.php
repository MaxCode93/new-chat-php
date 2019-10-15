<?php
session_start();
$_SESSION['zona']['home'] = "escritorio";

include("header.php");
include 'functions/class.DiskUsage.php';
$obj = new DiskUsage;

$path= "../xc_uploads/files/";
$size = $obj->_directorySize($path);

if(isset($_GET['page']))
{
    $pageno = $_GET['page'];
}
else
{
    $page = 1;
}

if(!isset($_GET['sortby']))
{
    $_GET['sortby']='id';
}
if(!isset($_GET['direction']))
{
    $_GET['direction']='DESC';
}

$total_user = mysqli_num_rows(mysqli_query($mysqli,"select 1 from users"));
$day_user = mysqli_num_rows(mysqli_query($mysqli,"select 1 from users where user_register > DATE_SUB(NOW(), INTERVAL 1 DAY)"));
$banned_user = mysqli_num_rows(mysqli_query($mysqli,"select 1 from ip_ban"));
$mess = mysqli_num_rows(mysqli_query($mysqli,"select 1 from mess"));
$adm_user = mysqli_num_rows(mysqli_query($mysqli,"select 1 from users where user_priv > 1"));

$query_z = "Update admins set zona='Escritorio' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Escritorio</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="escritorio">Escritorio</a></li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- .row -->
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="row">
					    <div class="col-lg-3 col-sm-3 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title">Usuarios Totales</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="fa fa-users text-success"></i></li>
                                    <li class="text-right"><span class=""><?php echo $total_user; ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title">Usuarios Admines</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="fa fa-user text-warning"></i></li>
                                    <li class="text-right"><span class=""><?php echo $adm_user; ?></span></li>
                                </ul>
                            </div>
                        </div>
						 <div class="col-lg-3 col-sm-3 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title">Usuarios Baneados</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="fa fa-user-times text-danger"></i></li>
                                    <li class="text-right"><span class=""><?php echo $banned_user; ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title">Mensajes</h3>
                                <ul class="list-inline two-part">
                                    <li><i class="icon-envelope fa-fw text-danger"></i></li>
                                    <li class="text-right"><span class=""><?php echo $mess; ?></span></li>
                                </ul>
                            </div>
                        </div>

						
						
					<div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Ultimo Registrado</h3>

                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Fecha</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM users order by id DESC LIMIT 1";
                                $result = $mysqli->query($query);
                                while ($row = mysqli_fetch_assoc($result)) {
								$fecha = str_replace('-', '/', date("d-m-Y", strtotime($row['user_register'])));
                                ?>
                                    <tr>
                                        <td class="txt-oflo"><img src="../xc_uploads/thumbs/0/<?php echo $row['user_thumb']; ?>" alt="<?php echo $row['user_nick']; ?>"class="img-circle bg-theme" width="40"> <?php echo $row['user_nick']; ?></td>
                                        <td><span class="label label-megna label-rounded"><?php echo $row['user_email']; ?></span> </td>
                                        <td class="txt-oflo"><span class="label label-success label-rounded"><?php echo $row['user_register']; ?></span></td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                            <a href="users">Ver todos los Usuarios</a> </div>
                       </div>
					
                     </div>
                     	<div class="col-lg-3 col-sm-3 col-xs-12">
                            <div class="white-box">
                                <h3 class="box-title">Archivos Adjuntos</h3>
                                <ul class="list-inline two-part">
								 <i class="fa fa-bar-chart-o"><?php echo " Uso de disco : ".$obj->_sizeFormat($size['size']);?></i>
                                 <i class="fa fa-file"><?php echo " Total de Archivos : ".$size['count'];?></i>
                                 <i class="fa fa-file"><?php echo " Total de Directorios : ".$size['dircount']."<br><br>";?></i>								  
                                </ul>
                            </div>
                        </div>
					
                     </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- .row -->
            <div class="row">

            </div>
            <!-- /.row -->


<?php include("footer.php"); ?>