<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

$id_us_m=$_GET['id'];
$user3 = "SELECT * FROM users where id = '".$id_us_m."'";
$userresult3 = $mysqli->query($user3);
$fetchuser3 = mysqli_fetch_array($userresult3);
$fetchusername3  = $fetchuser3['user_nick'];
$edit_us= "Editando usuario ".$fetchusername3;

$query_z = "Update admins set zona='".$edit_us."', fecha='".$date_time."' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

if(!isset($_GET['id']))
{
    echo '<script>window.location="404.php"</script>';
}
$error = array();
$errorNo = 0;
function check_account_exists($config,$con,$id)
{
    $row = mysqli_num_rows(mysqli_query($con, "select 1 from users where id = '".$id."'"));
    if($row>0){
        return TRUE;
    }
    return FALSE;
}
$check = check_account_exists($config,$mysqli,$_GET['id']);
if($check != 1)
{
    echo '<script>window.location="404.php"</script>';
}

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
        if($_POST["username"] == ""){
            $error[] = "El campo usuario no puede estar en blanco.";
            $errorNo = 1;
        }
        if($_POST["email"] == ""){
            $error[] = "El campo email no puede estar en blanco.";
            $errorNo = 3;
        }
        if($errorNo==0) {
            if ($_POST['id_user']=='1' && $_SESSION['admin']['id'] != '1') {
			$error[] = "Este usuario no se puede editar.";
            $errorNo = 2;			
			}else{
					
			if ($_POST["acp"] == "1"){
			$id_us=$_POST['id_user'];
			$user_a = "SELECT id_us FROM admins where id_us = '".$id_us."'";
			$userresult_a = $mysqli->query($user_a);
            $fetchuser_a = mysqli_fetch_array($userresult_a);
            $fetchusername_a  = $fetchuser_a['id_us'];
			if($fetchusername_a!=$id_us){
			$query0 = "Insert into admins set id_us='".$_POST['id_user']."', user_nick='" . $_POST['username'] . "', user_group='" . $_POST['stt'] . "',
				user_priv='" . $_POST['priv'] . "', user_start='" . $_POST['att'] . "'";
              $query_result0 = $mysqli->query($query0);
              
              $logs=fopen("../xc_error/admlog.txt","a+"); 
                $ip=$_SERVER['REMOTE_ADDR']; 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. $_SESSION['admin']['username']. " Concede panel admin a ". "[".$_POST["username"]. "]" . PHP_EOL); 
                fclose($logs);
			}}
			
			if ($_POST["acp"] == "0") {
			$user_a = "SELECT id_us FROM admins where id_us = '".$id_us."'";
			$userresult_a = $mysqli->query($user_a);
            $fetchuser_a = mysqli_fetch_array($userresult_a);
            $fetchusername_a  = $fetchuser_a['id_us'];
			if($fetchusername_a==$id_us){
			$query1 = "DELETE FROM admins where user_nick='" . $_POST['username'] . "'";
              $query_result1 = $mysqli->query($query1);
              $logs=fopen("../xc_error/admlog.txt","a+"); 
                $ip=$_SERVER['REMOTE_ADDR']; 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. $_SESSION['admin']['username']. " Quita panel admin a ". "[".$_POST["username"]. "]" . PHP_EOL); 
                fclose($logs);
			}}
				
			if (!empty($_POST['pass'])) {
              $id_us=$_POST['id_user'];
	          $us_passw = $_POST["pass"];                            
			$query = "Update users set user_nick='" . mysqli_real_escape_string($mysqli, $_POST["username"]) . "', 
			    user_passw=md5('$us_passw'),
                user_email='" . mysqli_real_escape_string($mysqli, $_POST["email"]) . "',
                firma='" . mysqli_real_escape_string($mysqli, $_POST['firma']) . "',
                user_sexo='" . mysqli_real_escape_string($mysqli, $_POST['sex']) . "',
                user_mess='" . mysqli_real_escape_string($mysqli, $_POST['sms']) . "',
				user_group='" . mysqli_real_escape_string($mysqli, $_POST['stt']) . "',
				user_priv='" . mysqli_real_escape_string($mysqli, $_POST['priv']) . "',
				user_start='" . mysqli_real_escape_string($mysqli, $_POST['att']) . "',
                acp='" . mysqli_real_escape_string($mysqli, $_POST['acp']) . "'
            WHERE id = '".$id_us."' LIMIT 1";
              $query_result = $mysqli->query($query);
              $logs=fopen("../xc_error/admlog.txt","a+"); 
                $ip=$_SERVER['REMOTE_ADDR']; 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. $_SESSION['admin']['username']. " Modifica perfil de ". "[".$_POST["username"]. "]" . PHP_EOL); 
                fclose($logs);
						
 $success = "Perfil Actualizado Correctamente";
              }else {
              //$time = date('Y-m-d H:i:s', time());
				$id_us=$_POST['id_user'];
				
                $query = "Update users set user_nick='" . mysqli_real_escape_string($mysqli, $_POST["username"]) . "', 
                user_email='" . mysqli_real_escape_string($mysqli, $_POST["email"]) . "',
                firma='" . mysqli_real_escape_string($mysqli, $_POST['firma']) . "',
                user_sexo='" . mysqli_real_escape_string($mysqli, $_POST['sex']) . "',
                user_mess='" . mysqli_real_escape_string($mysqli, $_POST['sms']) . "',
				user_group='" . mysqli_real_escape_string($mysqli, $_POST['stt']) . "',
				user_priv='" . mysqli_real_escape_string($mysqli, $_POST['priv']) . "',
				user_start='" . mysqli_real_escape_string($mysqli, $_POST['att']) . "',
                acp='" . mysqli_real_escape_string($mysqli, $_POST['acp']) . "'
            WHERE id = '".$id_us."' LIMIT 1";
                $query_result = $mysqli->query($query);
            $logs=fopen("../xc_error/admlog.txt","a+"); 
                $ip=$_SERVER['REMOTE_ADDR']; 
                $fecha=date("d/m/y  h:i-> "); 
                fwrite($logs, $fecha. $_SESSION['admin']['username']. " Modifica perfil de ". "[".$_POST["username"]."]" . PHP_EOL); 
                fclose($logs);
					if($query_result){
                $success = "Perfil Actualizado Correctamente";
                }else{
                	     $success = "Error!!";
                }
}
		}       
		}
        
    }
}
$user = "SELECT * FROM users where id = '".$_GET['id']."'";
$userresult = $mysqli->query($user);
$fetchuser = mysqli_fetch_assoc($userresult);
$fetchusername  = $fetchuser['user_nick'];
$fetchpass = $fetchuser['user_passw'];
$fetchuserpic   = $fetchuser['user_thumb'];
$fetchemail  = $fetchuser['user_email'];
$fetchabout  = $fetchuser['firma'];
$fetchsex    = $fetchuser['user_sexo'];
$fetchjoined  = $fetchuser['user_register'];
$fetchsms      = $fetchuser['user_mess'];
?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Editar perfil de <?php echo $fetchusername;?></h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="escritorio">Escritorio</a></li>
                        <li class="active">Editar perfil de <?php echo $fetchusername;?></li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <span style="color:#df6c6e;">
                    <?php
                    if($errorNo!=0){
                        foreach($error as $value){
                            echo '<div class="byMsg byMsgError">! '.$value.'</div>';
                        }
                    }

                    ?>
                </span>
            <span style="color:#31df0c;">
                    <?php
                    if(!empty($success)){
                        echo '<div class="byMsg byMsgSuccess">! '.$success.'</div>';
                    }
                    ?>
                </span>
            <!-- /row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-info">

                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <form name="form1" method="post" action="#" id="send" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="box-title">Información Personal</h3>
                                        <hr>
										<input type="hidden" name="id_user" id="id_user" value="<?php echo $fetchuser['id']; ?>">
										<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Nombre</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Nombre" name="username" value="<?php echo $fetchusername;?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-key"></i></div>
                                                    <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
                                                </div>
                                            </div>
                                        </div>

                                    

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $fetchemail;?>">
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sms">Mensajes</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="icon-envelope fa-fw"></i></div>
                                                        <input type="number" MAX="99999" MIN="0" class="form-control" id="sms" name="sms" placeholder="Min 0 - Max 99999" value="<?php echo $fetchsms;?>">
                                                    </div>
                                                </div>
                                            </div>
									
                                    </div>
                                    </div>
										
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <img src="../xc_uploads/thumbs/0/<?php echo $fetchuserpic;?>" alt="<?php echo $fetchname;?>" style="width: 80px; border-radius: 50%">
                                                    </div>
                                                    <div class="col-md-10">
                                                        <label class="control-label">Imagen de Perfil</label>
                                                        <div class="col-sm-12">
                                                            <div>
               
                                        <a href="users_del_thumb?id_to_del=<?php echo $fetchuser['id']; ?>" class="input-group-addon btn btn-default fileinput-exists">Eliminar Foto</a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Firma</label>
                                                    <textarea name="firma" class="form-control" ><?php echo urldecode($fetchabout);?></textarea>
                                              </div>
                                         </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Genero</label>
                                                    <select class="form-control" name="sex">
                                                        <option value="m" <?php if($fetchsex == "m") { echo "selected"; }?>>Hombre</option>
                                                        <option value="f" <?php if($fetchsex == "f") { echo "selected"; }?>>Mujer</option>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
											
                                        </div>

                                    
								    <h3 class="box-title m-t-40">Estatus y Privilegios</h3>
                                    <hr>
                                    <div class="row">


                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Estatus</label>  
                    <select class="form-control" name="stt" required>
					<option value="1" <?=$fetchuser['user_group']==1?"selected":""?>>Registrado</option> 
					<option value="2" <?=$fetchuser['user_group']==2?"selected":""?>>Nivel 1</option>
					<option value="3" <?=$fetchuser['user_group']==3?"selected":""?>>Nivel 2</option>
					<option value="4" <?=$fetchuser['user_group']==4?"selected":""?>>Estrella</option>
					<option value="5" <?=$fetchuser['user_group']==5?"selected":""?>>Prince</option>
					<option value="6" <?=$fetchuser['user_group']==6?"selected":""?>>Princess</option>
					<option value="7" <?=$fetchuser['user_group']==7?"selected":""?>>Destacado</option>
					<option value="8" <?=$fetchuser['user_group']==8?"selected":""?>>Chico VIP</option>
					<option value="9" <?=$fetchuser['user_group']==9?"selected":""?>>Chica VIP</option>
					<option value="10" <?=$fetchuser['user_group']==10?"selected":""?>>Reina</option>
					<option value="11" <?=$fetchuser['user_group']==11?"selected":""?>>Asistente</option>
					<option value="12" <?=$fetchuser['user_group']==12?"selected":""?>>Operador</option>
					<option value="13" <?=$fetchuser['user_group']==13?"selected":""?>>Supervisor</option>
					<option value="14" <?=$fetchuser['user_group']==14?"selected":""?>>Sub-Admin</option>
					<option value="15" <?=$fetchuser['user_group']==15?"selected":""?>>Administrador</option>
					<?php
if($_SESSION['admin']['username']!='admin' || $s_admin_s == $_SESSION['admin']['username']){?>

<option value="16" <?=$fetchuser['user_group']==16?"selected":""?> disabled>Webmaster</option>
<?php
}else{
?> 
<option value="16" <?=$fetchuser['user_group']==16?"selected":""?>>Webmaster</option>
<?php
}
?>
                    </select>
                                                <span class="help-block"></span>
                                                </div>
                                                </div>
											
											
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Estrellas</label>    
                    <select class="form-control" name="att" required>
				    <option value="1" <?=$fetchuser['user_start']==1?"selected":""?>>1 Estrella</option> 
					<option value="2" <?=$fetchuser['user_start']==2?"selected":""?>>2 Estrellas</option> 
					<option value="3" <?=$fetchuser['user_start']==3?"selected":""?>>3 Estrellas</option>
					<option value="4" <?=$fetchuser['user_start']==4?"selected":""?>>4 Estrellas</option>
					<option value="5" <?=$fetchuser['user_start']==5?"selected":""?>>5 Estrellas</option>
                    </select>
                                                <span class="help-block"></span>
                                                </div>
                                                </div>
                                    
									            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Privilegios</label>    
                    <select class="form-control" name="priv" required>
					<option value="0" <?=$fetchuser['user_priv']==0?"selected":""?>>Ninguno</option>
				    <option value="1" <?=$fetchuser['user_priv']==1?"selected":""?>>Ver IP</option> 
					<option value="3" <?=$fetchuser['user_priv']==3?"selected":""?>>Expulsar</option> 
					<option value="7" <?=$fetchuser['user_priv']==7?"selected":""?>>Banear</option>
					<option value="15" <?=$fetchuser['user_priv']==15?"selected":""?>>Desbanear</option>
					<option value="31" <?=$fetchuser['user_priv']==31?"selected":""?>>Mutear/Desmutear </option>
					<option value="63" <?=$fetchuser['user_priv']==63?"selected":""?>>Comandos</option>
					<option value="127" <?=$fetchuser['user_priv']==127?"selected":""?>>Cambiar Grupos/Estrellas </option> 
                     <option value="255" <?=$fetchuser['user_priv']==255?"selected":""?>>Cambiar Privilegios </option>
                    </select>
					<label class="control-label">Nota: Al dar el siguiente privilegio los anteriores se mantienen.</label>
                                                <span class="help-block"></span>
                                                </div>
                                                </div>
												<?php 
												if(isset($_SESSION['admin']['username'])=='admin'){
													if($_SESSION['admin']['username']=='admin'){
													?>
												<div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Administración</label> 
                    <select class="form-control" name="acp" required>
					<option value="1" <?=$fetchuser['acp']==1?"selected":""?>>Si</option> 
					<option value="0" <?=$fetchuser['acp']==0?"selected":""?>>No</option>
                    </select>
					<label class="control-label">Nota: Solo dar a usuarios de confianza.</label>
                                                <span class="help-block"></span>
                                                </div>
                                                </div>	
												<?php }} ?>
													
												
												
									
									
									</div>

                                    <div class="form-actions">
                                        <button type="submit" name="Submit" class="btn btn-success"> <i class="fa fa-check"></i> Salvar</button>
                                        <a href="users" class="btn btn-default">Cancelar</a>
                                    </div>
                                </form>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php include("../../footer.php"); ?>