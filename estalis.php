<?php require_once('Connections/ira.php'); ?>
<?php
mysql_select_db($database_ira, $ira);
$query_rse = "SELECT e.*, c.nombre as comunac FROM establecimiento e, comuna c WHERE e.comuna=c.id ORDER BY e.tipo, e.nombre";
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
<table width="550" border="0" align="center">
  <caption>
  <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Establecimientos 
  Servicios de Urgencia <img src="imagenes/urg1.jpg" width="75" height="56" align="absmiddle"></font></strong> 
  </caption>
  <tr> 
    <td width="123"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Establecimiento</strong></font></td>
    <td width="101"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Comuna</strong></font></td>
    <td width="71"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tipo</strong></font></td>
    <td width="53"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Fono</strong></font></td>
    <td width="74"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Encargado</strong></font></td>
    <td width="55"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Editar</strong></font></td>
    <td width="43"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Borrar</strong></font></td>
  </tr>
  <?php do { ?>
  <tr> 
    <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_rse['nombre']; ?></font></td>
    <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_rse['comunac']; ?></font></td>
    <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_rse['tipo']; ?></font></td>
    <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_rse['telefono']; ?></font></td>
    <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_rse['encargado']; ?></font></td>
    <td><div align="center"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <a href="index.php?page=estab&file=index&func=formulup&id=<?php echo $row_rse['id']; ?>">
          <img src="button_edit.png" alt="Editar" width="12" height="13" border="0"> 
        </a>  
        </font></div></td>
    <td><div align="center"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <a href="index.php?page=estab&file=index&func=elimina?id=<?php echo $row_rse['id']; ?>" >
           <img src="button_drop.png" border="0" alt="Eliminar" onClick="if(!confirm('¿Desea eliminar?'))return false;" > 
        </a>

   </font></div></td>
  </tr>
  <?php } while ($row_rse = mysql_fetch_assoc($rse)); ?>
</table>
<form name="form1" method="post" action="index.php?page=estab&file=index&func=formulin">
  <div align="center">
    <input type="submit" name="Submit" value="Agrega nuevo servicio">
  </div>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rse);
?>

