<?php
include "header.php";

//Autenticarse con el sistema
function login(){
echo " <form method=\"POST\" action=\"index.php?page=admin&file=index&func=fijacookie\">"
. " Nombre:&nbsp;&nbsp;<input type=\"text\" name=\"nombreusuario\"><br/>"
. " Password:<input type=\"password\" name=\"passwdusuario\"><br/>"
. " <input type=\"submit\" name=\"submit\" value=\"Login\">"
. " </form>";
}
function fijacookie(){
// include "header.php";
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
 }
exit;
} 
// Salr y borrar cookies
function logout(){
 setcookie('nombreusuario','',time()-3600);
 setcookie('nivelautorizado','',time()-3600);
 echo "Ud. ha sido exitosamente log-out";
 exit;
}
// Selección de funciones
switch($func){
   default:
    login();
	break;
  case "fijacookie":
    fijacookie();
	break;	
  case "logout":
    logout();
	break;
}
?>
