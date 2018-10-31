<?
include "header.php";
function fijasesion(){
// global $passwdusuario,$nombreusuario;
 $nombreusuario=$_POST['nombreusuario'];
 $passwdusuario=$_POST['passwdusuario'];
// echo $passwdusuario." ".$nombreusuario."<br/>";

 $result=safe_query("select nivel, id_estab, nombre from usuarios, establecimiento where 
                     establecimiento.id=usuarios.id_estab and 
                     password='$passwdusuario' and nombre='$nombreusuario'");
 while($rowu=mysql_fetch_array($result)){
    $valid_nivel=$rowu['nivel'];
    $id_estab=$rowu['id_estab'];
    $nombre=$rowu['nombre'];

 }
// echo $valid_nivel."<br/>";
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
   echo  "<p><b>Ingresando como $nombreusuario y su nivel autorizado es $valid_nivel</b></p>\n";
   header("Location:index.php");
 }
exit;
} 
switch($func){
   default:
    fijasesion();
	break;
}
?>
