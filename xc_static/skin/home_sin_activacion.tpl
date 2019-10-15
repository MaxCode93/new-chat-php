<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
<title>XenCuba - &Uacute;nete a nuestra Familia</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<meta name="title" content="Invitado - &Uacute;nete a nuestra comunidad" />
		<meta name="description" content="Chatea con tu familia inalambrica" />
		<meta name="keywords" content="XenCuba, Chat, Chat gratis" />
		<meta name="author" content="Maxwell" />

		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow" />

		<link rel="shortcut icon" type="image/png" href="xc_static/img/favicon.png" />
	
		<link type="text/css" rel="stylesheet" href="xc_static/css/animate.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/confirm.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/fancybox.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/pace.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/switchery.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/simple-line-icons.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/dataTables.bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/fonts/open_sans/open-sans.css" />
		<link type="text/css" rel="stylesheet" href="xc_static/css/app.css" />
        <link rel="stylesheet" type="text/css" href="xc_static/css/cookieconsent.min.css" /> 
		<link type="text/css" rel="stylesheet" href="xc_static/css/sweetalert.css">
        <link type="text/css" rel="stylesheet" href="xc_static/css/notifIt.css">
	   <script type="text/javascript"> window.onunload = window.onbeforeunload = function(){ return ""; }; </script>
		<style>
			table.dataTable thead .sorting:after {
			    opacity: 1;
			}
			table.dataTable thead .sorting_asc:after {
			     opacity: 1;
			}
		</style>
 </head>

	<body app-view="index">
	
	<header>
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div id="mynavbar" class="container">
					<a class="navbar-brand hidden-xs"><i class="icon-speech" style="color: #00c292;"></i> XenCuba</a>		
					<ul class="nav navbar-search-user navbar-nav navbar-left hidden-xs hidden-sm">
						<li>
							<form class="navbar-form" onsubmit="return false;">
		                        
		                        <input id="search" class="form-control navbar-search" placeholder="Buscar usuario..." type="text">
								
								<div id="search-results" class="dropdown-menu animated fadeInUp dropdown-widget dropdown-open dropdown-search" style="display: none;">
									<div class="dropdown-widget-header">
										Resultados de la b?squeda
									</div>
									<div class="dropdown-widget-body">
										<div class="loader mt10 mb10"></div>
									</div>
								</div>

		                   	</form>
						</li>
					</ul>


					<div class="pull-right">
						<ul class="nav navbar-nav navbar-right">
							<li id="cntonline" class="hidden-xs usonline">
								<a role="button">
									<span class="badge">?</span> Conectados						
								</a>
							</li>
								<li class="vis start" data-toggle="modal" href="#modal-login">
										<a role="button">
											<i class="icon-login" style="margin-right: 5px;"></i>Iniciar Sesi&oacute;n
										</a>
									</li>
								<li class="vis register" data-toggle="modal" href="#modal-register" >  <!-- #modal-register -->
										<a  role="button">			
											<i class="icon-people" style="margin-right: 5px;"></i>Registrarse
									</a>
							</li>
						
							<li class="opcion dropdown notify hidden"><a class="dropdown-toggle dropdown-mn" data-toggle="dropdown" role="button" aria-haspopup="true" onclick="shownotify();"><i class="icon-bell" style="position: relative;top:2px;"></i>

			<span class="count-notify hidden">0
			</span></a>
			<ul notify="0" class="dropdown-menu notifications dropdown-menu-right animated fadeInUp" style="padding-bottom: 0px;padding-top: 0px;">
			<li style="padding-bottom: 10px;padding-top: 10px;">

<div style="text-align: center"><i class="icon-bell"></i> No hay notificaciones
</div></li>
</ul></li>
							<li id="uspreferencias" title="Preferencias" class="opcion preferencias hidden" data-toggle="modal" href="#modal-change-prefer">
							    <a role="button">										
									<i class="icon-settings" style="margin-right: 5px;"></i> 
								</a>
							</li>
							<li id="usperfil" title="Modificar Perfil" class="opcion opciones hidden" data-toggle="modal" href="#modal-change-data">
							    <a  role="button">	
									<i class="icon-note" style="margin-right: 5px;"></i>
							</a>
							</li>
							<li id="view_user_list" show="0" class="opcion hidden">
								<a role="button">
									<i class="icon-people" style="font-size: 16px;"></i>							
								</a>
							</li>
							<li class="dropdown opcion1 hidden">							
								<a class="dropdown-toggle dropdown-mn" data-toggle="dropdown" role="button" aria-haspopup="true">
									<img id="myavatar" class="img-circle" src="xc_uploads/thumbs/default.png" width="21" height="21">
									<b id="mynick"></b>
									<b style="margin-left: 8px;" class="caret"></b>
								</a>
								<ul class="dropdown-menu dropdown-menu-right dropdown-user-opcion animated fadeInUp">
									<li class="qban hidden">
										<a onclick="viewban();" role="button">	
											<i class="icon-ban" style="margin-right: 5px;"></i> Ver Baneados
										</a>
									</li>

									<li class="divider qban hidden"></li>	
									<li class="acp hidden">
										<a onClick="window.open('admin')" role="button">	
											<i class="icon-menu" style="margin-right: 5px;"></i> Admininstracion v4.1(Beta)
										</a>
									</li>
									<li class="divider acp hidden"></li>	
									<li class="tpic hidden">
										<a data-toggle="modal" href="#modal-change-topic" role="button">	
											<i class="icon-note" style="margin-right: 5px;"></i> Cambiar Topic
										</a>
									</li>
									<li class="divider tpic hidden"></li>
									<li>
										<a data-toggle="modal" href="#modal-change-avatar" role="button">										
											<i class="icon-camera" style="margin-right: 5px;"></i> Cambiar Avatar
										</a>
									</li>	
									<li class="divider"></li>
									<li>
										<a data-toggle="modal" href="#changePass" role="button">										
											<i class="icon-key" style="margin-right: 5px;"></i> Cambiar Contrase&ntilde;a
										</a>
									</li>
									<li class="divider"></li>
                                    <li onclick="show_transf_mess();"><a data-toggle="modal" href="#transf" role="button"><i class="icon-bubbles" style="margin-right: 5px;">
									</i> Transferir mensajes</a>
									</li>
									<li class="divider qban "></li>	
									<li class="tpic ">
										<a data-toggle="modal" href="#estatus_privis" role="button">	
											<i class="icon-trophy" style="margin-right: 5px;"></i> Estatus & Privilegios
										</a>
									</li>
									<li class="divider qban"></li>	
									<li class="tpic ">
										<a data-toggle="modal" href="#terminos_de_uso" role="button">	
											<i class="icon-book-open" style="margin-right: 5px;"></i> Reglamento
										</a>
									</li>
									
										 <li class="divider"></li>
									<li>
										<a href="javascript:close();" role="button">										
											<i class="icon-logout" style="margin-right: 5px;"></i> Desconectarme
										</a>
									</li>							
								</ul>									
							</li>
						</ul>
					</div>			
				</div>			
			</nav>
		</header>
		<div class="container">	
			<div class="log-false">
				<div class="container">
					
					<div class="row">


						<div class="col-lg-12 portada_top" style="overflow: hidden;">
							<div class="col-lg-8 animated fadeInLeft">
								<div class="panel panel-default">
									<div class="panel-body">
                                         <img src="xc_static/img/default.png" width="680" height="380" />

									</div>
								</div>
								<footer>
									<div class="footer" style="font-family: 'Viga'">
										<div class="col-lg-12 text-center">
											<p style="margin-bottom: 0px;">
												Powered by <a>XenCuba, 2019</a>
											</p>				
										</div>					
									</div>
								</footer>
							</div>

							<div class="col-lg-4 animated fadeInRight">
								<div class="panel panel-default">
									<div class="panel-body">
									   <h5 style="font-family: 'Viga';">Staff Conectado:</h5>
									   <div class="showstaff text-center">
									   		<a class="loader"></a>
									   </div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-body">
									   <h5 style="font-family: 'Viga';">Usuarios m&aacute;s Populares:</h5>
									   <div class="showrating text-center">
									   		<a class="loader"></a>
									   </div>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-body">
									   <h5 style="font-family: 'Viga';">Estadisticas de Usuarios:</h5>
									   <div class="text-center">
									   		<div>
		                                        <p align="left">
		                                        	<small>Total</small>
		                                        	<small class="tx-gray" id="total_de_users">?</small>
		                                        </p>
		                                        <div class="">
		                                            <div class="progress progress_sm">
		                                                <div class="progress-bar bg-green progress-bar-striped active" role="progressbar" data-transitiongoal="100"></div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div>
		                                        <p align="left">
		                                        	<small>Hombres</small>
		                                        	<small class="tx-gray" id="total_de_users_m">?</small>
		                                        </p>
		                                        <div class="">
		                                            <div class="progress progress_sm">
		                                                <div class="progress-bar bg-blue progress-bar-striped active total_de_users_m" role="progressbar" data-transitiongoal=""></div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                     <div>
		                                        <p align="left">
		                                        	<small>Mujeres</small>
		                                        	<small class="tx-gray" id="total_de_users_f">?</small>
		                                        </p>
		                                        <div class="">
		                                            <div class="progress progress_sm">
		                                                <div class="progress-bar bg-pink progress-bar-striped active total_de_users_f" role="progressbar" data-transitiongoal=""></div>
		                                            </div>
		                                        </div>
		                                    </div>
									   </div>
									</div>
								</div>
							</div>
							
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="log-true" style="display: none;">
				<div class="row">
					<div class="navbar-header header-start">
						<div class="header-privados">
							
							<!-- zone table active -->
							<ul id="zone-header" class="list-inline list-unstyled">
								
								<li zone="0" class="active">
									<img src="xc_static/img/home.png" class="img-circle" width="44" height="42">
								</li>
							
							</ul>
							<!-- end zone table active -->

						</div>
						<div class="header-usuario">
							<!--(?) <i class="icon-people"></i>-->
						</div>
					</div>
					<div class="row">
						
						<!-- user list -->
						<aside class="user-list"></aside>
						<!-- end user list -->

						<!-- view profile -->
						<aside id="profile_view" class="view-profile animated">
							<div class="about clearfix">
								<div class="thumb">
									<div class="avatar">
										<div class="avatar-image" alt="Cargando.."></div>
									</div>		
								</div>
								<div class="info">
									<h4>
										<span class="unamenick">Unamenick</span> <small>[level]</small>
									</h4>
									<p>
										<small class="data">Sexo, ??? a&ntilde;os</small>
									</p>
									<p>
										<small class="sms">Mensajes: ???</small>
									</p>

								</div>
								<nav>							
									<button type="button" user-id="" class="init-charla btn btn-primary btn-block"><i class="icon-bubbles"></i> Iniciar Conversaci&oacute;n</button>
									<button type="button" user-id="" class="bloking btn btn-danger btn-block"><i class="icon-ban"></i> Ignorar Usuario</button>
									<div class="extra"></div>								
									<button class="btn btn-default back"><span>Volver Atras ></span></button>
								</nav>
							</div>			
						</aside>
						<!-- end view profile -->

						<div class="col-lg-12 col-xs-12 chat-container">
							
							<!-- zona de mensajes -->
							<div id="zone-boddy">	
								<div zone-id="0">
										
									<div class="app-item">						
										<div class="app-item-msg">
											<span class="tx-gray">*** XenCuba (c) Powered by XenCuba - Todos los derechos reservados</span>
										</div>
									</div>	
									<!-- topic -->
									<div class="app-item">						
										<div class="app-item-msg topic2">
											<span class="tx-system">*** TOPIC: </span> <span class="topic"></span>
										</div>
									</div>												

								</div>

							</div>
							<!-- end zona de mensajes -->
						<div class="footer-start">					
								<ul class="nav navbar-nav navbar-left clearfix">
									<li>
										<button data-toggle="button" type="button" class="btn btn-format btn-default btn-sm" aria-pressed="false">
					                        <b>B</b>
					                    </button> 
									</li>
									<li>
										<button data-toggle="button" type="button" class="btn btn-format btn-default btn-sm" aria-pressed="false">
					                        <i>I</i>
					                    </button> 
									</li>
									<li>
										<button data-toggle="button" type="button" class="btn btn-format btn-default btn-sm" aria-pressed="false">
					                        <u>U</u>
					                    </button>
									</li>
									<li>
										<input type="color" class="btn btn-format btn-default attcolor btn-xs" value="#000000">
									</li>
										
																	
									<li class="dropup">
										<button id="showemot" type="button" data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">
											<i class="icon-emotsmile"></i> <span class="hidden-xs">Emoticons</span>
					                    </button>
					                   <ul class="dropdown-menu dropdown-menu-left emoticons dropup-m" role="menu"></ul>
									</li>
									<!--STICKERS-->
									<li class="dropup">
										<button id="showstick" type="button" data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">
											<i class="icon-fire"></i> <span class="hidden-xs">Stickers</span>
					                    </button>
					                   <ul class="dropdown-menu dropdown-menu-left stickers dropup-m" role="menu"></ul>
									</li>
 
										<li class="dropup hidden-sm">
										<button id="addfile" type="button" data-toggle="dropdown"   class="btn btn-default btn-sm dropdown-toggle">
											<i class="icon-picture"></i> <span class="hidden-xs">Imagen</span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-menu-left adjuntos dropup-m" role="menu">
					                    	<table class="table" style="margin-bottom: 0px;">
					                    		<thead>
					                    			<tr>
					                    				<th>
					                    					<button type="button" class="btn btn-block btn-sm btn-primary btn-upload-file" onclick="$('#upl-fil').trigger('click');">Subir Fichero</button>
															
					                    					<form action="xc_clases/file.php" id="form-upload" enctype="multipart/form-data" method="post">
					                    						<input type="file" name="file" id="upl-fil" class="form-control hidden" onchange="$('#form-upload').submit();">
					                    						<input id="upload_sess" name="sess" type="text" class="hidden" value="">
					                    					</form>
					                    				</th>
					                    			</tr>
					                    		</thead>
					                    		<tbody id="files_contens">
					                    		</tbody>
					                    	</table>
					                    </ul>
									</li>
									<li class="dropup hidden-sm">
										<button onclick=""  type="button" data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle">
											<i class="icon-eye"></i> <span class="hidden-xs">Youtube</span>
					                    </button>
										
										
										
										<ul id="cartelito"class="dropdown-menu dropdown-menu-left adjuntos dropup-m" role="menu">
					                    	<table class="table" style="margin-bottom: 0px;">
					                    		<thead>
					                    			<th>
													
												<div id="wrapper">
																								
													 <div class="input-group-inline">
													 													
													<input id="texturl" type="text" class="form-control" placeholder="https://www.youtube.com" required>
													<input type="button" class="btn btn-danger btn-sm btn-block" id="sendvideo" onclick="sendvideo();"value="Compartir Video"></input>
													
													</div>
																								
												</div>
			                   				</th>
					                    			
					                    		</thead>
					                    		
					                    	</table>
					                    </ul>
                                     </li>
                                     </li>
									<li class="pull-right" style="padding-right: 6px;">
										<small style="font-size:11px;">
											<span id="xconect" name="xconect">!! </span> 
											
											(<span class="xpin">-5</span>) Lag: <span class="xlag">0.024</span>
										</small>
									</li>
								</ul>
								<div class="col-md-12">
									<div class="row">
										<div class="input-group">		        
									       	<input type="text" id="tx-mess" maxlength="200" placeholder="Escriba su mensaje aqui..." style="border-radius: 0px;" class="form-control">
									       	<span class="input-group-addon btn" onclick="send_message();" role="button">Enviar</span>
									    </div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Login -->
		<div class="modal fade" id="modal-login">
			<div class="modal-dialog login">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title"><i class="icon-login"></i> Iniciar sesi&oacute;n</h4>
					</div>
					<div class="modal-body">
						<form class="form_signin" autocomplete="off" a role="form">
		                    <div style="margin-bottom: 10px" class="input-group">
                            <span class="input-group-addon"><i class="icon-user"></i></span>
                              <input id="log_us" type="text" class="form-control" name="user_nick" value="" placeholder="Usuario" title="Minimum 5 letters or numbers." oninvalid="this.setCustomValidity('Escriba un Nombre de Usuario')" oninput="setCustomValidity('')" required>                                        
                        </div>
                        <div style="margin-bottom: 10px" class="input-group">
                            <span class="input-group-addon"><i class="icon-lock"></i></span>

                            <input id="log_passw" type="password" class="form-control" name="user_passw" placeholder="Password" title="Minmimum 5 letters or numbers." oninvalid="this.setCustomValidity('Escriba su Password')" oninput="setCustomValidity('')" required>
                        </div>               
		                    
		                    <button type="submit" class="btn btn-block btn-red">Iniciar</button>                                        

		                    <!-- error -->
		                    <div class="alert alert-danger hidden" style="margin-top: 10px;margin-bottom: 0px;" role="alert"></div>
		                    <!-- error -->
		                </form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-register">
			<div class="modal-dialog login">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Registrarse</h4>
					</div>
					<div class="modal-body">
						<form class="form_signup" method="post" autocomplete="off" role="form">
								  		<div class="form-group">
								  			<input id="reg_us" name="user_nick" maxlength="16" minlength="3" type="text" class="form-control" placeholder="Nombre de usuario" required="">                    
					                    </div>
					                    <div class="form-group">
								  			<input id="reg_passw" name="user_passw" minlength="6" type="password" class="form-control" placeholder="Ingrese una contrase&ntilde;a" required="">                    
					                    </div>
					                    <div class="form-group">
								  			<input id="reg_passw_reper" name="user_passw_reper" minlength="6" type="password" class="form-control" placeholder="Repita la contrase&ntilde;a ingresada" required="">                    
					                    </div>
					                    <div class="form-group">
								  			<input id="reg_email" name="user_email" minlength="6" type="email" class="form-control" placeholder="Escriba su email" required="required">                    
					                    </div>
					                    <div class="form-group">
					                    	<input type="number" id="reg_age" name="user_age" class="form-control" value="" min="12" max="75" step="1" required="required" placeholder="Edad">
					                    </div>		
					                    <div class="form-group">
								  			<select id="reg_sex" name="user_sexo" class="form-control uneditable-input">
								  				<option value="?" selected="">Seleccione su sexo:</option>
								  				<option value="m">Hombre</option>
								  				<option value="f">Mujer</option>
								  			</select>                    
					                    </div>                                
					                    <p>
				                            <small>
				                            	Al Regístrarte, aceptas nuestros <a data-toggle="modal" href="#terminos_de_uso" role="button">Términos</a>
				                            </small>
				                        
									  	<div class="form-group">
									  		<button type="submit" class="btn btn-block btn-red">Registrarse</button>
									  	</div>		  	
									</form>	
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="uban">
			<div class="modal-dialog medium">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form">				
								<div id="form_uban" class="form-group" style="margin-bottom:0px;">
									<div class="col-md-12">
										<input type="number" id="uban_kill" class="hidden" value="">
										<input type="number" id="uban_user" class="hidden" value="">
										<textarea id="uban_motiv" class="form-control" rows="3" required="required">No moleste a los dem&aacute;s...</textarea>
									</div>	
								</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="button" onclick="$('#form_uban').submit();" class="btn btn-primary"></button>
					</div>
				</div>
			</div>
		</div>
		<!-- modal change avatar -->
		<div class="modal fade" id="modal-change-avatar">
			<div class="modal-dialog medium">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Cambiar avatar</h4>
					</div>
					<div class="modal-body">
						<div style="position: relative;margin-bottom: 15px;">
							<div class="js-upload-avatar">
								<div style="position: relative;top:45%;" class="loader"></div>
							</div>
							<img id="tx-pflth" src="xc_uploads/thumbs/default.png" width="100%">
						</div>
						<form id="form-change-avatar" action="xc_clases/upload.php" enctype="multipart/form-data" method="post">
							<input class="change-avatar-file form-control" type="file" name="avatar" onchange="$('#form-change-avatar').submit();">
							<input id="thumb_sess" name="sess" type="text" class="hidden" value="">
						</form>	
					</div>
				</div>
			</div>
		</div>

		<!-- modal change data -->
		<div class="modal fade" id="modal-change-data">
			<div class="modal-dialog medium">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Modificar perfil</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px;">
						<form class="form-horizontal form_changedata" role="form">
								<div class="form-group">
									<div class="col-sm-12">
										<label for="edad">Edad:</label>
										<input type="number" id="tx-pflage" name="edad" class="form-control" value="" min="12" max="75" step="1" required="required" title="">
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-12">
										<label for="sexo">Sexo:</label>
										<select name="sexo" id="tx-pflsex" class="form-control">
											<option value="m">Hombre</option>
											<option value="f">Mujer</option>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-12">
										<label for="status">Estado:</label>
										<select name="status" id="tx-pflstatu" class="form-control">
											<option value="1">En linea</option>
											<option value="3">Ausente</option>
										</select>
									</div>
								</div>
														<div class="form-group">
									<div class="col-sm-12">
										<label>Correo:</label>
										<input placeholder="Agregue un nuevo correo..." type="email" name="email" id="tx-email" class="form-control">
									</div>
								</div>			
								<div class="form-group">
									<div class="col-sm-12">
										<label>Firma:</label>
										<textarea maxlength="255" id="tx-firma" class="form-control"></textarea>
									</div>
								</div>						
								<div class="form-group">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-block btn-red">Guardar</button>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- modal change preferencias -->
		<div class="modal fade" id="modal-change-prefer">
			<div class="modal-dialog medium">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Preferencias</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px;">
						<form class="form-horizontal form_changepref" role="form">
							<div class="form-group">
								<div class="col-md-12">
									<div class="checkbox">
										<label>
											<input id="prefnopv" type="checkbox" value="" data-plugin="switchery" data-color="#2f3e4f" data-size="small">
											&nbsp;&nbsp;<small><b>No aceptar privados</b></small>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="checkbox">
										<label>
											<input id="prefsound" type="checkbox" value="" data-plugin="switchery" data-color="#2f3e4f" data-size="small">
											&nbsp;&nbsp;<small><b>Sin sonidos</b></small>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-block btn-red">Guardar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<!-- modal admin user -->
		<div class="modal fade" id="adminuser">
			<div class="modal-dialog modal-sm">
			    <div class="modal-content">
				    <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Privilegios de Usuario</h4>
				    </div>
				    <div class="modal-body">
				            <form class="form-horizontal" onsubmit="return false;">
				                <div class="form-group">
					                <div class="row">
				                       	<label class="col-md-4 col-xs-4 control-label" style="padding-top:0px;">Usuario:</label><label class="col-md-8 col-xs-8" id="prof_nick">Usuario:</label>
				                    </div>
				                    <div class="row">
				                        <label class="col-md-4 col-xs-4 control-label">Estrellas</label>
				                        <div class="col-md-4 col-xs-4">
				                            <select id="prof_stars" class="form-control">
				                                <option value="1">1</option>
				                                <option value="2">2</option>
				                                <option value="3">3</option>
				                                <option value="4">4</option>
				                                <option value="5">5</option>
				                            </select>
				                        </div>
				                    </div>
				                    <div class="row">
				                       	<label class="col-md-4 col-xs-4 control-label">Grupo</label>
				                       	<div class="col-md-7 col-xs-7" id="status_xone"></div>
				                    </div>
								</div>
				                <div class="mypriv">
								   <div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="1"> Ver IP
					                        </label>
					                    </div>
					                </div>
					                <div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="2"> Expulsar
					                        </label>
					                    </div>
					                </div>
									<div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="4"> Banear
					                        </label>
					                    </div>
					                </div>
									<div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="8"> Desbanear
					                        </label>
					                    </div>
					                </div>
									<div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="16"> Mutear/Desmutear
					                        </label>
					                    </div>
					                </div>
					                <div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="32"> Adjuntos<!--Compartir ficheros ANTES Comandos-->
					                        </label>
					                    </div>
					                </div>   
   							   <div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="64" disabled> Cambiar Grupos/Estrellas
					                        </label>
					                    </div>
					                </div>
                                                    <div class="row">
					                    <div class="checkbox col-md-offset-2 col-xs-offset-2 col-md-10 col-xs-10">
					                        <label>
					                            <input type="checkbox" priv="128" disabled> Cambiar Privilegios
					                        </label>
					                    </div>
					                </div>
								</div>
				                <input type="hidden" class="field" id="prof_id" />
				            </form> 			      
				    </div>
				    <div class="modal-footer">
				        <label type="button" class="btn btn-default" data-dismiss="modal">Cerrar</label>
				   		<button class="btn btn-primary" onClick="changepriv();">Guardar</button>
				    </div>
				</div>
			</div>
		</div>
		
		<!-- cambiar passw -->
		<div class="modal fade" id="changePass">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Cambiar contrase&ntilde;a</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px;">
						<form id="chgpassw" class="form-horizontal" role="form">
					    	<div class="form-group">    
						      	<label for="changePass1" class="col-sm-3 control-label">Anterior:</label>
						      	<div class="col-sm-9">
						        	<input type="password" minlength="6" class="form-control" name="changePass1" placeholder="Password" required="required" />
						      	</div>
					      	</div>
					      	<div class="form-group">				      
					      		<label for="changePass2" class="col-sm-3 control-label">Nueva:</label>
					      		<div class="col-sm-9">
					      			<input type="password" minlength="6" class="form-control" name="changePass2" placeholder="Password" required="required"/>
					      		</div>
					      	</div>
					      	<div class="form-group">				      
					      		<label for="changePass3" class="col-sm-3 control-label">Repetir:</label>
						      	<div class="col-sm-9">
						        	<input type="password" minlength="6" class="form-control" name="changePass3" placeholder="Password" required="required"/>
						      	</div>	      
					      	</div>	
					      	<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-block btn-red">Guardar</button>
								</div>
							</div>			     
					  	</form>
					</div>
				</div>
			</div>
		</div>

		<!-- desbanear -->
<div class="modal fade" id="uban_users">
			<div class="modal-dialog large">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Desbanear usuarios</h4>
					</div>
					<div class="modal-body">
<center style="background-color: red;color: white;font-family: bold;">No desbanear usuarios de otros operadores. Las operaciones quedaran registradas en el log de la administracion.</center>
						<table id="datatable" class="table table-bordered">
                            <thead>
								<th>Desbanear</th>
                                <th>Usuario</th>
                                <th>Ip</th>
                                <th>Operador</th>
                                <th>Motivo</th>
                                <th>Fecha</th>
							</thead>
							<tbody id="users_ban">
								
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
				   		<button class="btn btn-uban btn-primary" onClick="uban_users();">Desbanear</button>
				    </div>
				</div>
			</div>
		</div>
		
<div class="modal fade" id="transf">

					<div class="modal-dialog modal-sm">

					<div class="modal-content">

					<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">Transferir mensajes</h4>
					</div>

					<div class="modal-body text-center" style="max-height: 450px;overflow: auto;">

					<form id="transferir_msg" class="form-horizontal" role="form"> 

                     <div class="form-group"> 
                     <label for="transf_us" style="text-align: left;" class="col-xs-12 control-label">Usuarios conectados:
                     </label> 

					<div class="col-sm-12"> 
                  <select class="form-control uneditable-input" id="transf_us" name="transf_us" placeholder="Seleccionar usuario">
                  </select> 
                 </div> 
                 </div> 

<div class="form-group"> 
        <label for="transf_msg" class="col-sm-3 control-label">Mensajes:</label> 
          <div class="col-sm-12"> 
             <input type="number" class="form-control" id="transf_msg" name="transf_msg" placeholder="Definir cantidad" min="100" max="100000" required="required"/> 
  </div> 
</div> 

<div class="alert alert-info" style="font-size:11px;padding:10px;padding-left:5px;padding-right:5px;">Cada transferencia le resta <b>1000</b> mensajes
</div> 

<div class="form-group">
  <div class="col-sm-12"><button type="submit" id="submit_transf" class="btn btn-block btn-red">Transferir</button>
               </div>
             </div> 
           </form>
         </div>
      </div>
    </div>
</div>

		<!-- Reglamento -->
<div class="modal fade" id="terminos_de_uso">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Terminos de Uso</h4>
					</div>
					<div class="modal-body text-center" style="max-height: 450px;overflow: auto;">
						<p>
							<small>
								Estos Terminos de uso estan basado y estructurado para lograr la satisfaccion plena de cada usuario que se registre en el Sitio. Sirve de orientacion para cada uno de los miembros de este sitio web, donde los mismos tendran a su disposicion todos los parametros a seguir y cumplir con el fin de avanzar en estados mientras esten inscritos. Lo que se expone a continuacion es de estricto cumplimiento tanto por los usuarios como por el equipo de administracion del sitio; por lo tanto ningun usuario podra violar lo establecido en los Terminos de Uso.
							</small>
						</p>

						<h3>Acerca del Sitio:</h3>
							<small>
								<p>
									1- El desconocimiento del contenido de los Terminos de Uso por parte del usuario que se registre, en el Sitio, no exime a este de cumplirlo y acatar la totalidad de sus disposiciones.
								</p>

								<p>
									2- Las reglas que a continuacion se enumeran acerca de los Usuarios, rigen en todo el sitio, cada Sitio en la red podra poseer sus propias normas especificas, las cuales no estamos en desacuerdo con ninguna, pero en este caso, se agrega este nuestros Terminos de Uso, por el cual usted se debe regir mientras este compartiendo en nuestro sitio.
								</p>

								<p>
									3- El objetivo de este chat es propiciar un espacio para el debate de diversos temas de conversacion y darles la oportunidad de conocer y ampliar su marco de amistades online.
								</p>

								<p>
									4- Al registrarse se le recomienda no usar como password el mismo nombre de usuario, preferentemente elegir un password complejo, dificil de adivinar por otro usuario para evitar la perdida de la cuenta de usuario.
								</p>
							</small>
						

						<h3>Acerca de los Usuarios:</h3>
							
							<small>
								<p>
									Los usuarios registrados en el sitio, estan obligados a aceptar las siguientes condiciones de no serlo asi no se registre:
								</p>

								<p>
									1- Una vez registrados en el sitio, su cuenta es personal e intransferible, y es el propietario de la misma, el maximo responsable del uso que se le de a ella.
								</p>

								<p>
									2- No utilizar nombres de usuario vulgares, excluyentes, que infieran de forma directa o no su preferencia sexual, propagandisticos, politico, que puedan prestarse para su interpretacion explicita o con un doble sentido (en ambos casos el usuario sera expulsado del sitio) y la cuenta sera suspendida por parte del equipo de Operadores.
								</p>

								<p>
									3- Esta prohibido cualquier tipo de insulto o amenaza tanto directa como indirecta a cualquier miembro del sitio, acosar, violentar, amenazar o causar molestias a cualquier otro participante, esto sera motivo de expulsion inmediata por cualquier Operador presente en dicho momento.
								</p>

								<p>
									4- Queda terminantemente prohibido hablar de politica tanto en la sala como en los privados ya que este es un sitio para conocer amigos, de serlo asi se tomaran las medidas establecidas por el Staff y se puede llegar hasta hacer una queja a sus proveedores de servicios.
								</p>

								<p>
									5- Esta prohibida la Publicidad de otros sitios en la Sala Publica.
								</p>

								<p>
									6- Los Operadores tienen el permiso para llamar la atencion tanto publicamente como en privado a un usuario siempre y cuando ellos lo vean conveniente debido a el incumplimiento de uno de estos parametros.
								</p>

								<p>
									7- Si un Administrador tiene seleccionada la opcion (Ocupado) no debe ser molestado. Ni en sala ni en privado, cualquier duda o sugerencia pueden contactar con el grupo de Operadores que estan para aconsejar, ayudar y orientar a cada miembro del chat.
								</p>

								<p>
									8- Cualquier duda, sugerencia acerca del chat pueden contar con los Operadores si ellos no pueden solucionar el problema son los encargados de comunicarselo a los Administradores.
								</p>
							</small>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Estatus y Privilegios -->
		<div class="modal fade" id="estatus_privis">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Estatus y Privilegios</h4>
					</div>
					<div class="modal-body text-center" style="max-height: 450px;overflow: auto;">
						<h3>Requisitos para cambiar su estatus</h3>
							
							<small>
								<p>
								<strong>Nivel 1 :</strong> Tener una foto de perfil correcta y 1000 
								</p>
								<p>
								<strong>Nivel 2 :</strong> Tener una foto de perfil correcta y 10 000 mensajes.
								</p>
								<p>
								<strong>Estella :</strong> Tener una foto de perfil correcta y 30 000 mensajes.
								</p>
								<p>
								<strong>Prince :</strong> Tener una foto de perfil correcta y 40 000 mensajes.
								</p>
                                <p>
								<strong>Princess :</strong> Tener una foto de perfil correcta y 40 000 mensajes.
								</p>
                                <p>
								<strong>Destacado :</strong> Tener una foto de perfil correcta y 50 000 mensajes.
								</p>
								<p>
								<strong>Chico VIP :</strong> Tener una foto de perfil correcta y 70 000 mensajes.
								</p>
								<p>
								<strong>Chica VIP :</strong> Tener una foto de perfil correcta y 70 000 mensajes.
								</p>
								
								<p>
								<strong>Reina :</strong> Tener una foto de perfil correcta y 100 000 mensajes.
								</p>
							</small>
							
							<h3>Requisitos para tener privilegios</h3>
							
							<small>
								<p>
								Los privilegios en el chat seran dados por los administradores, autorizados por los Webmasters, solo a quienes ellos lo decidan. Los puestos de Ayudantes y Operadores estan reservados para personas responsables escogidas por el staff administrativo.
								</p>
								<p><strong>
								En algunos casos, se podran otorgar estatus y privilegios a personas que tengan caracteristicas especiales previamente consultado y aprobado por el staff del sitio. 
								</strong></p>
							</small>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-change-topic">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Cambiar Topic</h4>
					</div>
					<div class="modal-body">
						<textarea id="topic" class="form-control" rows="3" required="required"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="button" onclick="savetopic(0);" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		

		<div id="sound"></div>
		<a id="view_avatar" class="zoom" style="display: none;" href=""></a>
	</body>	
	<script>
		console.log("%c%s","color:red;background:yellow;font-size:30px;","ADVERTENCIA");
		console.log("%c%s","color:black;font-size:18px;","-Esta funcion del navegador esta pensada para desarrolladores. Si alguien te indico que copiaras y pegaras algo aqui para habilitar una funcion del chat o para hackear la cuenta de alguien, se trata de un fraude. Si lo haces, esta persona podra acceder a tu cuenta.");
	</script>	
	<script type="text/javascript" src="xc_static/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="xc_static/js/jquery.min.js"></script>
	<script type="text/javascript" src="xc_static/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="xc_static/js/scroll.min.js"></script>
	<script type="text/javascript" src="xc_static/js/jquery.form.js"></script>
	<script type="text/javascript" src="xc_static/js/pace.min.js"></script>
	<script type="text/javascript" src="xc_static/js/switchery.min.js"></script>
	<script type="text/javascript" src="xc_static/js/jquery.cookie.js"></script>	
	<script type="text/javascript" src="xc_static/js/fancybox.min.js"></script>
	<script type="text/javascript" src="xc_static/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="xc_static/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("a.zoom").fancybox({
				padding: 3,
			});
		});
	</script>
	
	<script type="text/javascript" src="xc_static/js/confirm.min.js"></script>
	<script type="text/javascript" src="xc_static/js/favico.min.js"></script>
	<script type="text/javascript" src="xc_static/js/chart.js"></script>
	<script type="text/javascript" src="xc_static/js/bootstrap-progressbar.min.js"></script>
    <script type="text/javascript" src="xc_static/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="xc_static/js/notifIt.js"></script>
  <!--  <script type="text/javascript" src="xc_static/js/jquery.snow.js"></script> -->
	<script type="text/javascript" src="xc_static/js/cookieconsent.min.js"></script>


<!-- <script> copos de nieve 
$(document).ready( function(){ $.fn.snow({ minSize: 10,flakeColor: '#5b8aee' });
});
</script> -->
	
	
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#252e39"
    },
    "button": {
      "background": "#14a7d0"
    }
  },
  "showLink": false,
  "theme": "classic",
  "position": "bottom-right",
  "content": {
    "message": "Nuestras cookies son personalizadas y las guardamos en su navegador para mejorar el contenido y lograr que usted consiga una mejor experiencia.",
    "dismiss": "Aceptar"
  }
})});

</script> 

	<script type="text/javascript" src="xc_static/js/app.js"></script>
	
	
	
	
	
</html>