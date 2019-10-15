<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

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

$query_z = "Update admins set zona='Viendo los Admines Conectados', fecha='".$date_time."' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);
?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Admins Conectados</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Admins Conectados</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <form action="adm_del" method="post" name="f1" id="f1">
                    <div>
                        <div class="pull-left"><h3 class="box-title">Acciones de los Usuarios Administradores</h3></div>
                        <div class="pull-right">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <hr>

                    <div class="table-responsive">

                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Usuario</th>
								<th>Última Zona</th>
								<th>Fecha</th>
                                <th class="sortingNone">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM admins where online=1 ORDER BY user_nick DESC";
                            $result = $mysqli->query($query);
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id_us'];
                                $username = $row['user_nick'];
                                $zona = $row['zona'];
                                $fecha = $row['fecha'];
							
							$query_us = "SELECT * FROM users where=$username ORDER BY user_nick DESC";
                            $result_us = $mysqli->query($query_us);
                            while ($row_us = mysqli_fetch_assoc($result_us)) {
                            }

								
								$query1 = "SELECT user_thumb FROM users WHERE user_nick='" .$row['user_nick']. "' LIMIT 1";
                                $query_result1 = mysqli_query ($mysqli, $query1);
                                while ($info1 = mysqli_fetch_array($query_result1))
                                {
                            $foto = $info1['user_thumb'];
                                  }
								  
                                ?>
                                <tr>
                                    <td><?php echo $row['id_us'] ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $foto; ?>" alt="<?php echo $username ?>" class="img-circle bg-theme" width="40"> <?php echo $username ?></td>
									<td><span class="label label-rounded label-info"><?php echo $zona ?></span></td>
									<td><span class="label label-rounded label-info"><?php echo $fecha ?></span></td>
                                    <td class="text-nowrap">
									 <a href="users_edit?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Editar <?php echo $username ?>"> <i class="fa fa-edit btn btn-success waves-effect waves-light m-r-10"></i> </a>
                                     <a href="adm_del?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Eliminar <?php echo $username ?>"> <i class="fa fa-trash-o btn btn-danger waves-effect waves-light m-r-10"></i></a>
                                    </td>
                                </tr>
                            <?php }?>

                            </tbody>
                        </table>

                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.row -->


<?php include("../../footer.php"); ?>