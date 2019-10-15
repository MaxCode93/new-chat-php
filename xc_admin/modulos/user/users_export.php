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

?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Usuarios</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Exportar Datos de Usuarios</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /row -->
    <div class="row">

        <!-- /.row -->
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Exportar Datos</h3>
                <p class="text-muted m-b-30">Opciones Copia, CSV, Excel, PDF e Imprimir</p>
                <div class="table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Foto</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM users order by id ASC";
                        $result = $mysqli->query($query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $username = $row['user_nick'];
                            $picname = $row['user_thumb'];
                            $status = $row['user_group'];

                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><img src="../xc_uploads/thumbs/0/<?php echo $picname; ?>" alt="<?php echo $username ?>" class="img-circle bg-theme" width="40"></td>
                                <td><?php echo $username ?></td>
                                <td><?php echo $row['user_email'] ?></td>
                                <td><?php echo $status ?></td>
                                <td><?php echo $row['user_register']; ?></td>
                            </tr>
                        <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->


<?php include("../../footer.php"); ?>