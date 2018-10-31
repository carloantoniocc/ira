<?php
include "header.php";
// funcion que lista establecimientos
function estalis(){
if(($_SESSION['nivelautorizado']=='establecimiento')){
   $vid=$_SESSION['id_estab'];
   header("Location:index.php?page=resumen&file=index&func=ingparam&id=".$vid."");
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
echo "<a href=\"index.php?page=resumen&file=index&func=ingparam&id=".
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

function resumen(){
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
$fileExcel=$_SESSION['nombre'].".xls";
$fileExcel=str_replace(" ","_",$fileExcel);
$fp=fopen($fileExcel,"w");
$data="";
$query_rs = sprintf("SELECT  
                    sum(bronq_m1) bronq_m1,
                    sum(bronq_1a9) as bronq_1a9,
                    sum(bronq_10a14) as bronq_10a14,
                    sum(bronq_15a64) as bronq_15a64,
                    sum(bronq_65ym) as bronq_65ym,
                    sum(asma_m1) asma_m1,
                    sum(asma_1a9) as asma_1a9,
                    sum(asma_10a14) as asma_10a14,
                    sum(asma_15a64) as asma_15a64,
                    sum(asma_65ym) as asma_65ym,
                    sum(neumo_m1) neumo_m1,
                    sum(neumo_1a9) as neumo_1a9,
                    sum(neumo_10a14) as neumo_10a14,
                    sum(neumo_15a64) as neumo_15a64,
                    sum(neumo_65ym) as neumo_65ym,
                    sum(influ_m1) influ_m1,
                    sum(influ_1a9) as influ_1a9,
                    sum(influ_10a14) as influ_10a14,
                    sum(influ_15a64) as influ_15a64,
                    sum(influ_65ym) as influ_65ym,
                    sum(larin_m1) larin_m1,
                    sum(larin_1a9) as larin_1a9,
                    sum(larin_10a14) as larin_10a14,
                    sum(larin_15a64) as larin_15a64,
                    sum(larin_65ym) as larin_65ym,
					 sum(iraltas_m1) iraltas_m1,
                    sum(iraltas_1a9) as iraltas_1a9,
                    sum(iraltas_10a14) as iraltas_10a14,
                    sum(iraltas_15a64) as iraltas_15a64,
                    sum(iraltas_65ym) as iraltas_65ym,
                    sum(resto_m1) resto_m1,
                    sum(resto_1a9) as resto_1a9,
                    sum(resto_10a14) as resto_10a14,
                    sum(resto_15a64) as resto_15a64,
                    sum(resto_65ym) as resto_65ym,
                    sum(totm1) totm1,
                    sum(tot1a9) as tot1a9,
                    sum(tot10a14) as tot10a14,
                    sum(tot15a64) as tot15a64,
                    sum(tot65ym) as tot65ym,
                    sum(totsinm1) totsinm1,
                    sum(totsin1a9) as totsin1a9,
                    sum(totsin10a14) as totsin10a14,
                    sum(totsin15a64) as totsin15a64,
                    sum(totsin65ym) as totsin65ym,
                    sum(bronq_m1+bronq_1a9+bronq_10a14+bronq_15a64+bronq_65ym) as totgenbron,
                    sum(bronq_m1+bronq_1a9+bronq_10a14) as totinfbron,
                    sum(bronq_15a64+bronq_65ym) as totadubron,
                    sum(asma_m1+asma_1a9+asma_10a14+asma_15a64+asma_65ym) as totgenasma,
                    sum(asma_m1+asma_1a9+asma_10a14) as totinfasma,
                    sum(asma_15a64+asma_65ym) as totaduasma,
                    sum(neumo_m1+neumo_1a9+neumo_10a14+neumo_15a64+neumo_65ym) as totgenneumo,
                    sum(neumo_m1+neumo_1a9+neumo_10a14) as totinfneumo,
                    sum(neumo_15a64+neumo_65ym) as totaduneumo,
                    sum(influ_m1+influ_1a9+influ_10a14+influ_15a64+influ_65ym) as totgeninflu,
                    sum(influ_m1+influ_1a9+influ_10a14) as totinfinflu,
                    sum(influ_15a64+influ_65ym) as totaduinflu,
                    sum(larin_m1+larin_1a9+larin_10a14+larin_15a64+larin_65ym) as totgenlarin,
                    sum(larin_m1+larin_1a9+larin_10a14) as totinflarin,
                    sum(larin_15a64+larin_65ym) as totadularin,
					sum(iraltas_m1+iraltas_1a9+iraltas_10a14+iraltas_15a64+iraltas_65ym) as totgeniraltas,
                    sum(iraltas_m1+iraltas_1a9+iraltas_10a14) as totinfiraltas,
                    sum(iraltas_15a64+iraltas_65ym) as totaduiraltas,
                    sum(resto_m1+resto_1a9+resto_10a14+resto_15a64+resto_65ym) as totgenresto,
                    sum(resto_m1+resto_1a9+resto_10a14) as totinfresto,
                    sum(resto_15a64+resto_65ym) as totaduresto,
                    sum(bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+iraltas_m1+resto_m1) as totiram1,
                    sum(bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+iraltas_1a9+resto_1a9) as totira1a9,
                    sum(bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+iraltas_10a14+resto_10a14) as totira10a14,
                    sum(bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64) as totira15a64,
                    sum(bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym) as totira65ym,
                    sum(totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym) as toturg,
                    sum(totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym) as totsin,
                    sum(totm1 + tot1a9 + tot10a14) as toturginf,
                    sum(tot15a64 + tot65ym) as toturgadu,
                    sum(totsinm1 + totsin1a9 + totsin10a14) as totsininf,
                    sum(totsin15a64 + totsin65ym) as totsinadu,
                    sum(bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+iraltas_m1+resto_m1 +
                     bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+iraltas_1a9+resto_1a9 +
                     bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+iraltas_10a14+resto_10a14 +
                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64 +
                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym)  as totgentod,
                    sum(bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+iraltas_m1+resto_m1 +
                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+iraltas_1a9+resto_1a9 +
                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+iraltas_10a14+resto_10a14) as totinftod,
                   sum( bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64 +
                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym)  as totadutod,				
                   sum( bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+iraltas_m1+resto_m1 +
                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+iraltas_1a9+resto_1a9 +
                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+iraltas_10a14+resto_10a14 +
                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64 +
                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym  +
                    totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym +
                    totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym )
                    as tottot,
                    sum(bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+iraltas_m1+resto_m1 +
                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+iraltas_1a9+resto_1a9 +
                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+iraltas_10a14+resto_10a14 +
                    totm1 + tot1a9 + tot10a14 + totsinm1 + totsin1a9 + totsin10a14) as tottotinf,
                    sum(bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64 +
                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym +
                    tot15a64 + tot65ym + totsin15a64 + totsin65ym) as tottotadu,
                    sum(bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+iraltas_m1+resto_m1 + totm1 + totsinm1) as tottotm1,
                    sum(bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+iraltas_1a9+resto_1a9 + totsin1a9 + tot1a9) as tottot1a9,
                    sum(bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+iraltas_10a14+resto_10a14 +
                    tot10a14 + totsin10a14) as tottot10a14,
                    sum(bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64 +
                     tot15a64 + totsin15a64 ) as tottot15a64,
                    sum(bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym +
                     tot65ym + totsin65ym) as tottot65ym
                    FROM aturg_urbana where id_estab=%s
                    and fecha between '%s' and '%s'",
                    $_SESSION['id_estab'],$fechai,$fechat);
$rs = safe_query($query_rs);
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
echo "<table width=\"600\" align=\"center\">"
 ."   <caption><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>"
 ."Resumen de Atenciones "
 ."   de Urgencia y Causas Respiratorias<br>Establecimiento: <i>".$_SESSION['nombre']."</i> "
 ."&nbsp;&nbsp;&nbsp;Fecha: ".$_POST['fechai']." al " .$_POST['fechat']
 ."</strong></font> "
 ."</caption>"
 ."<tr valign=\"baseline\">" 
   ."<td width=\"85\" align=\"right\" nowrap>" 
."<div align=\"left\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."Grupos de edad:</font></strong></div></td>"
  ."<td width=\"53\" bgcolor=\"#DDDDDD\" > "
  ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
  ."Total urgencias </font></strong></font></div></td>"
   ."<td width=\"53\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
  ."Resto urg.M�dicas</font></strong></font></div></td>"
   ."<td width=\"56\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
   ."Total urg.Quir�r.</font></strong></font></div></td>"
   ."<td width=\"48\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
   ."Todas respirat.</font></strong></font></div></td>"
   ."<td width=\"55\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Bronquitis</font></strong></font></div></td>"
   ."<td width=\"47\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Asma</font></strong></font></div></td>"
   ."<td width=\"49\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Neumo.</font></strong></font></div></td>"
   ."<td width=\"50\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Influenza</font></strong></font></div></td>"
   ."<td width=\"52\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Laringitis</font></strong></font></div></td>"
   ."<td width=\"52\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Iras Altas</font></strong></font></div></td>"
   ."<td width=\"48\"> "
     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Resto de Respirat.</font></strong></font></div></td>"
 ."</tr>";
$data.=" \t \t \t \tConsultas de Urgencia\t \t \t \n";
$data.="Grupos Edad\t";
$data.="Total Urgencias\t";
$data.="Resto Urg.M�dicas\t";
$data.="Total Urg.Quirur.\t";
$data.="Todas las Respir.\t";
$data.="Bronquitis\t";
$data.="Asma\t";
$data.="Neumonias\t";
$data.="Influenza\t";
$data.="Laringitis\t";
$data.="Iras Altas\t";
$data.="Resto causas";
$data.="\n";
fwrite($fp,$data);
$data="";
echo "<tr valign=\"baseline\">" 
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"
."Total General:</font></strong></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottot\" type=\"text\" id=\"tottot\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottot']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"toturg\" type=\"text\" id=\"toturg\" size=\"5\" maxlength=\"5\""
       ."    value=\"". $row_rs['toturg']."\" readonly=\"true\">"
       ."</font></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totsin\" type=\"text\" id=\"totsin\" size=\"5\" maxlength=\"5\""
      ."    value=\"". $row_rs['totsin']."\" readonly=\"true\">"
       ."</font></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totgentod\" type=\"text\" id=\"totgentod\" size=\"5\" maxlength=\"5\""
."value=\"". $row_rs['totgentod']."\" readonly=\"true\">"
       ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totgenbron\" type=\"text\" id=\"totgenbron\" size=\"5\" maxlength=\"5\" readonly=\"true\""
    ."       value=\"". $row_rs['totgenbron']."\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totgenasma\" type=\"text\" id=\"totgenasma\" size=\"5\" maxlength=\"5\" readonly=\"true\""
       ." value=\"". $row_rs['totgenasma']."\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totgenneumo\" type=\"text\" id=\"totgenneumo\" size=\"5\" maxlength=\"5\" readonly=\"true\""
       ."value=\"". $row_rs['totgenneumo'] ."\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totgeninflu\" type=\"text\" id=\"totgeninflu\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ."  value=\"". $row_rs['totgeninflu'] ."\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totgenlarin\" type=\"text\" id=\"totgenlarin\" size=\"5\" maxlength=\"5\" readonly=\"true\""
       ."   value=\"". $row_rs['totgenlarin'] ."\">"
       ."</font></div></td>"
	 ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totgeniraltas\" type=\"text\" id=\"totgeniraltas\" size=\"5\" maxlength=\"5\" readonly=\"true\""
       ."   value=\"". $row_rs['totgeniraltas'] ."\">"
       ."</font></div></td>"  
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totgenresto\" type=\"text\" id=\"totgenresto\" size=\"5\" maxlength=\"5\" readonly=\"true\""
       ." value=\"". $row_rs['totgenresto'] ."\">"
       ."</font></div></td>"
 ."</tr>";
$data.="Total General\t";
$data.=$row_rs['tottot']."\t";
$data.=$row_rs['toturg']."\t";
$data.=$row_rs['totsin']."\t";
$data.=$row_rs['totgentod']."\t";
$data.=$row_rs['totgenbron']."\t";
$data.=$row_rs['totgenasma']."\t";
$data.=$row_rs['totgenneumo']."\t";
$data.=$row_rs['totgeninflu']."\t";
$data.=$row_rs['totgenlarin']."\t";
$data.=$row_rs['totgeniraltas']."\t";
$data.=$row_rs['totgenresto']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";
echo "<tr valign=\"baseline\"> "
   ."<td height=\"26\" align=\"right\" nowrap>" 
."<div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">Total "
  ."        Infantil:</font></strong></font></div></td>"
   ."<td ><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottotinf\" type=\"text\" id=\"tottotinf\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottotinf']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
      ."<input name=\"toturginf\" type=\"text\" id=\"toturginf\" size=\"5\" maxlength=\"5\""
." value=\"". $row_rs['toturginf'] ."\" readonly=\"true\">"
       ."</font></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totsininf\" type=\"text\" id=\"totsininf\" size=\"5\" maxlength=\"5\""
."value=\"". $row_rs['totsininf'] ."\" readonly=\"true\">"
       ."</font></font></div></td>"
   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totinftod\" type=\"text\" id=\"totinftod\" size=\"5\" maxlength=\"5\""
."value=\"". $row_rs['totinftod'] ."\" readonly=\"true\">"
       ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totinfbron\" type=\"text\" id=\"totinfbron\" "
         ." value=\"". $row_rs['totinfbron'] ."\" size=\"5\" maxlength=\"5\" readonly=\"true\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totinfasma\" type=\"text\" id=\"totinfasma\" "
        ." value=\"". $row_rs['totinfasma'] ."\" size=\"5\" maxlength=\"5\" readonly=\"true\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totinfneumo\" type=\"text\" id=\"totinfneumo\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totinfneumo'] ."\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totinfinflu\" type=\"text\" id=\"totinfinflu\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totinfinflu'] ."\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totinflarin\" type=\"text\" id=\"totinflarin\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totinflarin'] ."\">"
       ."</font></div></td>"
	 ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totinfiraltas\" type=\"text\" id=\"totinfiraltas\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totinfiraltas'] ."\">"
       ."</font></div></td>"   
   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totinfresto\" type=\"text\" id=\"totinfresto\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totinfresto'] ."\">"
       ."</font></div></td>"
 ."</tr>";
$data.="Total ni�os\t";
$data.=$row_rs['tottotinf']."\t";
$data.=$row_rs['toturginf']."\t";
$data.=$row_rs['totsininf']."\t";
$data.=$row_rs['totinftod']."\t";
$data.=$row_rs['totinfbron']."\t";
$data.=$row_rs['totinfasma']."\t";
$data.=$row_rs['totinfneumo']."\t";
$data.=$row_rs['totinfinflu']."\t";
$data.=$row_rs['totinflarin']."\t";
$data.=$row_rs['totinfiraltas']."\t";
$data.=$row_rs['totinfresto']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
echo "<tr valign=\"baseline\">" 
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."<strong><font color=\"#0000CC\">&lt;1 a&ntilde;o:</font></strong></font></div></td>"
   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottotm1\" type=\"text\" id=\"tottotm1\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottotm1']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"totm1\" value=\"". $row_rs['totm1'] ."\" size=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totsinm1\" type=\"text\" value=\"". $row_rs['totsinm1'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\">"
."<font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totiram1\" type=\"text\" id=\"totiram1\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totiram1'] ."\">"
       ."</font></font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"bronq_m1\" type=\"text\" value=\"". $row_rs['bronq_m1'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"asma_m1\" type=\"text\" value=\"". $row_rs['asma_m1'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"neumo_m1\" value=\"". $row_rs['neumo_m1'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"influ_m1\" value=\"". $row_rs['influ_m1'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"larin_m1\" value=\"". $row_rs['larin_m1'] ."\" size=\"5\">"
       ."</font></div></td>"
	  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"iraltas_m1\" value=\"". $row_rs['iraltas_m1'] ."\" size=\"5\">"
       ."</font></div></td>" 
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"resto_m1\" value=\"". $row_rs['resto_m1'] ."\" size=\"5\" >"
       ."</font></div></td>"
 ."</tr>";
$data.="< 1 a�o\t";
$data.=$row_rs['tottotm1']."\t";
$data.=$row_rs['totm1']."\t";
$data.=$row_rs['totsinm1']."\t";
$data.=$row_rs['totiram1']."\t";
$data.=$row_rs['bronq_m1']."\t";
$data.=$row_rs['asma_m1']."\t";
$data.=$row_rs['neumo_m1']."\t";
$data.=$row_rs['influ_m1']."\t";
$data.=$row_rs['larin_m1']."\t";
$data.=$row_rs['iraltas_m1']."\t";
$data.=$row_rs['resto_m1']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
echo "<tr valign=\"baseline\">" 
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."<strong><font color=\"#0000CC\">";
if(strcmp( $fechai,'2006-03-29')>0)
	echo "1-4 a&ntilde;os:";
if(strcmp( $fechat,'2006-03-29')<=0)
	echo "1-9 a&ntilde;os:";
echo "</font></strong></font></div></td>"
   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottot1a9\" type=\"text\" id=\"tottot1a9\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottot1a9']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"tot1a9\" type=\"text\" value=\"". $row_rs['tot1a9']."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totsin1a9\" type=\"text\" value=\"". $row_rs['totsin1a9'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totira1a9\" type=\"text\" id=\"totira1a9\" size=\"5\" maxlength=\"5\" readonly=\"true\""
          ." value=\"". $row_rs['totira1a9'] ."\">"
       ."</font></font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"bronq_1a9\" type=\"text\" value=\"". $row_rs['bronq_1a9'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"asma_1a9\" type=\"text\" value=\"". $row_rs['asma_1a9'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"neumo_1a9\" value=\"". $row_rs['neumo_1a9'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"influ_1a9\" value=\"". $row_rs['influ_1a9'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"larin_1a9\" value=\"". $row_rs['larin_1a9'] ."\" size=\"5\" >"
       ."</font></div></td>"
	   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"iraltas_1a9\" value=\"". $row_rs['iraltas_1a9'] ."\" size=\"5\" >"
       ."</font></div></td>" 
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"resto_1a9\" value=\"". $row_rs['resto_1a9'] ."\" size=\"5\">"
       ."</font></div></td>"
 ."</tr>";
 if(strcmp( $fechai,'2006-03-29')>0)
	$data.= "1-4 a�os\t";
if(strcmp( $fechat,'2006-03-29')<=0)
	$data.= "1-9 a�os\t";
$data.=$row_rs['tottot1a9']."\t";
$data.=$row_rs['tot1a9']."\t";
$data.=$row_rs['totsin1a9']."\t";
$data.=$row_rs['totira1a9']."\t";
$data.=$row_rs['bronq_1a9']."\t";
$data.=$row_rs['asma_1a9']."\t";
$data.=$row_rs['neumo_1a9']."\t";
$data.=$row_rs['influ_1a9']."\t";
$data.=$row_rs['larin_1a9']."\t";
$data.=$row_rs['iraltas_1a9']."\t";
$data.=$row_rs['resto_1a9']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
echo "<tr valign=\"baseline\"> "
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<strong><font color=\"#0000CC\">";
if(strcmp( $fechai,'2006-03-29')>0)
	echo "5-14 a&ntilde;os:";
if(strcmp( $fechat,'2006-03-29')<=0)
	echo "10-14 a&ntilde;os:";
  echo "</font></strong></font></div></td>"
   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottot10a14\" type=\"text\" id=\"tottot10a14\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottot10a14']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"tot10a14\" type=\"text\" value=\"". $row_rs['tot10a14'] ."\" size=\"5\" maxlength=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totsin10a14\" type=\"text\" value=\"". $row_rs['totsin10a14'] ."\" size=\"5\" maxlength=\"5\" >"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."</font><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totira10a14\" type=\"text\" id=\"totira10a14\" size=\"5\" maxlength=\"5\" readonly=\"true\" "
       ." value=\"". $row_rs['totira10a14'] ."\">"
       ."</font></font></font><font face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."</font></font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"bronq_10a14\" type=\"text\" value=\"". $row_rs['bronq_10a14'] ."\" size=\"5\" maxlength=\"5\"> "
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"asma_10a14\" type=\"text\" value=\"". $row_rs['asma_10a14'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"neumo_10a14\" value=\"". $row_rs['neumo_10a14'] ."\" size=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"influ_10a14\" value=\"". $row_rs['influ_10a14'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"larin_10a14\" value=\"". $row_rs['larin_10a14'] ."\" size=\"5\" >"
       ."</font></div></td>"
	 ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"iraltas_10a14\" value=\"". $row_rs['iraltas_10a14'] ."\" size=\"5\" >"
       ."</font></div></td>"   
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"resto_10a14\" value=\"". $row_rs['resto_10a14'] ."\" size=\"5\" >"
       ."</font></div></td>"
 ."</tr>";
if(strcmp( $fechai,'2006-03-29')>0)
	$data.= "5-14 a�os\t";
if(strcmp( $fechat,'2006-03-29')<=0)
	$data.= "10-14 a�os\t";
$data.=$row_rs['tottot10a14']."\t";
$data.=$row_rs['tot10a14']."\t";
$data.=$row_rs['totsin10a14']."\t";
$data.=$row_rs['totira10a14']."\t";
$data.=$row_rs['bronq_10a14']."\t";
$data.=$row_rs['asma_10a14']."\t";
$data.=$row_rs['neumo_10a14']."\t";
$data.=$row_rs['influ_10a14']."\t";
$data.=$row_rs['larin_10a14']."\t";
$data.=$row_rs['iraltas_10a14']."\t";
$data.=$row_rs['resto_10a14']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
echo "<tr valign=\"baseline\"> "
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">Total "
    ."      adultos:</font></strong></font></div></td>"
   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottotadu\" type=\"text\" id=\"tottotadu\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottotadu']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"toturgadu\" type=\"text\" id=\"toturgadu\" size=\"5\" maxlength=\"5\""
  ."value=\"". $row_rs['toturgadu'] ."\" readonly=\"true\">"
       ."</font></font></font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totsinadu\" type=\"text\" id=\"totsinadu\" size=\"5\" maxlength=\"5\""
   ."value=\"". $row_rs['totsinadu'] ."\" readonly=\"true\">"
       ."</font></font></font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totadutod\" type=\"text\" id=\"totadutod\" size=\"5\" maxlength=\"5\""
   ."value=\"". $row_rs['totadutod'] ."\" readonly=\"true\">"
       ."</font></font></font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totadubron\" type=\"text\" id=\"totadubron\" "
         ." value=\"". $row_rs['totadubron'] ."\" size=\"5\" maxlength=\"5\" readonly=\"true\">"
       ."</font></div></td> "
       ."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totaduasma\" type=\"text\" id=\"totaduasma\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totaduasma'] ."\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totaduneumo\" type=\"text\" id=\"totaduneumo\" size=\"5\" maxlength=\"5\" readonly=\"true\" "   
     ." value=\"". $row_rs['totaduneumo'] ."\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totaduinflu\" type=\"text\" id=\"totaduinflu\" size=\"5\" maxlength=\"5\" readonly=\"true\""
        ." value=\"". $row_rs['totaduinflu'] ."\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totadularin\" type=\"text\" id=\"totadularin\" size=\"5\" maxlength=\"5\" readonly=\"true\""
         ." value=\"". $row_rs['totadularin'] ."\">"
       ."</font></div></td>"
	."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"totaduiraltas\" type=\"text\" id=\"totaduiraltas\" size=\"5\" maxlength=\"5\" readonly=\"true\""
         ." value=\"". $row_rs['totaduiraltas'] ."\">"
       ."</font></div></td>"   
   ."<td> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totaduresto\" type=\"text\" id=\"totaduresto\" size=\"5\" maxlength=\"5\" readonly=\"true\""
         ." value=\"". $row_rs['totaduresto'] ."\">"
       ."</font></div></td>"
 ."</tr>";

$data.="Total adultos\t";
$data.=$row_rs['tottotadu']."\t";
$data.=$row_rs['toturgadu']."\t";
$data.=$row_rs['totsinadu']."\t";
$data.=$row_rs['totadutod']."\t";
$data.=$row_rs['totadubron']."\t";
$data.=$row_rs['totaduasma']."\t";
$data.=$row_rs['totaduneumo']."\t";
$data.=$row_rs['totaduinflu']."\t";
$data.=$row_rs['totadularin']."\t";
$data.=$row_rs['totaduiraltas']."\t";
$data.=$row_rs['totaduresto']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
 echo "<tr valign=\"baseline\"> "
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
."<strong><font color=\"#0000CC\">15-64 a&ntilde;os:</font></strong></font></div></td>"
   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottot15a64\" type=\"text\" id=\"tottot15a64\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottot15a64']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"tot15a64\" type=\"text\" value=\"". $row_rs['tot15a64'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totsin15a64\" type=\"text\" value=\"". $row_rs['totsin15a64'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totira15a64\" type=\"text\" id=\"totira15a64\" size=\"5\" maxlength=\"5\" "
        ." value=\"". $row_rs['totira15a64'] ."\" readonly=\"true\">"
       ."</font></font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"bronq_15a64\" type=\"text\" value=\"". $row_rs['bronq_15a64'] ."\" size=\"5\" maxlength=\"5\">"
  ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input name=\"asma_15a64\" type=\"text\" value=\"". $row_rs['asma_15a64'] ."\" size=\"5\" maxlength=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"neumo_15a64\" value=\"". $row_rs['neumo_15a64'] ."\" size=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"influ_15a64\" value=\"". $row_rs['influ_15a64'] ."\" size=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"larin_15a64\" value=\"". $row_rs['larin_15a64'] ."\" size=\"5\" >"
       ."</font></div></td>"
	     ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"iraltas_15a64\" value=\"". $row_rs['iraltas_15a64'] ."\" size=\"5\" >"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"resto_15a64\" value=\"". $row_rs['resto_15a64'] ."\" size=\"5\" "
       ."</font></div></td>"
 ."</tr>";

$data.="15 -64 a�os\t";
$data.=$row_rs['tottot15a64']."\t";
$data.=$row_rs['tot15a64']."\t";
$data.=$row_rs['totsin15a64']."\t";
$data.=$row_rs['totira15a64']."\t";
$data.=$row_rs['bronq_15a64']."\t";
$data.=$row_rs['asma_15a64']."\t";
$data.=$row_rs['neumo_15a64']."\t";
$data.=$row_rs['influ_15a64']."\t";
$data.=$row_rs['larin_15a64']."\t";
$data.=$row_rs['iraltas_15a64']."\t";
$data.=$row_rs['resto_15a64']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
echo "<tr valign=\"baseline\">" 
   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">65 "
         ." y m&aacute;s a&ntilde;os:</font></strong></font></div></td>"
   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
   ."<input name=\"tottot65ym\" type=\"text\" id=\"tottot65ym\" size=\"5\" maxlength=\"5\""
   ."    value=\"". $row_rs['tottot65ym']."\" readonly=\"true\">"
   ."</font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"tot65ym\" type=\"text\" value=\"". $row_rs['tot65ym'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"totsin65ym\" type=\"text\" value=\"". $row_rs['totsin65ym'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"
       ."<input name=\"totira65ym\" type=\"text\" id=\"totira65ym\" size=\"5\" maxlength=\"5\" readonly=\"true\""
         ." value=\"". $row_rs['totira65ym'] ."\">"
       ."</font></font></font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"bronq_65ym\" type=\"text\" value=\"". $row_rs['bronq_65ym'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input name=\"asma_65ym\" type=\"text\" value=\"". $row_rs['asma_65ym'] ."\" size=\"5\" maxlength=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"neumo_65ym\" value=\"". $row_rs['neumo_65ym'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
       ."<input type=\"text\" name=\"influ_65ym\" value=\"". $row_rs['influ_65ym'] ."\" size=\"5\">"
       ."</font></div></td>"
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"larin_65ym\" value=\"". $row_rs['larin_65ym'] ."\" size=\"5\">"
       ."</font></div></td>"
	  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"iraltas_65ym\" value=\"". $row_rs['iraltas_65ym'] ."\" size=\"5\">"
       ."</font></div></td>"   
   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
       ."<input type=\"text\" name=\"resto_65ym\" value=\"". $row_rs['resto_65ym'] ."\" size=\"5\">"
       ."</font></div></td>"
 ."</tr>";
$data.="65 y m�s a�os\t";
$data.=$row_rs['tottot65ym']."\t";
$data.=$row_rs['tot65ym']."\t";
$data.=$row_rs['totsin65ym']."\t";
$data.=$row_rs['totira65ym']."\t";
$data.=$row_rs['bronq_65ym']."\t";
$data.=$row_rs['asma_65ym']."\t";
$data.=$row_rs['neumo_65ym']."\t";
$data.=$row_rs['influ_65ym']."\t";
$data.=$row_rs['larin_65ym']."\t";
$data.=$row_rs['iraltas_65ym']."\t";
$data.=$row_rs['resto_65ym']."\t";
$data.="\n";
fwrite($fp,$data);

$data="";
echo " </table>"
."</form>";
// Otras atenciones de urgencia
$query_rsfh = "SELECT 
 sum(infarto_m1) as infarto_m1,
 sum(infarto_1a4) as infarto_1a4,
 sum(infarto_5a14 ) as infarto_5a14 ,
 sum(infarto_15a64) as infarto_15a64,
 sum(infarto_65ym) as infarto_65ym,
 sum(vascular_m1) as vascular_m1,
 sum(vascular_1a4) as vascular_1a4,
 sum(vascular_5a14 ) as vascular_5a14 ,
 sum(vascular_15a64) as vascular_15a64,
 sum(vascular_65ym) as vascular_65ym,
 sum(hipertensiva_m1) as hipertensiva_m1,
 sum(hipertensiva_1a4) as hipertensiva_1a4,
 sum(hipertensiva_5a14 ) as hipertensiva_5a14 ,
 sum(hipertensiva_15a64) as hipertensiva_15a64,
 sum(hipertensiva_65ym) as hipertensiva_65ym,
 sum(arritmia_m1) as arritmia_m1,
 sum(arritmia_1a4) as arritmia_1a4,
 sum(arritmia_5a14 ) as arritmia_5a14 ,
 sum(arritmia_15a64) as arritmia_15a64,
 sum(arritmia_65ym) as arritmia_65ym,
 sum(otrascirc_m1) as otrascirc_m1,
 sum(otrascirc_1a4) as otrascirc_1a4,
 sum(otrascirc_5a14 ) as otrascirc_5a14 ,
 sum(otrascirc_15a64) as otrascirc_15a64,
 sum(otrascirc_65ym) as otrascirc_65ym,
 sum(transito_m1) as transito_m1,
 sum(transito_1a4) as transito_1a4,
 sum(transito_5a14 ) as transito_5a14 ,
 sum(transito_15a64) as transito_15a64,
 sum(transito_65ym) as transito_65ym,
 sum(otrasext_m1) as otrasext_m1,
 sum(otrasext_1a4) as otrasext_1a4,
 sum(otrasext_5a14 ) as otrasext_5a14 ,
 sum(otrasext_15a64) as otrasext_15a64,
 sum(otrasext_65ym) as otrasext_65ym,
 sum(demas_m1) as demas_m1,
 sum(demas_1a4) as demas_1a4,
 sum(demas_5a14 ) as demas_5a14 ,
 sum(demas_15a64) as demas_15a64,
 sum(demas_65ym) as demas_65ym
, sum(infarto_m1 + vascular_m1 + hipertensiva_m1 + arritmia_m1 + otrascirc_m1) as circ_m1
, sum(infarto_1a4 + vascular_1a4 + hipertensiva_1a4 + arritmia_1a4 + otrascirc_1a4) as circ_1a4
, sum(infarto_5a14 + vascular_5a14 + hipertensiva_5a14 + arritmia_5a14 + otrascirc_5a14) as circ_5a14
, sum(infarto_15a64 + vascular_15a64 + hipertensiva_15a64 + arritmia_15a64 + otrascirc_15a64) as circ_15a64
, sum(infarto_65ym + vascular_65ym + hipertensiva_65ym + arritmia_65ym + otrascirc_65ym) as circ_65ym
, sum(infarto_m1 + vascular_m1 + hipertensiva_m1 + arritmia_m1 + otrascirc_m1 +
 infarto_1a4 + vascular_1a4 + hipertensiva_1a4 + arritmia_1a4 + otrascirc_1a4 +
infarto_5a14 + vascular_5a14 + hipertensiva_5a14 + arritmia_5a14 + otrascirc_5a14 +
 infarto_15a64 + vascular_15a64 + hipertensiva_15a64 + arritmia_15a64 + otrascirc_15a64 +
 infarto_65ym + vascular_65ym + hipertensiva_65ym + arritmia_65ym + otrascirc_65ym) as totcirc
 , sum(transito_m1 + otrasext_m1) as trauma_m1
  , sum(transito_1a4 + otrasext_1a4) as trauma_1a4
   , sum(transito_5a14 + otrasext_5a14) as trauma_5a14
    , sum(transito_15a64 + otrasext_15a64) as trauma_15a64
	 , sum(transito_65ym + otrasext_65ym) as trauma_65ym
 , sum(transito_m1 + otrasext_m1 +
  transito_1a4 + otrasext_1a4 +
  transito_5a14 + otrasext_5a14 +
  transito_15a64 + otrasext_15a64 +
  transito_65ym + otrasext_65ym) as tottrauma
  , sum(infarto_m1+infarto_1a4+infarto_5a14+infarto_15a64+infarto_65ym) as totinfarto
, sum(vascular_m1+vascular_1a4+vascular_5a14+vascular_15a64+vascular_65ym) as totvascular
, sum(hipertensiva_m1+hipertensiva_1a4+hipertensiva_5a14+hipertensiva_15a64+hipertensiva_65ym) as tothipertensiva
, sum(arritmia_m1+arritmia_1a4+arritmia_5a14+arritmia_15a64+arritmia_65ym) as totarritmia
, sum(otrascirc_m1+otrascirc_1a4+otrascirc_5a14+otrascirc_15a64+otrascirc_65ym) as tototrascirc
, sum(transito_m1+transito_1a4+transito_5a14+transito_15a64+transito_65ym) as tottransito
, sum(otrasext_m1+otrasext_1a4+otrasext_5a14+otrasext_15a64+otrasext_65ym) as tototrasext
, sum(demas_m1+demas_1a4+demas_5a14+demas_15a64+demas_65ym) as totdemas
FROM aturgo where id_estab=".$_SESSION['id_estab']." and fecha between '".$fechai."' and '".$fechat."'";                   
$rsfh = safe_query($query_rsfh);
$row_rsfh = mysql_fetch_assoc($rsfh);
$totalRows_rsfh = mysql_num_rows($rsfh);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Atenciones por otros diagnosticos
</strong></font> 
</caption>
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Atenciones</strong></font></div></td>
	<td> <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Total</strong></font></div></td>
    <td> <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>-1 anno</strong></font></div></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>1 - 4 annos</strong></font></div></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>5 - 14 annos</strong></font></div></td>
	  <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>15 - 64 annos</strong></font></div></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>65 y mas annos</strong></font></div></td>
  </tr>
EOQ;
$data.=" \t \t \t Atenciones por otros diagnosticos \t \t \t \n";
$data.="Atenciones\t";
$data.="Total \t";
$data.="-1 a�o\t";
$data.="1 -4 a�os\t";
$data.="5 - 14 a�os\t";
$data.="15 - 64 a�os\t";
$data.="65 y m�s\t";
$data.="\n";
fwrite($fp,$data);
$data="";
print <<<EOQ
      <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>TOTAL CAUSAS CIRCULATORIAS</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totcirc\" type=\"text\" id=\"totcirc\" value=\"".$row_rsfh['totcirc'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circ_m1\" type=\"text\" id=\"circ_m1\" value=\"".$row_rsfh['circ_m1'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circ_1a4\" type=\"text\" id=\circ_1a4\" value=\"".$row_rsfh['circ_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circ_5a14\" type=\"text\" id=\"circ_5a14\" value=\"".$row_rsfh['circ_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circ_15a64\" type=\"text\" id=\"circ_15a64\" value=\"".$row_rsfh['circ_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circ_65ym\" type=\"text\" id=\"circ_65ym\" value=\"".$row_rsfh['circ_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
  </tr> 
EOQ;
$data.="Total causas circulatorias\t";
$data.=$row_rsfh['totcirc']."\t";
$data.=$row_rsfh['circ_m1']."\t";
$data.=$row_rsfh['circ_1a4']."\t";
$data.=$row_rsfh['circ_5a14']."\t";
$data.=$row_rsfh['circ_15a64']."\t";
$data.=$row_rsfh['circ_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Infarto agudo miocardio</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totinfarto\" type=\"text\" id=\"totinfarto\" value=\"".$row_rsfh['totinfarto'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"infarto_m1\" type=\"text\" id=\"infarto_m1\" value=\"".$row_rsfh['infarto_m1'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"infarto_1a4\" type=\"text\" id=\"infarto_1a4\" value=\"".$row_rsfh['infarto_1a4'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"infarto_5a14\" type=\"text\" id=\"infarto_5a14\" value=\"".$row_rsfh['infarto_5a14'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"infarto_15a64\" type=\"text\" id=\"infarto_15a64\" value=\"".$row_rsfh['infarto_15a64'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"infarto_65ym\" type=\"text\" id=\"infarto_65ym\" value=\"".$row_rsfh['infarto_65ym'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
EOQ;
$data.="Infarto agudo miocardio\t";
$data.=$row_rsfh['totinfarto']."\t";
$data.=$row_rsfh['infarto_m1']."\t";
$data.=$row_rsfh['infarto_1a4']."\t";
$data.=$row_rsfh['infarto_5a14']."\t";
$data.=$row_rsfh['infarto_15a64']."\t";
$data.=$row_rsfh['infarto_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
 <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Accidente Vascular Encefalico</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totvascular\" type=\"text\" id=\"totvascular\" value=\"".$row_rsfh['totvascular'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"vascular_m1\" type=\"text\" id=\"vascular_m1\" value=\"".$row_rsfh['vascular_m1'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"vascular_1a4\" type=\"text\" id=\"vascular_1a4\" value=\"".$row_rsfh['vascular_1a4'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"vascular_5a14\" type=\"text\" id=\"vascular_5a14\" value=\"".$row_rsfh['vascular_5a14'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"vascular_15a64\" type=\"text\" id=\"vascular_15a64\" value=\"".$row_rsfh['vascular_15a64'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"vascular_65ym\" type=\"text\" id=\"vascular_65ym\" value=\"".$row_rsfh['vascular_65ym'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
EOQ;
$data.="Accidente Vascular\t";
$data.=$row_rsfh['totvascular']."\t";
$data.=$row_rsfh['vascular_m1']."\t";
$data.=$row_rsfh['vascular_1a4']."\t";
$data.=$row_rsfh['vascular_5a14']."\t";
$data.=$row_rsfh['vascular_15a64']."\t";
$data.=$row_rsfh['vascular_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
   <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Crisis Hipertensiva</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothipertensiva\" type=\"text\" id=\"tothipertensiva\" value=\"".$row_rsfh['tothipertensiva'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"hipertensiva_m1\" type=\"text\" id=\"hipertensiva_m1\" value=\"".$row_rsfh['hipertensiva_m1'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"hipertensiva_1a4\" type=\"text\" id=\"hipertensiva_1a4\" value=\"".$row_rsfh['hipertensiva_1a4'];
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"hipertensiva_5a14\" type=\"text\" id=\"hipertensiva_5a14\" value=\"".$row_rsfh['hipertensiva_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"hipertensiva_15a64\" type=\"text\" id=\"hipertensiva_15a64\" value=\"".$row_rsfh['hipertensiva_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"hipertensiva_65ym\" type=\"text\" id=\"hipertensiva_65ym\" value=\"".$row_rsfh['hipertensiva_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" >"; 
print <<<EOQ
        </strong></font></div></td>
  </tr>
EOQ;
$data.="Crisis Hipertensiva\t";
$data.=$row_rsfh['tothipertensiva']."\t";
$data.=$row_rsfh['hipertensiva_m1']."\t";
$data.=$row_rsfh['hipertensiva_1a4']."\t";
$data.=$row_rsfh['hipertensiva_5a14']."\t";
$data.=$row_rsfh['hipertensiva_15a64']."\t";
$data.=$row_rsfh['hipertensiva_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Arritmia Severa</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totarritmia\" type=\"text\" id=\"totarritmia\" value=\"".$row_rsfh['totarritmia'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"arritmia_m1\" type=\"text\" id=\"arritmia_m1\" value=\"".$row_rsfh['arritmia_m1'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"arritmia_1a4\" type=\"text\" id=\"arritmia_1a4\" value=\"".$row_rsfh['arritmia_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"arritmia_5a14\" type=\"text\" id=\"arritmia_5a14\" value=\"".$row_rsfh['arritmia_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"arritmia_15a64\" type=\"text\" id=\"arritmia_15a64\" value=\"".$row_rsfh['arritmia_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"arritmia_65ym\" type=\"text\" id=\"arritmia_65ym\" value=\"".$row_rsfh['arritmia_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr>
EOQ;
$data.="Arritmia Severa\t";
$data.=$row_rsfh['totarritmia']."\t";
$data.=$row_rsfh['arritmia_m1']."\t";
$data.=$row_rsfh['arritmia_1a4']."\t";
$data.=$row_rsfh['arritmia_5a14']."\t";
$data.=$row_rsfh['arritmia_15a64']."\t";
$data.=$row_rsfh['arritmia_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
   <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Otras causas circulatorias</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tototrascirc\" type=\"text\" id=\"tototrascirc\" value=\"".$row_rsfh['tototrascirc'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrascirc_m1\" type=\"text\" id=\"otrascirc_m1\" value=\"".$row_rsfh['otrascirc_m1'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrascirc_1a4\" type=\"text\" id=\"otrascirc_1a4\" value=\"".$row_rsfh['otrascirc_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrascirc_5a14\" type=\"text\" id=\"otrascirc_5a14\" value=\"".$row_rsfh['otrascirc_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrascirc_15a64\" type=\"text\" id=\"otrascirc_15a64\" value=\"".$row_rsfh['otrascirc_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrascirc_65ym\" type=\"text\" id=\"otrascirc_65ym\" value=\"".$row_rsfh['otrascirc_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr>
EOQ;
$data.="Otras Causas Circ.\t";
$data.=$row_rsfh['tototrascirc']."\t";
$data.=$row_rsfh['otrascirc_m1']."\t";
$data.=$row_rsfh['otrascirc_1a4']."\t";
$data.=$row_rsfh['otrascirc_5a14']."\t";
$data.=$row_rsfh['otrascirc_15a64']."\t";
$data.=$row_rsfh['otrascirc_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
      <tr> 
<td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>TOTAL TRAUMATISMOS Y ENVENENAMIENTOS</strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tottrauma\" type=\"text\" id=\"tottrauma\" value=\"".$row_rsfh['tottrauma'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"trauma_m1\" type=\"text\" id=\"trauma_m1\" value=\"".$row_rsfh['trauma_m1'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"trauma_1a4\" type=\"text\" id=\"trauma_1a4\" value=\"".$row_rsfh['trauma_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"trauma_5a14\" type=\"text\" id=\"trauma_5a14\" value=\"".$row_rsfh['trauma_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"trauma_15a64\" type=\"text\" id=\"trauma_15a64\" value=\"".$row_rsfh['trauma_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"trauma_65ym\" type=\"text\" id=\"trauma_65ym\" value=\"".$row_rsfh['trauma_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr> 
EOQ;
$data.="Total Traumatismos\t";
$data.=$row_rsfh['tottrauma']."\t";
$data.=$row_rsfh['trauma_m1']."\t";
$data.=$row_rsfh['trauma_1a4']."\t";
$data.=$row_rsfh['trauma_5a14']."\t";
$data.=$row_rsfh['trauma_15a64']."\t";
$data.=$row_rsfh['trauma_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
      <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Accidentes del transito</strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tottransito\" type=\"text\" id=\"tottransito\" value=\"".$row_rsfh['tottransito'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"transito_m1\" type=\"text\" id=\"transito_m1\" value=\"".$row_rsfh['transito_m1'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"transito_1a4\" type=\"text\" id=\"transito_1a4\" value=\"".$row_rsfh['transito_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"transito_5a14\" type=\"text\" id=\"transito_5a14\" value=\"".$row_rsfh['transito_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"transito_15a64\" type=\"text\" id=\"transito_15a64\" value=\"".$row_rsfh['transito_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"transito_65ym\" type=\"text\" id=\"transito_65ym\" value=\"".$row_rsfh['transito_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr> 
EOQ;
$data.="Accidentes de Transito\t";
$data.=$row_rsfh['tottransito']."\t";
$data.=$row_rsfh['transito_m1']."\t";
$data.=$row_rsfh['transito_1a4']."\t";
$data.=$row_rsfh['transito_5a14']."\t";
$data.=$row_rsfh['transito_15a64']."\t";
$data.=$row_rsfh['transito_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
    <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Otras causas externas</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tototrasext\" type=\"text\" id=\"tototrasext\" value=\"".$row_rsfh['tototrasext'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrasext_m1\" type=\"text\" id=\"otrasext_m1\" value=\"".$row_rsfh['otrasext_m1'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrasext_1a4\" type=\"text\" id=\"otrasext_1a4\" value=\"".$row_rsfh['otrasext_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrasext_5a14\" type=\"text\" id=\"otrasext_5a14\" value=\"".$row_rsfh['otrasext_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrasext_15a64\" type=\"text\" id=\"otrasext_15a64\" value=\"".$row_rsfh['otrasext_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"otrasext_65ym\" type=\"text\" id=\"otrasext_65ym\" value=\"".$row_rsfh['otrasext_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr> 
EOQ;
$data.="Otras Causas Externas\t";
$data.=$row_rsfh['tototrasext']."\t";
$data.=$row_rsfh['otrasext_m1']."\t";
$data.=$row_rsfh['otrasext_1a4']."\t";
$data.=$row_rsfh['otrasext_5a14']."\t";
$data.=$row_rsfh['otrasext_15a64']."\t";
$data.=$row_rsfh['otrasext_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>TOTAL DEMAS CAUSAS</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totdemas\" type=\"text\" id=\"totdemas\" value=\"".$row_rsfh['totdemas'];
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demas_m1\" type=\"text\" id=\"demas_m1\" value=\"".$row_rsfh['demas_m1'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
EOQ;
    echo "<input name=\"demas_1a4\" type=\"text\" id=\"demas_1a4\" value=\"".$row_rsfh['demas_1a4'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demas_5a14\" type=\"text\" id=\"demas_5a14\" value=\"".$row_rsfh['demas_5a14'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demas_15a64\" type=\"text\" id=\"demas_15a64\" value=\"".$row_rsfh['demas_15a64'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
EOQ;
    echo "<input name=\"demas_65ym\" type=\"text\" id=\"demas_65ym\" value=\"".$row_rsfh['demas_65ym'];
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr> 
EOQ;
$data.="Total Dem�s Causas\t";
$data.=$row_rsfh['totdemas']."\t";
$data.=$row_rsfh['demas_m1']."\t";
$data.=$row_rsfh['demas_1a4']."\t";
$data.=$row_rsfh['demas_5a14']."\t";
$data.=$row_rsfh['demas_15a64']."\t";
$data.=$row_rsfh['demas_65ym']."\t";
$data.="\n";
fwrite($fp,$data);
$data="";  
print <<<EOQ
</table>
EOQ;
if(strcmp($_SESSION['tipo'],'urbano')==0 || strcmp($_SESSION['tipo'],'provincial')==0){
   $query_rsh="select sum(pbm1) as pbm1,
                      sum(pb1_9) as pb1_9,
                      sum(pb10_14) as pb10_14,
                      sum(pb15_64) as pb15_64,
                      sum(pb65ym) as pb65ym,
                      sum(pom1) as pom1,
                      sum(po1_9) as po1_9,
                      sum(po10_14) as po10_14,
                      sum(po15_64) as po15_64,
                      sum(po65ym) as po65ym,
                      sum(hbm1) as hbm1,
                      sum(hb1_9) as hb1_9,
                      sum(hb10_14) as hb10_14,
                      sum(hb15_64) as hb15_64,
                      sum(hb65ym) as hb65ym,
                      sum(hom1) as hom1,
                      sum(ho1_9) as ho1_9,
                      sum(ho10_14) as ho10_14,
                      sum(ho15_64) as ho15_64,
                      sum(ho65ym) as ho65ym,
                      sum(mbm1) as mbm1,
                      sum(mb1_9) as mb1_9,
                      sum(mb10_14) as mb10_14,
                      sum(mb15_64) as mb15_64,
                      sum(mb65ym) as mb65ym,
                      sum(mom1) as mom1,
                      sum(mo1_9) as mo1_9,
                      sum(mo10_14) as mo10_14,
                      sum(mo15_64) as mo15_64,
                      sum(mo65ym) as mo65ym,
                      sum(pbotras) as pbotras,
                      sum(pootras) as pootras,
                      sum(hbotras) as hbotras,
                      sum(hootras) as hootras,
                      sum(mbotras) as mbotras,
                      sum(mootras) as mootras,
               sum(pbm1 + pb1_9 + pb10_14 + pb15_64 + pb65ym) as pbsubtotr,
               sum(pom1 + po1_9 + po10_14 + po15_64 + po65ym) as posubtotr,
               sum(hbm1 + hb1_9 + hb10_14 + hb15_64 + hb65ym) as hbsubtotr,
               sum(hom1 + ho1_9 + ho10_14 + ho15_64 + ho65ym) as hosubtotr,
               sum(mbm1 + mb1_9 + mb10_14 + mb15_64 + mb65ym) as mbsubtotr,
               sum(mom1 + mo1_9 + mo10_14 + mo15_64 + mo65ym) as mosubtotr,
               sum(pbm1 + pb1_9 + pb10_14 + pb15_64 + pb65ym + pbotras) as pbtot,
               sum(pom1 + po1_9 + po10_14 + po15_64 + po65ym + pootras) as potot,
               sum(hbm1 + hb1_9 + hb10_14 + hb15_64 + hb65ym + hbotras) as hbtot,
               sum(hom1 + ho1_9 + ho10_14 + ho15_64 + ho65ym + hootras) as hotot,
               sum(mbm1 + mb1_9 + mb10_14 + mb15_64 + mb65ym + mbotras) as mbtot,
               sum(mom1 + mo1_9 + mo10_14 + mo15_64 + mo65ym + mootras) as motot
               from hospitaliza
               where id_estab=".$_SESSION['id_estab']." and fecha between '".
                     $fechai. "' and '" .$fechat."'";
       $rsh = safe_query($query_rsh);
       $row_rsh = mysql_fetch_assoc($rsh);
       $totalRows_rsh = mysql_num_rows($rsh);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Hospitalizaciones</font></strong> 
  </caption>
  <tr> 
    <td width="96"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td width="103"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td
    <td colspan="3"> <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;os</font></strong></font></div></td>
    <td colspan="6"> <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Adultos Medicina</font></strong></font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Grupos 
      de Edad</font></strong></td>
    <td colspan="2"><div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Pediatr&iacute;a</font></strong></font></div></td>
    <td colspan="2"><div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Hombres</font></strong></font></div></td>
    <td colspan="2"><div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Mujeres</font></strong></font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td width="58"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>
    <td width="42"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>
    <td width="31"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>
    <td width="37"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>
    <td width="27"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>
    <td width="52"> 
      <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&lt;1 
      a&ntilde;o</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        <strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pbm1\" type=\"text\" id=\"pbm1\" value=\"";  
          echo $row_rsh['pbm1'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pom1\" type=\"text\" id=\"pom1\" value=\"";  
          echo $row_rsh['pom1'];
   echo "\" size=\"4\" maxlength=\"4\" >";  
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
   echo "<input name=\"hbm1\" type=\"text\" id=\"hbm1\" value=\"";  
          echo $row_rsh['hbm1'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hom1\" type=\"text\" id=\"hom1\" value=\"";  
          echo $row_rsh['hom1'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mbm1\" type=\"text\" id=\"mbm1\" value=\"";  
          echo $row_rsh['mbm1'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
    </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mom1\" type=\"text\" id=\"mom1\" value=\"";  
          echo $row_rsh['mom1'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
if(strcmp( $fechai,'2006-03-29')>0)
	echo "1-4 a&ntilde;os:";
if(strcmp( $fechat,'2006-03-29')<=0)
	echo "1-9 a&ntilde;os:";
print <<<EOQ
	</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pb1_9\" type=\"text\" id=\"pb1_9\" value=\"";  
          echo $row_rsh['pb1_9'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"po1_9\" type=\"text\" id=\"po1_9\" value=\"";  
          echo $row_rsh['po1_9'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hb1_9\" type=\"text\" id=\"hb1_9\" value=\"";  
          echo $row_rsh['hb1_9'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"ho1_9\" type=\"text\" id=\"ho1_9\" value=\"";  
          echo $row_rsh['ho1_9'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mb1_9\" type=\"text\" id=\"mb1_9\" value=\"";  
          echo $row_rsh['mb1_9'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mo1_9\" type=\"text\" id=\"mo1_9\" value=\"";  
          echo $row_rsh['mo1_9'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
if(strcmp( $fechai,'2006-03-29')>0)
	echo "5-14 a&ntilde;os:";
if(strcmp( $fechat,'2006-03-29')<=0)
	echo "10-14 a&ntilde;os:";
print <<<EOQ
	</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pb10_14\" type=\"text\" id=\"pb10_14\" value=\"";  
          echo $row_rsh['pb10_14'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC">
EOQ;
   echo "<input name=\"po10_14\" type=\"text\" id=\"po10_14\" value=\"";  
          echo $row_rsh['po10_14'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hb10_14\" type=\"text\" id=\"hb10_14\" value=\"";  
          echo $row_rsh['hb10_14'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"ho10_14\" type=\"text\" id=\"ho10_14\" value=\"";  
          echo $row_rsh['ho10_14'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
   echo "<input name=\"mb10_14\" type=\"text\" id=\"mb10_14\" value=\"";  
          echo $row_rsh['mb10_14'];
   echo "\" size=\"4\" maxlength=\"4\" >";   
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mo10_14\" type=\"text\" id=\"mo10_14\" value=\"";  
          echo $row_rsh['mo10_14'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Respiratorias</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">15-64 
      a&ntilde;os</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pb15_64\" type=\"text\" id=\"pb15_64\" value=\"";  
          echo $row_rsh['pb15_64'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"po15_64\" type=\"text\" id=\"po15_64\" value=\"";  
          echo $row_rsh['po15_64'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hb15_64\" type=\"text\" id=\"hb15_64\" value=\"";  
          echo $row_rsh['hb15_64'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"ho15_64\" type=\"text\" id=\"ho15_64\" value=\"";  
          echo $row_rsh['ho15_64'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mb15_64\" type=\"text\" id=\"mb15_64\" value=\"";  
          echo $row_rsh['mb15_64'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mo15_64\" type=\"text\" id=\"mo15_64\" value=\"";  
          echo $row_rsh['mo15_64'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">65 
      y m&aacute;s</font></strong></td>
   <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC">
EOQ;
   echo "<input name=\"pb65ym\" type=\"text\" id=\"pb65ym\" value=\"";  
          echo $row_rsh['pb65ym'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC">
EOQ;
   echo "<input name=\"po65ym\" type=\"text\" id=\"po65ym\" value=\"";  
          echo $row_rsh['po65ym'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hb65ym\" type=\"text\" id=\"hb65ym\" value=\"";  
          echo $row_rsh['hb65ym'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"ho65ym\" type=\"text\" id=\"ho65ym\" value=\"";  
          echo $row_rsh['ho65ym'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mb65ym\" type=\"text\" id=\"mb65ym\" value=\"";  
          echo $row_rsh['mb65ym'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mo65ym\" type=\"text\" id=\"mo65ym\" value=\"";  
          echo $row_rsh['mo65ym'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Subtotal</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pbsubtotr\" type=\"text\" id=\"pbsubtotr\" value=\"";  
          echo $row_rsh['pbsubtotr'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"posubtotr\" type=\"text\" id=\"posubtotr\" value=\"";  
          echo $row_rsh['posubtotr'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hbsubtotr\" type=\"text\" id=\"hbsubtotr\" value=\"";  
          echo $row_rsh['hbsubtotr'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hosubtotr\" type=\"text\" id=\"hosubtotr\" value=\"";  
          echo $row_rsh['hosubtotr'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mbsubtotr\" type=\"text\" id=\"mbsubtotr\" value=\"";  
          echo $row_rsh['mbsubtotr'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mosubtotr\" type=\"text\" id=\"mosubtotr\" value=\"";  
          echo $row_rsh['mosubtotr'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Otras 
      Causas</font></strong></td>
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Subtotal</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        <strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pbotras\" type=\"text\" id=\"pbotras\" value=\"";  
          echo $row_rsh['pbotras'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pootras\" type=\"text\" id=\"pootras\" value=\"";  
          echo $row_rsh['pootras'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hbotras\" type=\"text\" id=\"hbotras\" value=\"";  
          echo $row_rsh['hbotras'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hootras\" type=\"text\" id=\"hootras\" value=\"";  
          echo $row_rsh['hootras'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mbotras\" type=\"text\" id=\"mbotras\" value=\"";  
          echo $row_rsh['mbotras'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mootras\" type=\"text\" id=\"mootras\" value=\"";  
          echo $row_rsh['mootras'];
   echo "\" size=\"4\" maxlength=\"4\" >";   
print <<<EOQ
        </font></div></td>
  </tr>
  <tr> 
    <td colspan="2"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 
      Hospitalizaciones</font></strong></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"pbtot\" type=\"text\" id=\"pbtot\" value=\"";  
          echo $row_rsh['pbtot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 
EOQ;
   echo "<input name=\"potot\" type=\"text\" id=\"potot\" value=\"";  
          echo $row_rsh['potot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hbtot\" type=\"text\" id=\"hbtot\" value=\"";  
          echo $row_rsh['hbtot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
   echo "<input name=\"hotot\" type=\"text\" id=\"hotot\" value=\"";  
          echo $row_rsh['hotot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mbtot\" type=\"text\" id=\"mbtot\" value=\"";  
          echo $row_rsh['mbtot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
   echo "<input name=\"motot\" type=\"text\" id=\"motot\" value=\"";  
          echo $row_rsh['motot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></div></td>
  </tr>
</table>
EOQ;
$data.=" \t \t \t Hospitalizaciones\t \t \t \n";
$data.=" \t  Ni�os \t  Hombres \t  \t Mujeres \t \n";
$data.="Grupo edad\t CR \t O \t CR \t O\t CR \t O\t\n";
$data.="< 1 a�o\t".$row_rsh['pbm1']."\t".$row_rsh['pom1']."\t".
       $row_rsh['hbm1']."\t".$row_rsh['hom1']."\t".
       $row_rsh['mbm1']."\t".$row_rsh['mom1']."\t\n";
if(strcmp( $fechai,'2006-03-29')>0)
	$data.= "1-4 a�os\t";
if(strcmp( $fechat,'2006-03-29')<=0)
	$data.= "1-9 a�os\t";   
$data.=$row_rsh['pb1_9']."\t".$row_rsh['po1_9']."\t".
       $row_rsh['hb1_9']."\t".$row_rsh['ho1_9']."\t".
       $row_rsh['mb1_9']."\t".$row_rsh['mo1_9']."\t\n";
if(strcmp( $fechai,'2006-03-29')>0)
	$data.= "5-14 a�os\t";
if(strcmp( $fechat,'2006-03-29')<=0)
	$data.= "10-14 a�os\t";
$data.=$row_rsh['pb10_14']."\t".$row_rsh['po10_14']."\t".
       $row_rsh['hb10_14']."\t".$row_rsh['ho10_14']."\t".
       $row_rsh['mb10_14']."\t".$row_rsh['mo10_14']."\t\n";
$data.="15-64 a�os\t".$row_rsh['pb15_64']."\t".$row_rsh['po15_64']."\t".
       $row_rsh['hb15_64']."\t".$row_rsh['ho15_64']."\t".
       $row_rsh['mb15_64']."\t".$row_rsh['mo15_64']."\t\n";
$data.="65 y m�s a�o\t".$row_rsh['pb65ym']."\t".$row_rsh['po65ym']."\t".
       $row_rsh['hb65ym']."\t".$row_rsh['ho65ym']."\t".
       $row_rsh['mb65ym']."\t".$row_rsh['mo65ym']."\t\n";
$data.="Subtotal Resp.\t".$row_rsh['pbsubtotr']."\t".$row_rsh['posubtotr']."\t".
       $row_rsh['hbsubtotr']."\t".$row_rsh['hosubtotr']."\t".
       $row_rsh['mbsubtotr']."\t".$row_rsh['mosubtotr']."\t\n";
$data.="Subtotal Otras\t".$row_rsh['pbotras']."\t".$row_rsh['pootras']."\t".
       $row_rsh['hbotras']."\t".$row_rsh['hootras']."\t".
       $row_rsh['mbotras']."\t".$row_rsh['mootras']."\t\n";
$data.="Total hosp.\t".$row_rsh['pbtot']."\t".$row_rsh['potot']."\t".
       $row_rsh['hbtot']."\t".$row_rsh['hotot']."\t".
       $row_rsh['mbtot']."\t".$row_rsh['motot']."\t\n";
fwrite($fp,$data);
// Otras hospitalizaciones
$query_rsfh="select 
			sum(circulatorias_m1) as circulatorias_m1,
			sum(circulatorias_1a4) as circulatorias_1a4,
			sum(circulatorias_5a14) as circulatorias_5a14,
			sum(circulatorias_15a64) as circulatorias_15a64,
			sum(circulatorias_65ym) as circulatorias_65ym,
			sum(trauma_m1) as trauma_m1,
			sum(trauma_1a4) as trauma_1a4,
			sum(trauma_5a14) as trauma_5a14,
			sum(trauma_15a64) as trauma_15a64,
			sum(trauma_65ym) as trauma_65ym,
			sum(cirurg_m1) as cirurg_m1,
			sum(cirurg_1a4) as cirurg_1a4,
			sum(cirurg_5a14) as cirurg_5a14,
			sum(cirurg_15a64) as cirurg_15a64,
			sum(cirurg_65ym) as cirurg_65ym,
			sum(demas_m1) as demas_m1,
			sum(demas_1a4) as demas_1a4,
			sum(demas_5a14) as demas_5a14,
			sum(demas_15a64) as demas_15a64,
			sum(demas_65ym) as demas_65ym,
			sum(circulatorias_m1+trauma_m1+cirurg_m1+demas_m1) as tothospo_m1,
			sum(circulatorias_1a4+trauma_1a4+cirurg_1a4+demas_1a4) as tothospo_1a4,
			sum(circulatorias_5a14+trauma_5a14+cirurg_5a14+demas_5a14) as tothospo_5a14,
			sum(circulatorias_15a64+trauma_15a64+cirurg_15a64+demas_15a64) as tothospo_15a64,
			sum(circulatorias_65ym+trauma_65ym+cirurg_65ym+demas_65ym) as tothospo_65ym,
			sum(circulatorias_m1 + circulatorias_1a4 + circulatorias_5a14 + circulatorias_15a64 + circulatorias_65ym) 
			as totcirculatorias,
			sum(trauma_m1 + trauma_1a4 + trauma_5a14 + trauma_15a64 + trauma_65ym) as tottrauma,
			sum(cirurg_m1 + cirurg_1a4 + cirurg_5a14 + cirurg_15a64 + cirurg_65ym) as totcirurg,
			sum(demas_m1 + demas_1a4 + demas_5a14 + demas_15a64 + demas_65ym) as totdemas,
			sum(circulatorias_m1 + trauma_m1 + cirurg_m1 + demas_m1
			+ circulatorias_1a4 + trauma_1a4 + cirurg_1a4 + demas_1a4
			+ circulatorias_5a14 + trauma_5a14 + cirurg_5a14 + demas_5a14
			+ circulatorias_15a64 + trauma_15a64 + cirurg_15a64+ demas_15a64
			+ circulatorias_65ym + trauma_65ym + cirurg_65ym + demas_65ym )as tothospo
             from hospitalizao
             where id_estab=".$_SESSION['id_estab']." and fecha between '".$fechai."' and '".$fechat."'";
	$rsfh = safe_query($query_rsfh);
       $row_rsfh = mysql_fetch_assoc($rsfh);
       $totalRows_rsfh = mysql_num_rows($rsfh);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Hospitalizaciones por otros diagnosticos
</strong></font> 
</caption>
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Hospitalizaciones</strong></font></div></td>
	<td> <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Total</strong></font></div></td>
    <td> <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>-1 anno</strong></font></div></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>1 - 4 annos</strong></font></div></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>5 - 14 annos</strong></font></div></td>
	  <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>15 - 64 annos</strong></font></div></td>
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>65 y mas annos</strong></font></div></td>
  </tr>
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>TOTAL POR otros diagnosticos</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothospo\" type=\"text\" id=\"tothospo\" value=\"";
	 if(!empty($row_rsfh['tothospo']))
        echo $row_rsfh['tothospo']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothospo_m1\" type=\"text\" id=\"tothospo_m1\" value=\"";
     if(!empty($row_rsfh['tothospo_m1']))
        echo $row_rsfh['tothospo_m1']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothospo_1a4\" type=\"text\" id=\"tothospo_1a4\" value=\"";
     if(!empty($row_rsfh['tothospo_1a4']))
        echo $row_rsfh['tothospo_1a4']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothospo_5a14\" type=\"text\" id=\"tothospo_5a14\" value=\"";
     if(!empty($row_rsfh['tothospo_5a14']))
        echo $row_rsfh['tothospo_5a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothospo_15a64\" type=\"text\" id=\"tothospo_15a64\" value=\"";
     if(!empty($row_rsfh['tothospo_15a64']))
        echo $row_rsfh['tothospo_15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tothospo_65ym\" type=\"text\" id=\"tothospo_65ym\" value=\"";
     if(!empty($row_rsfh['tothospo_65ym']))
        echo $row_rsfh['tothospo_65ym']; 
     else
        echo 0;
		echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
       </strong></font></div></td>
  </tr> 
  
  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>POR CAUSAS CIRCULATORIAS</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totcirculatorias\" type=\"text\" id=\"totcirculatorias\" value=\"";
	 if(!empty($row_rsfh['totcirculatorias']))
        echo $row_rsfh['totcirculatorias']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circulatorias_m1\" type=\"text\" id=\"circulatorias_m1\" value=\"";
     if(!empty($row_rsfh['circulatorias_m1']))
        echo $row_rsfh['circulatorias_m1']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
."onBlur=\"return calculoh(document.f.circulatorias_m1,document.f.circulatorias_m1h,document.f.totcirculatorias,document.f.tothospo_m1,document.f.tothospo)\" >";
   echo "<input name=\"circulatorias_m1h\" type=\"hidden\" id=\"circulatorias_m1h\" value=\""; 
     if( isset( $row_rsfh['circulatorias_m1']))
          echo $row_rsfh['circulatorias_m1'];
     else
          echo 0;
   echo "\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circulatorias_1a4\" type=\"text\" id=\circulatorias_1a4\" value=\"";
     if(!empty($row_rsfh['circulatorias_1a4']))
        echo $row_rsfh['circulatorias_1a4']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
."onBlur=\"return calculoh(document.f.circulatorias_1a4,document.f.circulatorias_1a4h,document.f.totcirculatorias,document.f.tothospo_1a4,document.f.tothospo)\" >";
   echo "<input name=\"circulatorias_1a4h\" type=\"hidden\" id=\"circulatorias_1a4h\" value=\""; 
     if( isset( $row_rsfh['circulatorias_1a4']))
          echo $row_rsfh['circulatorias_1a4'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circulatorias_5a14\" type=\"text\" id=\"circulatorias_5a14\" value=\"";
     if(!empty($row_rsfh['circulatorias_5a14']))
        echo $row_rsfh['circulatorias_5a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	."onBlur=\"return calculoh(document.f.circulatorias_5a14,document.f.circulatorias_5a14h,document.f.totcirculatorias,document.f.tothospo_5a14,document.f.tothospo)\" >";
   echo "<input name=\"circulatorias_5a14h\" type=\"hidden\" id=\"circulatorias_5a14h\" value=\""; 
     if( isset( $row_rsfh['circulatorias_5a14']))
          echo $row_rsfh['circulatorias_5a14'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circulatorias_15a64\" type=\"text\" id=\"circulatorias_15a64\" value=\"";
     if(!empty($row_rsfh['circulatorias_15a64']))
        echo $row_rsfh['circulatorias_15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
  ."onBlur=\"return calculoh(document.f.circulatorias_15a64,document.f.circulatorias_15a64h,document.f.totcirculatorias,document.f.tothospo_15a64,document.f.tothospo)\" >";
   echo "<input name=\"circulatorias_15a64h\" type=\"hidden\" id=\"circulatorias_15a64h\" value=\""; 
     if( isset( $row_rsfh['circulatorias_15a64']))
          echo $row_rsfh['circulatorias_15a64'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"circulatorias_65ym\" type=\"text\" id=\"circulatorias_65ym\" value=\"";
     if(!empty($row_rsfh['circulatorias_65ym']))
        echo $row_rsfh['circulatorias_65ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	  ."onBlur=\"return calculoh(document.f.circulatorias_65ym,document.f.circulatorias_65ymh,document.f.totcirculatorias,document.f.tothospo_65ym,document.f.tothospo)\" >";
   echo "<input name=\"circulatorias_65ymh\" type=\"hidden\" id=\"circulatorias_65ymh\" value=\""; 
     if( isset( $row_rsfh['circulatorias_65ym']))
          echo $row_rsfh['circulatorias_65ym'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
  </tr> 

  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>POR TRAUMATISMOS Y ENVENENAMIENTOS</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"tottraumah\" type=\"text\" id=\"tottraumah\" value=\"";
	 if(!empty($row_rsfh['tottrauma']))
        echo $row_rsfh['tottrauma']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"traumah_m1\" type=\"text\" id=\"traumah_m1\" value=\"";
     if(!empty($row_rsfh['trauma_m1']))
        echo $row_rsfh['trauma_m1']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
."onBlur=\"return calculoh(document.f.traumah_m1,document.f.traumah_m1h,document.f.tottraumah,document.f.tothospo_m1,document.f.tothospo)\" >";
   echo "<input name=\"traumah_m1h\" type=\"hidden\" id=\"traumah_m1h\" value=\""; 
     if( isset( $row_rsfh['trauma_m1']))
          echo $row_rsfh['trauma_m1'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"traumah_1a4\" type=\"text\" id=\"traumah_1a4\" value=\"";
     if(!empty($row_rsfh['trauma_1a4']))
        echo $row_rsfh['trauma_1a4']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
	."onBlur=\"return calculoh(document.f.traumah_1a4,document.f.traumah_1a4h,document.f.tottraumah,document.f.tothospo_1a4,document.f.tothospo)\" >";
   echo "<input name=\"traumah_1a4h\" type=\"hidden\" id=\"traumah_1a4h\" value=\""; 
     if( isset( $row_rsfh['trauma_1a4']))
          echo $row_rsfh['trauma_1a4'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"traumah_5a14\" type=\"text\" id=\"traumah_5a14\" value=\"";
     if(!empty($row_rsfh['trauma_5a14']))
        echo $row_rsfh['trauma_5a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
   ."onBlur=\"return calculoh(document.f.traumah_5a14,document.f.traumah_5a14h,document.f.tottraumah,document.f.tothospo_5a14,document.f.tothospo)\" >";
   echo "<input name=\"traumah_5a14h\" type=\"hidden\" id=\"traumah_5a14h\" value=\""; 
     if( isset( $row_rsfh['trauma_5a14']))
          echo $row_rsfh['trauma_5a14'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"traumah_15a64\" type=\"text\" id=\"traumah_15a64\" value=\"";
     if(!empty($row_rsfh['trauma_15a64']))
        echo $row_rsfh['trauma_15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	."onBlur=\"return calculoh(document.f.traumah_15a64,document.f.traumah_15a64h,document.f.tottraumah,document.f.tothospo_15a64,document.f.tothospo)\" >";
   echo "<input name=\"traumah_15a64h\" type=\"hidden\" id=\"traumah_15a64h\" value=\""; 
     if( isset( $row_rsfh['trauma_15a64']))
          echo $row_rsfh['trauma_15a64'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"traumah_65ym\" type=\"text\" id=\"traumah_65ym\" value=\"";
     if(!empty($row_rsfh['trauma_65ym']))
        echo $row_rsfh['trauma_65ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
	."onBlur=\"return calculoh(document.f.traumah_65ym,document.f.traumah_65ymh,document.f.tottraumah,document.f.tothospo_65ym,document.f.tothospo)\" >";
   echo "<input name=\"traumah_65ymh\" type=\"hidden\" id=\"traumah_65ymh\" value=\""; 
     if( isset( $row_rsfh['trauma_65ym']))
          echo $row_rsfh['trauma_65ym'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
  </tr>

  <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Cirugias de Urgencias</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totcirurg\" type=\"text\" id=\"totcirurg\" value=\"";
	 if(!empty($row_rsfh['totcirurg']))
        echo $row_rsfh['totcirurg']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"cirurg_m1\" type=\"text\" id=\"cirurg_m1\" value=\"";
     if(!empty($row_rsfh['cirurg_m1']))
        echo $row_rsfh['cirurg_m1']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
."onBlur=\"return calculoh(document.f.cirurg_m1,document.f.cirurg_m1h,document.f.totcirurg,document.f.tothospo_m1,document.f.tothospo)\" >";
   echo "<input name=\"cirurg_m1h\" type=\"hidden\" id=\"cirurg_m1h\" value=\""; 
     if( isset( $row_rsfh['cirurg_m1']))
          echo $row_rsfh['cirurg_m1'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"cirurg_1a4\" type=\"text\" id=\"cirurg_1a4\" value=\"";
     if(!empty($row_rsfh['cirurg_1a4']))
        echo $row_rsfh['cirurg_1a4']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
	."onBlur=\"return calculoh(document.f.cirurg_1a4,document.f.cirurg_1a4h,document.f.totcirurg,document.f.tothospo_1a4,document.f.tothospo)\" >";
   echo "<input name=\"cirurg_1a4h\" type=\"hidden\" id=\"cirurg_1a4h\" value=\""; 
     if( isset( $row_rsfh['cirurg_1a4']))
          echo $row_rsfh['cirurg_1a4'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"cirurg_5a14\" type=\"text\" id=\"cirurg_5a14\" value=\"";
     if(!empty($row_rsfh['cirurg_5a14']))
        echo $row_rsfh['cirurg_5a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
   ."onBlur=\"return calculoh(document.f.cirurg_5a14,document.f.cirurg_5a14h,document.f.totcirurg,document.f.tothospo_5a14,document.f.tothospo)\" >";
   echo "<input name=\"cirurg_5a14h\" type=\"hidden\" id=\"cirurg_5a14h\" value=\""; 
     if( isset( $row_rsfh['cirurg_5a14']))
          echo $row_rsfh['cirurg_5a14'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"cirurg_15a64\" type=\"text\" id=\"cirurg_15a64\" value=\"";
     if(!empty($row_rsfh['cirurg_15a64']))
        echo $row_rsfh['cirurg_15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	."onBlur=\"return calculoh(document.f.cirurg_15a64,document.f.cirurg_15a64h,document.f.totcirurg,document.f.tothospo_15a64,document.f.tothospo)\" >";
   echo "<input name=\"cirurg_15a64h\" type=\"hidden\" id=\"cirurg_15a64h\" value=\""; 
     if( isset( $row_rsfh['cirurg_15a64']))
          echo $row_rsfh['cirurg_15a64'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"cirurg_65ym\" type=\"text\" id=\"cirurg_65ym\" value=\"";
     if(!empty($row_rsfh['cirurg_65ym']))
        echo $row_rsfh['cirurg_65ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
	."onBlur=\"return calculoh(document.f.cirurg_65ym,document.f.cirurg_65ymh,document.f.totcirurg,document.f.tothospo_65ym,document.f.tothospo)\" >";
   echo "<input name=\"cirurg_65ymh\" type=\"hidden\" id=\"cirurg_65ymh\" value=\""; 
     if( isset( $row_rsfh['cirurg_65ym']))
          echo $row_rsfh['cirurg_65ym'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
  </tr>

 <tr> 
    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>POR LAS DEMAS CAUSAS</strong></font></div></td>
	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"totdemash\" type=\"text\" id=\"totdemash\" value=\"";
	  if(!empty($row_rsfh['totdemas']))
        echo $row_rsfh['totdemas']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demash_m1\" type=\"text\" id=\"demash_m1\" value=\"";
     if(!empty($row_rsfh['demas_m1']))
        echo $row_rsfh['demas_m1']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" "
."onBlur=\"return calculoh(document.f.demash_m1,document.f.demash_m1h,document.f.totdemash,document.f.tothospo_m1,document.f.tothospo)\" >";
   echo "<input name=\"demash_m1h\" type=\"hidden\" id=\"demash_m1h\" value=\""; 
     if( isset( $row_rsfh['demas_m1']))
          echo $row_rsfh['demas_m1'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demash_1a4\" type=\"text\" id=\"demash_1a4\" value=\"";
     if(!empty($row_rsfh['demas_1a4']))
        echo $row_rsfh['demas_1a4']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
."onBlur=\"return calculoh(document.f.demash_1a4,document.f.demash_1a4h,document.f.totdemash,document.f.tothospo_1a4,document.f.tothospo)\" >";
   echo "<input name=\"demash_1a4h\" type=\"hidden\" id=\"demash_1a4h\" value=\""; 
     if( isset( $row_rsfh['demas_1a4']))
          echo $row_rsfh['demas_1a4'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demash_5a14\" type=\"text\" id=\"demash_5a14\" value=\"";
     if(!empty($row_rsfh['demas_5a14']))
        echo $row_rsfh['demas_5a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	."onBlur=\"return calculoh(document.f.demash_5a14,document.f.demash_5a14h,document.f.totdemash,document.f.tothospo_5a14,document.f.tothospo)\" >";
   echo "<input name=\"demash_5a14h\" type=\"hidden\" id=\"demash_5a14h\" value=\""; 
     if( isset( $row_rsfh['demas_5a14']))
          echo $row_rsfh['demas_5a14'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demash_15a64\" type=\"text\" id=\"demash_15a64\" value=\"";
     if(!empty($row_rsfh['demas_15a64']))
        echo $row_rsfh['demas_15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	."onBlur=\"return calculoh(document.f.demash_15a64,document.f.demash_15a64h,document.f.totdemash,document.f.tothospo_15a64,document.f.tothospo)\" >";
   echo "<input name=\"demash_15a64h\" type=\"hidden\" id=\"demash_15a64h\" value=\""; 
     if( isset( $row_rsfh['demas_15a64']))
          echo $row_rsfh['demas_15a64'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"demash_65ym\" type=\"text\" id=\"demash_65ym\" value=\"";
     if(!empty($row_rsfh['demas_65ym']))
        echo $row_rsfh['demas_65ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\""
	."onBlur=\"return calculoh(document.f.demash_65ym,document.f.demash_65ymh,document.f.totdemash,document.f.tothospo_65ym,document.f.tothospo)\" >";
   echo "<input name=\"demash_65ymh\" type=\"hidden\" id=\"demash_65ymh\" value=\""; 
     if( isset( $row_rsfh['demas_65ym']))
          echo $row_rsfh['demas_65ym'];
     else
          echo 0;
   echo "\" >";	
print <<<EOQ
        </strong></font></div></td>
  </tr> 
EOQ;
$data="";
$data.=" \t \t \t Hospitalizaciones x otros diagnosticos\t \t \t \n";
$data.="Hospitalizaciones\t Total \t -1 anno \t 1-4 annos \t 5-14 annos\t 15-64 annos \t 65 y + annos\n";
$data.="Total x otros diagnosticos\t".$row_rsfh['tothospo']."\t".$row_rsfh['tothospo_m1']."\t".
       $row_rsfh['tothospo_1a4']."\t".$row_rsfh['tothospo_5a14']."\t".
       $row_rsfh['tothospo_15a64']."\t".$row_rsfh['tothospo_65ym']."\n";
$data.="Por causas circulatorias\t".$row_rsfh['totcirculatorias']."\t".$row_rsfh['circulatorias_m1']."\t".
       $row_rsfh['circulatorias_1a4']."\t".$row_rsfh['circulatorias_5a14']."\t".
       $row_rsfh['circulatorias_15a64']."\t".$row_rsfh['circulatorias_65ym']."\n";	 
$data.="Por traumatismos\t".$row_rsfh['tottrauma']."\t".$row_rsfh['trauma_m1']."\t".
       $row_rsfh['trauma_1a4']."\t".$row_rsfh['trauma_5a14']."\t".
       $row_rsfh['trauma_15a64']."\t".$row_rsfh['trauma_65ym']."\n";
$data.="Por cirugias de urgencias\t".$row_rsfh['totcirurg']."\t".$row_rsfh['cirurg_m1']."\t".
       $row_rsfh['cirurg_1a4']."\t".$row_rsfh['cirurg_5a14']."\t".
       $row_rsfh['cirurg_15a64']."\t".$row_rsfh['cirurg_65ym']."\n";	 
$data.="Por las demas causas\t".$row_rsfh['totdemas']."\t".$row_rsfh['demas_m1']."\t".
       $row_rsfh['demas_1a4']."\t".$row_rsfh['demas_5a14']."\t".
       $row_rsfh['demas_15a64']."\t".$row_rsfh['demas_65ym']."\n";	 	
fwrite($fp,$data);	      	   	   
// egresos
   $query_rse="select sum(presp) as presp,
                      sum(potra) as potra,
                      sum(hresp) as hresp,
                      sum(hotra) as hotra,
                      sum(mresp) as mresp,
                      sum(motra) as motra,
               sum(presp + potra) as ptot  ,
               sum(hresp + hotra) as htot  ,
               sum(mresp + motra) as mtot
               from egresos
               where id_estab=".$_SESSION['id_estab']." and fecha between '".$fechai."' and '".$fechat."'";
       $rse = safe_query($query_rse);
       $row_rse = mysql_fetch_assoc($rse);
       $totalRows_rse = mysql_num_rows($rse);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Egresos </font></strong> 
  </caption>
  <tr> 
    <td width="152">&nbsp;</td>
    <td width="126"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;os</font></strong></div></td>
    <td colspan="2"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Adultos</font></strong></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>
    <td><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Pediatr&iacute;a</font></strong></div></td>
    <td colspan="2"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Medicina</font></strong></div></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
    <td width="147"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Hombres 
        </font></strong></div></td>
    <td width="157"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Mujeres</font></strong></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Por 
      causas respiratorias</font></strong></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"presp\" type=\"text\" id=\"presp\" value=\"";  
      if(!empty($row_rse['presp']))
          echo $row_rse['presp'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hresp\" type=\"text\" id=\"hresp\" value=\"";  
          echo $row_rse['hresp'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mresp\" type=\"text\" id=\"mresp\" value=\"";  
          echo $row_rse['mresp'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Por 
      otras Patologias</font></strong></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"potra\" type=\"text\" id=\"potra\" value=\"";  
          echo $row_rse['potra'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"hotra\" type=\"text\" id=\"hotra\" value=\"";  
          echo $row_rse['hotra'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"motra\" type=\"text\" id=\"motra\" value=\"";  
          echo $row_rse['motra'];
   echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
  </tr>
  <tr> 
    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 
      Egresos</font></strong></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"ptot\" type=\"text\" id=\"ptot\" value=\"";  
          echo $row_rse['ptot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"htot\" type=\"text\" id=\"htot\" value=\"";  
          echo $row_rse['htot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"mtot\" type=\"text\" id=\"mtot\" value=\"";  
          echo $row_rse['mtot'];
   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       
print <<<EOQ
        </font></strong></div></td>
  </tr>
</table>
EOQ;
$data=" \t \t Egresos\t \t \t\n";
$data.="Causas\tNi�os\t \t Adultos\t \t\n";
$data.="\tPediatria\t \t Medicina\t \t\n";
$data.=" \t \t Hombres \t Mujeres\t\n";
$data.="Por causa Resp\t".$row_rse['presp']."\t".$row_rse['hresp']."\t".$row_rse['mresp']."\n";
$data.="Por otras Pat.\t".$row_rse['potra']."\t".$row_rse['hotra']."\t".$row_rse['motra']."\n";
$data.="Total Egresos\t".$row_rse['ptot']."\t".$row_rse['htot']."\t".$row_rse['mtot']."\n";
fwrite($fp,$data);
 } // fin de urbanos
if(strcmp($_SESSION['tipo'],'sapu')==0){ // si es sapu
   $query_rsd = "SELECT sum(cbnino) as cbnino,
                     sum(cbadul) as cbadul,
                     sum(hbnino) as hbnino,
                     sum(hbadul) as hbadul,
                     sum(cnnino) as cnnino,
                     sum(hnnino) as hnnino,
                     sum(cnadul) as cnadul,
                     sum(hnadul) as hnadul, 
               sum(cbnino + hbnino) as totbn, 
               sum(cbadul + hbadul) as totba,
               sum(cnnino + hnnino) as totnn, 
               sum(cnadul + hnadul) as totna 
              FROM derivaciones where id_estab=".$_SESSION['id_estab'].
              " and fecha between '".$fechai."' and '".$fechat."'";
  $rsd = safe_query($query_rsd);
  $row_rsd = mysql_fetch_assoc($rsd);
  $totalRows_rsd = mysql_num_rows($rsd);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Derivaciones </strong></font> 
  </caption>
  <tr> 
    <td width="112"><div align="center"></div></td>
    <td colspan="2"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Bronquitis, 
        sindrome bronquial obst.</font></strong></div></td>
    <td colspan="2"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Neumonia, 
        Bronconeumonia</font></strong></div></td>
  </tr>
  <tr> 
    <td><div align="center"></div></td>
    <td width="169">
      <div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;o</font></strong></div></td>
    <td width="46">
      <div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Adulto</font></strong></div></td>
    <td width="125"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;o 
        </font></strong></div></td>
    <td width="126"><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Adulto</font></strong></div></td>
  </tr>
  <tr> 
    <td><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"totbn\" type=\"text\" id=\"totbn\" value=\"";
        echo $row_rsd['totbn']; 
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"totba\" type=\"text\" id=\"totba\" value=\"";
        echo $row_rsd['totba']; 
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"totnn\" type=\"text\" id=\"totnn\" value=\"";
        echo $row_rsd['totnn']; 
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"totna\" type=\"text\" id=\"totna\" value=\"";
        echo $row_rsd['totna']; 
    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";
print <<<EOQ
        </font></strong></div></td>
  </tr>
  <tr> 
    <td><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
     Casa/Consultorio</font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"cbnino\" type=\"text\" id=\"cbnino\" value=\"";
        echo $row_rsd['cbnino']; 
    echo "\" size=\"4\" maxlength=\"4\" >"; 
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"cbadul\" type=\"text\" id=\"cbadul\" value=\"";
        echo $row_rsd['cbadul']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"cnnino\" type=\"text\" id=\"cnnino\" value=\"";
        echo $row_rsd['cnnino']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
    echo "<input name=\"cnadul\" type=\"text\" id=\"cnadul\" value=\"";
     if(!empty($row_rsd['cnadul']))
        echo $row_rsd['cnadul']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
  </tr>
  <tr> 
    <td><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Hospital</font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"hbnino\" type=\"text\" id=\"hbnino\" value=\"";
        echo $row_rsd['hbnino']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"hbadul\" type=\"text\" id=\"hbadul\" value=\"";
        echo $row_rsd['hbadul']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
EOQ;
    echo "<input name=\"hnnino\" type=\"text\" id=\"hnnino\" value=\"";
        echo $row_rsd['hnnino']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
    echo "<input name=\"hnadul\" type=\"text\" id=\"hnadul\" value=\"";
        echo $row_rsd['hnadul']; 
    echo "\" size=\"4\" maxlength=\"4\" >";
print <<<EOQ
        </font></strong></div></td>
  </tr>
</table>
EOQ;
$data="\nDerivaciones\tBronquitis\t \tNeumonia\t \n";
$data.="\tNi�o\tAdulto\tNi�o\tAdulto\n";
$data.="Total\t".$row_rsd['totbn']."\t".$row_rsd['totba']."\t".$row_rsd['totnn']."\t".$row_rsd['totna']."\n";
$data.="Casa/Cons.\t".$row_rsd['cbnino']."\t".$row_rsd['cbadul']."\t".$row_rsd['cnnino']."\t".$row_rsd['cnadul']."\n";
$data.="Hospital\t".$row_rsd['hbnino']."\t".$row_rsd['hbadul']."\t".$row_rsd['hnnino']."\t".$row_rsd['hnadul']."\n";
fwrite($fp,$data);

 } // fin de sapu

$query_rsfh = "SELECT 
               sum(falli0a14) as falli0a14,
               sum(falli15a64) as falli15a64,
               sum(falli65a74) as falli65a74,
               sum(falli75ym) as falli75ym, 
               sum(falle0a14) as falle0a14,
               sum(falle15a64) as falle15a64,
               sum(falle65a74) as falle65a74,
               sum(falle75ym) as falle75ym ,
               sum(falleh0a14) as falleh0a14,
               sum(falleh15a64) as falleh15a64,
               sum(falleh65a74) as falleh65a74,
               sum(falleh75ym) as falleh75ym ,
			   sum(ifi0a14) as ifi0a14,
				sum(ifi15a64) as ifi15a64,
				sum(ifi65a74) as ifi65a74,
				sum(ifi75ym) as ifi75ym
               FROM fallecidoh 
               where id_estab=".$_SESSION['id_estab']." and fecha between '".
                     $fechai. "' and '" .$fechat."'";

$rsfh = safe_query($query_rsfh);
$row_rsfh = mysql_fetch_assoc($rsfh);
$totalRows_rsfh = mysql_num_rows($rsfh);
print <<<EOQ
<table width="600" border="0" align="center">
  <caption>
  <font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Fallecidos 
</strong></font> 
</caption>
  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Condici&oacute;n</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>0-14 a�os</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>15-64 a�os</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>65-74 a�os</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>75 y m�s a�os</strong></font></div></td>
  </tr>

  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Al ingresar Urg.</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli0a14\" type=\"text\" id=\"falli0a14\" value=\"";
     if(!empty($row_rsfh['falli0a14']))
        echo $row_rsfh['falli0a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli15a64\" type=\"text\" id=\"falli15a64\" value=\"";
     if(!empty($row_rsfh['falli15a64']))
        echo $row_rsfh['falli15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli65a74\" type=\"text\" id=\"falli65a74\" value=\"";
     if(!empty($row_rsfh['falli65a74']))
        echo $row_rsfh['falli65a74']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli75ym\" type=\"text\" id=\"falli75ym\" value=\"";
     if(!empty($row_rsfh['falli75ym']))
        echo $row_rsfh['falli75ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
<tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Al Ingreso Urg.x IRA</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli0a14ira\" type=\"text\" id=\"falli0a14ira\" value=\"";
     if(!empty($row_rsfh['falli0a14ira']))
        echo $row_rsfh['falli0a14ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli15a64ira\" type=\"text\" id=\"falli15a64ira\" value=\"";
     if(!empty($row_rsfh['falli15a64ira']))
        echo $row_rsfh['falli15a64ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli65a74ira\" type=\"text\" id=\"falli65a74ira\" value=\"";
     if(!empty($row_rsfh['falli65a74ira']))
        echo $row_rsfh['falli65a74ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falli75ymira\" type=\"text\" id=\"falli75ymira\" value=\"";
     if(!empty($row_rsfh['falli75ymira']))
        echo $row_rsfh['falli75ymira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>

  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>En el Serv.Urg.</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle0a14\" type=\"text\" id=\"falle0a14\" value=\"";
     if(!empty($row_rsfh['falle0a14']))
        echo $row_rsfh['falle0a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle15a64\" type=\"text\" id=\"falle15a64\" value=\"";
     if(!empty($row_rsfh['falle15a64']))
        echo $row_rsfh['falle15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle65a74\" type=\"text\" id=\"falle65a74\" value=\"";
     if(!empty($row_rsfh['falle65a74']))
        echo $row_rsfh['falle65a74']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle75ym\" type=\"text\" id=\"falle75ym\" value=\"";
     if(!empty($row_rsfh['falle75ym']))
        echo $row_rsfh['falle75ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
<tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>En el Serv.Urg.x IRA</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle0a14ira\" type=\"text\" id=\"falle0a14ira\" value=\"";
     if(!empty($row_rsfh['falle0a14ira']))
        echo $row_rsfh['falle0a14ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle15a64ira\" type=\"text\" id=\"falle15a64ira\" value=\"";
     if(!empty($row_rsfh['falle15a64ira']))
        echo $row_rsfh['falle15a64ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle65a74ira\" type=\"text\" id=\"falle65a74ira\" value=\"";
     if(!empty($row_rsfh['falle65a74ira']))
        echo $row_rsfh['falle65a74ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falle75ymira\" type=\"text\" id=\"falle75ymira\" value=\"";
     if(!empty($row_rsfh['falle75ymira']))
        echo $row_rsfh['falle75ymira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
  
  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Hospitalizados</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh0a14\" type=\"text\" id=\"falleh0a14\" value=\"";
     if(!empty($row_rsfh['falleh0a14']))
        echo $row_rsfh['falleh0a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh15a64\" type=\"text\" id=\"falleh15a64\" value=\"";
     if(!empty($row_rsfh['falleh15a64']))
        echo $row_rsfh['falleh15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh65a74\" type=\"text\" id=\"falleh65a74\" value=\"";
     if(!empty($row_rsfh['falleh65a74']))
        echo $row_rsfh['falleh65a74']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh75ym\" type=\"text\" id=\"falleh75ym\" value=\"";
     if(!empty($row_rsfh['falleh75ym']))
        echo $row_rsfh['falleh75ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
 <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Hospitalizados X IRA</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh0a14ira\" type=\"text\" id=\"falleh0a14ira\" value=\"";
     if(!empty($row_rsfh['falleh0a14ira']))
        echo $row_rsfh['falleh0a14ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh15a64ira\" type=\"text\" id=\"falleh15a64ira\" value=\"";
     if(!empty($row_rsfh['falleh15a64ira']))
        echo $row_rsfh['falleh15a64ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh65a74ira\" type=\"text\" id=\"falleh65a74ira\" value=\"";
     if(!empty($row_rsfh['falleh65a74ira']))
        echo $row_rsfh['falleh65a74ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh75ymira\" type=\"text\" id=\"falleh75ymira\" value=\"";
     if(!empty($row_rsfh['falleh75ymira']))
        echo $row_rsfh['falleh75ymira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Examenes IFI</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"ifi0a14\" type=\"text\" id=\"ifi0a14\" value=\"";
     if(!empty($row_rsfh['ifi0a14']))
        echo $row_rsfh['ifi0a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"ifi15a64\" type=\"text\" id=\"ifi15a64\" value=\"";
     if(!empty($row_rsfh['ifi15a64']))
        echo $row_rsfh['ifi15a64']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"ifi65a74\" type=\"text\" id=\"ifi65a74\" value=\"";
     if(!empty($row_rsfh['ifi65a74']))
        echo $row_rsfh['ifi65a74']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"ifi75ym\" type=\"text\" id=\"ifi75ym\" value=\"";
     if(!empty($row_rsfh['ifi75ym']))
        echo $row_rsfh['ifi75ym']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\">";
print <<<EOQ
        </strong></font></div></td>
  </tr>
</table>
EOQ;
$data=" \t \t Fallecidos x \t causa resp.\n";
$data.="Grupos\t0-14 a�os \t 15-64 a�os\t 65-74 a�os\t 75 y m�s\n";
$data.="Al ingreso x otras causas".$row_rsfh['falli0a14']."\t".$row_rsfh['falli15a64']."\t".$row_rsfh['falli65a74']."\t".$row_rsfh['falli75ym']."\n";
$data.="Al ingreso x IRA".$row_rsfh['falli0a14ira']."\t".$row_rsfh['falli15a64ira']."\t".$row_rsfh['falli65a74ira']."\t".$row_rsfh['falli75ymira']."\n";
$data.="En Urg. x otras causas".$row_rsfh['falle0a14']."\t".$row_rsfh['falle15a64']."\t".$row_rsfh['falle65a74']."\t".$row_rsfh['falle75ym']."\n";
$data.="En Urg. x IRA".$row_rsfh['falle0a14ira']."\t".$row_rsfh['falle15a64ira']."\t".$row_rsfh['falle65a74ira']."\t".$row_rsfh['falle75ymira']."\n";
$data.="Hospitaliz. x otras causas".$row_rsfh['falleh0a14']."\t".$row_rsfh['falleh15a64']."\t".$row_rsfh['falleh65a74']."\t".$row_rsfh['falleh75ym']."\n";
$data.="Hospitaliz. x IRA".$row_rsfh['falleh0a14ira']."\t".$row_rsfh['falleh15a64ira']."\t".$row_rsfh['falleh65a74ira']."\t".$row_rsfh['falleh75ymira']."\n";
$data.="Examenes IFI ".$row_rsfh['ifi0a14']."\t".$row_rsfh['ifi15a64']."\t".$row_rsfh['ifi65a74']."\t".$row_rsfh['ifi75ym']."\n";
fwrite($fp,$data);
fclose($fp);
echo "<a href=".$fileExcel.">Abra Excel</a>";
} // fin funcion resumen
// Ingresa parametros para resumir
function ingparam(){
if (isset($_GET['id']))
    $_SESSION['id_estab']=$_GET['id'];
if (isset($_GET['nom']))
    $_SESSION['nombre']=$_GET['nom'];
if (isset($_GET['tipo']))
    $_SESSION['tipo']=$_GET['tipo'];
echo "<body><form action=\"index.php?page=resumen&file=index&func=resumen\" method=\"post\" name=\"form1\">"
 ."<table width=\"550\" border=\"0\" align=\"center\">"
 ." <caption>"
 ." <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Resumen "
 ." de Atenciones de Urgencia<br>"
 ."Establecimiento:</strong>&nbsp;&nbsp;&nbsp;". $_SESSION['nombre']."</font>" 
 ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"imagenes/urg5.jpg\" width=\"100\" height=\"50\" align=\"absmiddle\">"
 ."</caption>"
 ."<tr> "
 ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha "
 ." desde (dd/mm/aaaa): "
 ." <input name=\"fechai\" type=\"text\" onBlur=\"return esfecha(document.forms.form1.fechai)\" "
 ." value=\"".$_SESSION['fechai']."\" id=\"fechai\" size=\"10\" maxlength=\"10\">"
 ." </strong>  </font></td>"
 ." <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha "
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
  case "resumen":
   resumen();
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



function esfechar(elemento) {

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

