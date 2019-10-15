<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

$config = "SELECT * FROM config";
$configresult = $mysqli->query($config);
$fetchconfig= mysqli_fetch_assoc($configresult);

$query_z = "Update admins set zona='Viendo la Configuración del Sitio' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z); 

$ver_mmto = '../../../xc_include/ONLINE_YES';
if (file_exists($ver_mmto)) {
        $mmto=0;
}else{
    	$mmto=1;
}

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
            
$reg_mail   = $_POST['reg_mail'];
$query_reg_mail = "Update config set reg_mail='$reg_mail'";
$query_result_reg_mail = $mysqli->query($query_reg_mail);

$value_mmto = $_POST['mmto'];
if($value_mmto==1){
@unlink('../../../xc_include/ONLINE_YES');
}else{
	fopen('../../../xc_include/ONLINE_YES', 'w');
}

$success = "Configuracion Guardada";
transfer('config_site','config_site');
exit;
}
}

?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Configuracion del Sitio</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="escritorio">Escritorio</a></li>
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
                                    <!--<h3 class="box-title m-b-0">Configuration</h3>-->
                                    <!--<p class="text-muted m-b-30 font-13"></p>-->
                                    <form class="form-horizontal" action="" method="post">
                                        
                                        <div class="col-md-6">
										<div class="form-group">
											<div class=""><strong>Modo Mantenimiento</strong></div>
				             				<hr>
                                             <select class="form-control" name="mmto" id="mmto">
					                          <option value="1" <?=$mmto==1?"selected":""?>>Si</option> 
					                          <option value="0" <?=$mmto==0?"selected":""?>>No</option>
                                             </select>
                                        </div>
									<hr>
									<div class="form-group">
										<div class=""><strong>Activar Registro Via Email</strong></div>
				             				<hr>
                                             <select class="form-control" name="reg_mail" id="reg_mail">
					                          <option value="1" <?=$fetchconfig['reg_mail']==1?"selected":""?>>Si</option> 
					                          <option value="0" <?=$fetchconfig['reg_mail']==0?"selected":""?>>No</option>
                                             </select>
                                        </div>
                                         </div>
									<hr>

								
							
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
