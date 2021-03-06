<?php
include "header.php";
// funcion que lista establecimientos
function estalis(){
if(($_SESSION['nivelautorizado']=='establecimiento')){
   $vid=$_SESSION['id_estab'];
   header("Location:index.php?page=indicadores&file=index&func=ingparam&id=".$vid."");
 } else {
$query_rsb = "SELECT *
             FROM establecimiento
             ORDER BY nombre";
$rsb = safe_query($query_rsb);
$row_rsb = mysql_fetch_assoc($rsb);
$totalRows_rsb = mysql_num_rows($rsb);
print <<<EOQ
<table width="400" border="0" align="center">
  <caption>
  <strong><font color="#000099" size="1" face="Verdana, Arial, Helvetica, sans-serif">
  Lista de Establecimientos</font></strong> <img src="imagenes/urg4.jpg" width="99" height="71" align="absmiddle"> 
  </caption>
  <tr> 
    <td width="235"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Nombre</strong></font></td>
    <td width="100"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tipo</strong></font></td>
    <td width="51">
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Ver 
        Estab.</strong></font></div></td>
  </tr>
EOQ;
   $bgcolor1="#DDDDDD";
   $bgcolor2="#FFFFFF";
   $i=1;
   do { 
      $bgcolor=(bcmod( $i++,2)) ? $bgcolor1 : $bgcolor2; 
      echo " <tr bgcolor='". $bgcolor ."'> <td  >";
print <<<EOQ
 <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
 echo $row_rsb['nombre']; 
print <<<EOQ
</font></td>
    <td><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
 echo $row_rsb['tipo']; 
print <<<EOQ
</font></td>
    <td><div align="center"> 
EOQ;
echo "<a href=\"index.php?page=indicadores&file=index&func=ingparam&id=".
     $row_rsb['id']."&nom=".$row_rsb['nombre']."&tipo=".$row_rsb['tipo'] ."\" >"; 
print <<<EOQ
       <img src="button_select.png" alt="Ver establecimientos" width="14" height="13" border="0"> 
        </a> </div></td>
  </tr>
EOQ;
 } while ($row_rsb = mysql_fetch_assoc($rsb));
mysql_free_result($rsb);
 }
}
function indicadores(){

if (!isset($_SESSION['fechai']))
    $_SESSION['fechai']=$_POST['fechai'];
if (!isset($_SESSION['fechat']))
    $_SESSION['fechat']=$_POST['fechat'];

$fecha=$_POST['fechai'];
$dia=substr($fecha,0,2);
$mes=substr($fecha,3,2);
$ano=substr($fecha,6,4);
$fechai=$ano."-".$mes."-".$dia;
$fecha=$_POST['fechat'];
$dia=substr($fecha,0,2);
$mes=substr($fecha,3,2);
$ano=substr($fecha,6,4);
$fechat=$ano."-".$mes."-".$dia;

$query_rsh = "select sum(pbm1+pb1_9+pb10_14+pb15_64+pb65ym+pbotras +
                         pom1+po1_9+po10_14+po15_64+po65ym+pootras) as pediatria,
             sum(hbm1+hb1_9+hb10_14+hb15_64+hb65ym+hbotras +
                hom1+ho1_9+ho10_14+ho15_64+ho65ym+hootras +
                mbm1+mb1_9+mb10_14+mb15_64+mb65ym+mbotras +
                mom1+mo1_9+mo10_14+mo15_64+mo65ym+mootras ) as medicina,
             sum(utitm1+utit1_9+utit10_14+utit15_64+utit65ym+utitotras +
                 utibm1+utib1_9+utib10_14+utib15_64+utib65ym+utibotras +
                 ucibm1+ucib1_9+ucib10_14+ucib15_64+ucib65ym+ucibotras +
                 ucitm1+ucit1_9+ucit10_14+ucit15_64+ucit65ym+ucitotras ) as upc
            FROM hospitaliza
            where id_estab=".$_SESSION['id_estab'].
            " and fecha between '".$fechai."' and '".$fechat."'";

$query_rsf = "select sum(falli0a14 + falle0a14 + falleh0a14) as f0a14,
                     sum(falli15a64 + falle15a64 + falleh15a64) as f15a64,
                     sum(falli65a74 + falle65a74 + falleh65a74) as f65a74,
                     sum(falli75ym + falle75ym + falleh75ym) as f75ym
            FROM fallecidoh
            where id_estab=".$_SESSION['id_estab'].
            " and fecha between '".$fechai."' and '".$fechat."'";

$query_rs = "SELECT 
            sum(bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       
            asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  
            neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  
            influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   
            larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +     
            resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym +
            totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym +
            totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym) as toturg,

            sum(totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym) as totmed,

            sum(bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym) as totsbo,

            sum(neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym) as totneumo,  

            sum(bronq_m1 + asma_m1 + neumo_m1 + influ_m1 + larin_m1 +  resto_m1) as iram1,

            sum(bronq_65ym + asma_65ym + neumo_65ym + influ_65ym + larin_65ym +  resto_65ym) as ira65ym,

            sum(bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       
               asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  
               neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  
               influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   
               larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +     
               resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym) as totira 

            FROM aturg_urbana
            where id_estab=".$_SESSION['id_estab'].
            " and fecha between '".$fechai."' and '".$fechat."'";
$rs = safe_query($query_rs);
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
$toturg=$row_rs['toturg'];
$totira=$row_rs['totira'];
$totmed=$row_rs['totmed'];
$totsbo=$row_rs['totsbo'];
$totneumo=$row_rs['totneumo'];
$iram1=$row_rs['iram1'];
$ira65ym=$row_rs['ira65ym'];

$rsf = safe_query($query_rsf);
$row_rsf = mysql_fetch_assoc($rsf);
$totalRows_rsf = mysql_num_rows($rsf);
$f0a14=$row_rsf['f0a14'];
$f15a64=$row_rsf['f15a64'];
$f65a74=$row_rsf['f65a74'];
$f75ym=$row_rsf['f75ym'];

$rsh = safe_query($query_rsh);
$row_rsh = mysql_fetch_assoc($rsh);
$totalRows_rsh = mysql_num_rows($rsh);
$pediatria=$row_rsh['pediatria'];
$medicina=$row_rsh['medicina'];
$upc=$row_rsh['upc'];

if ($toturg>0){
   $ind1=($totira/$toturg)*100;
   $val1=number_format($ind1,2,",","."); }
else
   $val1="-";

if ($totmed>0){
   $ind2=($totira/($totmed + $totira))*100;
   $val2=number_format($ind2,2,",","."); }
else
   $val2="-";

if ($totira>0){
   $ind3=($totsbo/$totira)*100;
   $val3=number_format($ind3,2,",","."); }
else
   $val3="-";

if ($totneumo>0){
   $ind4=($totneumo/$totira)*100;
   $val4=number_format($ind4,2,",","."); }
else
   $val4="-";

if ($totira>0){
   $ind5=($iram1/$totira)*100;
   $val5=number_format($ind5,2,",","."); }
else
   $val5="-";

if ($totira>0){
   $ind6=($ira65ym/$totira)*100;
   $val6=number_format($ind6,2,",","."); }
else
   $val6="-";


print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
  Gesti�n IRA<br>
EOQ;
echo " <br>Establecimiento: <i>".$_SESSION['nombre']."</i> "
 ."&nbsp;&nbsp;Fecha: "
 ."<input name=\"f1\" type=\"text\" value=\"".$_POST['fechai']."\" size=\"10\" readonly=\"true\" maxlength=\"10\">"
 ." al " 
 ."<input name=\"f1\" type=\"text\" value=\"".$_POST['fechat']."\" size=\"10\" readonly=\"true\" maxlength=\"10\">";
print <<<EOQ
  </strong></font> 
  </caption>
  <tr bgcolor="#DDDDDD"> 
    <td width="320"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
     Indicador</strong></font></td>
    <td width="80"> 
      <div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
     Valor</strong></font></div></td>
    <td width="100">
      <div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
     Composici�n
     </strong></font></div>
    <td>  
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">% 
      consultas IRA / total consultas urgencia</font></strong></td>
    <td><div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
       <input name="ira1" type="text" value=$val1 size="6" readonly="true" maxlength="10">%</font></font></font></div></td>
    <td>
       <div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
         (<input name="ira1n" type="text" value=$totira size="6" readonly="true" maxlength="10">
          / 
           <input name="ira1d" type="text" value=$toturg  size="6" readonly="true" maxlength="10">) </font></font></font></div>
    </td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">% 
      consultas IRA / total consultas m&eacute;dicas</font></strong></td>
    <td><div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
         <input name="ira2" type="text" value=$val2 size="6" readonly="true" maxlength="10">%</font></font></font></div></td>
    <td>
       <div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
         ( <input name="ira2n" type="text" value=$totira size="6" readonly="true" maxlength="10"> 
          / 
         ( <input name="ira2d1" type="text" value=$totmed size="6" readonly="true" maxlength="10"> 
         + <input name="ira2d2" type="text" value=$totira size="6" readonly="true" maxlength="10">) )</font></font></font></div>
    </td>

  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">% 
      consultas Sind.Bron.Obs. / total consultas respirat.</font></strong></td>
    <td><div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="ira3" type="text" value=$val3 size="6" readonly="true" maxlength="10">%</font></font></font></div></td>
    <td>
       <div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
         ( <input name="ira3n" type="text" value=$totsbo size="6" readonly="true" maxlength="10"> 
          / 
           <input name="ira3d" type="text" value=$totira size="6" readonly="true" maxlength="10"> )</font></font></font></div>
    </td>

  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">% 
      consultas neumon&iacute;a / total consultas respiratorias</font></strong></td>
    <td><div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
         <input name="ira4" type="text" value=$val4 size="6" readonly="true" maxlength="10">%</font></font></font></div></td>
    <td>
       <div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
        (<input name="ira4n" type="text" value=$totneumo  size="6" readonly="true" maxlength="10">
         / 
          <input name="ira4d" type="text" value=$totira size="6" readonly="true" maxlength="10">)</font></font></font></div>
    </td>

  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">% 
      Consultas respiratorias por grupo etario:</font></strong></td>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><div align="right"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&lt; 
        1 a&ntilde;o:</font></div></td>
    <td><div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif">
     <input name="ira5" type="text" value=$val5 size="6" readonly="true" maxlength="10">%</font></font></font></div></td>
    <td>
       <div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
         ( <input name="ira5n" type="text" value=$iram1 size="6" readonly="true" maxlength="10"> 
          / 
           <input name="ira5d" type="text" value=$totira size="6" readonly="true" maxlength="10"> ) </font></font></font></div>
    </td>

  </tr>
  <tr> 
    <td><div align="right"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&gt; 
        65 a&ntilde;os:</font></div></td>
    <td><div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif">
    <input name="ira6" type="text" value=$val6 size="6" readonly="true" maxlength="10">%</font></font></font></div></td>
    <td>
       <div align="right"><font color="#0000CC"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"> 
        ( <input name="ira6n" type="text" value=$ira65ym size="6" readonly="true" maxlength="10">
         / 
         <input name="ira6d" type="text" value=$totira size="6" readonly="true" maxlength="10"> )</font></font></font></div>
    </td>

  </tr>
EOQ;
  if(strcmp($_SESSION['tipo'],'sapu')!=0){
print <<<EOQ
  <tr> 
    <td><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Hospitalizaciones</strong></font></td>
    <td><div align="right"><font color="#0000CC"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
  </tr>
  <tr> 
    <td><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Pediatr�a:
    </font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$pediatria</font></td>
  </tr>
  <tr> 
    <td><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Medicina:
    </font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$medicina</font></td>
  </tr>
  <tr> 
    <td><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">U.P.C.:
    </font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$upc</font></td>
  </tr>
EOQ;
}
print <<<EOQ
  <tr> 
    <td><strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Fallecidos 
      por IRA seg&uacute;n edad:</font></strong></td>
    <td><div align="right"></div></td>
  </tr>
  <tr> 
    <td><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">0-14 a�os:
    </font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$f0a14</font></td>
  </tr>
  <tr> 
    <td height="26"><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
    15-64a�os:</font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$f15a64</font></td>
  </tr>
  <tr> 
    <td height="26"><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
    65-74 a�os:</font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$f65a74</font></td>
  </tr>
  <tr> 
    <td height="26"><div align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">
   75 a�os y m�s:</font></div></td>
    <td align="right"><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">$f75ym</font></td>
  </tr>
</table>
EOQ;
} // fin funcion indicadores
// Ingresa parametros para resumir
function ingparam(){

if (isset($_GET['id']))
    $_SESSION['id_estab']=$_GET['id'];
if (isset($_GET['nom']))
    $_SESSION['nombre']=$_GET['nom'];
if (isset($_GET['tipo']))
    $_SESSION['tipo']=$_GET['tipo'];

echo "<body><form action=\"index.php?page=indicadores&file=index&func=indicadores\" method=\"post\" name=\"form1\">"
 ."<table width=\"550\" border=\"0\" align=\"center\">"
 ." <caption>"
 ." <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Indicadores sobre "
 ." las Atenciones de Urgencia<br>"
 ."Establecimiento:</strong>&nbsp;&nbsp;&nbsp;". $_SESSION['nombre']."</font>" 
 ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"imagenes/urg5.jpg\" width=\"100\" height=\"50\" align=\"absmiddle\">"
    ."</caption>"
    ."<tr> "
    ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha "
    ." desde (dd/mm/aaaa): "
    ."    <input name=\"fechai\" type=\"text\" onBlur=\"return esfecha(document.forms.form1.fechai)\" "
    ." value=\"".$_SESSION['fechai']."\" id=\"fechai\" size=\"10\" maxlength=\"10\">"
    ."  </strong>  </font></td>"
    ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha "
    ." hasta (dd/mm/aaaa) : "
    ."   <input name=\"fechat\" type=\"text\" onBlur=\"return esfecha(document.forms.form1.fechat)\" "
    ." value=\"".$_SESSION['fechat']."\" id=\"fechat\" size=\"10\" maxlength=\"10\">"
    ."  </strong> </font></td>"
    ."</tr>"
    ."<tr> "
    ." <td>&nbsp;</td>"
    ." <td><input type=\"submit\" name=\"Submit\" value=\"Resumir\"></td>"
    ."</tr>"
  ."</table>"
."</form>";
}
switch($func){
   default:
    estalis();
    break;
  case "ingparam":
    ingparam();
	break;
  case "indicadores":
   indicadores();
   break;
}
?>
<script type="text/javascript">
function esfecha(elemento) {
str = elemento.value;
len = str.length;
var diasmes=0;

if(len!=10){
	alert("su valor debe ser una fecha dd-mm-aaaa");
	return false;
	}

strdia = str.substring(0,2);
strmes = str.substring(3,5);
strano = str.substring(6,10);

 if ( isNaN(strdia) || (strdia < 0) || isNaN(strmes) || (strmes < 0) ||    isNaN(strano) || (strano < 0) ) {
	alert ("Valor debe ser una fecha v�lida");
      return false;
	}

if (strmes=="01" || strmes=="03" || strmes =="05" || strmes=="07"|| strmes == "08" || strmes == "10" || strmes=="12")
			diasmes = 31;
else if (strmes=="04" || strmes=="06" || strmes == "09" || strmes=="11")
			diasmes = 30;
else if (strmes=="02")
		diasmes = ((parseInt(strano) % 4) == 0 ) ? 29 : 28;
else {
		alert("Debe ser un mes entre 01 y 12");
		return false;
	}

if (strdia > diasmes){
	alert("El dia excede al mayor de ese mes");
	return false;
	}

	return true; 

}

function esfechav(elemento) {
str = elemento.value;
len = str.length;
var diasmes=0;

if(len!=10){
	alert("su valor debe ser una fecha aaaa-mm-dd");
	return false;
	}

strdia = str.substring(8,10);
strmes = str.substring(5,7);
strano = str.substring(0,4);

 if ( isNaN(strdia) || (strdia < 0) || isNaN(strmes) || (strmes < 0) ||    isNaN(strano) || (strano < 0) ) {
	alert ("Valor debe ser una fecha v�lida");
      return false;
	}

if (strmes=="01" || strmes=="03" || strmes =="05" || strmes=="07"|| strmes == "08" || strmes == "10" || strmes=="12")
			diasmes = 31;
else if (strmes=="04" || strmes=="06" || strmes == "09" || strmes=="11")
			diasmes = 30;
else if (strmes=="02")
		diasmes = ((parseInt(strano) % 4) == 0 ) ? 29 : 28;
else {
		alert("Debe ser un mes entre 01 y 12");
		return false;
	}

if (strdia > diasmes){
	alert("El dia excede al mayor de ese mes");
	return false;
	}

	return true; 

}

var tecla;
function capturaTecla(){
 tecla=event.keyCode;
 if(tecla==13)
  event.keyCode=9;
}
document.onkeydown = capturaTecla;
</script>
