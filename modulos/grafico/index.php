<?php
include "header.php";
/*
function grafica(){
$desde=$_POST['desde'];
$hasta=$_POST['hasta'];
$title="Serie de Tiempo";
$leyenda=$_SESSION['nombre'];
$ejey="casos";
include("jpgraph-1.16/src/jpgraph.php");
include("jpgraph-1.16/src/jpgraph_bar.php");
include("jpgraph-1.16/src/jpgraph_line.php");
$jpgcache=CACHE_DIR;
$query="select bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 +
               bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 +
               bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 +
               bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +
               bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym  as totira
               from aturg_urbana where id_estab=".$_SESSION['id_estab']
               ." and fecha between '".$_POST['fechai'] ."' and '".$_POST['fechat']."'"
               ." order by fecha";
$rs=safe_query($query);
$row_rs=mysql_fetch_assoc($rs);
do{
   $punto[]=$row_rs['totira'];
//   echo $row_rs['totira']."<br>";
  }while($row_rs=mysql_fetch_assoc($rs) );
$graph_name="puntos.png";
// set general graph details 
$graph = new graph(400, 350, $graph_name,1,true); 
//    margins, background color, scale and shadow for the whole graph 
$graph->img->SetMargin(80,40,40, 80); 
$graph->SetMarginColor('white'); 
$graph->SetScale('textlin'); 
$graph->SetShadow(); 
//    set the title and font 
$graph->title->Set($title); 
//$graph->title->SetFont(FF_VERDANA, FS_BOLD, 14); 
$graph->title->SetFont(FF_FONT1, FS_BOLD, 14); 
//    set the y-axis and title it 
//$graph->yaxis->SetLabelAngle(0); 
$graph->yaxis->title->Set($ejey); 
$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD); 

$graph->xaxis->SetFont(FF_FONT1, FS_NORMAL, 8); 
//$graph->xaxis->SetTickLabels($hosp); 
//    set the graph title and font 
$graph->xaxis->title->Set('Meses'); 
$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD); 

$lin1 = new LinePlot($punto); 
$lin1->SetColor("blue");
$lin1->SetLegend($leyenda); 
$lin1->value->Show();
$graph->Add($lin1); 
$graph->Stroke(); 

}
*/
// funcion que lista establecimientos
function estalis(){
if(($_SESSION['nivelautorizado']=='establecimiento')){
   $vid=$_SESSION['id_estab'];
   header("Location:index.php?page=grafico&file=index&func=ingparam&id=".$vid."");
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
echo "<a href=\"index.php?page=grafico&file=index&func=ingparam&id=".
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

function ingparam(){

if (isset($_GET['id']))
    $_SESSION['id_estab']=$_GET['id'];
if (isset($_GET['nom']))
    $_SESSION['nombre']=$_GET['nom'];
if (isset($_GET['tipo']))
    $_SESSION['tipo']=$_GET['tipo'];

echo "<body><form action=\"muestraserie.php\" method=\"post\" name=\"form1\">"
  ."<table width=\"550\" border=\"0\" align=\"center\" >"
   ." <caption>"
   ." <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Grafico "
   ." de Atenciones de Urgencia<br>"
    ."Establecimiento:&nbsp;&nbsp;&nbsp;</strong>". $_SESSION['nombre']."</font>" 
   ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"imagenes/www.jpg\" width=\"100\" height=\"50\" align=\"absmiddle\">"
    ."</caption>"
    ."<tr> "
    ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha "
    ." desde (dd/mm/aaaa): "
    ."    <input name=\"fechai\" type=\"text\" onBlur=\"return esfecha(document.forms.form1.fechai)\" "
   ." value=\"".$_SESSION['fechai']."\" id=\"fechai\" size=\"10\" maxlength=\"10\">"
    ."   </strong> </font></td>"
    ."  <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha "
    ."   hasta (dd/mm/aaaa): "
    ."   <input name=\"fechat\" type=\"text\" onBlur=\"return esfecha(document.forms.form1.fechat)\" "
    ." value=\"".$_SESSION['fechat']."\" id=\"fechat\" size=\"10\" maxlength=\"10\">"
    ." </strong>  </font></td>"
    ."</tr>"
    ."<tr> "
    ." <td>&nbsp;<input type=\"hidden\" name=\"id_estab\" value=\"".$_SESSION['id_estab']."\">"
    ." <input type=\"hidden\" name=\"nomb\" value=\"".$_SESSION['nombre']."\"></td>"
    ." <td><input type=\"submit\" name=\"Submit\" value=\"Graficar\"></td>"
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
	alert ("Valor debe ser una fecha válida");
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
	alert ("Valor debe ser una fecha válida");
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
