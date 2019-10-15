<?php
session_start();
$_SESSION['zona']['home'] = "about";

include("header.php");

if(isset($_GET['page']))
{
    $pageno = $_GET['page'];
}
else
{
    $page = 1;
}

if(!isset($_GET['sortby']))
{
    $_GET['sortby']='id';
}
if(!isset($_GET['direction']))
{
    $_GET['direction']='DESC';
}

$query_z = "Update admins set zona='Acerca del Sitio' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);
?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Acerca de</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="index.php">Escritorio</a></li>
                <li class="active">Acerca de</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <form action="" method="post" name="f1" id="f1">
                    <div>

		   	 <h1>
      <i class="fa fa-smile-o"></i> Acerca del Sitio
    </h1>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <h1 style="text-align: center;">XenCuba v3.1</h1>
					
                    <h3>Panel de Administracion</h3>
                      <h4>XenCuba Admin(v4.1)</h4>
<p>1. Agregado nuevo estilo visual.(Tema Evolution v3.0) <br>
2. Agregadas las opciones de los estilos visuales.<br>
3. Agregadas las opciones de cambio de interfaz, asi como opciones de cambio de colores en los paneles y barras.<br>
4. Agregado el modulo de actualizacion del sitio.<br>
</p>                  
					<h4>XenCuba Admin(v3.0)</h4>
<p>1. Arreglos en el estilo visual.(Tema Evolution v2.0) <br>
2. Agregado el plugins datatables.<br>
3. Corregido error en la pagina de Mensajes(root)(bloqueba el navegador por la cantidad de registros que mostraba , agregada la paginacion).<br>
4. Optimizada la pagina principal.<br>
5. Agregados los logs de registros para la Administracion(root).</p>

                    <h4>XenCuba Admin(v2.0)</h4>
<p>1. Agregado nuevo estilo visual.(Tema Evolution v1.0) <br>
2. Agregados iconos a la acciones.<br>
3. Agregadas las paginas de contenidos(ajustes, usuarios, anuncios, mensajes, archivos, y los logs del chat) asi como sus respectivas acciones(crear, modificar y eliminar).
</p>

                </div>
            </div>
                        <div class="clear"></div>
                    </div>
                    <hr>


                </form>
            </div>
        </div>

    </div>
    <!-- /.row -->
<?php include("footer.php"); ?>