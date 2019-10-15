<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

$config = "SELECT * FROM config";
$configresult = $mysqli->query($config);
$fetchconfig= mysqli_fetch_assoc($configresult);


$query_z = "Update admins set zona='Actualizando el Sitio' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
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
		$tipo=$_POST['tipo'];
		$file = $_POST['repo'].$tipo;
		$newfile = "../../../xc_uploads/temp/update.zip";
		if (!copy($file, $newfile)) 
		{
	       $error = "No existen actualizaciones disponibles!";
		}
		else
		{
			$zip = new ZipArchive;
			if ($zip->open('../../../xc_uploads/temp/update.zip') === TRUE) 
			{
				$fecha=date("d-m-Y h:i:s a");
				$zip->extractTo('../../../');
				$zip->close();
				unlink('../../../xc_uploads/temp/update.zip');
				$file = fopen("../../../xc_uploads/temp/last_update.log", "w");
                fwrite($file, "$fecha" . PHP_EOL);
                fclose($file);			
                      }else 	
			{
				$error = "Imposible actualizar, intentelo mas tarde!";
			}
		}
}
}

?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Actualizar el Sitio</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="escritorio">Escritorio</a></li>
                    <li class="active">Actualizar</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <span style="color:#df6c6e;">
                    <?php
                    if(!empty($error)){
                        echo '<div class="byMsg byMsgError">!'.$error.'</div>';
                    }
                    ?>
                </span>
                   <span style="color:#31df0c;">
                    <?php
                    if(!empty($success)){
                        echo '<div class="byMsg byMsgSuccess">!'.$success.'</div>';
                    }
                    ?>
                </span>
        <!-- /row -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">        	                 <div class="col-md-12">
                                <div class="white-box">
                                    <!--<h3 class="box-title m-b-0">Actualizar</h3>-->
                                    <!--<p class="text-muted m-b-30 font-13"></p>-->
                                    <form class="form-horizontal" action="" method="post">
                                        
                                        <div class="col-md-6">
										<div class="form-group">
										<div class="alert navbar-header">Seleccione a que parte del sitio decea buscarle una actualizacion</div>
				             				<hr>
											<strong>Repositorio (Eje: http://repo.xencuba.cu/update/)</strong>
											<input type="text" class="form-control" id="repo" placeholder="Repositorio" name="repo" value="http://update.cubava.cu/files/2019/10/">
											<hr>
                                        <select class="form-control" name="tipo" id="tipo">
					                          <option value="chat.zip">Chat</option> 
					                          <option value="xc_admin.zip">Panel Admin</option>
                                             </select>
											 <br>
											 Ultima Actualizacion: <?php $file = fopen("../../../xc_uploads/temp/last_update.log", "r"); while(!feof($file)) {echo "<strong>".fgets($file). "<br></strong>";}fclose($file);?>
											  
											  Cambios: <br>
											  <?php $file = fopen("../../../xc_uploads/temp/cambios.log", "r"); while(!feof($file)) {echo "<strong>".fgets($file). "<br/></strong>";}fclose($file);?>
                                        </div>

                                        <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button name="Submit" type="submit" class="btn btn-info waves-effect waves-light m-t-10">Actualizar</button>
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
