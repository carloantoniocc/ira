<?php 
ob_start();
session_start();
include "modulos.php"; 
?>
<html>
<head>
<title>Sitio: <?php getTitle(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="file:///C:/AppServ/www/moviliza/estilo_w1.css" rel="stylesheet" type="text/css">
</head>
<body LINK="#eeeeee" VLINK="#eeeeee" ALINK="#eeeeee">
<table align="center" width="60%" height="500" border="0" >
  <tr width="20%" valign="top">
    <td height="12%" colspan="2"> 
      <!--Cabecera-->
    <p align="center" class="tit-2"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?php getHeader(); ?>
       </font>
    </p>
    </td>
  </tr>
  <tr width="40%">
    <td width="10%" height="88%" valign="top" bordercolor="#000000" bgcolor="#eeeeee"> 
      <!--Navegaci&oacute;n-->
      <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?php getNav(); ?>
      &nbsp;</font>
    </td>
    <td width="90%" height="88%" valign="top"> 
      <!--Contenido-->
      <div align="left"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?php getContent(); ?>
      </font> </div>
    </td>
  </tr>
</table>
</body>
</html>
<?php
flush();
?>