<?php
// Items a desplegar en la barra de navegación
function getNav(){
//echo "centinela:".$_SESSION['centinela'];
//session_start();
 echo "<strong>Men&uacute; de Navegaci&oacute;n</strong><br/><br/>";
 echo "<a href=\"index.php\">"
 ."<font id=\"ta\" style=\"color:blue;\" onMouseOver=\"Cambia('ta');\" onMouseOut=\"Vuelve('ta');\" >"
 ."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
 ."Inicio</font></a><br/><br/>";
 //echo "<a href=\"index.php?page=catalogo&file=index\">Cat&aacute;logo</a><br/>";
 if(empty($_SESSION['nombreusuario'])){
    echo "<a href=\"index.php?page=admin&file=login\">"
    ."<font id=\"t0\" style=\"color:blue;\" onMouseOver=\"Cambia('t0');\" onMouseOut=\"Vuelve('t0');\" >"
    ."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Log In</font></a><br/>";
 } else {
   if(strcmp($_SESSION['nivelautorizado'],'establecimiento')==0||strcmp($_SESSION['nivelautorizado'],'direccion')==0 )
   {
    echo "<strong>Registro:</strong><br/>";
    echo "<a href=\"index.php?page=ayuda&file=ayuda\">"
    ."<font id=\"t1\" style=\"color:blue;\" onMouseOver=\"Cambia('t1');\" onMouseOut=\"Vuelve('t1');\" >"
 ."&nbsp;<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;&nbsp;&nbsp;"
    ."Ver instrucciones</font></a><br/>";
	
if($_SESSION['centinela']==1||strcmp($_SESSION['nivelautorizado'],'direccion')==0 )
//if($_SESSION['id_estab']==1||$_SESSION['id_estab']==3||strcmp($_SESSION['nivelautorizado'],'direccion')==0 )
    echo "<a href=\"index.php?page=registra&file=indexn\">"
    ."<font id=\"t2\" style=\"color:blue;\" onMouseOver=\"Cambia('t2');\" onMouseOut=\"Vuelve('t2');\" >"
   ."&nbsp;<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;&nbsp;&nbsp;"
    ."Registrar</font></a><br/>";
	else
	 echo "<a href=\"index.php?page=registra&file=index\">"
    ."<font id=\"t2\" style=\"color:blue;\" onMouseOver=\"Cambia('t2');\" onMouseOut=\"Vuelve('t2');\" >"
   ."&nbsp;<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;&nbsp;&nbsp;"
    ."Registrar</font></a><br/>";
	 
    echo "<br/><strong>Resumenes:</strong><br/>";
    echo "<a href=\"index.php?page=resumen&file=index\">"
    ."<font id=\"t3\" style=\"color:blue;\" onMouseOver=\"Cambia('t3');\" onMouseOut=\"Vuelve('t3');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
    ."x Establec.</font></a><br/>";
	echo "<a href=\"index.php?page=resumen&file=resumes\">"
    ."<font id=\"t3\" style=\"color:blue;\" onMouseOver=\"Cambia('t3');\" onMouseOut=\"Vuelve('t3');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
    ."x Año/Mes</font></a><br/>";
    if(strcmp($_SESSION['nivelautorizado'],'direccion')==0)
       echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=resumen&file=resumen\">"
      ."<font id=\"t4\" style=\"color:blue;\" onMouseOver=\"Cambia('t4');\" onMouseOut=\"Vuelve('t4');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
      ."Agrupado x</font></a><br/>";
	  
       echo "<br/><strong>Gráficos:</strong><br/>";
       echo "<a href=\"index.php?page=grafico&file=index\">"
      ."<font id=\"t5\" style=\"color:blue;\" onMouseOver=\"Cambia('t5');\" onMouseOut=\"Vuelve('t5');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
      ."Rango de días</font></a><br/>";
    if(strcmp($_SESSION['nivelautorizado'],'direccion')==0)
       echo "<a href=\"index.php?page=grafico&file=canale2\">"
      ."<font id=\"t6\" style=\"color:blue;\" onMouseOver=\"Cambia('t6');\" onMouseOut=\"Vuelve('t6');\" >"
 		."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
      ."Canal Endemico</font></a><br/>";
    if(strcmp($_SESSION['nivelautorizado'],'establecimiento')==0)
       echo "<a href=\"canalendemico2007.php?id=".$_SESSION['id_estab']."&nom=".$_SESSION['nombre']."\">"
      ."<font id=\"t7\" style=\"color:blue;\" onMouseOver=\"Cambia('t7');\" onMouseOut=\"Vuelve('t7');\" >"
 		."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
      ."Canal Endemico</font></a><br/>";
    echo "<br/><strong>Indicadores:</strong><br/>";
    echo "<a href=\"index.php?page=indicadores&file=index\">"
    ."<font id=\"t8\" style=\"color:blue;\" onMouseOver=\"Cambia('t8');\" onMouseOut=\"Vuelve('t8');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ver indicadores</font></a><br/>";
    echo "<br/><strong>Mapa:</strong><br/>";
    echo "<a href=\"index.php?page=mapa&file=Mpa\">"
    ."<font id=\"t9\" style=\"color:blue;\" onMouseOver=\"Cambia('t9');\" onMouseOut=\"Vuelve('t9');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ver mapa</font></a><br/>";
    echo "<br/><strong>Revision:</strong><br/>";
    echo "<a href=\"index.php?page=registra&file=listafec\">"
    ."<font id=\"t10\" style=\"color:blue;\" onMouseOver=\"Cambia('t10');\" onMouseOut=\"Vuelve('t10');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ultimos Registros</font></a><br/>";

   }
 if(strcmp($_SESSION['nivelautorizado'],'administrador')==0 ){
    echo "<strong>Registro:</strong><br/>";
    echo "<a href=\"index.php?page=ayuda&file=ayuda\">"
    ."<font id=\"t11\" style=\"color:blue;\" onMouseOver=\"Cambia('t11');\" onMouseOut=\"Vuelve('t11');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ver instrucciones</font></a><br/>";
    echo "<a href=\"index.php?page=registra&file=indexn\">"
    ."<font id=\"t12\" style=\"color:blue;\" onMouseOver=\"Cambia('t12');\" onMouseOut=\"Vuelve('t12');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Registrar</font></a><br/>";
    echo "<br/><strong>Resumenes:</strong><br/>";
    echo "<a href=\"index.php?page=resumen&file=index\">"
    ."<font id=\"t13\" style=\"color:blue;\" onMouseOver=\"Cambia('t13');\" onMouseOut=\"Vuelve('t13');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."x Establec.</font></a><br/>";
	echo "<a href=\"index.php?page=resumen&file=resumes\">"
    ."<font id=\"t3\" style=\"color:blue;\" onMouseOver=\"Cambia('t3');\" onMouseOut=\"Vuelve('t3');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>&nbsp;"
    ."x Año/Mes</font></a><br/>";
    echo "<a href=\"index.php?page=resumen&file=resumen\">"
    ."<font id=\"t14\" style=\"color:blue;\" onMouseOver=\"Cambia('t14');\" onMouseOut=\"Vuelve('t14');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Agrupados x</font></a><br/>";
    echo "<br/><strong>Gráficos:</strong><br/>";
    echo "<a href=\"index.php?page=grafico&file=index\">"
    ."<font id=\"t15\" style=\"color:blue;\" onMouseOver=\"Cambia('t15');\" onMouseOut=\"Vuelve('t15');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Rango de dias</font></a><br/>";
    echo "<a href=\"index.php?page=grafico&file=canale2\">"
    ."<font id=\"t16\" style=\"color:blue;\" onMouseOver=\"Cambia('t16');\" onMouseOut=\"Vuelve('t16');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Canal Endemico</font></a><br/>";
    echo "<br/><strong>Indicadores:</strong><br/>";
    echo "<a href=\"index.php?page=indicadores&file=index\">"
    ."<font id=\"t17\" style=\"color:blue;\" onMouseOver=\"Cambia('t17');\" onMouseOut=\"Vuelve('t17');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ver indicadores</font></a><br/>";
    echo "<br/><strong>Mapa:</strong><br/>";
    echo "<a href=\"index.php?page=mapa&file=Mpa\">"
    ."<font id=\"t18\" style=\"color:blue;\" onMouseOver=\"Cambia('t18');\" onMouseOut=\"Vuelve('t18');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ver mapa</font></a><br/>";
    echo "<br/><strong>Revision:</strong><br/>";
    echo "<a href=\"index.php?page=registra&file=listafec\">"
    ."<font id=\"t19\" style=\"color:blue;\" onMouseOver=\"Cambia('t19');\" onMouseOut=\"Vuelve('t19');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ultimos Registros</font></a><br/>";
    echo "<br/><strong>Administraci&oacute;n:</strong><br/>";

    echo "<a href=\"index.php?page=estab&file=index\">"
    ."<font id=\"t20\" style=\"color:blue;\" onMouseOver=\"Cambia('t20');\" onMouseOut=\"Vuelve('t20');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Establecimientos</font></a><br/>";
    echo "<a href=\"index.php?page=adminusu&file=index\">"
    ."<font id=\"t21\" style=\"color:blue;\" onMouseOver=\"Cambia('t21');\" onMouseOut=\"Vuelve('t21');\" >"
 	."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Ctas. Usuarios</font></a><br/>";
    }
//    echo "<a href="index.php?page=admin&file=index&func=logout">Log Out</a><br/>";
echo "<br/>";
echo "<a href=\"index.php?page=admin&file=logout\">"
    ."<font id=\"t22\" style=\"color:blue;\" onMouseOver=\"Cambia('t22');\" onMouseOut=\"Vuelve('t22');\" >"
 ."<img src=\"ICONO.gif\" align=\"absmiddle\" border=0>"
    ."Log Out</font></a><br/>";
 }

}
//Obtiene nombre de la página
function getTitle(){
 echo ucfirst($_GET['page']);
}
//Obtiene Cabecera de la página 
function getHeader(){
echo "<table width=\"760\" align=\"center\">"
."<tr ><td width=\"20%\" align=\"center\">"
."<img src=\"imagenes/logo.png\" width=\"98\" height=\"100\" ></td>"
."<td width=\"60%\" align=\"center\">"
."<font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."<strong>Sistema de Registro y Estadísticas de Enfermedades Respiratorias Agudas</br></br>"
."<i>Direcci&oacute;n Servicio de Salud Metropolitano Occidente</i></strong></font></td>"
."<td width=\"20%\" align=\"center\">"
."<img src=\"imagenes/ira2.jpg\"  ></td></tr>"
."<tr><td colspan=\"3\"><hr></td>"
."</tr></table>";
}
//construye paso de la página y la incluye en el contenido
function getContent(){
 global $func;
 if(empty($_GET['file'])){
   $modpath='inicio.php';
 }
  else
 {
   $page="";
   $file="";
   $func="";
   $modpath="";
   $page = $_GET['page'];
   $file = $_GET['file'];
   $func = $_GET['func'];
   $modpath="modulos/$page/$file.php";
   if(false==is_file($modpath)){
      $modpath = 'file_not_found.php';
   }
 }
 include($modpath);
}
//Obtiene el píe de página
function getFooter(){
echo "Para contactarnos, marque este enlace";
}
?>
<script type="text/javascript">
function Cambia(capa){
 var orden="";
 orden=capa + ".style.color";
 eval(orden+"='red'");
 return true;
}
function Vuelve(capa){
 var orden="";
 orden=capa + ".style.color";
 eval(orden+"='blue'");
 return true;
}
</script>
