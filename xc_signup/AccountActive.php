<?php
	include('encript.php');
	$cliente  = Encrypter::decrypt($_GET['account']);
	$codigo   = $_GET['code'];
 ?>
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>Cybergalaxia - Activar Cuenta</title>
	<link rel="shortcut icon" type="image/png" href="../xc_static/img/favicon.png" />
    <!--JQUERY-->
    <script src="static/js/jquery-1.8.2.js"></script>
    <script src="static/js/jquery-ui.js"></script>
<script>
function redireccionar(){
  window.location.replace('../'); 
}
	$(document).ready(function(){
		// Dar el foco al recuadro del código
		$("#Activacion").focus();	
		// Al hacer click en el botón para guardar
		$("#guarda").click(function()
		{
				var User = new Object();
				User.Codigo     = $('input#Activacion').val();
				User.Id         = $('input#id').val();
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='static/img/gif-load.gif'> Activando Cuenta...</center></div></div>");
				var DatosJson = JSON.stringify(User);
				$.post('ActivaCuenta.php',
					{ 
						user: DatosJson
					},
					function(data, textStatus) {
						$("#"+data.campo+"").focus();
						$("#mensaje").html(data.error_msg);
					setTimeout ("redireccionar()", 5000);	
					}, 
					"json"		
				);
				return false;
		});
	});
    </script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="static/css/bootstrap2.min.css">
    <script src="../xc_static/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="static/css/font-install.css">

    <!-- mi css-->
    <link rel="stylesheet" type="text/css" href="static/css/index.css" th:href="@{/css/index.css}">

</head>
<body>
    <div class="modal-dialog text-center">
        <div class="col-sm-8 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <h4>Activar Cuenta<h4>
                </div>
                <form class="col-12" name="formulario" id="formulario" method="post" action="">
                    <div class="form-group" id="code">
                        <input type="text" class="form-control" placeholder="Su Codigo" name="Activacion" id="Activacion" value="<?php echo $codigo; ?>"/><input type="hidden" id="id" name="id" value="<?php echo $cliente; ?>"/>
                    </div>
					<br>
					<a class="btn btn-primary" style="position: relative; top: -9px;" href="new_code"><i class="fas fa-reply"></i>Re-Enviar Codigo</a>
					<button style="width: 88px;"  type="submit" id="guarda" name="guarda" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>Activar</button>
                </form>
                
            </div>
            <br>
           <div id="mensaje"></div>
        </div>
    </div>

</body>
</html><?php
