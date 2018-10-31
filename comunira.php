<?php
include "header.php";
//datos de la última semana
$date=date("Y-m-d");
list($Y,$m,$d)=explode('-',$date);
$fechai=date("Y-m-d",strtotime('-7 days',mktime(0,0,0,$m,$d,$Y)));
$fechat=$date;

$query_rsb = "SELECT e.comuna,c.nombre,
               sum(bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       
               asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  
               neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  
               influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   
               larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +     
               resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym) as totira 

            FROM aturg_urbana a , establecimiento e,comuna c
            where a.id_estab = e.id
            and c.id = e.comuna
            and fecha between '".$fechai."' and '".$fechat."'
            group by e.comuna,c.nombre ";

$rsb = safe_query($query_rsb);
$totalRows_rsb = mysql_num_rows($rsb);

$query_rse = "SELECT e.comuna,e.nombre,
               sum(bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       
               asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  
               neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  
               influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   
               larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +     
               resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym) as totira 

            FROM aturg_urbana a , establecimiento e
            where a.id_estab = e.id
            and fecha between '".$fechai."' and '".$fechat."'
            group by e.comuna,e.nombre ";

$rse = safe_query($query_rse);
$totalRows_rse = mysql_num_rows($rse);

$rstring="n=".$totalRows_rsb;
$rstring.="&fi=".$fechai."&ft=".$fechat;
for($i=0;$i<$totalRows_rsb;$i++){
  $row=mysql_fetch_assoc($rsb);
  $rstring.="&comuna".$i."=".$row['comuna'].
            "&nombre".$i."=".$row['nombre'].
            "&ira".$i."=".$row['totira'];
}

$rstring.="&m=".$totalRows_rse;
for($i=0;$i<$totalRows_rse;$i++){
  $row=mysql_fetch_assoc($rse);
  $rstring.="&comunae".$i."=".$row['comuna'].
              "&estab".$i."=".$row['nombre'].
               "&irae".$i."=".$row['totira'];
}

echo $rstring;
?>