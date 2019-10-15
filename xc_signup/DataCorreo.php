<?php  
require '../xc_include/Mailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();                                      
$mail->Host = 'localhost';                      
$mail->SMTPAuth = true;                               
$mail->Username = 'admin@es.cu';        
$mail->Password = '123456';                
$mail->SMTPSecure = 'tls';                            
$mail->Port = '587';                                    
$mail->From = 'admin@es.cu';
$mail->FromName = 'XenCuba Team';                       
$mail->isHTML(true); 
$mail->CharSet = 'UTF-8'; 

function enviarMail($destinatarios,$asunto,$mensaje){
	global $mail;

	
	$mail->addAddress($destinatarios);
	
	$mail->Subject = $asunto; 

	$mail->Body    = $mensaje;

	if(!$mail->send()) {
		return false;
	} else {
		return true;
	} 
} 
?>
