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
    $_GET['direction']='ASC';
}
$query_z = "Update admins set zona='Usuarios', date='".$date_time."' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Usuarios</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="escritorio">Escritorio</a></li>
                    <li class="active">Usuarios</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="users_delete" method="post" name="f1" id="f1">
                        <div>
                            <div class="pull-left"><h3 class="box-title">Lista de Usuarios del Chat</h3></div>
                            <div class="pull-right">
                                <p class="text-muted">
                                    <button type="submit" name="submit" class="btn btn-danger waves-effect waves-light m-r-10"><i class="fa fa-trash-o"></i> Eliminar Seleccionados</button>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <hr>

                    <div class="table-responsive">

                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th class="sortingNone"><input type="checkbox" name="selall" value="checkbox" onClick="checkBox(this)" style="display: block"></th>
                                <th>#ID</th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Activado</th>
                                <th>Registro</th>
                                <th class="sortingNone">Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                           $query = "SELECT * FROM users ORDER BY user_nick ASC";
                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $username = $row['user_nick'];
                                $picname = $row['user_thumb'];
                                $fecha = $row['user_register'];

                                if($row['estatus'] == 1){
                                 $activado="Si";  
                                }else $activado="No";
                                    
							//	if($row['user_group'] == 1){
							//	$stt="Registrado";	
							//	}else if($row['user_group'] == 2){
							//	$stt="Nivel 1";
							//	}else if($row['user_group'] == 3){
							//	$stt="Nivel 2";
							//	}else if($row['user_group'] == 4){
							//	$stt="Estrella";
							//	}else if($row['user_group'] == 5){
							//	$stt="Prince";
							//	}else if($row['user_group'] == 6){
							//	$stt="Princess";
							//	}else if($row['user_group'] == 7){
							//	$stt="Destacado";
							//	}else if($row['user_group'] == 8){
							//	$stt="Chico VIP";
							//	}else if($row['user_group'] == 9){
							//	$stt="Chica VIP";
							//	}else if($row['user_group'] == 10){
							//	$stt="Xen-Chico";
							//	}else if($row['user_group'] == 11){
							//	$stt="Xen-Chica";
							//	}else if($row['user_group'] == 12){
							//	$stt="Ayudante";
							//	}else if($row['user_group'] == 13){
							//	$stt="Operador";
							//	}else if($row['user_group'] == 14){
							//	$stt="Reina";
							//	}else if($row['user_group'] == 15){
							//	$stt="Administrador";
							//	}else if($row['user_group'] == 16){
							//	$stt="Webmaster";
							//	}else $stt="No Establecido";
								
								
								if($row['user_group'] == 1){
								$color="background-color:rgba(0, 137, 0, 0.68);";	
								}else if($row['user_group'] == 2){
								$color="background-color:#749218;";
								}else if($row['user_group'] == 3){
								$color="background-color:rgba(128, 0, 128, 0.81);";
								}else if($row['user_group'] == 4){
								$color="background-color:#F26600;";
								}else if($row['user_group'] == 5){
								$color="background-color:#6696FA;";
								}else if($row['user_group'] == 6){
								$color="background-color:#FF0066;";
								}else if($row['user_group'] == 7){
								$color="background-color:#9999FF;";
								}else if($row['user_group'] == 8){
								$color="background-color:#24b999;";
								}else if($row['user_group'] == 9){
								$color="background-color:#E356DC;";
								}else if($row['user_group'] == 10){
								$color="background-color:#24b999;";
								}else if($row['user_group'] == 11){
								$color="background-color:#9900FF;";
								}else if($row['user_group'] == 12){
								$color="background-color:rgba(165, 52, 134, 0.77);";
								}else if($row['user_group'] == 13){
								$color="background-color:rgba(0, 57, 255, 0.72);";
								}else if($row['user_group'] == 14){
								$color="background-color:rgba(204, 0, 255, 0.74);";
								}else if($row['user_group'] == 15){
								$color="background-color:rgba(255, 0, 0, 0.72);";
								}else if($row['user_group'] == 16){
								$color="background-color:#0ab7fc;";
								}else $color="background-color:rgba(0, 137, 0, 0.68);";
                                ?>
								
                                <tr>
                                    <td>
                                        <input type="hidden" name="titles[]" id="titles[]" value="<?php echo $username;?>">
                                        <input type="checkbox" name="list[]" id="list[]" value="<?php echo $id;?>" style="display: block">
                                    </td>
                                    <td><?php echo $id ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $picname; ?>" alt="<?php echo $username; ?>" class="img-circle bg-theme" width="40"> <?php echo $username; ?></td>
                                    <td><span class="label label-megna label-rounded"><?php echo $row['user_email'] ?></span></td>
                                    <td><span class="label label-megna label-rounded"><?php echo $activado ?></span></td>
                                    <td><span class="label label-success label-rounded"><?php echo $fecha ?></span></td>
                                    <td class="text-nowrap">
                                        <a href="users_edit?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Editar <?php echo $username ?>"> <i class="fa fa-edit btn btn-success waves-effect waves-light m-r-10"></i> </a>
                                        <a href="users_delete?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Eliminar <?php echo $username ?>"> <i class="fa fa-trash-o btn btn-danger waves-effect waves-light m-r-10"></i> </a>
                                        
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