<?
include "header.php";
function fijacookie(){
// global $passwdusuario,$nombreusuario;
 $nombreusuario=$_POST['nombreusuario'];
 $passwdusuario=$_POST['passwdusuario'];
// echo $passwdusuario." ".$nombreusuario."<br/>";

 $result=safe_query("select nivel from usuarios where password='$passwdusuario' and nombre='$nombreusuario'");
 while($rowu=mysql_fetch_array($result)){
    $valid_nivel=$rowu['nivel'];
 }
// echo $valid_nivel."<br/>";
 if (!mysql_num_rows($result)){ 
   echo "Ud. no está autorizado para el acceso...";
 }
 else
 {
   setcookie('nombreusuario',$nombreusuario,(time()+7200));
   setcookie('nivelautorizado',$valid_nivel,(time()+7200));
 echo  "<p><b>Ingresando como $nombreusuario y su nivel autorizado es $valid_nivel</b></p>\n";
   header("Location:http://localhost/estadistica/index.php");
 }
exit;
} 
switch($func){
   default:
    fijacookie();
	break;
}
?>
