<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

$query_z = "Update admins set zona='Viendo la Configuración' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z); 

if(isset($_POST['Submit'])) {

        if (!check_allow()) {
            ?>
            <script src="js/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#sa-title').trigger('click');
                });
            </script>
        <?php
        } else {
            
$user_a = "SELECT * FROM admins where id_us = '".$_SESSION['admin']['id']."'";
$userresult_a = $mysqli->query($user_a);
$fetchuser_a = mysqli_fetch_array($userresult_a);
$fetchusername_a  = $fetchuser_a['id_us'];

$sql2 = "UPDATE admins SET tpl_name = '" . $_POST['tpl_name'] . "', tpl_color='" . $_POST['tpl_color'] . "', transfer_filter='" . $_POST['transfer_filter'] . "' WHERE id_us = '".$_SESSION['admin']['id']."'";
$query_result2 = $mysqli->query($sql2);
$success = "Configuracion Guardada";
transfer('config','config');
        exit;
}
}

?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Configuracion</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Escritorio</a></li>
                    <li class="active">Configuracion</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /row -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">


                            <div class="col-md-12">
                                <div class="white-box">
                                    <form class="form-horizontal" action="" method="post">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Filtro de Transferencia </label>
                                            <div class="col-sm-9">
                                                <select name="transfer_filter" class="form-control" id="transfer_filter" style="width:60%;">
                                                    <option value="1" <?php if($transfer_filter_s == 1){ echo "selected"; } ?>>Si</option>
                                                    <option value="0" <?php if($transfer_filter_s == 0){ echo "selected"; } ?>>No</option>
                                                </select>
                                            </div>
                                        </div>

                                       <div class="form-group">
									   <label for="inputPassword3" class="col-sm-3 control-label">Estilo de Colores del Tema</label>
                                                <div class="col-sm-9">
                                                <select name="tpl_name" class="form-control" id="tpl_name" style="width:60%;">
                                                    <option value="style-light.css" <?php if($tpl_name_s == "style-light.css"){ echo "selected"; } ?>>Claro</option>
                                                    <option value="style-dark.css" <?php if($tpl_name_s == "style-dark.css"){ echo "selected"; } ?>>Oscuro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword4" class="col-sm-3 control-label">Color del Tema</label>
                                            <div class="col-sm-9">
                                                <select name="tpl_color" id="tpl_color" class="form-control" style="width:60%">
                                                    <?php
                                                    $langs = array();

                                                    if ($handle = opendir('../../css/colors/'))
                                                    {
                                                        while (false !== ($file = readdir($handle)))
                                                        {
                                                            if ($file != "." && $file != "..")
                                                            {
                                                                $lang2 = $file;
                                                                //$lang2 = str_replace('lang_','',$lang2);

                                                                $langs[] = $lang2;
                                                            }
                                                        }
                                                        closedir($handle);
                                                    }

                                                    sort($langs);

                                                    foreach ($langs as $key => $lang2)
                                                    {
                                                        if($tpl_color_s == $lang2)
                                                        {
                                                            echo '<option value="'.$lang2.'" selected>'.ucwords($lang2).'</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="'.$lang2.'">'.ucwords($lang2).'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button name="Submit" type="submit" class="btn btn-info waves-effect waves-light m-t-10">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php include("../../footer.php"); ?>
