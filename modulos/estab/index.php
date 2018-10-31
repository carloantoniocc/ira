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
function formulin(){
$query_rsc = "SELECT * FROM comuna ORDER BY comuna.nombre";
$rsc = safe_query($query_rsc, $ira) or die(mysql_error());
$row_rsc = mysql_fetch_assoc($rsc);
$totalRows_rsc = mysql_num_rows($rsc);
print <<<EOQ
  <form method="post" name="form1" action="index.php?page=estab&file=index&func=inserta">
  <table align="center">
    <caption>
    <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Agrega 
    nuevo establecimiento de Urgencia </strong></font> 
    </caption>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong>
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombre:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="text" name="nombre" value="" size="32">
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong>
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipo:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="tipo" id="tipo">
          <option value="urbano">urbano</option>
          <option value="provincial">provincial</option>
          <option value="sapu">sapu</option>
          <option value="otro">otro</option>
        </select>
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong>
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Comuna:</font></strong></td>
      <td> <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="comuna">
EOQ;
    do {  
      echo  " <option value=\"".$row_rsc['id']."\" >".$row_rsc['nombre']."</option>";
    } while ($row_rsc = mysql_fetch_assoc($rsc));
print <<<EOQ
        </select>
        </font></strong></td>
    <tr> 
    <tr valign="baseline"> 
      <td nowrap align="right"><strong>
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Telefono:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="telefono" type="text" value="" size="10" maxlength="10">
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong>
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Encargado:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="encargado" type="text" value="" size="21" maxlength="21">
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">
      <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="submit" value="Inserta Registro">
        </font></strong></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
EOQ;
mysql_free_result($rsc);
}
function inserta(){
  $insertSQL = sprintf("INSERT INTO establecimiento (nombre, tipo, comuna, telefono, encargado) 
                      VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['comuna'], "int"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['encargado'], "text"));
  $Result1 =safe_query($insertSQL);
  header("Location: index.php?page=estab&file=index");
}
function formulup(){
$query_rsc = "SELECT * FROM comuna ORDER BY comuna.nombre";
$rsc = safe_query($query_rsc);
$row_rsc = mysql_fetch_assoc($rsc);
$totalRows_rsc = mysql_num_rows($rsc);

//$vid_rse = 1;
if (isset($_GET['id'])) {
  $vid_rse = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
$query_rse = sprintf("SELECT * FROM establecimiento WHERE establecimiento.id=%s", $vid_rse);
$rse = safe_query($query_rse);
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);
print <<<EOQ
<form method="post" name="form1" action="index.php?page=estab&file=index&func=modifica">
  <table align="center">
    <caption>
    <strong><font color="#0000CC">Actualiza Registro Establecimiento</font></strong> 
    </caption>
    <tr valign="baseline"> 
      <td nowrap align="right">
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Nombre:</strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
   echo "<input type=\"text\" name=\"nombre\" value=\"".$row_rse['nombre']."\" size=\"32\">";
print <<<EOQ
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tipo:</strong></font></td>
      <td> <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <select name="tipo">
EOQ;
echo " <option value=\"urbano\" ";
       if (!(strcmp($row_rse['tipo'], "urbano"))) {echo "SELECTED";} 
echo ">urbano</option>"
     ."     <option value=\"provincial\" ";
       if (!(strcmp($row_rse['tipo'], "provincial"))) {echo "SELECTED";} 
echo ">provincial</option>"
      ."    <option value=\"sapu\" ";
      if (!(strcmp($row_rse['tipo'], "sapu"))) {echo "SELECTED";} 
echo ">sapu</option>"
     ."     <option value=\"otro\" ";
      if (!(strcmp($row_rse['tipo'], "otro"))) {echo "SELECTED";} 
print <<<EOQ
      >otro</option>
        </select>
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">
     <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Comuna:</strong></font></td>
      <td> <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <select name="comuna">
EOQ;
     do {  
      echo "<option value=\"". $row_rsc['id']."\"" ;
     if (!(strcmp($row_rsc['id'], $row_rse['comuna']))) {echo "SELECTED";} 
      echo ">". $row_rsc['nombre']."</option>";
} while ($row_rsc = mysql_fetch_assoc($rsc));
print <<<EOQ
        </select>
        </strong></font></td>
    <tr> 
    <tr valign="baseline"> 
      <td nowrap align="right">
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>Telefono:</strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
  echo " <input type=\"text\" name=\"telefono\" value=\"".$row_rse['telefono']."\" size=\"32\">";
print <<<EOQ
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>Encargado:</strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
   echo "<input type=\"text\" name=\"encargado\" value=\"". $row_rse['encargado']."\" size=\"32\">";
print <<<EOQ
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">
      <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong></strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <input type="submit" value="Actualiza registro">
        </strong></font></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
EOQ;
  echo "<input type=\"hidden\" name=\"id\" value=\"". $row_rse['id']."\" >";
echo "</form>";
mysql_free_result($rsc);
mysql_free_result($rse);
}
function modifica(){
$updateSQL = sprintf("UPDATE establecimiento 
                         SET nombre=%s, tipo=%s, 
                             comuna=%s, telefono=%s,
                             encargado=%s 
                       WHERE id=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['comuna'], "int"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['encargado'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
  $Result1 = safe_query($updateSQL);
  header("Location: index.php?page=estab&file=index");
}
function lista(){
$query_rse = "SELECT e.*, c.nombre as comunac 
              FROM establecimiento e, comuna c 
              WHERE e.comuna=c.id 
              ORDER BY e.tipo, e.nombre";
$rse = safe_query($query_rse, $ira) or die(mysql_error());
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Establecimientos 
  Servicios de Urgencia <img src="imagenes/urg1.jpg" width="75" height="56" align="absmiddle"></font></strong> 
  </caption>
  <tr> 
    <td width="173"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Establecimiento</strong></font></td>
    <td width="101"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Comuna</strong></font></td>
    <td width="50"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tipo</strong></font></td>
    <td width="50"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Fono</strong></font></td>
    <td width="103"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Encargado</strong></font></td>
    <td width="50"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Editar</strong></font></td>
    <td width="43"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Borrar</strong></font></td>
  </tr>
EOQ;
  do { 
print <<<EOQ
  <tr> 
    <td><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
echo $row_rse['nombre'];
print <<<EOQ
</font></td>
    <td><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
 echo $row_rse['comunac']; 
print <<<EOQ
</font></td>
    <td><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
 echo $row_rse['tipo']; 
print <<<EOQ
</font></td>
    <td><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
 echo $row_rse['telefono']; 
print <<<EOQ
</font></td>
    <td><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
 echo $row_rse['encargado']; 
print <<<EOQ
</font></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
     echo "   <a href=\"index.php?page=estab&file=index&func=formulup&id=".$row_rse['id']."\">";
print <<<EOQ
          <img src="button_edit.png" alt="Editar" width="12" height="13" border="0"> 
        </a>  
        </font></div></td>
    <td><div align="center"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
    echo " <a href=\"index.php?page=estab&file=index&func=elimina?id=". $row_rse['id']."\">" ;
print <<<EOQ
           <img src="button_drop.png" border="0" alt="Eliminar" 
           onClick="if(!confirm('¿Desea eliminar?'))return false;" > 
        </a>
   </font></div></td>
  </tr>
EOQ;
  } while ($row_rse = mysql_fetch_assoc($rse));
print <<<EOQ
</table>
<form name="form1" method="post" action="index.php?page=estab&file=index&func=formulin">
  <div align="center">
    <input type="submit" name="Submit" value="Agrega nuevo servicio">
  </div>
</form>
EOQ;
mysql_free_result($rse);
}
function elimina(){
 $id=$_POST['id'];
 $mensajerror="";
 $query_rs=sprintf("select * from aturg_urbana where id_estab='%s'",$id);
 $rs=safe_query($query_rs);
 $row_rs=mysql_fetch_assoc($rs);
 $totalRows_rs=mysql_num_rows($rs);
 if($totalRows_rs>0)
 $mensajerror.="<li>No elimina, existen atenciones asociadas\n";

 if (empty($mensajerror)){
  $deleteSQL="delete from establecimiento where id=".$id;
  $result=safe_query($deleteSQL);
  header("Location: index.php?page=estab&file=index");
  }
   echo "<p><font color=red><b><ul> $mensajerror </ul>"
        ."No eliminó. Por favor reintente </p>";
}
switch ($func){
 default:
  lista();
  break;
 case "inserta":
  inserta();
  break;
 case "modifica":
  modifica();
  break;
 case "elimina":
  elimina();
  break;
 case "formulin":
  formulin();
  break;
 case "formulup":
  formulup();
  break;
}
?>
