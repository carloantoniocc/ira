<?php require_once('file:///C|/AppServ/www/moviliza/Connections/ira.php'); ?>
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

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE establecimiento SET nombre=%s, tipo=%s, comuna=%s, telefono=%s, encargado=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['nombre'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['tipo'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['comuna'], "int"),
                       GetSQLValueString($HTTP_POST_VARS['telefono'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['encargado'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"));

  mysql_select_db($database_ira, $ira);
  $Result1 = mysql_query($updateSQL, $ira) or die(mysql_error());
}

mysql_select_db($database_ira, $ira);
$query_rsc = "SELECT * FROM comuna ORDER BY comuna.nombre";
$rsc = mysql_query($query_rsc, $ira) or die(mysql_error());
$row_rsc = mysql_fetch_assoc($rsc);
$totalRows_rsc = mysql_num_rows($rsc);

$vid_rse = 1;
if (isset($_GET['id'])) {
  $vid_rse = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_ira, $ira);
$query_rse = sprintf("SELECT * FROM establecimiento WHERE establecimiento.id=%s", $vid_rse);
$rse = mysql_query($query_rse, $ira) or die(mysql_error());
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);
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
    <strong><font color="#0000CC">Actualiza Registro Establecimiento</font></strong> 
    </caption>
    <tr valign="baseline"> 
      <td nowrap align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Nombre:</strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <input type="text" name="nombre" value="<?php echo $row_rse['nombre']; ?>" size="32">
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tipo:</strong></font></td>
      <td> <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <select name="tipo">
          <option value="urbano" <?php if (!(strcmp(<?php echo $row_rse['tipo']; ?>, "urbano"))) {echo "SELECTED";} ?>>urbano</option>
          <option value="provincial" <?php if (!(strcmp(<?php echo $row_rse['tipo']; ?>, "provincial"))) {echo "SELECTED";} ?>>provincial</option>
          <option value="sapu" <?php if (!(strcmp(<?php echo $row_rse['tipo']; ?>, "sapu"))) {echo "SELECTED";} ?>>sapu</option>
          <option value="otro" <?php if (!(strcmp(<?php echo $row_rse['tipo']; ?>, "otro"))) {echo "SELECTED";} ?>>otro</option>
        </select>
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Comuna:</strong></font></td>
      <td> <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <select name="comuna">
          <?php 
do {  
?>
          <option value="<?php echo $row_rsc['id']?>" <?php if (!(strcmp($row_rsc['id'], $row_rse['comuna']))) {echo "SELECTED";} ?>><?php echo $row_rsc['nombre']?></option>
          <?php
} while ($row_rsc = mysql_fetch_assoc($rsc));
?>
        </select>
        </strong></font></td>
    <tr> 
    <tr valign="baseline"> 
      <td nowrap align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Telefono:</strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <input type="text" name="telefono" value="<?php echo $row_rse['telefono']; ?>" size="32">
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Encargado:</strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <input type="text" name="encargado" value="<?php echo $row_rse['encargado']; ?>" size="32">
        </strong></font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong></strong></font></td>
      <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        <input type="submit" value="Actualiza registro">
        </strong></font></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_rse['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsc);

mysql_free_result($rse);
?>
