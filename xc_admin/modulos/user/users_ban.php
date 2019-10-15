<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

$query_z = "Update admins set zona='Viendo los Usuarios Baneados', date='".$date_time."' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z); 

if(isset($_POST['Submit']))
{
    if(!check_allow()){
        ?>
        <script src="js/jquery/dist/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#sa-title').trigger('click');
            });
        </script>
    <?php

    }
    else{
        $count = 0;
        $sql = "DELETE FROM ip_ban ";

        foreach ($_POST['list'] as $value)
        {
            if($count == 0)
            {
                $sql.= "WHERE id = '" . $value . "'";
            }
            else
            {
                $sql.= " OR id = '" . $value . "'";
            }

            $count++;
        }
        $sql.= " LIMIT " . count($_POST['list']);

        mysqli_query($mysqli,$sql);

        transfer($config,'users_ban','User Banned');
        exit;
    }

}

if(isset($_GET['id']))
{
    $_POST['list'][] = $_GET['id'];
}
?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Usuarios Baneados</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="escritorio">Escritorio</a></li>
                        <li class="active">Usuarios Baneados</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                    <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="users_desban" method="post" name="f1" id="f1">
                        <div>
                            <div class="pull-left"><h3 class="box-title">Lista de Usuarios Baneados</h3></div>
                            <div class="pull-right">
                                <p class="text-muted">
                                    <button type="submit" name="submit" class="btn btn-danger waves-effect waves-light m-r-10"><i class="fa fa-trash-o"></i>Desbanear Seleccionados</button>
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
                                <th>Operador</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
                                <th class="sortingNone">Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM ip_ban ORDER BY id ASC";
                            $result = $mysqli->query($query);
                               while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $username = $row['user'];
							$fecha_ban = str_replace('-', '/', date("d-m-Y", strtotime($row['fecha'])));
							
                            $query1 = "SELECT user_thumb FROM users WHERE user_nick='" .$row['user']. "' LIMIT 1";
                                $query_result1 = mysqli_query ($mysqli, $query1);
                                while ($info1 = mysqli_fetch_array($query_result1))
                                {
                            $foto = $info1['user_thumb'];
                                  }
                                  
                            $query2 = "SELECT user_thumb FROM users WHERE user_nick='" .$row['oper']. "' LIMIT 1";
                                $query_result2 = mysqli_query ($mysqli, $query2);
                                while ($info2 = mysqli_fetch_array($query_result2))
                                {
                            $foto2 = $info2['user_thumb'];
                                  }                               
                            ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="titles[]" id="titles[]" value="<?php echo $username;?>">
                                        <input type="checkbox" name="list[]" id="list[]" value="<?php echo $id;?>" style="display: block">
                                    </td>
                                    <td><?php echo $id ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $foto ?>" alt="<?php echo $username ?>" class="img-circle bg-theme" width="40"> <?php echo $username ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $foto2 ?>" alt="<?php echo $row['oper'] ?>" class="img-circle bg-theme" width="40"> <?php echo $row['oper'] ?></td>
                                    <td><span class="label label-megna label-rounded"><?php echo $row['motivo']; ?></span></td>
                                    <td><span class="label label-success label-rounded"><?php echo $fecha_ban; ?></span></td>
                                    <td class="text-nowrap">
                                        <a href="users_desban?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Quitar Ban a <?php echo $username ?>"> <i class="fa fa-trash-o btn btn-danger waves-effect waves-light m-r-10"></i></a>
                                        
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

<?php include('../../footer.php'); ?>