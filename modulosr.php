<?php
// Items a desplegar en la barra de navegación
function getNav(){
//session_start();
 echo "<strong>Men&uacute; de Navegaci&oacute;n</strong><br/><br/>";
 echo "<a href=\"index.php\">Inicio</a><br/>";
 //echo "<a href=\"index.php?page=catalogo&file=index\">Cat&aacute;logo</a><br/>";
 if(empty($_SESSION['nombreusuario'])){
    echo "<a href=\"index.php?page=admin&file=login\">Log In</a><br/>";
 } else {
   if(strcmp($_SESSION['nivelautorizado'],'establecimiento')==0||strcmp($_SESSION['nivelautorizado'],'direccion')==0 )
   {
    echo "Registro:<br/>";
    echo "<a href=\"index.php?page=ayuda&file=ayuda\">Ver instrucciones</a><br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=registra&file=index\">Registrar</a><br/>";
    echo "Resumenes:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=resumen&file=index\">x Establec.</a><br/>";
  if(strcmp($_SESSION['nivelautorizado'],'direccion')==0)
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=resumen&file=resumen\">Agrupado x</a><br/>";
    echo "Gráficos:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=grafico&file=index\">Ver gráficos</a><br/>";
    echo "Indicadores:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=indicadores&file=index\">Ver indicadores</a><br/>";
    echo "Mapa:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=mapa&file=Mpa\">Ver mapa</a><br/>";

   }
 if(strcmp($_SESSION['nivelautorizado'],'administrador')==0 ){
    echo "Registro:<br/>";
    echo "<a href=\"index.php?page=ayuda&file=ayuda\">Ver instrucciones</a><br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=registra&file=index\">Registrar</a><br/>";
    echo "Resumenes:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=resumen&file=index\">x Establec.</a><br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=resumen&file=resumen\">Agrupados x</a><br/>";

    echo "Gráficos:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=grafico&file=index\">Ver gráficos</a><br/>";
    echo "Indicadores:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=indicadores&file=index\">Ver indicadores</a><br/>";
    echo "Mapa:<br/>";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=mapa&file=Mpa\">Ver mapa</a><br/>";

    echo "Administraci&oacute;n:<br/>";

    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=estab&file=index\">Establecimientos</a><br/>";

    echo "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=adminusu&file=index\">Ctas. Usuarios</a><br/>";
    }
//    echo "<a href="index.php?page=admin&file=index&func=logout">Log Out</a><br/>";
echo "<a href=\"index.php?page=admin&file=logout\">Log Out</a><br/>";
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
."<img src=\"imagenes/minsal1.jpg\" width=\"50\" height=\"50\" ></td>"
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
