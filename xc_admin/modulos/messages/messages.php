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

$query_z = "Update admins set zona='Viendo los Mensajes del Chat', fecha='".$date_time."' WHERE user_nick = '".$_SESSION['admin']['username']."' LIMIT 1";
$query_result_z = $mysqli->query($query_z);

$total_mess = mysqli_num_rows(mysqli_query($mysqli,"select 1 from mess"));
if($total_mess >= 10000){
$query_mess = "DELETE FROM mess limit 1000";
$query_result_mess = $mysqli->query($query_mess);    
}

?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mensajes</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Mensajes</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <form action="message_delete" method="post" name="f1" id="f1">
                    <div>
                        <div class="pull-left"><h3 class="box-title">Todos los Mensajes</h3>(Los mensajes mas viejos seran eliminados automaticamente max. 9999)</div>
                        
                        <div class="pull-right">
                            <p class="text-muted">
                                <?php
                                	if(isset($_SESSION['admin']['username'])==_Maxwell_ or isset($_SESSION['admin']['username'])==admin){
													if($_SESSION['admin']['username']==_Maxwell_ or $_SESSION['admin']['username']==admin){
													?>
                                <button type="submit" name="submit" class="btn btn-danger waves-effect waves-light m-r-10"><i class="fa fa-trash-o"></i> Eliminar Seleccionados</button>
                                <a href="message_delete_all" data-toggle="tooltip" data-original-title="Eliminar Todos" class="btn btn-danger waves-effect waves-light m-r-10"> <i class="fa fa-trash-o"> Eliminar Todos</i></a>
                                <?php }} ?>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <hr>

                    <div class="table-responsive">

                        <table id="message" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="sortingNone"><input type="checkbox" name="selall" value="checkbox" onClick="checkBox(this)" style="display: block"></th>
                                    <th class="sortingNone">#ID</th>
                                    <th>De</th>
                                    <th>Para</th>
                                    <th>Mensaje</th>
                                    <th>Fecha</th>
                                    <th class="sortingNone">Accion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="sortingNone">Nada</th>
                                    <th class="sortingNone">#ID</th>
                                    <th>De</th>
                                    <th>Para</th>
                                    <th>Mensaje</th>
                                    <th>Fecha</th>
                                    <th class="sortingNone">Accion</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if(isset($_GET['de']) && isset($_GET['para']) ){
                                $query = "SELECT * FROM mess where ((de = '".mysqli_real_escape_string($mysqli, $_GET['de'])."' AND para = '".mysqli_real_escape_string($mysqli,$_GET['para'])."' ) OR (de = '".mysqli_real_escape_string($mysqli,$_GET['de'])."' AND para = '".mysqli_real_escape_string($mysqli,$_GET['para'])."' )) ORDER BY id DESC";
                            }
                            else{
                                $query = "SELECT * FROM mess ORDER BY fecha DESC";
                            }

                            $result = $mysqli->query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $fromuname = $row['de'];
                                $touname = $row['para'];

                                $msgdate = $row['fecha'];
                                $msgcontent = $row['mess'];


                            $query1 = "SELECT user_thumb FROM users WHERE user_nick='" .$row['de']. "' LIMIT 1";
                                $query_result1 = $mysqli->query($query1);
                                while ($info1 = mysqli_fetch_assoc($query_result1))
                                {
                            $foto = $info1['user_thumb'];
                                  }
                                
                            $query2 = "SELECT user_thumb FROM users WHERE user_nick='" .$row['para']. "' LIMIT 1";
                                $query_result2 = $mysqli->query($query2);
                                while ($info2 = mysqli_fetch_assoc($query_result2))
                                {
                            $foto2 = $info2['user_thumb'];
                                  }   

                                ?>
                                <tr>

                                    <td>
                                        <input type="hidden" name="titles[]" id="titles[]" value="<?php echo $id;?>">
                                        <input type="checkbox" name="list[]" id="list[]" value="<?php echo $id;?>" style="display: block">
                                    </td>
                                    <td><?php echo $id ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $foto ?>" alt="<?php echo $row['de'] ?>" class="img-circle bg-theme" width="30"> <?php echo $row['de'] ?></td>
                                    <td><img src="../xc_uploads/thumbs/0/<?php echo $foto2 ?>" alt="<?php echo $row['para'] ?>" class="img-circle bg-theme" width="30"> <?php echo $row['para'] ?></td>
                                    <td width="20%" style="max-width: 100px;word-break: break-all;"><?php echo $msgcontent ?></td>
                                    <td><span class="label label-megna label-rounded"><?php echo $row['fecha'] ?></span></td>
                                    <td class="text-nowrap">
                                        <a href="messages?de=<?php echo $row['de'] ?>&para=<?php echo $row['para'] ?>" data-toggle="tooltip" data-original-title="Buscar conversaciones de <?php echo $row['de'] ?> y <?php echo $row['para'] ?>"> <i class="ti-eye btn btn-success waves-effect waves-light m-r-10"></i></a>
                                        <?php
                                	if(isset($_SESSION['admin']['username'])==_Maxwell_ or isset($_SESSION['admin']['username'])==admin){
													if($_SESSION['admin']['username']==_Maxwell_ or $_SESSION['admin']['username']==admin){
													?>
                                        <a href="message_delete?id=<?php echo $id;?>" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-trash-o btn btn-danger waves-effect waves-light m-r-10"></i> </a>
                                        <?php }} ?>
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