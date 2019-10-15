<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

function db_connect($config)
{
    // Create connection in MYsqli
        $con = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
    // Check connection in MYsqli
    if (mysqli_connect_errno()) {
        printf("Error conectando: %s\n", mysqli_connect_error());
        exit();
    }

    return $con;
}

function check_allow()
{
    return TRUE;
}

function checkloggedadmin()
{
    if(isset($_SESSION['admin']['id']))
    {
        return TRUE;
    }
    else
    {
        echo '<script>window.location="login"</script>';
    }
}

function getUserIP() {
if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
$ip = getenv("HTTP_CLIENT_IP");
else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
$ip = getenv("REMOTE_ADDR");
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
$ip = $_SERVER['REMOTE_ADDR'];
else
$ip = "IP desconocida";
return($ip);
}


function transfer($config,$url,$msg,$page_title='')
{
    ob_start();
    echo "<html>\n";
    echo "<head>\n";
    echo "<title>\n";
    echo $page_title;
    echo "</title>\n";
    echo "<STYLE>\n";
    echo "<!--\n";
    echo "TABLE, TR, TD                { font-family:Verdana, Tahoma, Arial;font-size: 7.5pt; color:#000000}\n";
    echo "a:link, a:visited, a:active  { text-decoration:underline; color:#000000 }\n";
    echo "a:hover                      { color:#465584 }\n";
    echo "#alt1   { font-size: 16px; }\n";
    echo "body {\n";
    echo "	background-color: #e8ebf1\n";
    echo "	z-index: 99999\n";
    echo "}\n";
    echo "-->\n";
    echo "</STYLE>\n";
    echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
    echo "function changeurl(){\n";
    echo "window.location='" . $url . "';\n";
    echo "}\n";
    echo "</script>\n";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>\n";
    echo "<body onload=\"window.setTimeout('changeurl();',2000);\">\n";
    echo "<table width='95%' height='85%'>\n";
    echo "<tr>\n";
    echo "<td valign='middle'>\n";
    echo "<table align='center' border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#fff\">\n";
    echo "<tr>\n";
    echo "<td id='mainbg'>";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"12\">\n";
    echo "<tr>\n";
    echo "<td width=\"100%\" align=\"center\" id=alt1>\n";
    echo $msg . "<br><br>\n";
    echo "<div><img src=\"images/loading.gif\"/></div><br><br>\n";
    echo "(<a href='" . $url . "'>O click aqui si no desea esperar</a>)</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</body></html>\n";
    ob_end_flush();
}



?>