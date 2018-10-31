<?php
include "header.php";
//Autenticarse con el sistema
function login(){
echo " <form method=\"POST\" action=\"fijasesion.php\">"
."<table width=\"500\" align=\"center\">"
."<caption><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Por favor, ingrese su nombre de usuario y contraseña <img src=\"imagenes/ira4.jpg\" align=\"absmiddle\"></font></caption>"
. "<tr> <td align=\"right\">"
."<font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Nombre:</font></td><td><input type=\"text\" name=\"nombreusuario\"></td></tr>"
. "<tr><td align=\"right\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Password:</font></td><td><input type=\"password\" name=\"passwdusuario\"></td></tr>"
. "<tr><td colspan=\"2\" align=\"center\"> <input type=\"submit\" name=\"submit\" value=\"Login\">"
."</td></tr>"
."<tr><td>&nbsp;</td></tr>"
."<tr><td>&nbsp;</td></tr>"
."<tr><td>&nbsp;</td></tr>"

."<tr><td align=\"center\" colspan=\"2\"> <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Si extravió su contraseña y desea recuperarla, o bien solicitar una cuenta de usuario y contraseña"
.", solicitela a </font>"
." <a href=\"mailto:dsanchez@ssmoc.cl\"> "
." <img src=\"imagenes/email.gif\" width=\"32\" height=\"32\" border=\"0\" align=\"absmiddle\"></a>"
."</td></tr>"
."</table>"
. " </form>";
}
switch($func){
   default:
    login();
	break;
}
?>