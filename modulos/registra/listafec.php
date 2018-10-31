<?php
include "header.php";
function listafec(){
//datos de la última semana
$date=date("Y-m-d");
list($Y,$m,$d)=explode('-',$date);
$fechai=date("Y-m-d",strtotime('-1 days',mktime(0,0,0,$m,$d,$Y)));
$query_rs = "SELECT id_estab, MAX(fecha) as fechamax
              from aturg_urbana 
              group by id_estab
              order by fechamax ";
$rs = safe_query($query_rs);
$totalRows_rs = mysql_num_rows($rs);
$rowe=mysql_fetch_assoc($rs);
print <<<EOQ
  <table width="500" border="0" align="center">
  <caption>
  <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
  Lista de Establecimientos por fecha último registro <img src="felix.jpg" width="80" heigth="60" align="absmiddle"><br>
  <font size="1">Fecha Esperada :  $fechai  </font></font></strong> 
  </caption>
  <tr bgcolor="#DDDDDD"> 
    <td width="191"> 
    <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">
    Nombre</font></strong></font></div></td>
    <td width="117"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">
    Ultima fecha registro</font></strong></font></div></td>
    <td width="74"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">
    Total Casos IRA</font></strong></font></div></td>
    <td width="100"> <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Correo</font></strong></font></div></td>
  </tr>
EOQ;
   do { 
  $query_rse = "SELECT e.nombre, fecha, email,
               bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       
               asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  
               neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  
               influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   
               larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +     
               resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym as totira 
               FROM aturg_urbana a , establecimiento e
               where a.id_estab = e.id
               and e.id=".$rowe['id_estab']." and fecha='".$rowe['fechamax']."'";
 $rse = safe_query($query_rse);
 $totalRows_rse = mysql_num_rows($rse);
 $row=mysql_fetch_assoc($rse);

echo "  <tr "; 
 if ( $row['fecha'] < $fechai ){ 
    echo " bgcolor=\"#FF0000\"";
 } 
   
 echo " > "
    ."<td><div align=\"left\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
    . $row['nombre']
    . "</font></div></td>"
    . "<td ><div align=\"center\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
    . $row['fecha'] 
    . "</font></div></td>"
    ."<td><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
    .$row['totira'] 
    ."</font></div></td>"
    ."<td><div align=\"center\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
    ."<a href=\"mailto:".$row['email']."\"><img src=\"email.gif\" border=\"0\"></a></font></div></td>"
    ." </tr>";
   } while ($rowe = mysql_fetch_assoc($rs)); 
echo "</table>";
} // fin funcion
switch($func){
  default:
    listafec();
    break;
}
?>