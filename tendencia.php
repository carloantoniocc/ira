<?php
include "header.php";
$ano=$_GET['ano'];
$estab=$_GET['estab'];
$nome=$_GET['nome'];
$title="Tendencia Consultas Urgencia $nome Año $ano  ";
//$leyenda=$_SESSION['nombre'];
$ejey="casos";
include("/webfolders/ssmoc2/html/ira/jpgraph-1.22/jpgraph-1.22/src/jpgraph.php");
include("/webfolders/ssmoc2/html/ira/jpgraph-1.22/jpgraph-1.22/src/jpgraph_bar.php");
include("/webfolders/ssmoc2/html/ira/jpgraph-1.22/jpgraph-1.22/src/jpgraph_line.php");
$jpgcache=CACHE_DIR;
$q="SELECT tipo_estab,`id_estab`,month(`fecha`) as mes,
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
                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+iraltas_15a64+resto_15a64 +
                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+iraltas_65ym+resto_65ym)  as totgentod
FROM aturg_urbana, establecimiento 
where establecimiento.id = aturg_urbana.id_estab 
 and establecimiento.id=".$estab.
 " and year(fecha)=".$ano."
 group by tipo_estab,`id_estab`,month(`fecha`)
order by tipo_estab desc,`id_estab`,month(`fecha`)";
$r=mysql_query($q) or die("error sql: $q # ".mysql_error());
while($row=mysql_fetch_assoc($r)){
$totg[]=$row['tottot'];
$toti[]=$row['totgentod'];
//$mes[]=$row['mes'];
}
$mes=array(0=>'Enero',1=>'Febrero',2=>'Marzo',3=>'Abril',4=>'Mayo',5=>'Junio',6=>'Julio',7=>'Agosto',8=>'Septiembre',9=>'Octubre',
10=>'Noviembre',11=>'Diciembre');
$graph_name="tendencia.png";
// set general graph details 
$graph = new graph(600, 450, $graph_name,1,true); 
//    margins, background color, scale and shadow for the whole graph 
$graph->img->SetMargin(80,40,40, 80); 
$graph->SetMarginColor('white'); 
//$graph->SetScale('textlin'); 
//$graph->SetScale('intlin',0,200,0,0);
$maxi=14000;
$graph->SetScale('linlin',0,$maxi);
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
$graph->xaxis->SetTickLabels($mes); 
//    set the graph title and font 
$graph->xaxis->title->Set('Meses'); 
$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD); 

$lin1 = new LinePlot($totg); 
$lin1->SetColor("blue");
$lin1->SetLegend("Total"); 
//$lin1->value->Show();
$graph->Add($lin1); 

$lin2 = new LinePlot($toti); 
$lin2->SetColor("red");
$lin2->SetLegend("IRA"); 
//$lin1->value->Show();
$graph->Add($lin2); 

$graph->legend->Pos(0.05,0.5,"right","center");

$graph->Stroke();

?>