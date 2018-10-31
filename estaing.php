<?php require_once('Connections/ira.php'); ?>
<?php
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

$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO establecimiento (nombre, tipo, comuna, telefono, encargado) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['nombre'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['tipo'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['comuna'], "int"),
                       GetSQLValueString($HTTP_POST_VARS['telefono'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['encargado'], "text"));

  mysql_select_db($database_ira, $ira);
  $Result1 = mysql_query($insertSQL, $ira) or die(mysql_error());
}

mysql_select_db($database_ira, $ira);
$query_rsc = "SELECT * FROM comuna ORDER BY comuna.nombre";
$rsc = mysql_query($query_rsc, $ira) or die(mysql_error());
$row_rsc = mysql_fetch_assoc($rsc);
$totalRows_rsc = mysql_num_rows($rsc);
?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <caption>
    <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Agrega 
    nuevo establecimiento de Urgencia </strong></font> 
    </caption>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombre:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="text" name="nombre" value="" size="32">
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipo:</font></strong></td>
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
      <td nowrap align="right"><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Comuna:</font></strong></td>
      <td> <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="comuna">
          <?php 
do {  
?>
          <option value="<?php echo $row_rsc['id']?>" ><?php echo $row_rsc['nombre']?></option>
          <?php
} while ($row_rsc = mysql_fetch_assoc($rsc));
?>
        </select>
        </font></strong></td>
    <tr> 
    <tr valign="baseline"> 
      <td nowrap align="right"><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Telefono:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="telefono" type="text" value="" size="10" maxlength="10">
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Encargado:</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="encargado" type="text" value="" size="21" maxlength="21">
        </font></strong></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
      <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="submit" value="Inserta Registro">
        </font></strong></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsc);
?>

