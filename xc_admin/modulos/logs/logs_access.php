<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");

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

$query_z = "Update admins set zona='Viendo los Logs de los Accesos', fecha='".$date_time."' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Logs de la Administracion</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Logs de la Administracion</li>
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
					
<p>
    <i class="fa fa-file icon-title"></i> Errores de Acceso
  </p>
<div class="box-body">
<textarea name="enteruser" style="width:700px;height:250px" type="text" id="enteruser"><?=$enteruser=(@file_get_contents('../../../xc_error/accesfail.txt'));?> </textarea>
<?php
if($_SESSION['admin']['username']== admin){ ?>
<a style="position: relative; top: -65px;" data-toggle="tooltip" data-placement="top" title="Vaciar" class="btn btn-danger btn-sm" href="clear_afail" onclick="return confirm('¿Está seguro de que desea vaciar los registros?');">
<i style="color:#fff" class="glyphicon glyphicon-trash"></i>
</a>
<?php
}else{
?>
<a style="position: relative; top: -65px;" data-toggle="tooltip" data-placement="top" title="Solo Root" class="btn btn-danger btn-sm"  disabled>
<i style="color:#fff" class="glyphicon glyphicon-trash"></i>
</a>
<?php
}
?>
</div>
			<p>
    <i class="fa fa-file icon-title"></i> Errores de PHP
  </p>
<div class="box-body">
<textarea name="stt" style="width:700px;height:250px" type="text" id="stt" disabled><?=$stt=(@file_get_contents('../../../xc_error/php-error.log'));?> </textarea>
<?php
if($_SESSION['admin']['username']== admin){ ?>
<a style="position: relative; top: -65px;" data-toggle="tooltip" data-placement="top" title="Vaciar" class="btn btn-danger btn-sm" href="clear_error" onclick="return confirm('¿Está seguro de que desea vaciar los registros ?');">
<i style="color:#fff" class="glyphicon glyphicon-trash"></i>
</a>
<?php
}else{
?>
<a style="position: relative; top: -65px;" data-toggle="tooltip" data-placement="top" title="Solo Root" class="btn btn-danger btn-sm"  disabled>
<i style="color:#fff" class="glyphicon glyphicon-trash"></i>
</a>
<?php
}
?>
</div>		
					
 </form>
            </div>
        </div>

    </div>
    <!-- /.row -->


<?php include("../../footer.php"); ?>