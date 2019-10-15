<?php
session_start();
$_SESSION['zona']['home'] = "email";

include('header.php');
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
	require '../xc_include/Mailer/PHPMailerAutoload.php';
    $email =  $_POST["email"];
    $sms   =  $_POST["sms"];
    $de    =  $_POST["adm_name"];
    
    $mail = new PHPMailer;
    $mail->isSMTP();                                      
    $mail->Host = 'localhost';                      
    $mail->SMTPAuth = true;                              
    $mail->Username = 'admin@es.cu';       
    $mail->Password = '123456';                
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = '587';                                    
    $mail->From = 'admin@es.cu';
    $mail->FromName = 'XenCuba Team - '.$de;                       
    $mail->isHTML(true); 
    $mail->CharSet = 'UTF-8'; 
 

    $mail->addAddress($email); 

    $mail->Subject = 'XenCuba - Informacion';
    $mail->Body    = $sms;
    $mail->AltBody = 'XenCuba - Informacion';
	
	if(!$mail->send()) {
		  $success = "Error Mensaje No Enviado, intenta mas tarde";
	} else {
		 $success = "Mensaje Enviado Correctamente";
	}

 
    }

}

?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Enviar Mensaje</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
              <li><a href="escritorio">Escritorio</a></li>
                        <li class="active">Enviar Mensaje</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <span style="color:#31df0c;">
                    <?php
                    if(!empty($success)){
                        echo '<div class="byMsg byMsgSuccess">! '.$success.'</div>';
                    }
                    ?>
                </span>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <form action="" method="post" name="f1" id="f1">
                            <h3 class="box-title">El mensaje sera recibido con su nombre de usuario</h3>
                            <hr>
                            <input type="hidden" name="adm_name" id="adm_name" value="<?php echo $_SESSION['admin']['username']; ?>">
                            <div class="panel-body" style="width:70%; margin-left:15%">

                                <div class="form-group" align="center">
                                    <h2>Enviar correo a un usuario<h2>
									<hr>
                                    <div class="col-sm-8 col-sm-offset-2">
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
									<select name="email">
                                     <?php
									 $sql_mail = "select * from users";
									 $query_mail_result = mysqli_query($mysqli,$sql_mail);
                                     while ($row_mail = mysqli_fetch_assoc($query_mail_result))
                                          {           
                                     ?>
                                     <option value="<?php echo $row_mail['user_email']?>"> <?php echo $row_mail['user_nick']?> </option>
                                     <?php
									 } 
									 ?>  
									</select>
									
                                      </div><b style="font-size: 12px;left: -60px;position: relative;">* El correo se le enviara al email de registro del usuario.</b><hr>
                                         <textarea id="sms" name="sms" placeholder="Escriba su mensaje"></textarea>
                                        <br></br>
                                        <input name="Submit" type="submit" class="btn btn-danger" value="Enviar Mensaje">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<?php include('footer.php'); ?>
