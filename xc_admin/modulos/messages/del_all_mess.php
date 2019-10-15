<?php
session_start();
$_SESSION['zona']['home'] = null;

include("../../header.php");
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
        $sql = "TRUNCATE mess";

        mysqli_query($mysqli,$sql);

        transfer($config,'messages','Message Deleted');
        exit;
    }

