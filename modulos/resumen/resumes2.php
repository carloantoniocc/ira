<STYLE TYPE="text/css">
<!-- 
H4 {font-family:Verdana,sans-serif; font-size:10pt;color:#0000CC}
B, TD {font-family:Verdana,sans-serif;font-size:8pt;
color:#0000CC}
TH {font-family:Verdana,sans-serif;font-size:9pt;
color:white;background-color:#0080C0} 
-->
</STYLE> 
<?php
include "header.php";
if (isset($_POST['ano']))
$ano=$_POST['ano'];
else
$ano=date("Y");
?>
<center>
<form method="post" action="index.php?page=resumen&file=resumes" >
<table><caption><h4>Casos de Atenciones de Urgencia</h4></caption>
<tr>
<td>Periodo del Resumen:</td>
<td>
<select name="ano" >
<?php 
for($i=0;$i<3;$i++){
$p=date("Y")-$i;
echo "<option value=".$p." ";
if ($p==$ano)echo " SELECTED";
echo " >".$p."</option>";
}
?>
</select>
</td>
<td >
<input type="submit" name="enviar" value="Cambie el año y presione este botón" />
</td>
</tr>
</table>
</form>
</center>
<?php
//$ano=$_GET['ano'];
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
 and year(fecha)=".$ano."
 group by tipo_estab,`id_estab`,month(`fecha`)
order by tipo_estab desc,`id_estab`,month(`fecha`)";
$r=mysql_query($q);
while($row=mysql_fetch_assoc($r)){
$arreglo[]=$row;
}

$q="select * from establecimiento";
$re=mysql_query($q);
while($ro=mysql_fetch_assoc($re)){
$estab[]=$ro;
}
?>
<table><caption><h4><?php echo "Periodo: ".$ano."&nbsp;&nbsp;&nbsp;  Fecha consulta: ".date("Y-m-d H:m"); ?></h4></caption>
<tr>
<th>Establecimiento</td>
<th colspan="2">Enero</td>
<th colspan="2">Febrero</td>
<th colspan="2">Marzo</td>
<th colspan="2">Abril</td>
<th colspan="2">Mayo</td>
<th colspan="2">Junio</td>
<th colspan="2">Julio</td>
<th colspan="2">Agosto</td>
<th colspan="2">Septiembre</td>
<th colspan="2">Octubre</td>
<th colspan="2">Noviembre</td>
<th colspan="2">Diciembre</td>
<th colspan="2">Total Anual</td>
</tr>
<tr>
<td>&nbsp;</td>
<?php
for($i=1;$i<=13;$i++){
?>
<th>Total</td>
<th>Resp.</td>
<?php } ?>
</tr>
<?php
$tottot=0;
$totgentod=0;
$acons=999;
$atipo="";
$i=0;
$j=1;
echo "<tr>";
foreach($arreglo as $r){
	if($acons!=$r['id_estab']){
		
		if($i>0){ // terminar fila del establecimiento
			for($j=$k;$j<=12;$j++){
			echo "<td>0</td><td>0</td>";
			}
			echo "<td>".$tottot."</td><td>".$totgentod."</td>";
   			$tottot=$totgentod=0;
			echo "</tr>";
		}
		if($atipo!=$r['tipo_estab'])
			if($r['tipo_estab']=="H")
				echo "<tr><td><b>Hospitales</b></td></tr>";
			else
				echo "<tr><td><b>SAPUs</b></td></tr>";
		$k=1;
//		$consultorio=$d->getConsultorio($r['consultorio_atiende']);	
//		if(is_object($consultorio))
//		echo "<tr><td>".$consultorio->nombre."</td>";
//		else
//		echo "<tr><td>No especifica</td>";
		foreach($estab as $e){
			if($r['id_estab']==$e['id'])
				$nom=$e['nombre'];
		}
		echo "<tr><th>".$nom."</td>";
		$acons=$r['id_estab'] ;
		$atipo=$r['tipo_estab'];
	}
	for($j=$k;$j<=12;$j++){
		if($j==$r['mes']){
			echo "<td>".$r['tottot']."</td>";
			echo "<td>".$r['totgentod']."</td>";
			$tottot+=$r['tottot'];
			$totgentod+=$r['totgentod'];
			$tot[$k]+=$r['tottot'];
			$k++;
			break;
		} else {	
			echo "<td>0</td><td>0</td>";
			$k++;
		}
   } // fin del for
   
	$i++;
}// fin foreach
for($j=$k;$j<=12;$j++){
	echo "<td>0</td><td>0</td>";
}
echo "<td>".$tottot."</td><td>".$totgentod."</td>";
$tottot=$totgentod=0;
echo "</tr>";
?>
<?php //foreach($arreglo as $a){ ?>
<!-- <tr>
<td><?php //echo $a['id_estab']; ?></td>
<td><?php //echo $a['mes']; ?></td>
<td><?php //echo $a['tottot']; ?></td>
<td><?php //echo $a['totgentod']; ?></td>
</tr> -->
<?php
//}
?>
</table>
