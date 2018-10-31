<?
function logout(){
// ob_start();
 session_start();
 session_destroy();
// echo "Ud. ha sido exitosamente log-out";
// header("Location:http://localhost/moviliza/index.php");
 header("Location:index.php");
// flush();
 exit;
}
// Selección de funciones
switch($func){
   default:
    logout();
	break;
}
?>

