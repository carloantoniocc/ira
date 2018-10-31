<?php
include "header.php";
function fijasesion(){
ob_start();

 $nombreusuario=$_POST['nombreusuario'];
 $passwdusuario=$_POST['passwdusuario'];

 $result=safe_query("select nivel, id_estab, establecimiento.nombre as nombree,tipo,centinela
                     from   usuarios left outer join establecimiento on
                     establecimiento.id=usuarios.id_estab
                     where password='".$passwdusuario."' and usuarios.nombre='".$nombreusuario."'");

 while($rowu=mysql_fetch_array($result)){
    $valid_nivel=$rowu['nivel'];
    $id_estab=$rowu['id_estab'];
    $nombre=$rowu['nombree'];
    $tipo=$rowu['tipo'];
	$centinela=$rowu['centinela'];
 }

 if (!mysql_num_rows($result)){
   echo "Ud. no está autorizado para el acceso...";
 }
 else
 {
   session_start();
   $_SESSION['autorizado']=1;
   $_SESSION['nombreusuario']=$nombreusuario;
   $_SESSION['nivelautorizado']=$valid_nivel;
   $_SESSION['id_estab']=$id_estab;
   $_SESSION['nombre']=$nombre;
   $_SESSION['tipo']=$tipo;
   $_SESSION['centinela']=$centinela;

 header("Location:index.php");
 }
exit;
flush();
}
switch($func){
   default:
    fijasesion();
	break;
}
?>

