<?php
session_start();
$_SESSION['zona']['home'] = null;

include('../../header.php');
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
        $count = 0;
        $sql = "DELETE FROM mess ";

        foreach ($_POST['list'] as $value)
        {
            if($count == 0)
            {
                $sql.= "WHERE id = '" . $value . "'";
            }
            else
            {
                $sql.= " OR id = '" . $value . "'";
            }

            $count++;
        }
        $sql.= " LIMIT " . count($_POST['list']);

        mysqli_query($mysqli,$sql);

        transfer($config,'messages.php','Message Deleted');
        exit;
    }

}

if(isset($_GET['id']))
{
    $_POST['list'][] = $_GET['id'];
}
?>

    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Eliminar Mensajes</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="escritorio">Escritorio</a></li>
                <li class="active">Eliminar Mensajes</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <form action="" method="post" name="f1" id="f1">
                    <h3 class="box-title">Eliminar Mensajes</h3>
                    <hr>
                    <div class="panel-body" style="width:70%; margin-left:15%">
                        <div class="hr-line-dashed"></div>
                        <ul>
                            <?php
                            $count = 0;
                            $sql = "SELECT id FROM mess ";

                            foreach ($_POST['list'] as $value)
                            {
                                if($count == 0)
                                {
                                    $sql.= "WHERE id='" . $value . "'";
                                }
                                else
                                {
                                    $sql.= " OR id='" . $value . "'";
                                }

                                $count++;
                            }
                            $sql.= " LIMIT " . count($_POST['list']);

                            $query_result = mysqli_query($mysqli,$sql);
                            while ($info = @mysqli_fetch_array($query_result))
                            {

                                echo "<li><h3 style=\"color:#FF0000\"> ID : " . $info['id'] . "<h3></li>";
                                echo "<input type=\"hidden\" name=\"list[]\" id=\"list[]\" value=\"" . $info['id'] . "\">";

                            }
                            ?>
                        </ul>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group" align="center">
                            <div class="col-sm-8 col-sm-offset-2">
                                <a href="messages" class="btn btn-default">Cancelar</a>
                                <input name="Submit" type="submit" class="btn btn-danger" value="Si, Elimiarlo(s)">

                            </div>
                        </div>
                        <?php

                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('../../footer.php'); ?>