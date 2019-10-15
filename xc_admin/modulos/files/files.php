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
$query_z = "Update admins set zona='Viendo los Ficheros Adjuntos' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Archivos Adjuntos</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="escritorio">Escritorio</a></li>
                    <li class="active">Archivos Adjuntos</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="files_delete" method="post" name="f1" id="f1">
                        <div>
                            <div class="pull-left"><h3 class="box-title">Lista de Archivos Adjuntos</h3></div>
                            <div class="pull-right">
                                <p class="text-muted">
                                    <button type="submit" name="submit" class="btn btn-danger waves-effect waves-light m-r-10"><i class="fa fa-trash-o"></i> Eliminar Seleccionados</button>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <hr>

                    <div class="table-responsive">

                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th class="sortingNone"><input type="checkbox" name="selall" value="checkbox" onClick="checkBox(this)" style="display: block"></th>
                                <th class="sortingNone">Fichero</th>
                                <th>Propietario</th>
                                <th class="sortingNone">Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                           $query = "SELECT * FROM files ORDER BY user ASC";
                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
								$filename = $row['file'];
                        						
                           $query1 = "SELECT user_thumb FROM users WHERE user_nick='" .$row['user']. "' LIMIT 1";
                                $query_result1 = mysqli_query ($mysqli, $query1);
                                while ($info1 = mysqli_fetch_array($query_result1))
                                {
                           $foto = $info1[user_thumb];
								}
                           $query2 = "SELECT id FROM users WHERE user_nick='" .$row['user']. "' LIMIT 1";
                                $query_result2 = mysqli_query ($mysqli, $query2);
                                while ($info2 = mysqli_fetch_array($query_result2))
                                {
						    $id_us = $info2['id'];
                                }
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="titles[]" id="titles[]" value="<?php echo $filename;?>">
                                        <input type="checkbox" name="list[]" id="list[]" value="<?php echo $id;?>" style="display: block">
                                    </td>
                                    <td><img src="../xc_uploads/files/<?php echo $id_us;?>/<?php echo $row['file'];?>.tmp" alt="<?php echo $row['user'] ?>" class="img-circle bg-theme" width="40"> <?php echo $row['file'] ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $foto ?>" alt="<?php echo $row['user'] ?>" class="img-circle bg-theme" width="40"> <?php echo $row['user'] ?></td>                         
                                    <td class="text-nowrap">
                                        <!-- <a href="files_delete?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Eliminar <?php echo $filename ?>"> <i class="fa fa-trash-o btn btn-danger waves-effect waves-light m-r-10"></i> </a> -->
                                     <a href="#" data-toggle="tooltip" data-original-title="Eliminar <?php echo $filename ?>"> <i class="fa fa-trash-o btn btn-danger waves-effect waves-light m-r-10"></i> </a>

                                    </td>
                                </tr>
                            <?php }?>

                            </tbody>
                        </table>

                    </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->


<?php include("../../footer.php"); ?>