<?php
include "header.php";
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
// función de update a usuarios
function grabamod(){
$updateSQL = sprintf("UPDATE usuarios 
                      SET nombre=%s,
                          password=%s,
                          nivel=%s,
                          descripcion=%s,
                          id_estab=%s
                      WHERE id=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nivel'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['id_estab'], "int"),
                       GetSQLValueString($_POST['id'], "int")
                       );
  $Result1 = safe_query($updateSQL);
//echo "Modificó sus datos";
header("Location: index.php?page=adminusu&file=index&func=manusu");
}
function grabaing(){
 $insertSQL = sprintf("INSERT INTO usuarios (nombre, password, nivel, descripcion,id_estab)
                       VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nivel'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['id_estab'], "int")
                     );
  $Result1 = safe_query($insertSQL);
//echo "Se agregó un nuevo usuario";
header("Location: index.php?page=adminusu&file=index&func=manusu");
}
function eliusu(){
$id=$_POST['ide'];
$deleteSQL="delete from usuarios where id=".$id;
$result=safe_query($deleteSQL);
echo "se ha eliminado un usuario";
//header("Location: index.php?page=adminusu&file=index&func=manusu");
}
// funcion formulario de ingreso de datos
function ingusu(){

$query_rse = sprintf("SELECT * FROM establecimiento order by nombre");
$rse = safe_query($query_rse);
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);

echo "<form method=\"post\" name=\"form1\" action=\"index.php?page=adminusu&file=index&func=grabaing\" "
. " onsubmit=\"return forminputsubmit();\">"
. " <table align=\"center\">"
."    <caption>"
."    <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."  <strong>Agrega nuevo usuario</strong></font> "
."    </caption>"
."    <tr valign=\"baseline\"> "
."   <td nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."    Nombre:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input type=\"text\" name=\"nombre\" value=\"\" size=\"32\">"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."      <td nowrap align=\"right\">"
."      <strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."      Password:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input type=\"password\" name=\"password\" value=\"\" size=\"32\">"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."      <td nowrap align=\"right\"><strong>"
."      <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."     Reintentar Password:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input type=\"password\" name=\"password2\" value=\"\" size=\"32\">"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."      <td nowrap align=\"right\"><strong>"
."     <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."      Nivel:</font></strong></td>"
."      <td> <strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."        <select name=\"nivel\">"
."          <option value=\"administrador\" >Administrador</option>"
."          <option value=\"establecimiento\" >Establecimiento</option>"
."          <option value=\"direccion\" >Direccion</option>"
."        </select>"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\">" 
."      <td nowrap align=\"right\"><strong>"
."      <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."       Descripcion:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input type=\"text\" name=\"descripcion\" value=\"\" size=\"32\">"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\">" 
."      <td nowrap align=\"right\"><strong>"
."      <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."       Establecimiento:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
." <select name=\"id_estab\" >"
."<option value=\"\">No selecciona</option>";
   do {
      echo "<option value=\"".$row_rse['id']."\">".$row_rse['nombre']."</option>";
   } while($row_rse=mysql_fetch_assoc($rse));
   echo "</select></td></tr>"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."      <td nowrap align=\"right\">&nbsp;</td>"
."      <td><input type=\"submit\" value=\"Insertar Registro\"></td>"
."    </tr>"
."  </table>"
."  <input type=\"hidden\" name=\"MM_insert\" value=\"form1\">"
."</form>";
}// fin de ingusu
// función que modifica datos
function modusu(){
$vid_rsu = 1;
if (isset($_POST['id'])) {
  $vid_rsu = (get_magic_quotes_gpc()) ? $_POST['id'] : addslashes($_POST['id']);
}
$query_rse = sprintf("SELECT * FROM establecimiento order by nombre");
$rse = safe_query($query_rse);
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);

$query_rsu = sprintf("SELECT * FROM usuarios where id=%s", $vid_rsu);
$rsu = safe_query($query_rsu);
$row_rsu = mysql_fetch_assoc($rsu);
$totalRows_rsu = mysql_num_rows($rsu);
echo "<form method=\"post\" name=\"form1\" action=\"index.php?page=adminusu&file=index&func=grabamod\""
." onsubmit=\"return forminputsubmit();\">"
."  <table align=\"center\">"
."    <caption>"
."    <strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."   Modifica usuario</font></strong> "
."    </caption>"
."    <tr valign=\"baseline\"> "
."  <td nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."      Nombre:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."        <input type=\"text\" name=\"nombre\" value=". $row_rsu['nombre']." size=\"32\">"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."   <td nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."      Password:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input type=\"password\" name=\"password\" value=". $row_rsu['password']." size=\"32\">"
."        </font> </strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."   <td nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Reintentar "
."        Password:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input type=\"password\" name=\"password2\" value=".$row_rsu['password'] ." size=\"32\">"
."        </font></strong></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."      <td nowrap align=\"right\">"
."<strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Nivel:</font></strong></td>"
."      <td> <strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <select name=\"nivel\">"
."          <option value=\"administrador\" " ;
 if (!(strcmp( $row_rsu['nivel'], "administrador"))) {echo "SELECTED"; }
   echo     ">"
   ."         Administrador</option>"
   ."     <option value=\"direccion\" ";
 if (!(strcmp( $row_rsu['nivel'], "direccion"))) {echo "SELECTED";} 
  echo ">Direccion</option>"
   ."       <option value=\"establecimiento\" ";
 if (!(strcmp( $row_rsu['nivel'], "establecimiento"))) {echo "SELECTED";}
  echo ">Establecimiento</option>"
  ."     </select>"
  ."      </font></strong></td>"
  ." </tr>"
  ."  <tr valign=\"baseline\"> "
  ."    <td nowrap align=\"right\"><strong>"
  ."    <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
  ."    Descripcion:</font></strong></td>"
  ."    <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
  ."      <input type=\"text\" name=\"descripcion\" value=\"". $row_rsu['descripcion']."\" size=\"32\">"
  ."      </font></strong></td>"
   ." </tr>"
."    <tr valign=\"baseline\">" 
."      <td nowrap align=\"right\"><strong>"
."      <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."       Establecimiento:</font></strong></td>"
."      <td><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
." <select name=\"id_estab\">"
."<option value=\"\">No selecciona</option>";
   do {
      echo "<option value=\"".$row_rse['id']."\"";
      if(strcmp($row_rse['id'],$row_rsu['id_estab'])==0){
         echo " SELECTED ";
      }
   echo ">".$row_rse['nombre']."</option>";
   } while($row_rse=mysql_fetch_assoc($rse));
   echo "</select></td></tr>"
."        </font></strong></td>"
."    </tr>"

  ."  <tr valign=\"baseline\">" 
 ."     <td nowrap align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
 ."    &nbsp;</font></td>"
 ."     <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
 ."       <input type=\"submit\" value=\"Actualizar registro\">"
."        </font></td>"
."    </tr>"
."  </table>"
."  <input type=\"hidden\" name=\"id\" value=". $row_rsu['id'].">"
."</form>";   
} // fin de modusu
// funcion que llama a las demáa
function manusu(){
$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];
$maxRows_rsm = 15;
$pageNum_rsm = 0;
if (isset($HTTP_GET_VARS['pageNum_rsm'])) {
  $pageNum_rsm = $HTTP_GET_VARS['pageNum_rsm'];
}
$startRow_rsm = $pageNum_rsm * $maxRows_rsm;
$query_rsm = "SELECT usuarios.nombre, usuarios.nivel, usuarios.descripcion FROM usuarios ORDER BY usuarios.nombre";
$query_limit_rsm = sprintf("%s LIMIT %d, %d", $query_rsm, $startRow_rsm, $maxRows_rsm);
$rsm =safe_query($query_limit_rsm);
$row_rsm = mysql_fetch_assoc($rsm);

if (isset($HTTP_GET_VARS['totalRows_rsm'])) {
  $totalRows_rsm = $HTTP_GET_VARS['totalRows_rsm'];
} else {
  $all_rsm = mysql_query($query_rsm);
  $totalRows_rsm = mysql_num_rows($all_rsm);
}
$totalPages_rsm = (int)($totalRows_rsm/$maxRows_rsm);$maxRows_rsm = 15;
$pageNum_rsm = 0;
if (isset($HTTP_GET_VARS['pageNum_rsm'])) {
  $pageNum_rsm = $HTTP_GET_VARS['pageNum_rsm'];
}
$startRow_rsm = $pageNum_rsm * $maxRows_rsm;

$query_rsm = "SELECT usuarios.nombre, usuarios.nivel, usuarios.descripcion,id FROM usuarios ORDER BY usuarios.nombre";
$query_limit_rsm = sprintf("%s LIMIT %d, %d", $query_rsm, $startRow_rsm, $maxRows_rsm);
$rsm = safe_query($query_limit_rsm);
$row_rsm = mysql_fetch_assoc($rsm);

if (isset($HTTP_GET_VARS['totalRows_rsm'])) {
  $totalRows_rsm = $HTTP_GET_VARS['totalRows_rsm'];
} else {
  $all_rsm = mysql_query($query_rsm);
  $totalRows_rsm = mysql_num_rows($all_rsm);
}
$totalPages_rsm = (int)($totalRows_rsm/$maxRows_rsm);

$queryString_rsm = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsm") == false && 
        stristr($param, "totalRows_rsm") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsm = "&" . implode("&", $newParams);
  }
}
$queryString_rsm = sprintf("&totalRows_rsm=%d%s", $totalRows_rsm, $queryString_rsm);

echo "<table width=\"600\"   border=\"1\" align=\"center\">"
."<caption>"
."  <strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."  Lista de Usuarios</font></strong> "
."  </caption>"
."  <tr>" 
."    <td width=\"95\" height=\"20\"><strong>"
."    <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Nombre</font></strong></td>"
."    <td width=\"107\"> "
."      <div align=\"left\"><strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Nivel</font></strong></div></td>"
."    <td width=\"140\"><strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Descripcion</font></strong></td>"
."    <td colspan=\"2\"> "
."    <div align=\"center\"><strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Opciones</font></strong></div></td>"
."  </tr>";
  do { 
  echo "<tr>" 
  ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
  . $row_rsm['nombre'] ."</font></td>"
  ."  <td><div align=\"left\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
  . $row_rsm['nivel']."</font></div></td>"
  ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
  . $row_rsm['descripcion']."</font></td>"
  ."  <td width=\"90\">" 
  ." <div align=\"center\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
  ."      <form action=\"index.php?page=adminusu&file=index&func=modusu\" method=\"post\" name=\"fa\" id=\"fa\">"
 ."       <input name=\"id\" type=\"hidden\" value=\"". $row_rsm['id']."\">"
 ."         <input name=\"editar\" type=\"submit\" id=\"editar\" value=\"Editar\">"
 ."       </form>"     
."        </font></div></td>"
 ."   <td width=\"90\">"
 ."     <form action=\"index.php?page=adminusu&file=index&func=eliusu\" method=\"post\" name=\"fe\" id=\"fe\" "
 ."     onSubmit=\"if(!confirm('¿Desea eliminar?'))return false;\"> "
 ."         <input name=\"ide\" type=\"hidden\" value=\"". $row_rsm['id']."\">"
 ."         <input name=\"eliminar\" type=\"submit\" id=\"eliminar\" value=\"Eliminar\">"
."        </form></td>"
."  </tr>";
 } while ($row_rsm = mysql_fetch_assoc($rsm));
echo "</table>"
."<div align=\"center\">"
."  <form action=\"index.php?page=adminusu&file=index&func=ingusu\" method=\"post\" name=\"fi\" id=\"fi\">"
."<input name=\"agregar\" type=\"submit\" id=\"agregar\" value=\"Agregar usuario\">"
."</form>"
."</div>"
."<table border=\"0\" width=\"50%\" align=\"center\">"
."  <tr>" 
."    <td width=\"23%\" align=\"center\">";
    if ($pageNum_rsm > 0) { 
 echo "<a href=";
   printf("%s?pageNum_rsm=%d%s", $currentPage, 0, $queryString_rsm);
 echo ">"
   ." <img src=\"First.gif\" border=0></a> ";
       } 
 echo "   </td>"
  ."  <td width=\"31%\" align=\"center\"> ";
    if ($pageNum_rsm > 0) { 
 echo "<a href=";
 printf("%s?pageNum_rsm=%d%s", $currentPage, max(0, $pageNum_rsm - 1), $queryString_rsm);
echo ">"
   ."   <img src=\"Previous.gif\" border=0></a>"; 
       } 
 echo "    </td>"
 ."   <td width=\"23%\" align=\"center\">"; 
  if ($pageNum_rsm < $totalPages_rsm) { 
 echo "<a href=";
  printf("%s?pageNum_rsm=%d%s", $currentPage, min($totalPages_rsm, $pageNum_rsm + 1), $queryString_rsm);
 echo ">"
 ."<img src=\"Next.gif\" border=0></a> ";
      }
echo "    </td>"
 ."   <td width=\"23%\" align=\"center\">";
  if ($pageNum_rsm < $totalPages_rsm) { 
  echo " <a href=";
  printf("%s?pageNum_rsm=%d%s", $currentPage, $totalPages_rsm, $queryString_rsm);
 echo ">"
   ." <img src=\"Last.gif\" border=0></a>"; 
       } 
 echo "    </td>"
 ." </tr>"
."</table>";
mysql_free_result($rsm);
} // fin de manusu
//Selección de funciones
switch ($func){
 default:
  manusu();
  break;
 case "ingusu":
  ingusu();
  break;
 case "modusu":
  modusu();
  break;
 case "eliusu":
  eliusu();
  break;
 case "grabaing":
  grabaing();
  break;
 case "grabamod":
  grabamod();
  break;
}
?>
<script type="text/javascript">
function forminputsubmit(){
  if (document.form1.nombre.value=="" ){
     alert("El nombre del usuario debe ser ingresado");
     return false;
  }
  if (document.form1.password.value!=document.form1.password2.value && document.form1.password2.value!=""){
     alert("La clave y su reintento deben coincidir");
     return false;
 }
  if( document.form1.password.value=="" ){
     alert("La clave debe ser ingresada");
     return false;
  }
  return true;
}
</script>
