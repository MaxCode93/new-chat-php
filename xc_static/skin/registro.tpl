<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>XenCuba - Registro</title>
	<link rel="shortcut icon" type="image/png" href="xc_static/img/favicon.png" />
    <!--JQUERY-->
    <script src="xc_signup/static/js/jquery-1.8.2.js"></script>
    <script src="xc_signup/static/js/jquery-ui.js"></script>
    <script>
	$(document).ready(function(){
		// Dar el foco al recuadro del codigo
		$("#Nombre").focus();	
		// Al hacer click en el boton para guardar
		$("form#formulario").submit(function()
		{
				var User = new Object();
				User.Nombre     = $('input#Nombre').val();
				User.Apellidos  = $('input#Apellidos').val();
				User.Email      = $('input#Email').val();
				User.Password   = $('input#Password').val();
				User.cbSexo     = $('select#cbSexo').val();
				User.Edad       = $('input#Edad').val();
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='xc_signup/static/img/gif-load.gif'> Registrando...</center></div></div>");
				var DatosJson = JSON.stringify(User);
				$.post('xc_signup/register.php',
					{ 
						user: DatosJson
					},
					function(data, textStatus) {
						$("#"+data.campo+"").focus();
						$("#mensaje").html(data.error_msg);
					}, 
					"json"		
				);
				return false;
		});
	});
    </script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="xc_signup/static/css/bootstrap2.min.css">
    <script src="xc_signup/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="xc_signup/static/css/font-install.css">
    <!-- mi css-->
    <link rel="stylesheet" type="text/css" href="xc_signup/static/css/index.css" th:href="@{/css/index.css}">

</head>
<body>
    <div class="modal-dialog text-center">

        <div class="col-sm-8 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <h4>Formulario de Registro<h4>
                </div>
                <form class="col-12" name="formulario" id="formulario" method="post" action="">
                    <div class="form-group" id="user-group">
                        <input type="text" class="form-control" placeholder="Nombre de Usuario" name="Nombre" id="Nombre"/>
                    </div>
                    <div class="form-group" id="contrasena-group">
                        <input type="password" class="form-control" placeholder="Password" name="Password" id="Password"/>
                    </div>
					<div class="form-group" id="Email1">
                        <input type="text" class="form-control" placeholder="Correo Valido" name="Email" id="Email"/>
                    </div>
					<div class="form-group" id="Edad1">
                        <input type="number" class="form-control" min="12" max="65" placeholder="Edad" name="Edad" id="Edad"/>
                    </div>

                    <div class="form-group2" id="cbSexo2">
					<strong><a>Sexo: </a></strong>
					<select class="form-group" id="cbSexo">
					<option value="m">Masculino</option>
					<option value="f">Femenino</option>
					</select>
                    </div>
					<br>
					<a class="btn btn-primary" style="position: relative; top: -9px;" href="."><i class="fas fa-reply"></i> Regresar </a>&nbsp;&nbsp;
                    <button style="width: 130px;" type="submit" id="guarda" name="guarda" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>  Registrarme </button>
                </form>
            </div>
                        <br>
                    <div id="mensaje"></div>
        </div>
    </div>
</body>
</html>
