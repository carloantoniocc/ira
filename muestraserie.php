<?php
include "header.php";
function grafica(){

if (!isset($_SESSION['fechai']))
    $_SESSION['fechai']=$_POST['fechai'];
if (!isset($_SESSION['fechat']))
    $_SESSION['fechat']=$_POST['fechat'];
$nomb=$_POST['nomb'];
$fecha = $_POST['fechai'];
$diax = substr($fecha,0,2);
$mes = substr($fecha,3,2);
$ano = substr($fecha,6,4);
$fechai = $ano."-".$mes."-".$diax;

$fecha = $_POST['fechat'];
$diax = substr($fecha,0,2);
$mes = substr($fecha,3,2);
$ano = substr($fecha,6,4);
$fechat = $ano."-".$mes."-".$diax;

//echo "id_estab ".$_POST['id_estab'];
$title="Casos IRA \n Establecimiento: ".$nomb."\n"."Entre el ".$fechai." y el ".$fechat;
$leyenda=$_SESSION['nombre'];
$ejey="casos";
include("jpgraph-1.22/jpgraph-1.22/src/jpgraph.php");
include("jpgraph-1.22/jpgraph-1.22/src/jpgraph_bar.php");
include("jpgraph-1.22/jpgraph-1.22/src/jpgraph_line.php");
$jpgcache=CACHE_DIR;
$query="select fecha, bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 +
               bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 +
               bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 +
               bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +
               bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym  as totira
               from aturg_urbana where id_estab=".
               $_POST['id_estab'].
               " and fecha between '".$fechai."' and '".$fechat."'".
               "order by fecha";
$rs=safe_query($query);
if(mysql_num_rows($rs)<=1){
 echo "Sorry, no se puede trazar una línea con un solo punto\n"; 
}
else
{
$row_rs=mysql_fetch_assoc($rs);
do{
   $punto[]=$row_rs['totira'];
   $dia[]=substr($row_rs['fecha'],5,2).substr($row_rs['fecha'],8,2);
  }while($row_rs=mysql_fetch_assoc($rs) );
$graph_name="puntos.png";
// set general graph details 
$graph = new graph(600, 450, $graph_name,1,true); 
//    margins, background color, scale and shadow for the whole graph 
$graph->img->SetMargin(80,40,40, 80); 
$graph->SetMarginColor('white'); 
//$graph->SetScale('textlin'); 
//$graph->SetScale('intlin',0,200,0,0);
$graph->SetScale('linlin',0,250);
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
$graph->xaxis->SetTickLabels($dia); 
//    set the graph title and font 
$graph->xaxis->title->Set('Fechas'); 
$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD); 

$lin1 = new LinePlot($punto); 
$lin1->SetColor("blue");
$lin1->SetLegend($leyenda); 
//$lin1->value->Show();
$graph->Add($lin1); 
$graph->Stroke();

for($i = 0; $i < count($punto); $i++) { 
    $row_head .= '<th ><font color=\"#0000CC\" size=\"1\"></font></th>'; 
    $row_plan .= '<td ><font color=\"#0000CC\" size=\"1\">'.number_format($punto[$i], 0).'</font></td>'; 
} 
$archi=$jpgcache.$graph_name;
echo "<br><center>";
echo "<img src=".$archi." width=\"400\" height=\"300\" />"
."<div style=\"text-align: center\">" 
."<h3>Datos</h3> "
."<table width=\"400\" border=\"1\" cellpadding=\"5\" cellspacing=\"0\">" 
."<tr align=\"center\"><th ><font color=\"#0000CC\" size=\"1\">Fecha</font></th>$row_head</tr> "
."<tr align=\"right\"><td ><font color=\"#0000CC\" size=\"1\"><b>Casos</b></font></td>$row_plan</tr>" 
."</table>" 
."</div> "
. "</center>";

 }
}
// Selección de funciones
switch($func){
   default:
    grafica();
	break;
}
