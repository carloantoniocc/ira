<?php
include "header.php";
function grafica(){
ini_set("memory_limit","256M");
//$nomb=$_POST['nomb'];
//$ano=$_GET['ano'];
$ano=2008;
$nomb=$_GET['nom'];
$title="Canal Endémico Consultas Respiratorias\n Establecimiento: ".$nomb."   "."Año ".$ano;
//$leyenda=$_SESSION['nombre'];
$ejey="casos";
include("/webfolders/ssmoc2/html/ira/jpgraph-1.22/jpgraph-1.22/src/jpgraph.php");
include("/webfolders/ssmoc2/html/ira/jpgraph-1.22/jpgraph-1.22/src/jpgraph_bar.php");
include("/webfolders/ssmoc2/html/ira/jpgraph-1.22/jpgraph-1.22/src/jpgraph_line.php");
$jpgcache=CACHE_DIR;
// Obtiene el maximo de los maximos 
$query="select max(q3) as maxi
          from canalendemico where id_estab=".
        $_GET['id']." and ano=".$ano;
$rsm=safe_query($query);
$row_rsm=mysql_fetch_assoc($rsm);
$maxi=$row_rsm['maxi'];

$query="select semana,mediana,q1,q3,valoreal
               from canalendemico where id_estab=".
               $_GET['id']." and ano=".$ano.
               " order by semana";
$rs=safe_query($query);
if(mysql_num_rows($rs)<=1){
 echo "Sorry, no se puede trazar una línea con un solo punto\n"; 
}
else
{
$row_rs=mysql_fetch_assoc($rs);
do{
   if($row_rs['valoreal']==0){
      $query_rss="select fechai,fechat
                   from semana where semana=".$row_rs['semana']." and ano=".$ano;
      $rss=safe_query($query_rss);
      $row_rss=mysql_fetch_assoc($rss);
      $totalRows_rss = mysql_num_rows($rss);
      if($totalRows_rss>0){
         $query_rse="Select 0 from aturg_urbana where id_estab=".$_GET['id'].
                   " and fecha='".$row_rss['fechat']."'";
         $rse = safe_query($query_rse);
         $row_rse= mysql_fetch_assoc($rse);
         $totalRows_rse= mysql_num_rows($rse);
         if($totalRows_rse>0){
            $query_rsu = "SELECT 
                sum(bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       
                asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  
                neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  
                influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   
                larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym + 
				  iraltas_m1 + iraltas_1a9 + iraltas_10a14 + iraltas_15a64+  iraltas_65ym +   
                resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym) as totira 
                from aturg_urbana
                where id_estab=".$_GET['id'].
                " and fecha between '".$row_rss['fechai']."' and '".$row_rss['fechat']."'";
            $rsu = safe_query($query_rsu);
            $row_rsu = mysql_fetch_assoc($rsu);
            $totalRows_rsu = mysql_num_rows($rsu);
            if($totalRows_rsu >0 && $row_rsu['totira'] >0)
               $punto[]=$row_rsu['totira'];
            else
               $punto[]="";
         }
         else
              $punto[]="";
       }
      else
           $punto[]="";
    }
    else
   {
   $punto[]=$row_rs['valoreal'];
   }
 //  echo "real ".$row_rs['valoreal']." urg ".$row_rsu['totira']."<br>";
   $mediana[]=$row_rs['mediana'];
   $q1[]=$row_rs['q1'];
   $q3[]=$row_rs['q3'];
   $dia[]=$row_rs['semana'];
  }while($row_rs=mysql_fetch_assoc($rs) );
$graph_name="puntos.png";
// set general graph details 
$graph = new graph(600, 450, $graph_name,1,true); 
//    margins, background color, scale and shadow for the whole graph 
$graph->img->SetMargin(80,40,40, 80); 
$graph->SetMarginColor('white'); 
//$graph->SetScale('textlin'); 
//$graph->SetScale('intlin',0,200,0,0);
$maxi+=200;
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
$graph->xaxis->SetTickLabels($dia); 
//    set the graph title and font 
$graph->xaxis->title->Set('Semanas Epidemiologicas'); 
$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD); 

$lin1 = new LinePlot($punto); 
$lin1->SetColor("blue");
$lin1->SetLegend("Real"); 
//$lin1->value->Show();
$graph->Add($lin1); 

$lin2 = new LinePlot($mediana); 
$lin2->SetColor("magenta");
$lin2->SetLegend("Mediana"); 
$lin2->SetStyle('dotted');
//$lin1->value->Show();
$graph->Add($lin2); 

$lin3 = new LinePlot($q1); 
$lin3->SetColor("orange");
$lin3->SetLegend("Q1"); 
//$lin1->value->Show();
$graph->Add($lin3); 

$lin4 = new LinePlot($q3); 
$lin4->SetColor("red");
$lin4->SetLegend("Q3"); 
//$lin1->value->Show();
$graph->Add($lin4); 

$graph->legend->Pos(0.05,0.5,"right","center");

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
