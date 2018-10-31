<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body><form action="resumen.php" method="post" name="form1">

<table width="400" border="0"><caption>Resumen de Atenciones de Urgencia<br>
    Establecimiento: <?php echo $_SESSION['nombre']; ?>
    </caption>
  <tr>
    <td>Fecha desde:
      <input name="fechai" type="text" id="fechai" size="10" maxlength="10"></td>
    <td>Fecha hasta:
      <input name="fechat" type="text" id="fechat" size="10" maxlength="10"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>
</body>
</html>
