<?php
session_start();
$_SESSION['zona']['home'] = null;

include('../../header.php');
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
        $sql = "DELETE FROM users ";
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

        transfer($config,'adm','Admin(s) Eliminado(s)');
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
            <h4 class="page-title">Eliminar Usuarios Admin</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Eliminar Usuarios Admin</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <form action="" method="post" name="f1" id="f1">
                    <h3 class="box-title">Eliminar Usuarios Admin</h3>
                    <hr>
                    <div class="panel-body" style="width:70%; margin-left:15%">
                        <div class="alert alert-danger">
                            <?php
							$user_adm_id='1'; // Id del super usuario principal. :)
							if(is_int(array_search($user_adm_id, $_POST['list'])))
                            {
							echo 'No se puede eliminar este usuario admin <br><Br><a href="adm">Click aqui</a> para regresar.';	
							}
                            else
                            {	
                            if(is_int(array_search($_SESSION['admin']['id'], $_POST['list'])))
                            {
                                echo 'No se puede eliminar el usuario logrado en el panel admin <br><Br><a href="adm">Click aqui</a> para regresar.';
                            }
                            else
                            {
                            ?>
                            <i class="fa fa-bolt"></i> Seguro que deseas eliminar los admin(s) seleccionado(s)?
                        </div>
                        <div class="hr-line-dashed"></div>
                        <ul>
                            <?php
                            $count = 0;
                            $sql = "SELECT id,user_nick FROM users ";

                            foreach ($_POST['list'] as $value)
                            {
                                if($count == 0)
                                {
                                    $sql.= "WHERE id='" . $value . "'";
                                }
                                else
                                {
                                    $sql.= " OR id='" . $value . "'";
                                }

                                $count++;
                            }
                            $sql.= " LIMIT " . count($_POST['list']);

                            $query_result = mysqli_query($mysqli,$sql);
                            while ($info = @mysqli_fetch_array($query_result))
                            {
                                if($_SESSION['admin']['id'] != $info['id'])
                                {
                                    echo "<li><h3 style=\"color:#FF0000\">" . $info['user_nick'] . "<h3></li>";
                                    echo "<input type=\"hidden\" name=\"list[]\" id=\"list[]\" value=\"" . $info['id'] . "\">";
                                }
                            }
                            ?>
                        </ul>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group" align="center">
                            <div class="col-sm-8 col-sm-offset-2">
                                <a href="adm" class="btn btn-default">Cancelar</a>
                                <input name="Submit" type="submit" class="btn btn-danger" value="Si, Eliminarlos">

                            </div>
                        </div>
                        <?php
							}}
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>



<?php include('../../footer.php'); ?>