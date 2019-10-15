<?php  
namespace Server; 
use App; 
spl_autoload_register(function ($nombre_clase) { $nombre_clase = str_replace('\\', '/', $nombre_clase); 
include $nombre_clase . '.php'; }); 
ini_set("log_errors", 1); 
ini_set("error_log", "../xc_error/php-error.log"); 
error_reporting(1); 
$ret=array(); 
include "../xc_include/config.php"; 
$data=$_POST['data']; $prts=explode("%0D%0A",$data); 
$chat=new chat; 
if (!isset($ret['errors'])) 
	foreach($prts as $pt)
	{ if ($pt!=''){ parse_str($pt,$POST); 
foreach($POST as $k=>$v){ $POST[$k]=addslashes($v); } 
extract($POST);
 if (method_exists($chat,$act)){ $chat->$act(); } } } 
 $svr=$_POST['svr']; 
 $myself=(isset($_SESSION['user_data']))?$_SESSION['user_data']['id']:0; 
 $counter = (isset($_SESSION['counter']))?$_SESSION['counter']:0; 
 if ($svr>0){ 
 if ($counter==15) $db->query("DELETE FROM cmds WHERE mtime<".($now-600)); 
 if ($counter==6 || $counter==12) $db->query("UPDATE users SET user_last=$now WHERE id=".$myself); 

 if ($counter==15) 
 
 { $qry=$db->query("SELECT * FROM users WHERE user_online='1' AND user_last <".($now-600));
 
 while($row=$qry->fetch_array(MYSQLI_ASSOC))
 { extract($row); 
 $db->query("UPDATE users SET user_online='0', user_status='2' WHERE id=".$id); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"bye|$id|0")); 
 }
 } 
  $lastsvr=$svr; $exe=$db->query("SELECT * FROM cmds WHERE (id>$svr AND mfrom<>$myself AND (mdest=0 OR mdest=$myself)) ORDER BY id ASC"); 
 if ($exe->num_rows>0) { while($row=$exe->fetch_array(MYSQLI_ASSOC)) { extract($row); $ret[$type][]=$cmd; $lastsvr=$id; } } 
 if ($lastsvr!=$svr){ $ret['svr']=$lastsvr; } $counter++; 
 if ($counter==16) $counter=0; $_SESSION['counter']=$counter; } echo json_encode($ret); 
 class chat { 
 function start(){ global $db,$ret,$now; $rating = array(); $qry = $db->query("SELECT * FROM users ORDER BY user_mess DESC LIMIT 0,5");
while($row=$qry->fetch_array(MYSQLI_ASSOC)){ array_push($rating,getdata($row,array('user_nick','user_thumb','user_mess'))); } 
$ret['act']['stats']['rating'] = $rating; $staff = array(); 
$qry = $db->query("SELECT * FROM users WHERE user_priv>=62 AND user_online='1' ORDER BY user_priv DESC"); 
while($row=$qry->fetch_array(MYSQLI_ASSOC)){ array_push($staff,getdata($row,array('user_nick','user_thumb'))); } 
$ret['act']['stats']['staff'] = $staff; 
$onlines = $db->query("SELECT * FROM users WHERE user_online='1'"); 
$ret['act']['stats']['online'] = $onlines->num_rows; 
$stats = $db->query("SELECT * FROM visitas ORDER BY id DESC limit 0,7"); 
$visitas=array(); 
$max=array(); 
$c=0; $ds=array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'); 
while($stat=$stats->fetch_array(MYSQLI_ASSOC)) 
{ if ($c==0) $visitas['Hoy'] = $stat['visitas']; 
elseif ($c==1) $visitas['Ayer'] = $stat['visitas']; 
else $visitas[$ds[date('w',$now-$c*60*60*24)]." ".date('d',$now-$c*60*60*24)] = $stat['visitas']; 
$max[]=$stat['max']; $c++; } $ret['act']['stats']['visitas'] = array_reverse($visitas); 
$ret['act']['stats']['max'] = array_reverse($max); 
$users = $db->query("SELECT * FROM users"); 
$ret['act']['stats']['total'] = $users->num_rows; 
$masculino = $db->query("SELECT * FROM users WHERE user_sexo='m'"); 
$ret['act']['stats']['masculino'] = $masculino->num_rows; 
$ret['exe'][] = "start_complete"; } 
function login()
{ console.log("login"); 
global $db,$ret,$POST,$now; 
extract($POST); 
include "../xc_include/database.php"; 
$browsers = array('OPR'			=> 'Opera', 'Flock'			=> 'Flock', 'Edge'			=> 'Spartan', 'Chrome'		=> 'Google Chrome', 'Opera.*?Version'	=> 'Opera', 'Opera'			=> 'Opera', 'MSIE'			=> 'Internet Explorer', 'Internet Explorer'	=> 'Internet Explorer', 'Trident.* rv'	=> 'Internet Explorer', 'Shiira'		=> 'Shiira', 'Firefox'		=> 'Firefox', 'Chimera'		=> 'Chimera', 'Phoenix'		=> 'Phoenix', 'Firebird'		=> 'Firebird', 'Camino'		=> 'Camino', 'Netscape'		=> 'Netscape', 'OmniWeb'		=> 'OmniWeb', 'Safari'		=> 'Safari', 'Mozilla'		=> 'Mozilla', 'Konqueror'		=> 'Konqueror', 'icab'			=> 'iCab', 'Lynx'			=> 'Lynx', 'Links'			=> 'Links', 'hotjava'		=> 'HotJava', 'amaya'			=> 'Amaya', 'IBrowse'		=> 'IBrowse', 'Maxthon'		=> 'Maxthon', 'Ubuntu'		=> 'Ubuntu Web Browser'); $platforms = array('windows nt 10.0'	=> 'Windows 10', 'windows nt 6.3'	=> 'Windows 8.1', 'windows nt 6.2'	=> 'Windows 8', 'windows nt 6.1'	=> 'Windows 7', 'windows nt 6.0'	=> 'Windows Vista', 'windows nt 5.2'	=> 'Windows 2003', 'windows nt 5.1'	=> 'Windows XP', 'windows nt 5.0'	=> 'Windows 2000', 'windows nt 4.0'	=> 'Windows NT 4.0', 'winnt4.0'			=> 'Windows NT 4.0', 'winnt 4.0'			=> 'Windows NT', 'winnt'				=> 'Windows NT', 'windows 98'		=> 'Windows 98', 'win98'				=> 'Windows 98', 'windows 95'		=> 'Windows 95', 'win95'				=> 'Windows 95', 'windows phone'			=> 'Windows Phone', 'windows'			=> 'Unknown Windows OS', 'android'			=> 'Android', 'blackberry'		=> 'BlackBerry', 'iphone'			=> 'iOS', 'ipad'				=> 'iOS', 'ipod'				=> 'iOS', 'os x'				=> 'Mac OS X', 'ppc mac'			=> 'Power PC Mac', 'freebsd'			=> 'FreeBSD', 'ppc'				=> 'Macintosh', 'linux'				=> 'Linux', 'debian'			=> 'Debian', 'sunos'				=> 'Sun Solaris', 'beos'				=> 'BeOS', 'apachebench'		=> 'ApacheBench', 'aix'				=> 'AIX', 'irix'				=> 'Irix', 'osf'				=> 'DEC OSF', 'hp-ux'				=> 'HP-UX', 'netbsd'			=> 'NetBSD', 'bsdi'				=> 'BSDi', 'openbsd'			=> 'OpenBSD', 'gnu'				=> 'GNU/Linux', 'unix'				=> 'Unknown Unix OS', 'symbian' 			=> 'Symbian OS'); $browser = null; $platform = null; if (isset($_SERVER['HTTP_USER_AGENT'])) {$agent = trim($_SERVER['HTTP_USER_AGENT']); foreach ($browsers as $key => $val) {if (preg_match('|'.$key.'.*?([0-9\.]+)|i', $agent, $match)) {$browser = $val; break; } } foreach ($platforms as $key => $val) {if (preg_match('|'.preg_quote($key).'|i', $agent)) {$platform = $val; break; } } } 
$ret['debug'] = $platform; 

$sql2 = mysqli_query($mysqli, "select * from config");
while ($r2=mysqli_fetch_assoc($sql2)) {$reg_m=$r2["reg_mail"];
break;}
if($reg_m==1 ){ 
$sql1 = mysqli_query($mysqli, "select * from users where user_nick='$user_nick'");
while ($r=mysqli_fetch_assoc($sql1)) {$estatus=$r["estatus"];
break;}
if($estatus==0 ){return $ret['exe'][]="log_error|3"; }
}
$exist=$db->query("SELECT * FROM users WHERE user_nick='".$user_nick."'"); 
 if ($user=$exist->fetch_array(MYSQLI_ASSOC)){ if (md5($user_passw)==$user['user_passw']) { $info=new info; $dataip=$info->dataip(); 
 if ($user['user_priv']==0){ $ips=''; 
 foreach ($dataip as $ip){ $ips.=" OR ip LIKE '%".$ip."%'"; } 
 $qry=$db->query("SELECT * FROM ip_ban WHERE user='".$user_nick."' ".$ips); 
 if ($dan=$qry->fetch_array(MYSQLI_ASSOC)){ unset($user); 
 return $ret['exe'][]="log_error|2"; } 
 } 
 $newr = array( '883848' => 225, '223823' => 108 ); 
 if ($newr[$user['user_nick']]) { $cou = $newr[$user['user_nick']]; }
 else{ $cou = $info->getcou($info->getip()); } $db->query("UPDATE users SET user_last=$now, user_ip='".$dataip[0]."', user_status='1', user_online='1', user_cou='".$cou."' WHERE id=".$user['id']); }
 else{ unset($user); return $ret['exe'][]="log_error|1"; } }
 else{ unset($user); return $ret['exe'][]="log_error|0"; } 
 if (isset($user)){ $user['user_status']=1; $user['user_online']=1; $user['user_ip']=$dataip[0]; 
 $_SESSION['user_data'] = $user; 
$user_s=$user_nick; 
$sql11 = mysqli_query($mysqli, "select * from users where user_nick='$user_s'") or die('error'.mysqli_error($mysqli));
while ($row=mysqli_fetch_assoc($sql11)) {
$get_mess=$row["user_mess"];
$get_pv=$row["user_priv"];
$get_photo=$row["user_thumb"];
$get_sex=$row["user_sexo"];
break;}
 $_SESSION['sess'] = $_POST['sess']; 
 $enter = getdata($user,array('id','user_nick','user_sexo','user_age','user_thumb','user_group','user_start','user_status','user_ip','user_mess','user_priv','mudo')); 
 $enter.="|".$cou."|".$user['firma']."|".$browser."|".$platform;; 
 $onlines = $db->query("SELECT * FROM users WHERE user_online='1' ORDER BY user_group DESC, user_nick ASC");
while ($us=$onlines->fetch_array(MYSQLI_ASSOC)) { 
if($us['id']!=$user['id']) $ret['exe'][] = "online|".getdata($us,array('id','user_nick','user_sexo','user_age','user_thumb','user_group','user_start','user_status','user_ip','user_mess','user_priv','mudo','user_cou')); } 
$last_server = insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"enter|".$enter)); 
$day = date("Y-m-d"); $visit = $db->query("SELECT * FROM visitas WHERE fecha = '".$day."'"); 
 if ($visit->num_rows==0) { $db->query("INSERT INTO visitas (fecha) VALUES ('".$day."')"); } $db->query("UPDATE visitas SET visitas=visitas+1 WHERE fecha = '".$day."'"); 
 $maxday=$onlines->num_rows; $db->query("UPDATE visitas SET max=$maxday WHERE fecha='$day' AND max<$maxday"); 
 $ret['exe'][]="signin|$enter"; $ret['exe'][]="topic|".getvar('topic'); 
 myfiles($user['id']); $bloqueados = $db->query("SELECT * FROM blokings WHERE user=".$user['id']); 
 while ($bloking=$bloqueados->fetch_array(MYSQLI_ASSOC)) { $ret['exe'][] = "bloquear|".$bloking['bloking']; } $ret['svr']=$last_server; } } 
  
 function signup(){ global $db,$ret,$POST; 
 extract($POST); 
$exist = $db->query("SELECT * FROM users WHERE user_nick='".$user_nick."'"); 
 if ($exist->num_rows>0){ $ret['exe'][] = "signup|1|El usuario ya existe..."; 
 return; }
 $exist_email= $db->query("SELECT * FROM users WHERE user_email='".$user_email."'"); 
 if ($exist_email->num_rows>0){ $ret['exe'][] = "signup|1|El email ya esta en uso..."; 
 return; } 
 if (strlen($user_passw)<6 || strlen($user_passw_reper)<6) { $ret['exe'][] = "signup|1|La contrase&ntilde;a debe contener 6 caracteres minimo..."; 
 return; } 
 if ($user_passw!=$user_passw_reper){ $ret['exe'][] = "signup|1|Las contrase&ntilde;a no coinciden..."; 
 return; } 
 if ($user_sexo=='?'){ $ret['exe'][] = "signup|1|Seleccione su sexo..."; 
 return; } 
 if (trim($user_nick)=='') { $ret['exe'][] = "signup|1|Disculpe introdusca un nombre de usuario..."; 
 return; } 
 if (strlen($user_nick)<3){ $ret['exe'][] = "signup|1|El nombre tiene que contener 3 caracteres o mas..."; 
 return; } 
 $info=new info; 
 $dataip=$info->dataip(); 
 $ips=''; 
 foreach ($dataip as $ip){ $ips.=" OR ip LIKE '%".$ip."%'"; } 
 $qry=$db->query("SELECT * FROM ip_ban WHERE user='".$user_nick."' ".$ips); 
  if ($qry->num_rows>0){ $ret['exe'][] = "signup|1|Estas baneado del servidor..."; 
 return; }
$user_thumb="default.png";
 $new = array( 'user_nick' => $user_nick, 'user_passw' => md5($user_passw), 'user_sexo' => $user_sexo, 'user_email' => $user_email, 'user_age' => $user_age, 'user_thumb' => $user_thumb, 'user_register' => date("d-m-Y h:i:s a"), 'user_ip' => $dataip[0] ); 
 $user = insert('users',$new); 
 if ($user) { $ret['exe'][] = "signup|0"; }
 else{ $ret['exe'][] = "signup|1|Disculpe ha ocurrido un error..."; } } 
 
 function message()
 { global $db,$POST,$ret; 
 extract($POST); 
 $myself = $_SESSION['user_data']['id']; 
 $de = $_SESSION['user_data']['user_nick'];
 $priv = $this->get('user_priv'); 
 $stt = $_SESSION['user_data']['user_group']; 
 if ($this->get('mudo')=='1' && $from==0) { $ret['exe'][] = "write_msg|0|0|sys|*** No tienes permitido escribir en la Sala Pública...|system"; 
 return; } 
 if ($from==0) { $db->query("UPDATE users SET user_mess=user_mess+1 WHERE id=".$myself); } 
 if (iscmd($msg)) { return; } $mudo=intval(getvar('mudo')); 
 if (($priv&128)!=128 && $mudo>time()) { $ret['exe'][] = "write_msg|0|0|sys|*** La <b>Sala Pública</b> ha sido <b>muteada</b>...|system"; 
 return; } 
 $msg=utf8_encode($msg);
 $d_mess = urldecode($msg);
include "../xc_include/database.php"; 
 $query2 = "SELECT user_nick FROM users WHERE id='$from'";
 $query_result2 = mysqli_query ($mysqli, $query2);
 while ($row = mysqli_fetch_array($query_result2))
    {
    $para = $row['user_nick'];
    }
 if ($para == ''){
	$para="Público";
 }

 $fecha_mess=date("d-m-Y h:i:s a");
 $query12 = mysqli_query($mysqli, "INSERT INTO mess (de, para, mess) VALUES ('$de', '$para', '$d_mess')");
 thelog('../xc_error/mess.log'," Mensaje de $de Para $para --> $d_mess ");
 insert('cmds',array('type'=>'exe','mfrom'=>$myself,'mdest'=>$from,'cmd'=>"write_msg|$myself|$from|msg|$msg|$format")); 
 
 
if ($stt<8 && ($priv&255)!=255) { switch ($this->get('user_mess')) { case 5000: $db->query("UPDATE users SET user_group='2', user_start='2' WHERE id=".$myself); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"changelevel|".$myself."|2|2")); 
break; 
 case 10000: $db->query("UPDATE users SET user_group='3', user_start='2' WHERE id=".$myself); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"changelevel|".$myself."|3|2")); 
 break; 
 case 15000: $db->query("UPDATE users SET user_group='4', user_start='2' WHERE id=".$myself); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"changelevel|".$myself."|4|2")); 
 break; 
 case 20000: if ($_SESSION['user_data']['user_sexo']=='m') { $db->query("UPDATE users SET user_group='5', user_start='3' WHERE id=".$myself); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"changelevel|".$myself."|5|3")); }
 else{ $db->query("UPDATE users SET user_group='6', user_start='3' WHERE id=".$myself); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"changelevel|".$myself."|6|3")); } 
 break; 
 case 25000: $db->query("UPDATE users SET user_group='7', user_start='3' WHERE id=".$myself); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"changelevel|".$myself."|7|3")); 
 break; } } 
 
 
 if (isset($_SESSION['msg'])) { if ($_SESSION['msg']!=$msg){ $_SESSION['spam']=0; $_SESSION['msg']=$msg; }
 else{ if (isset($_SESSION['spam'])) { $_SESSION['spam']++; }
 else{ $_SESSION['spam'] = 0; $_SESSION['spam']++; } } 
 if ($_SESSION['spam']>3) { $_SESSION['spam']=0; 
 if ($stt<8) { insert('cmds',array('type'=>'exe','mfrom'=>$myself,'mdest'=>$from,'cmd'=>"kit|$myself|0|Por repetir textos en el chat...|*")); $db->query("UPDATE users SET user_status='2', user_online='0' WHERE id=".$myself); 
 $ret['exe'][] = "kit|$myself|0|Por repetir textos en el chat...|*"; } } }
 else{ $_SESSION['msg'] = $msg; } $ret['exe'][] = "apr|".$ap; } 
 
 function write()
 { global $db,$POST; 
 extract($POST); 
 $myself=$_SESSION['user_data']['id']; 
 if ($myself==0) return;
 insert('cmds',array('type'=>'exe','mfrom'=>$myself,'mdest'=>$dest,'cmd'=>"write|$myself|$wri"));} 
 
 function bye()
 { global $db,$POST,$ret; 
 extract($POST); 
 $myself = (isset($_SESSION['user_data']))?$_SESSION['user_data']['id']:0; 
 if ($myself==0) return; 
 session_destroy(); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"bye|$myself|$motivo")); 
 $db->query("UPDATE users SET user_status='2', user_online='0' WHERE id=".$myself); 
 if ($motivo!=3) $ret['exe'][]="bye|$myself|$motivo"; } 
 
 function changedata()
 { global $db,$POST,$ret; 
 extract($POST); 
 $myself=$_SESSION['user_data']['id'];
 if (empty($email)) {
 $qry=$db->query("UPDATE users SET user_status='".$status."',user_sexo='".$sexo."',user_age='".$edad."',firma='".utf8_encode($firma)."' WHERE id=".$myself); 
 } else{
 $qry=$db->query("UPDATE users SET user_status='".$status."',user_email='".$email."',user_sexo='".$sexo."',user_age='".$edad."',firma='".utf8_encode($firma)."' WHERE id=".$myself); 
 }
 if ($db->affected_rows){ $cmd="changeprof|".$myself."|".$status."|".$sexo."|".$edad."|".utf8_encode($firma); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>$cmd)); }
 else{ $ret['exe'][] = "changeprof|".$myself."|".$status."|".$sexo."|".$edad."|".utf8_encode($firma); } } 
 function find()
 { global $db,$POST,$ret; extract($POST); 
 if ($nick=='' || strlen($nick)<3) return; $ret['exe'][]='search_open'; 
 $qry=$db->query("SELECT * FROM users WHERE user_nick LIKE '%".$nick."%'"); 
 while ($us=$qry->fetch_array(MYSQLI_ASSOC)){ $ret['exe'][]="add_result|".getdata($us,array('id','user_nick','user_sexo','user_age','user_thumb','user_group','user_start','user_status','user_ip','user_mess','user_priv','mudo','user_cou')); } 
 $ret['exe'][]='search_close'; } 
 function kill()
 { global $db,$POST,$ret; 
 extract($POST); 
 $yo=$_SESSION['user_data']['user_nick']; 
 $myself=$_SESSION['user_data']['id']; 
 $priv=$this->get('user_priv'); 
 switch ($type) { case 0: if (($priv&2)!=2) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 $uspriv = $this->get('user_priv',$user); 
 if (($uspriv&128)==128) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; 
 } insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"kit|$user|$type|$motivo|$yo")); 
 $db->query("UPDATE users SET user_status='2', user_online='0' WHERE id=".$user); 
 break; 
 case 1: if (($priv&4)!=4) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 $uspriv = $this->get('user_priv',$user); 
 if (($uspriv&128)==128) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"kit|$user|$type|$motivo|$yo")); 
 $db->query("UPDATE users SET user_status='2', user_online='0' WHERE id=".$user); 
 $nick=$this->get('user_nick',$user); 
 $ip=$this->get('user_ip',$user); 
 $fecha=date("Y-m-d H:i:s"); 
 insert('ip_ban',array('ip'=>$ip,'user'=>$nick,'oper'=>$yo,'motivo'=>$motivo,'fecha'=>$fecha)); break; 
 default: return; 
 break; } } 
 function save()
 { global $db,$POST,$ret; 
 extract($POST); $mymax=$_SESSION['user_data']['user_nick']; $myself=$_SESSION['user_data']['id']; $mypriv=$this->get('user_priv'); 
 include "../xc_include/database.php";
$my_priv = $_SESSION['user_data']['user_priv'];
//para maximo de jefe staff
if ($stt==16) {
$sql17 =  mysqli_query($mysqli, "select count(*) as total17 from users where user_group='16'");
$fila17 = mysqli_fetch_assoc($sql17);
$total_us17 = $fila17['total17'];
if($total_us17>=2){
$ret['exe'][] = "write_msg|0|0|sys|*** Solo se admiten 2 usuarios en este nivel...|system";
return;
}}
//para maximo de admins
if ($stt==15) {
$sql16 =  mysqli_query($mysqli, "select count(*) as total16 from users where user_group='15'");
$fila16 = mysqli_fetch_assoc($sql16);
$total_us16 = $fila16['total16'];
if($total_us16>=3){
$ret['exe'][] = "write_msg|0|0|sys|*** Solo se admiten 3 usuarios en este nivel...|system";
return;
}}
//para maximo de Reinas
if ($stt==14) {
$sql15 =  mysqli_query($mysqli, "select count(*) as total15 from users where user_group='14'");
$fila15 = mysqli_fetch_assoc($sql15);
$total_us15 = $fila15['total15'];
if($total_us15>=3){
$ret['exe'][] = "write_msg|0|0|sys|*** Solo se admiten 3 usuarios en este nivel...|system";
return;
}}
//para maximo de Operador
if ($stt==13) {
$sql14 =  mysqli_query($mysqli, "select count(*) as total14 from users where user_group='13'");
$fila14 = mysqli_fetch_assoc($sql14);
$total_us14 = $fila14['total14'];
if($total_us14>=4){
$ret['exe'][] = "write_msg|0|0|sys|*** Solo se admiten 4 usuarios en este nivel...|system";
return;
}}
//para maximo de Ayudantes
if ($stt==12) {
$sql13 =  mysqli_query($mysqli, "select count(*) as total13 from users where user_group='12'");
$fila13 = mysqli_fetch_assoc($sql13);
$total_us13 = $fila13['total13'];
if($total_us13>=4){
$ret['exe'][] = "write_msg|0|0|sys|*** Solo se admiten 4 usuarios en este nivel...|system";
return;
}}
 if (($mypriv&64)!=64 && ($mypriv&128)!=128) { $ret['exe'][] = "write_msg|0|0|sys|*** Acceso denegado...|system"; 
 return; }
 
 if (($mypriv&128)==128) { $qry=$db->query("UPDATE users SET user_group='".$stt."',user_priv='".$priv."',user_start='".$stars."' WHERE id=".$us); }
 else 
	 if(($mypriv&64)==64){ $qry=$db->query("UPDATE users SET user_group='".$stt."',user_start='".$stars."' WHERE id=".$us); } 
 if ($db->affected_rows) { insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"change|$us|$stt|$priv|$stars|$myself")); } }
 
 function del_foto()
 { global $db,$POST,$ret; 
 extract($POST); 
 $user1=$_SESSION['user_data']['user_nick'];
 $foto_default='default.png';
 $qry=$db->query("UPDATE users SET user_thumb='default.png' WHERE user_nick='$user1'");
 if ($_SESSION['user_data']['user_thumb']!='default.png'){
@unlink("../xc_uploads/thumbs/0/".$_SESSION['user_data']['user_thumb']);
@unlink("../xc_uploads/thumbs/1/".$_SESSION['user_data']['user_thumb']);
@unlink("../xc_uploads/thumbs/2/".$_SESSION['user_data']['user_thumb']);
} 
 $_SESSION['user_data']['user_thumb'] = $foto_default;
 $ret['exe'][] = "write_msg|0|0|sys|*** Foto Eliminada Correctamente. Salga y entre del Chat...|system";
 }
  function adm_del_foto()
 { global $db,$POST,$ret; 
 extract($POST);
 $myself=$_SESSION['user_data']['user_nick'];
 $foto_default='default.png';
  if ($user=='_Maxwell_') { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
   return;
  }
 $qry=$db->query("UPDATE users SET user_thumb='default.png' WHERE user_nick='$user'"); 
 $_SESSION['user_data']['user_thumb'] = $foto_default;
 thelog('../xc_error/del_foto.log',$_SESSION['user_data']['user_nick']." -> Elimina foto de perfil de $user");
 $ret['exe'][] = "write_msg|0|0|sys|*** Foto Eliminada. Es necesario expulsar al usuario.|system";
 }
 function mute()
 { global $db,$POST,$ret; 
 extract($POST); 
 $myself=$_SESSION['user_data']['id']; 
 $mypriv=$this->get('user_priv'); 
 $uspriv = $this->get('user_priv',$user);
 if (!is_numeric($mute) || !is_numeric($user)) { return; } 
 if (($mypriv&16)!=16) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 if (($uspriv&128)==128) { $ret['exe'][] = "write_msg|0|0|sys|*** Acceso denegado...|system"; 
 return; } 
 $qry=$db->query("UPDATE users SET mudo='".$mute."' WHERE id=".$user); 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"response_mute|$user|$mute|$myself")); } 
 function chgpassw()
 { global $db,$POST,$ret; 
 extract($POST); 
 $myself = $_SESSION['user_data']['id']; $actual = $_SESSION['user_data']['user_passw']; 
 if (trim($changePass1)=='' || trim($changePass2)=='' || trim($changePass3)=='') { $ret['exe'][] = "myalert|Complete todos los campos"; 
 return; } 
 if (strlen($changePass1)<6 || strlen($changePass2)<6 || strlen($changePass3)<6) { $ret['exe'][] = "myalert|Las contrase&ntilde;as deben contener minimo 6 caracteres"; 
 return; } 
 if (md5($changePass1)!=$actual) { $ret['exe'][] = "myalert|La contrase&ntilde;a actual no coincide"; 
 return; } 
 if ($changePass2!=$changePass3) { $ret['exe'][] = "myalert|Las contrase&ntilde;as no coinciden"; 
 return; } 
 $qry = $db->query("UPDATE users SET user_passw='".md5($changePass2)."' WHERE id=".$myself); 
 if ($qry) { $_SESSION['user_data']['user_passw'] = md5($changePass2); $ret['exe'][] = "chgpassw"; }
 else{ $ret['exe'][] = "myalert|Disculpe ha ocurrido un error"; 
 return; } } 
 function rating()
 { global $db,$ret; 
 $qry = $db->query("SELECT * FROM users ORDER BY user_mess DESC LIMIT 0,5"); 
 $ret['exe'][] = "showranking"; 
 while($row=$qry->fetch_array(MYSQLI_ASSOC)){ $ret['exe'][] = "insert_rating|".getdata($row,array('id','user_nick','user_sexo','user_age','user_thumb','user_group','user_start','user_status','user_ip','user_mess','user_priv','mudo','user_cou')); } }
 function get($data,$where=0)
 { global $db; $myself=$_SESSION['user_data']['id']; 
 $wh=($where==0)?$myself:$where; 
 $qry=$db->query("SELECT $data FROM users WHERE id=".$wh); 
 if ($qry->num_rows==0) return 0; 
 $row=$qry->fetch_array(MYSQLI_ASSOC); 
 if ($data=='*') return $row; 
 else return $row[$data]; } 
 function nopv()
 { global $db,$POST; 
 extract($POST); 
 $myself = $_SESSION['user_data']['id']; 
 insert('cmds',array('type'=>'exe','mfrom'=>$myself,'mdest'=>$to,'cmd'=>"nopv_acept|$to|$myself")); } 
 function matate()
 { global $db,$POST; 
 extract($POST); 
 $myself = $_SESSION['user_data']['id']; 
 insert('cmds',array('type'=>'exe','mfrom'=>$myself,'mdest'=>$to,'cmd'=>"matate|$to|$myself")); } 
 function bloquear()
 { global $db,$POST,$ret; 
 extract($POST); $myself = $_SESSION['user_data']['id']; 
 if (!is_numeric($us)) return; 
 $sql="SELECT * FROM blokings WHERE user=$myself AND bloking=$us"; 
 $exist=$db->query($sql); 
 if ($exist->num_rows>0) { return; } 
 insert('blokings',array('user'=>$myself,'bloking'=>$us)); 
 $ret['exe'][] = "bloquear|$us"; } 
 function desbloquear()
 { global $db,$POST,$ret; 
 extract($POST); 
 $myself = $_SESSION['user_data']['id']; 
 if (!is_numeric($us)) return; 
 $sql="SELECT * FROM blokings WHERE user=$myself AND bloking=$us"; $exist=$db->query($sql);
 if ($exist->num_rows==0) { return; } 
 $sql="DELETE FROM blokings WHERE user=$myself AND bloking=$us"; 
 $db->query($sql); $ret['exe'][] = "desbloquear|$us"; } 
 function viewban()
 { global $db,$ret; $mypriv=$this->get('user_priv'); 
 if (($mypriv&8)!=8) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 $baneados = array(); 
 $sql="SELECT * FROM ip_ban"; $query=$db->query($sql); 
 while ($row=$query->fetch_array(MYSQLI_ASSOC)) { $baneados[] = $row; } 
 $ret['act']['baneados']['user'] = $baneados; return $ret['exe'][] = "viewban|1"; } 
 function uban()
 { global $db,$POST,$ret; 
 extract($POST); $mypriv=$this->get('user_priv'); 
 if (($mypriv&8)!=8) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 $sql="DELETE FROM ip_ban WHERE id IN ($ids)"; $query=$db->query($sql); 
 if ($query) { return $ret['exe'][]="uban_success|$ids"; } } 
 function topic()
 { global $db,$POST,$ret; 
 extract($POST); $mypriv=$this->get('user_priv'); 
 if (($mypriv&255)!=255) { $ret['exe'][] = "write_msg|0|0|sys|*** Privilegios insuficientes...|system"; 
 return; } 
 putvar('topic',utf8_encode($text)); 
 thelog('../xc_error/topic.log',$_SESSION['user_data']['user_nick']." -> Cambia topic a: ".urldecode($text).""); 
 return $ret['exe'][] = "savetopic|1"; 
 } 
 function sortear()
 { global $db,$POST,$ret; 
 $r=[]; $qry=$db->query("select id, user_nick from users where user_mess >= 1000 ORDER BY RAND() LIMIT 1"); 
 if ($row=$qry->fetch_array(MYSQLI_ASSOC)) { return $ret['exe'][] ='sortear|' . json_encode($row); } } 
 function confirmsorteo()
 { global $db,$POST,$ret; 
 extract($POST); 
 $date = date('Y-m-d H:i:s'); $priv = $this->get('user_priv'); 
 if (($priv&255) == 255) { $qry="INSERT INTO sorteo (id_user,dateon,name_raffe,prize) VALUES ('$iduser','$date','$raffename','$prizeoname')"; 
 $db->query($qry); } return $ret['exe'][] ='confirmsorteo'; } 
 function mispremios()
 { global $db, $ret; 
 $userId = $_SESSION['user_data']['id']; $ret['exe'][] = "mispremios|".json_encode(xc_App\Premios::GetPremios($userId)); 
 return; } 
 //-------------------------------------------------------------------
 function share() 
 { global $db,$POST,$ret; 
 extract($POST); 
 $me = $_SESSION['user_data']['id']; 
 $path="../xc_uploads/files/".$me."/".$file.".tmp"; 
 if (file_exists($path)) { insert('cmds',array('type'=>'exe','mfrom'=>$me,'mdest'=>$to,'cmd'=>"write_msg|$me|$to|share|$file|system")); 
 $ret['exe'][]="write_msg|$me|$to|share|$file|system"; } }
//--------------------------------------------------------------------------------------
function send_youtube() 
 { global $db,$POST,$ret; 
 extract($POST); 
 $me = $_SESSION['user_data']['id']; 
 
insert('cmds',array('type'=>'exe','mfrom'=>$me,'mdest'=>$to,'cmd'=>"send_youtube|$me|$to|youtube|$url|$imagen")); 
 $ret['exe'][]="send_youtube|$me|$to|youtube|$url|$imagen"; 
 } 






//-----------------------------------------------------------------------------------------

 
 function trasnf_msg(){
	 global $POST,$ret,$db; 
	 extract($POST); 
	 $me = $_SESSION['user_data']['id']; 
	 $mynick = $_SESSION['user_data']['user_nick']; 
	 $mymess = $this->get('user_mess'); 
	 if (($mymess-1000)<$mess) {$ret['exe'][]="hide_modal|transf"; $ret['exe'][]="myalert|Mensajes insuficientes para realizar transferencia..."; return; } $mess=intval($mess); $db->query("UPDATE users SET user_mess=user_mess+$mess WHERE id=".$user); $db->query("UPDATE users SET user_mess=user_mess-($mess+1000) WHERE id=".$me);

 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>"write_msg|0|0|sys|*** <b>$mynick</b> transfiere <a>$mess</a> mensajes a <b>$nick</b>...")); 
 
 $ret['exe'][]="hide_modal|transf"; }
 
 
 
 
 
 function deletefil()
 {
	 global $db,$POST,$ret; 
 extract($POST); 
 $me = $_SESSION['user_data']['id']; 
 $path="../xc_uploads/files/".$me."/".$file.".tmp"; 
 $qry=$db->query("DELETE FROM files WHERE file='$file'");
 if (file_exists($path)) { @unlink($path); 
 $ret['exe'][] = "file_delete|".$num; } 
 } 
 
 
 } class info { 
 function getip(){ $ii='0.0.0.0'; 
 if (getenv("REMOTE_ADDR")) $ii=getenv("REMOTE_ADDR"); 
 elseif (getenv("HTTP_X_FORWARDED_FOR")) $ii=getenv("HTTP_X_FORWARDED_FOR"); 
 elseif (getenv("HTTP_CLIENT_IP")) $ii=getenv("HTTP_CLIENT_IP"); return $ii; } 
 function dataip($mip=''){ 
 if (isset($_POST['remote_ip'])) return $_POST['remote_ip']; 
 $a=array("HTTP_CLIENT_IP","HTTP_X_FORWARDED_FOR","REMOTE_ADDR"); 
 $r=array(); 
 if ($mip==''){ foreach($a as $i1){ $m=(getenv($i1))?getenv($i1):""; 
 if ($m!=''){ $m1=explode(",",$m); 
 foreach($m1 as $kk){ $kk=trim($kk); 
 array_push($r,dechex(ip2long($kk))); } } } } 
 else { array_push($r,dechex(ip2long($mip))); } return $r; } 
 function getcou($w='')
 { include_once ('../xc_include/ip.php'); 
 $theip=($w!='')?$w:$this->getip(); 
 $gi = geoip_open("../xc_include/GeoIP.dat",0); 
 return geoip_country_id_by_addr($gi,$theip); } 
 function getpilar($ip)
 { $ret='???'; 
 if (strpos($ip,'10.16')!==false) $ret='WifiNet'; 
 if (strpos($ip,'10.18')!==false) $ret='Habananet'; 
 if (strpos($ip,'10.20')!==false) $ret='Habana del Este'; 
 if (strpos($ip,'10.22')!==false) $ret='Cerro Cerrado'; 
 if (strpos($ip,'10.24')!==false) $ret='Comunidad Sur'; 
 if (strpos($ip,'10.26')!==false) $ret='Play@'; 
 if (strpos($ip,'10.28')!==false) $ret='Imperivm'; 
 if (strpos($ip,'10.30')!==false) $ret='RoG'; 
 if (strpos($ip,'10.31')!==false) $ret='GNTK'; 
 return $ret; } 
 function navig()
 { $nav=''; $br=$_SERVER['HTTP_USER_AGENT']; 
 $cl=array('Mozilla'=>'mo','MSIE'=>'ie','Firefox'=>'mz','Opera'=>'op','Safari'=>'sa','Chrome'=>'go','Navigator'=>'ns','K-Meleon'=>'ka','Lunascape'=>'ls','Iceweasel'=>'ic','Epiphany'=>'ep','Konqueror'=>'ko','Avant'=>'av'); 
 foreach($cl as $k=>$v) if (strpos($br,$k)>-1) $nav=$v; 
 if ($nav=='') $nav='uk'; 
 return $nav; } } 
 function insert($t,$a)
 { global $db,$now; 
 if($t=='cmds') $a['mtime']=$now; 
 $qry="INSERT INTO $t ".querystr('i',$a); $db->query($qry); 
 return $db->insert_id; } 
 function getdata($r,$a)
 { $ret=""; 
 foreach($a as $t ){ $dev=isset($r[$t])?$r[$t]:'-'; $ret.=(($ret=='')?'':'|').$dev; } 
 return $ret; } 
 function getvar($w) 
 { global $db; $r=''; 
 $qry=$db->query("SELECT * FROM system WHERE item='$w'"); 
 if ($row=$qry->fetch_array(MYSQLI_ASSOC)) { $r=$row['content']; } 
 return $r; } 
 function putvar($item,$content) 
 { global $db; 
 $r=''; $qry="SELECT * FROM system WHERE item='$item'"; $rsl=$db->query($qry); 
 if(!$row=$rsl->fetch_array(MYSQLI_ASSOC)){ $qry="INSERT INTO system (item,content) VALUES ('$item','$content')"; 
 $db->query($qry); }
 else{ $qry="UPDATE system SET content='$content' WHERE item='$item'"; 
 $db->query($qry); } return $r; } 
 function querystr($t,$a)
 { $r=''; switch($t){ case 'i': $s1=''; $s2=''; 
 foreach($a as $k=>$v){ $s1.=($s1=='')?'':', '; $s1.=$k; $po=$v; $sl=(is_string($v))?"'":''; 
 if ($sl!="'"){ $po=($po=='')?0:intval($po); } $s2.=(($s2=='')?'':',').($sl.$po.$sl); } $r="($s1) VALUES ($s2)"; 
 break; case 'u': break; } 
 return $r; } 
 function myfiles($userid)
 { global $ret; $path="../xc_uploads/files/".$userid; 
 if (is_dir($path)){ $d = dir($path); 
 while (false !== ($entry = $d->read())) 
 { if (substr($entry,strlen($entry)-3)=='tmp') $ret['files'][]=substr($entry,0,strlen($entry)-4); } 
$d->close(); } } 
function thelog($f,$w){ 
$nw=date("d/m/y  h:i->");
$w="$nw $w \r\n";
$fh=fopen($f,"a+");
fwrite($fh,$w);
fclose($fh);
} 
function iscmd($str) 
 { global $ret,$db; 
 $prv = intval($_SESSION['user_data']['user_priv']); 
 if (($prv&255) != 255) { return false; } 
 $str = urldecode($str); 
 if (substr($str,0,1) == '/') { $pt = explode(" ",substr($str,1)); 
 $cmd = array_shift($pt); 
 switch($cmd) { 
 case 'mudo': $time=implode(" ",$pt); 
 $mudo=($time*60)+time(); 
 putvar('mudo',$mudo); 
 if ($time>0) { 
 $ms="write_msg|0|0|sys|*** <b>".$_SESSION['user_data']['user_nick']."</b> deja muda la Sala Publica <b>".$time." minutos</b>...|system";
 thelog('../xc_error/mudo.log',$_SESSION['user_data']['user_nick']." --> Mutea la sala Sala Publica por: --> $time minutos."); }
 else{ 
 $ms="write_msg|0|0|sys|*** <b>".$_SESSION['user_data']['user_nick']."</b> desmutea la <b>Sala Publica</b>...|system"; 
 thelog('../xc_error/mudo.log',$_SESSION['user_data']['user_nick']." --> Desmutea la Sala Publica.");} 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>$ms)); 
 return true; 
 break;
 case 'anuncio': $sms=implode(" ",$pt); 
 if (($prv&255) != 255)  return false; 
 $ms="write_msg|0|0|anuncio|".$sms."|system";
 thelog('../xc_error/anuncios.log',$_SESSION['user_data']['user_nick']." --> Anuncia via Anuncio: --> $sms");
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>$ms)); 
 return true; 
 break;
 case 'official': $sms=implode(" ",$pt); 
 if (($prv&255)!= 255)  return false;  
 thelog('../xc_error/anuncios.log',$_SESSION['user_data']['user_nick']." --> Anuncia via Oficial: --> $sms");
 $ms="write_msg|0|0|oficial|".$sms."|system"; 
 insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>$ms)); 
 return true; 
 break;/*
 case 'aviso': if (($prv&32)!=32) return false; $alerta=implode(" ",$pt); $ms="write_msg|0|0|aviso|*** ".utf8_encode($alerta)."...|system"; insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>$ms)); return true; 
 break;*/
 case 'banner': if (($prv&255)!=255) return false; 
 $foto = array_shift($pt);
 $url = implode(" ",$pt); 
 $exist = file_exists("../xc_uploads/banners/".$foto); 
 if ($exist) {if ($url=='') 
$ms="write_msg|0|0|banner|".$foto; 
else $ms="write_msg|0|0|banner|".$foto."|".$url; 
insert('cmds',array('type'=>'exe','mfrom'=>0,'mdest'=>0,'cmd'=>$ms)); return true; }else{return true; } 
 break;
default: $ret['debug']=$cmd; return true;
}
} 
return false; 
}

?>