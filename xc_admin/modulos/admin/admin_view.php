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

$query_z = "Update admins set zona='Viendo los Admines del Chat' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Admins</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Admins</li>
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
                        <div class="pull-left"><h3 class="box-title">Lista de los Usuarios Administradores</h3></div>
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
								<th>Privilegios</th>
								<th>Estatus</th>
                                <th class="sortingNone">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM users where user_priv>1 ORDER BY user_group DESC";
                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $username = $row['user_nick'];
                                $picname = $row['user_thumb'];
								
                                if($row['user_priv'] == 255){
								$status="SuperAdmin";	
								}else if($row['user_priv'] == 127){
								$status="Admin";
								}else if($row['user_priv'] == 63){
								$status="Supervisor";
								}else if($row['user_priv'] == 31){
								$status="Supervisor";
								}else if($row['user_priv'] == 15){
								$status="Supervisor";
								}else if($row['user_priv'] == 7){
								$status="Supervisor";
								}else if($row['user_priv'] == 3){
								$status="Supervisor";
								}else if($row['user_priv'] == 1){
								$status="Supervisor";
								}else if($row['user_priv'] == 0){
								$status="Sin Privilegios";
								}else $status="Supervisor";
								
								if($row['user_group'] == 1){
								$stt="Registrado";	
								}else if($row['user_group'] == 2){
								$stt="Nivel 1";
								}else if($row['user_group'] == 3){
								$stt="Nivel 2";
								}else if($row['user_group'] == 4){
								$stt="Estrella";
								}else if($row['user_group'] == 5){
								$stt="Prince";
								}else if($row['user_group'] == 6){
								$stt="Princess";
								}else if($row['user_group'] == 7){
								$stt="Destacado";
								}else if($row['user_group'] == 8){
								$stt="Chico VIP";
								}else if($row['user_group'] == 9){
								$stt="Chica VIP";
								}else if($row['user_group'] == 10){
								$stt="Reina";
								}else if($row['user_group'] == 11){
								$stt="Ayudante";
								}else if($row['user_group'] == 12){
								$stt="Operador";
								}else if($row['user_group'] == 13){
								$stt="Supervisor";
								}else if($row['user_group'] == 14){
								$stt="Sub-Admin";
								}else if($row['user_group'] == 15){
								$stt="Administrador";
								}else if($row['user_group'] == 16){
								$stt="Webmaster";
								}else $stt="No Establecido";
								
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
								$color="background-color:#993300;";
								}else if($row['user_group'] == 9){
								$color="background-color:#E356DC;";
								}else if($row['user_group'] == 10){
								$color="background-color:rgba(204, 0, 255, 0.74);";
								}else if($row['user_group'] == 11){
								$color="background-color:#3B3BBD;";
								}else if($row['user_group'] == 12){
								$color="background-color:#0303FE;";
								}else if($row['user_group'] == 13){
								$color="background-color:#A53486;";
								}else if($row['user_group'] == 14){
								$color="background-color:#DD4F43;";
								}else if($row['user_group'] == 15){									
								$color="background-color:#373434;";
								}else if($row['user_group'] == 16){
								$color="background-color:rgba(255, 0, 0, 0.72);";
								}else $color="background-color:rgba(0, 137, 0, 0.68);";
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="titles[]" id="titles[]" value="<?php echo $username;?>">
                                        <input type="checkbox" name="list[]" id="list[]" value="<?php echo $id;?>" style="display: block">
                                    </td>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $picname; ?>" alt="<?php echo $username ?>" class="img-circle bg-theme" width="40"> <?php echo $username ?></td>
                                    <td><span class="label label-megna label-rounded"><?php echo $row['user_email'] ?></span></td>
									<td><span class="label label-rounded label-info"><?php echo $status ?></span></td>
									<td><span class="label label-rounded" style="<?php echo $color;?>"><?php echo $stt ?></span></td>
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