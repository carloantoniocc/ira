<?php

include "header.php";

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {

  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {

    case "text":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;    

    case "long":

    case "int":

      $theValue = ($theValue != "") ? intval($theValue) : 0;

      break;

    case "double":

      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : 0;

      break;

    case "date":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;

    case "defined":

      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

      break;

  }

  return $theValue;

} // fin funci� GetSQLValueString

// funcion que lista establecimientos

function estalis(){

if(($_SESSION['nivelautorizado']=='establecimiento')){

   $vid=$_SESSION['id_estab'];

   header("Location:index.php?page=registra&file=indexn&func=listaurg&id=".$vid."");

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

echo "<a href=\"index.php?page=registra&file=indexn&func=listaurg&id=".

     $row_rsb['id']."&nom=".$row_rsb['nombre']."&tipo=".$row_rsb['tipo']."\" >"; 

print <<<EOQ

       <img src="button_select.png" alt="Ver establecimientos" width="14" height="13" border="0"> 

        </a> </div></td>

  </tr>

EOQ;

 } while ($row_rsb = mysql_fetch_assoc($rsb));

mysql_free_result($rsb);

 }

}



function modifica(){

global $e, $f;

$updateSQL = sprintf("UPDATE aturg_urbana SET fecha=%s, totm1=%s, tot1a9=%s, tot10a14=%s, tot15a64=%s, tot65ym=%s,

                      totsinm1=%s, totsin1a9=%s, totsin10a14=%s, totsin15a64=%s, totsin65ym=%s,

                      bronq_m1=%s, bronq_1a9=%s, bronq_10a14=%s, bronq_15a64=%s, bronq_65ym=%s, 

                      asma_m1=%s, asma_1a9=%s, asma_10a14=%s, asma_15a64=%s, asma_65ym=%s, 

                      neumo_m1=%s, neumo_1a9=%s, neumo_10a14=%s, neumo_15a64=%s, neumo_65ym=%s,

                      influ_m1=%s, influ_1a9=%s, influ_10a14=%s, influ_15a64=%s, influ_65ym=%s, 

                      larin_m1=%s, larin_1a9=%s, larin_10a14=%s, larin_15a64=%s, larin_65ym=%s, 

					  iraltas_m1=%s, iraltas_1a9=%s, iraltas_10a14=%s, iraltas_15a64=%s, iraltas_65ym=%s, 

                      resto_m1=%s, resto_1a9=%s, resto_10a14=%s, resto_15a64=%s, resto_65ym=%s WHERE id=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['totm1'], "int"),

                       GetSQLValueString($_POST['tot1a9'], "int"),

                       GetSQLValueString($_POST['tot10a14'], "int"),

                       GetSQLValueString($_POST['tot15a64'], "int"),

                       GetSQLValueString($_POST['tot65ym'], "int"),

                       GetSQLValueString($_POST['totsinm1'], "int"),

                       GetSQLValueString($_POST['totsin1a9'], "int"),

                       GetSQLValueString($_POST['totsin10a14'], "int"),

                       GetSQLValueString($_POST['totsin15a64'], "int"),

                       GetSQLValueString($_POST['totsin65ym'], "int"),

                       GetSQLValueString($_POST['bronq_m1'], "int"),

                       GetSQLValueString($_POST['bronq_1a9'], "int"),

                       GetSQLValueString($_POST['bronq_10a14'], "int"),

                       GetSQLValueString($_POST['bronq_15a64'], "int"),

                       GetSQLValueString($_POST['bronq_65ym'], "int"),

                       GetSQLValueString($_POST['asma_m1'], "int"),

                       GetSQLValueString($_POST['asma_1a9'], "int"),

                       GetSQLValueString($_POST['asma_10a14'], "int"),

                       GetSQLValueString($_POST['asma_15a64'], "int"),

                       GetSQLValueString($_POST['asma_65ym'], "int"),

                       GetSQLValueString($_POST['neumo_m1'], "int"),

                       GetSQLValueString($_POST['neumo_1a9'], "int"),

                       GetSQLValueString($_POST['neumo_10a14'], "int"),

                       GetSQLValueString($_POST['neumo_15a64'], "int"),

                       GetSQLValueString($_POST['neumo_65ym'], "int"),

                       GetSQLValueString($_POST['influ_m1'], "int"),

                       GetSQLValueString($_POST['influ_1a9'], "int"),

                       GetSQLValueString($_POST['influ_10a14'], "int"),

                       GetSQLValueString($_POST['influ_15a64'], "int"),

                       GetSQLValueString($_POST['influ_65ym'], "int"),

                       GetSQLValueString($_POST['larin_m1'], "int"),

                       GetSQLValueString($_POST['larin_1a9'], "int"),

                       GetSQLValueString($_POST['larin_10a14'], "int"),

                       GetSQLValueString($_POST['larin_15a64'], "int"),

                       GetSQLValueString($_POST['larin_65ym'], "int"),

					   GetSQLValueString($_POST['iraltas_m1'], "int"),

                       GetSQLValueString($_POST['iraltas_1a9'], "int"),

                       GetSQLValueString($_POST['iraltas_10a14'], "int"),

                       GetSQLValueString($_POST['iraltas_15a64'], "int"),

                       GetSQLValueString($_POST['iraltas_65ym'], "int"),

                       GetSQLValueString($_POST['resto_m1'], "int"),

                       GetSQLValueString($_POST['resto_1a9'], "int"),

                       GetSQLValueString($_POST['resto_10a14'], "int"),

                       GetSQLValueString($_POST['resto_15a64'], "int"),

                       GetSQLValueString($_POST['resto_65ym'], "int"),

                       GetSQLValueString($_POST['id'], "int"));



  $Result1 = safe_query($updateSQL);

  

  $updateSQL=sprintf("UPDATE aturgo SET fecha=%s, infarto_m1=%s, infarto_1a4=%s, infarto_5a14=%s, infarto_15a64=%s, infarto_65ym=%s,

                      vascular_m1=%s, vascular_1a4=%s, vascular_5a14=%s, vascular_15a64=%s, vascular_65ym=%s,

                      hipertensiva_m1=%s, hipertensiva_1a4=%s, hipertensiva_5a14=%s, hipertensiva_15a64=%s, hipertensiva_65ym=%s, 

                      arritmia_m1=%s, arritmia_1a4=%s, arritmia_5a14=%s, arritmia_15a64=%s, arritmia_65ym=%s, 

                      otrascirc_m1=%s, otrascirc_1a4=%s, otrascirc_5a14=%s, otrascirc_15a64=%s, otrascirc_65ym=%s,

                      transito_m1=%s, transito_1a4=%s, transito_5a14=%s, transito_15a64=%s, transito_65ym=%s, 

                      otrasext_m1=%s, otrasext_1a4=%s, otrasext_5a14=%s, otrasext_15a64=%s, otrasext_65ym=%s, 

					  demas_m1=%s, demas_1a4=%s, demas_5a14=%s, demas_15a64=%s, demas_65ym=%s 

                       WHERE id_estab=%s and fecha=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['infarto_m1'], "int"),

                       GetSQLValueString($_POST['infarto_1a4'], "int"),

                       GetSQLValueString($_POST['infarto_5a14'], "int"),

                       GetSQLValueString($_POST['infarto_15a64'], "int"),

                       GetSQLValueString($_POST['infarto_65ym'], "int"),

                       GetSQLValueString($_POST['vascular_m1'], "int"),

                       GetSQLValueString($_POST['vascular_1a4'], "int"),

                       GetSQLValueString($_POST['vascular_5a14'], "int"),

                       GetSQLValueString($_POST['vascular_15a64'], "int"),

                       GetSQLValueString($_POST['vascular_65ym'], "int"),

                       GetSQLValueString($_POST['hipertensiva_m1'], "int"),

                       GetSQLValueString($_POST['hipertensiva_1a4'], "int"),

                       GetSQLValueString($_POST['hipertensiva_5a14'], "int"),

                       GetSQLValueString($_POST['hipertensiva_15a64'], "int"),

                       GetSQLValueString($_POST['hipertensiva_65ym'], "int"),

                       GetSQLValueString($_POST['arritmia_m1'], "int"),

                       GetSQLValueString($_POST['arritmia_1a4'], "int"),

                       GetSQLValueString($_POST['arritmia_5a14'], "int"),

                       GetSQLValueString($_POST['arritmia_15a64'], "int"),

                       GetSQLValueString($_POST['arritmia_65ym'], "int"),

                       GetSQLValueString($_POST['otrascirc_m1'], "int"),

                       GetSQLValueString($_POST['otrascirc_1a4'], "int"),

                       GetSQLValueString($_POST['otrascirc_5a14'], "int"),

                       GetSQLValueString($_POST['otrascirc_15a64'], "int"),

                       GetSQLValueString($_POST['otrascirc_65ym'], "int"),

                       GetSQLValueString($_POST['transito_m1'], "int"),

                       GetSQLValueString($_POST['transito_1a4'], "int"),

                       GetSQLValueString($_POST['transito_5a14'], "int"),

                       GetSQLValueString($_POST['transito_15a64'], "int"),

                       GetSQLValueString($_POST['transito_65ym'], "int"),

                       GetSQLValueString($_POST['otrasext_m1'], "int"),

                       GetSQLValueString($_POST['otrasext_1a4'], "int"),

                       GetSQLValueString($_POST['otrasext_5a14'], "int"),

                       GetSQLValueString($_POST['otrasext_15a64'], "int"),

                       GetSQLValueString($_POST['otrasext_65ym'], "int"),

                       GetSQLValueString($_POST['demas_m1'], "int"),

                       GetSQLValueString($_POST['demas_1a4'], "int"),

                       GetSQLValueString($_POST['demas_5a14'], "int"),

                       GetSQLValueString($_POST['demas_15a64'], "int"),

                       GetSQLValueString($_POST['demas_65ym'], "int"),

					    GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fechah'], "date")

					    );

    $Result1 = safe_query($updateSQL);





     $updateSQL = sprintf("UPDATE fallecidoh SET fecha=%s,

                           falle0a14=%s, falle15a64=%s, falle65a74=%s,falle75ym=%s,
						   falle0a14ira=%s, falle15a64ira=%s, falle65a74ira=%s,falle75ymira=%s,
                           falli0a14=%s, falli15a64=%s, falli65a74=%s, falli75ym=%s,
							falli0a14ira=%s, falli15a64ira=%s, falli65a74ira=%s, falli75ymira=%s,
                           falleh0a14=%s, falleh15a64=%s, falleh65a74=%s,falleh75ym=%s,
							falleh0a14ira=%s, falleh15a64ira=%s, falleh65a74ira=%s,falleh75ymira=%s,
							ifi0a14=%s, ifi15a64=%s, ifi65a74=%s, ifi75ym=%s
                           where id_estab=%s and fecha=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['falle0a14'], "int"),
                       GetSQLValueString($_POST['falle15a64'], "int"),
                       GetSQLValueString($_POST['falle65a74'], "int"),
                       GetSQLValueString($_POST['falle75ym'], "int"),
						GetSQLValueString($_POST['falle0a14ira'], "int"),
                       GetSQLValueString($_POST['falle15a64ira'], "int"),
                       GetSQLValueString($_POST['falle65a74ira'], "int"),
                       GetSQLValueString($_POST['falle75ymira'], "int"),
                       GetSQLValueString($_POST['falli0a14'], "int"),
                       GetSQLValueString($_POST['falli15a64'], "int"),
                       GetSQLValueString($_POST['falli65a74'], "int"),
                       GetSQLValueString($_POST['falli75ym'], "int"),
						GetSQLValueString($_POST['falli0a14ira'], "int"),
                       GetSQLValueString($_POST['falli15a64ira'], "int"),
                       GetSQLValueString($_POST['falli65a74ira'], "int"),
                       GetSQLValueString($_POST['falli75ymira'], "int"),
				   
                       GetSQLValueString($_POST['falleh0a14'], "int"),
                       GetSQLValueString($_POST['falleh15a64'], "int"),
                       GetSQLValueString($_POST['falleh65a74'], "int"),
                       GetSQLValueString($_POST['falleh75ym'], "int"),
						GetSQLValueString($_POST['falleh0a14ira'], "int"),
                       GetSQLValueString($_POST['falleh15a64ira'], "int"),
                       GetSQLValueString($_POST['falleh65a74ira'], "int"),
                       GetSQLValueString($_POST['falleh75ymira'], "int"),
					   
					   GetSQLValueString($_POST['ifi0a14'], "int"),
                       GetSQLValueString($_POST['ifi15a64'], "int"),
                       GetSQLValueString($_POST['ifi65a74'], "int"),
                       GetSQLValueString($_POST['ifi75ym'], "int"),
					   
                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fechah'], "date")

     );

    $Result1 = safe_query($updateSQL);



  if(strcmp($_SESSION['tipo'],'urbano')==0 || strcmp($_SESSION['tipo'],'provincial')==0){



     $updateSQL = sprintf("UPDATE hospitaliza SET fecha=%s,

                           pbm1=%s, pb1_9=%s, pb10_14=%s,pb15_64=%s, pb65ym=%s, pbotras=%s,

                           hbm1=%s, hb1_9=%s, hb10_14=%s,hb15_64=%s, hb65ym=%s, hbotras=%s,

                           mbm1=%s, mb1_9=%s, mb10_14=%s,mb15_64=%s, mb65ym=%s, mbotras=%s,

                           pom1=%s, po1_9=%s, po10_14=%s,po15_64=%s, po65ym=%s, pootras=%s,

                           hom1=%s, ho1_9=%s, ho10_14=%s,ho15_64=%s, ho65ym=%s, hootras=%s,

                           mom1=%s, mo1_9=%s, mo10_14=%s,mo15_64=%s, mo65ym=%s, mootras=%s,

                           utibm1=%s, utib1_9=%s, utib10_14=%s,utib15_64=%s, utib65ym=%s, utibotras=%s,

                           utitm1=%s, utit1_9=%s, utit10_14=%s,utit15_64=%s, utit65ym=%s,utitotras=%s,

                           ucitm1=%s, ucit1_9=%s, ucit10_14=%s,ucit15_64=%s, ucit65ym=%s,ucitotras=%s,

                           ucibm1=%s, ucib1_9=%s, ucib10_14=%s,ucib15_64=%s, ucib65ym=%s,ucibotras=%s,

                           camillasxcr=%s, camillasxo=%s

                           where id_estab=%s and fecha=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['pbm1'], "int"),

                       GetSQLValueString($_POST['pb1_9'], "int"),

                       GetSQLValueString($_POST['pb10_14'], "int"),

                       GetSQLValueString($_POST['pb15_64'], "int"),

                       GetSQLValueString($_POST['pb65ym'], "int"),

                       GetSQLValueString($_POST['pbotras'], "int"),

                       GetSQLValueString($_POST['hbm1'], "int"),

                       GetSQLValueString($_POST['hb1_9'], "int"),

                       GetSQLValueString($_POST['hb10_14'], "int"),

                       GetSQLValueString($_POST['hb15_64'], "int"),

                       GetSQLValueString($_POST['hb65ym'], "int"),

                       GetSQLValueString($_POST['hbotras'], "int"),

                       GetSQLValueString($_POST['mbm1'], "int"),

                       GetSQLValueString($_POST['mb1_9'], "int"),

                       GetSQLValueString($_POST['mb10_14'], "int"),

                       GetSQLValueString($_POST['mb15_64'], "int"),

                       GetSQLValueString($_POST['mb65ym'], "int"),

                       GetSQLValueString($_POST['mbotras'], "int"),

                       GetSQLValueString($_POST['pom1'], "int"),

                       GetSQLValueString($_POST['po1_9'], "int"),

                       GetSQLValueString($_POST['po10_14'], "int"),

                       GetSQLValueString($_POST['po15_64'], "int"),

                       GetSQLValueString($_POST['po65ym'], "int"),

                       GetSQLValueString($_POST['pootras'], "int"),

                       GetSQLValueString($_POST['hom1'], "int"),

                       GetSQLValueString($_POST['ho1_9'], "int"),

                       GetSQLValueString($_POST['ho10_14'], "int"),

                       GetSQLValueString($_POST['ho15_64'], "int"),

                       GetSQLValueString($_POST['ho65ym'], "int"),

                       GetSQLValueString($_POST['hootras'], "int"),

                       GetSQLValueString($_POST['mom1'], "int"),

                       GetSQLValueString($_POST['mo1_9'], "int"),

                       GetSQLValueString($_POST['mo10_14'], "int"),

                       GetSQLValueString($_POST['mo15_64'], "int"),

                       GetSQLValueString($_POST['mo65ym'], "int"),

                       GetSQLValueString($_POST['mootras'], "int"),



                       GetSQLValueString($_POST['utibm1'], "int"),

                       GetSQLValueString($_POST['utib1_9'], "int"),

                       GetSQLValueString($_POST['utib10_14'], "int"),

                       GetSQLValueString($_POST['utib15_64'], "int"),

                       GetSQLValueString($_POST['utib65ym'], "int"),

                       GetSQLValueString($_POST['utibotras'], "int"),

                       GetSQLValueString($_POST['utitm1'], "int"),

                       GetSQLValueString($_POST['utit1_9'], "int"),

                       GetSQLValueString($_POST['utit10_14'], "int"),

                       GetSQLValueString($_POST['utit15_64'], "int"),

                       GetSQLValueString($_POST['utit65ym'], "int"),

                       GetSQLValueString($_POST['utitotras'], "int"),

                       GetSQLValueString($_POST['ucitm1'], "int"),

                       GetSQLValueString($_POST['ucit1_9'], "int"),

                       GetSQLValueString($_POST['ucit10_14'], "int"),

                       GetSQLValueString($_POST['ucit15_64'], "int"),

                       GetSQLValueString($_POST['ucit65ym'], "int"),

                       GetSQLValueString($_POST['ucitotras'], "int"),

                       GetSQLValueString($_POST['ucibm1'], "int"),

                       GetSQLValueString($_POST['ucib1_9'], "int"),

                       GetSQLValueString($_POST['ucib10_14'], "int"),

                       GetSQLValueString($_POST['ucib15_64'], "int"),

                       GetSQLValueString($_POST['ucib65ym'], "int"),

                       GetSQLValueString($_POST['ucibotras'], "int"),

                       GetSQLValueString($_POST['camillasxcr'], "int"),

                       GetSQLValueString($_POST['camillasxo'], "int"), 

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fechah'], "date")

     );

    $Result1 = safe_query($updateSQL);

 $updateSQL = sprintf("UPDATE hospitalizao SET fecha=%s,

                           circulatorias_m1=%s, circulatorias_1a4=%s, circulatorias_5a14=%s,circulatorias_15a64=%s,

						    circulatorias_65ym=%s, 

							trauma_m1=%s, trauma_1a4=%s, trauma_5a14=%s,trauma_15a64=%s,trauma_65ym=%s, 
							cirurg_m1=%s, cirurg_1a4=%s, cirurg_5a14=%s,cirurg_15a64=%s,cirurg_65ym=%s,

							demas_m1=%s, demas_1a4=%s, demas_5a14=%s,demas_15a64=%s,demas_65ym=%s 

                       where id_estab=%s and fecha=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['circulatorias_m1'], "int"),

                       GetSQLValueString($_POST['circulatorias_1a4'], "int"),

                       GetSQLValueString($_POST['circulatorias_5a14'], "int"),

                       GetSQLValueString($_POST['circulatorias_15a64'], "int"),

                       GetSQLValueString($_POST['circulatorias_65ym'], "int"),

                       GetSQLValueString($_POST['traumah_m1'], "int"),

                       GetSQLValueString($_POST['traumah_1a4'], "int"),

                       GetSQLValueString($_POST['traumah_5a14'], "int"),

                       GetSQLValueString($_POST['traumah_15a64'], "int"),

                       GetSQLValueString($_POST['traumah_65ym'], "int"),

					   GetSQLValueString($_POST['cirurg_m1'], "int"),

                       GetSQLValueString($_POST['cirurg_1a4'], "int"),

                       GetSQLValueString($_POST['cirurg_5a14'], "int"),

                       GetSQLValueString($_POST['cirurg_15a64'], "int"),

                       GetSQLValueString($_POST['cirurg_65ym'], "int"),
					   GetSQLValueString($_POST['demash_m1'], "int"),

                       GetSQLValueString($_POST['demash_1a4'], "int"),

                       GetSQLValueString($_POST['demash_5a14'], "int"),

                       GetSQLValueString($_POST['demash_15a64'], "int"),

                       GetSQLValueString($_POST['demash_65ym'], "int"),

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fechah'], "date")

    		 );

    $Result1 = safe_query($updateSQL);

	

     $updateSQL = sprintf("UPDATE egresos SET fecha=%s,

                           presp=%s, hresp=%s, mresp=%s,

                           potra=%s, hotra=%s, motra=%s

                           where id_estab=%s and fecha=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['presp'], "int"),

                       GetSQLValueString($_POST['hresp'], "int"),

                       GetSQLValueString($_POST['mresp'], "int"),

                       GetSQLValueString($_POST['potra'], "int"),

                       GetSQLValueString($_POST['hotra'], "int"),

                       GetSQLValueString($_POST['motra'], "int"),

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fechah'], "date")

     );

    $Result1 = safe_query($updateSQL);



  } // fin de urbanos

  if(strcmp($_SESSION['tipo'],'sapu')==0){



     $updateSQL = sprintf("UPDATE derivaciones SET fecha=%s,

                           hbnino=%s, cbnino=%s, hbadul=%s, cbadul=%s,

                           cnnino=%s, hnnino=%s, cnadul=%s, hnadul=%s

                           where id_estab=%s and fecha=%s",

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['hbnino'], "int"),

                       GetSQLValueString($_POST['cbnino'], "int"),

                       GetSQLValueString($_POST['hbadul'], "int"),

                       GetSQLValueString($_POST['cbadul'], "int"),

                       GetSQLValueString($_POST['cnnino'], "int"),

                       GetSQLValueString($_POST['hnnino'], "int"),

                       GetSQLValueString($_POST['cnadul'], "int"),

                       GetSQLValueString($_POST['hnadul'], "int"),

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fechah'], "date")

     );

    $Result1 = safe_query($updateSQL);

  } // fin sapu



  $insertGoTo = "index.php?page=registra&file=indexn&func=listaurg";

   header(sprintf("Location: %s", $insertGoTo));

}

function agrega(){

//echo "entra id=" . $id_estab;

   $mensajerror="";

    if(empty($_POST['fecha']))

     $mensajerror.="<li>Debe colocar la fecha\n";

    else {

     $query_rs=sprintf("select * from aturg_urbana where fecha='%s' and id_estab=%s ",

                       $_POST['fecha'],$_SESSION['id_estab']);

     $rs=safe_query($query_rs);

     $row_rs=mysql_fetch_assoc($rs);

     $totalRows_rs=mysql_num_rows($rs);

     if($totalRows_rs>0)

        $mensajerror.="<li>".$_POST['fecha']." es una fecha ya registrada\n";

     }

  if(empty($mensajerror)){

     if($_POST['totm1']=="")$_POST['totm1']=0;

     if($_POST['tot1a9']=="")$_POST['tot1a9']=0;

     if($_POST['tot10a14']=="")$_POST['tot10a14']=0;

     if($_POST['tot15a64']=="")$_POST['tot15a64']=0;

     if($_POST['tot65ym']=="")$_POST['tot65ym']=0;

     if($_POST['totsinm1']=="")$_POST['totsinm1']=0;

     if($_POST['totsin1a9']=="")$_POST['totsin1a9']=0;

     if($_POST['totsin10a14']=="")$_POST['totsin10a14']=0;

     if($_POST['totsin15a64']=="")$_POST['totsin15a64']=0;

     if($_POST['totsin65ym']=="")$_POST['totsin65ym']=0;

     if($_POST['bronq_m1']=="")$_POST['bronq_m1']=0;

     if($_POST['bronq_1a9']=="")$_POST['bronq_1a9']=0;

     if($_POST['bronq_10a14']=="")$_POST['bronq_10a14']=0;

     if($_POST['bronq_15a64']=="")$_POST['bronq_15a64']=0;

     if($_POST['bronq_65ym']=="")$_POST['bronq_65ym']=0;

     if($_POST['asma_m1']=="")$_POST['asma_m1']=0;

     if($_POST['asma_1a9']=="")$_POST['asma_1a9']=0;

     if($_POST['asma_10a14']=="")$_POST['asma_10a14']=0;

     if($_POST['asma_15a64']=="")$_POST['asma_15a64']=0;

     if($_POST['asma_65ym']=="")$_POST['asma_65ym']=0;

     if($_POST['neumo_m1']=="")$_POST['neumo_m1']=0;

     if($_POST['neumo_1a9']=="")$_POST['neumo_1a9']=0;

     if($_POST['neumo_10a14']=="")$_POST['neumo_10a14']=0;

     if($_POST['neumo_15a64']=="")$_POST['neumo_15a64']=0;

     if($_POST['neumo_65ym']=="")$_POST['neumo_65ym']=0;

     if($_POST['influ_m1']=="")$_POST['influ_m1']=0;

     if($_POST['influ_1a9']=="")$_POST['influ_1a9']=0;

     if($_POST['influ_10a14']=="")$_POST['influ_10a14']=0;

     if($_POST['influ_15a64']=="")$_POST['influ_15a64']=0;

     if($_POST['influ_65ym']=="")$_POST['influ_65ym']=0;

     if($_POST['larin_m1']=="")$_POST['larin_m1']=0;

     if($_POST['larin_1a9']=="")$_POST['larin_1a9']=0;

     if($_POST['larin_10a14']=="")$_POST['larin_10a14']=0;

     if($_POST['larin_15a64']=="")$_POST['larin_15a64']=0;

     if($_POST['larin_65ym']=="")$_POST['larin_65ym']=0;

	 

	 if($_POST['iraltas_m1']=="")$_POST['larin_m1']=0;

     if($_POST['iraltas_1a9']=="")$_POST['larin_1a9']=0;

     if($_POST['iraltas_10a14']=="")$_POST['larin_10a14']=0;

     if($_POST['iraltas_15a64']=="")$_POST['larin_15a64']=0;

     if($_POST['iraltas_65ym']=="")$_POST['larin_65ym']=0;

	 

     if($_POST['resto_m1']=="")$_POST['resto_m1']=0;

     if($_POST['resto_1a9']=="")$_POST['resto_1a9']=0;

     if($_POST['resto_10a14']=="")$_POST['resto_10a14']=0;

     if($_POST['resto_15a64']=="")$_POST['resto_15a64']=0;

     if($_POST['resto_65ym']=="")$_POST['resto_65ym']=0;



  $insertSQL = sprintf("INSERT INTO aturg_urbana (id_estab, fecha, 

                         totm1, tot1a9, tot10a14, tot15a64,tot65ym,

                         totsinm1,totsin1a9, totsin10a14, totsin15a64,totsin65ym,

                         bronq_m1, bronq_1a9, bronq_10a14, bronq_15a64, bronq_65ym,

                         asma_m1, asma_1a9, asma_10a14, asma_15a64, asma_65ym,

                         neumo_m1, neumo_1a9, neumo_10a14, neumo_15a64, neumo_65ym, 

                         influ_m1, influ_1a9, influ_10a14, influ_15a64, influ_65ym, 

                         larin_m1, larin_1a9, larin_10a14, larin_15a64, larin_65ym,

						 iraltas_m1, iraltas_1a9, iraltas_10a14, iraltas_15a64, iraltas_65ym,

                         resto_m1, resto_1a9, resto_10a14, resto_15a64, resto_65ym) 

                        VALUES (%s, %s,

                        %s, %s, %s, %s, %s, 

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, 

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, 

                        %s, %s, %s, %s, %s,

						%s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s)",

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['totm1'], "int"),

                       GetSQLValueString($_POST['tot1a9'], "int"),

                       GetSQLValueString($_POST['tot10a14'], "int"),

                       GetSQLValueString($_POST['tot15a64'], "int"),

                       GetSQLValueString($_POST['tot65ym'], "int"),

                       GetSQLValueString($_POST['totsinm1'], "int"),

                       GetSQLValueString($_POST['totsin1a9'], "int"),

                       GetSQLValueString($_POST['totsin10a14'], "int"),

                       GetSQLValueString($_POST['totsin15a64'], "int"),

                       GetSQLValueString($_POST['totsin65ym'], "int"),

                       GetSQLValueString($_POST['bronq_m1'], "int"),

                       GetSQLValueString($_POST['bronq_1a9'], "int"),

                       GetSQLValueString($_POST['bronq_10a14'], "int"),

                       GetSQLValueString($_POST['bronq_15a64'], "int"),

                       GetSQLValueString($_POST['bronq_65ym'], "int"),

                       GetSQLValueString($_POST['asma_m1'], "int"),

                       GetSQLValueString($_POST['asma_1a9'], "int"),

                       GetSQLValueString($_POST['asma_10a14'], "int"),

                       GetSQLValueString($_POST['asma_15a64'], "int"),

                       GetSQLValueString($_POST['asma_65ym'], "int"),

                       GetSQLValueString($_POST['neumo_m1'], "int"),

                       GetSQLValueString($_POST['neumo_1a9'], "int"),

                       GetSQLValueString($_POST['neumo_10a14'], "int"),

                       GetSQLValueString($_POST['neumo_15a64'], "int"),

                       GetSQLValueString($_POST['neumo_65ym'], "int"),

                       GetSQLValueString($_POST['influ_m1'], "int"),

                       GetSQLValueString($_POST['influ_1a9'], "int"),

                       GetSQLValueString($_POST['influ_10a14'], "int"),

                       GetSQLValueString($_POST['influ_15a64'], "int"),

                       GetSQLValueString($_POST['influ_65ym'], "int"),

					   

                       GetSQLValueString($_POST['larin_m1'], "int"),

                       GetSQLValueString($_POST['larin_1a9'], "int"),

                       GetSQLValueString($_POST['larin_10a14'], "int"),

                       GetSQLValueString($_POST['larin_15a64'], "int"),

                       GetSQLValueString($_POST['larin_65ym'], "int"),

					   

					    GetSQLValueString($_POST['iraltas_m1'], "int"),

                       GetSQLValueString($_POST['iraltas_1a9'], "int"),

                       GetSQLValueString($_POST['iraltas_10a14'], "int"),

                       GetSQLValueString($_POST['iraltas_15a64'], "int"),

                       GetSQLValueString($_POST['iraltas_65ym'], "int"),

					   

                       GetSQLValueString($_POST['resto_m1'], "int"),

                       GetSQLValueString($_POST['resto_1a9'], "int"),

                       GetSQLValueString($_POST['resto_10a14'], "int"),

                       GetSQLValueString($_POST['resto_15a64'], "int"),

                       GetSQLValueString($_POST['resto_65ym'], "int"));

  $Result1 = safe_query($insertSQL);

  

     if($_POST['infarto_m1']=="")$_POST['infarto_m1']=0;

     if($_POST['infarto_1a4']=="")$_POST['infarto_1a4']=0;

     if($_POST['infarto_5a14']=="")$_POST['infarto_5a14']=0;

     if($_POST['infarto_15a64']=="")$_POST['infarto_15a64']=0;

     if($_POST['infarto_65ym']=="")$_POST['infarto_65ym']=0;

	 if($_POST['vascular_m1']=="")$_POST['vascular_m1']=0;

     if($_POST['vascular_1a4']=="")$_POST['vascular_1a4']=0;

     if($_POST['vascular_5a14']=="")$_POST['vascular_5a14']=0;

     if($_POST['vascular_15a64']=="")$_POST['vascular_15a64']=0;

     if($_POST['vascular_65ym']=="")$_POST['vascular_65ym']=0; 

	 if($_POST['hipertensiva_m1']=="")$_POST['hipertensiva_m1']=0;

     if($_POST['hipertensiva_1a4']=="")$_POST['hipertensiva_1a4']=0;

     if($_POST['hipertensiva_5a14']=="")$_POST['hipertensiva_5a14']=0;

     if($_POST['hipertensiva_15a64']=="")$_POST['hipertensiva_15a64']=0;

     if($_POST['hipertensiva_65ym']=="")$_POST['hipertensiva_65ym']=0;

	 if($_POST['arritmia_m1']=="")$_POST['arritmia_m1']=0;

     if($_POST['arritmia_1a4']=="")$_POST['arritmia_1a4']=0;

     if($_POST['arritmia_5a14']=="")$_POST['arritmia_5a14']=0;

     if($_POST['arritmia_15a64']=="")$_POST['arritmia_15a64']=0;

     if($_POST['arritmia_65ym']=="")$_POST['arritmia_65ym']=0;

	 if($_POST['otrascirc_m1']=="")$_POST['otrascirc_m1']=0;

     if($_POST['otrascirc_1a4']=="")$_POST['otrascirc_1a4']=0;

     if($_POST['otrascirc_5a14']=="")$_POST['otrascirc_5a14']=0;

     if($_POST['otrascirc_15a64']=="")$_POST['otrascirc_15a64']=0;

     if($_POST['otrascirc_65ym']=="")$_POST['otrascirc_65ym']=0;

	 if($_POST['transito_m1']=="")$_POST['transito_m1']=0;

     if($_POST['transito_1a4']=="")$_POST['transito_1a4']=0;

     if($_POST['transito_5a14']=="")$_POST['transito_5a14']=0;

     if($_POST['transito_15a64']=="")$_POST['transito_15a64']=0;

     if($_POST['transito_65ym']=="")$_POST['transito_65ym']=0;

	 if($_POST['otrasext_m1']=="")$_POST['otrasext_m1']=0;

     if($_POST['otrasext_1a4']=="")$_POST['otrasext_1a4']=0;

     if($_POST['otrasext_5a14']=="")$_POST['otrasext_5a14']=0;

     if($_POST['otrasext_15a64']=="")$_POST['otrasext_15a64']=0;

     if($_POST['otrasext_65ym']=="")$_POST['otrasext_65ym']=0;

	 

	  $insertSQL = sprintf("INSERT INTO aturgo (id_estab, fecha, 

                         infarto_m1, infarto_1a4, infarto_5a14, infarto_15a64,infarto_65ym,

                         vascular_m1,vascular_1a4, vascular_5a14, vascular_15a64,vascular_65ym,

                         hipertensiva_m1, hipertensiva_1a4, hipertensiva_5a14, hipertensiva_15a64, hipertensiva_65ym,

                         arritmia_m1, arritmia_1a4, arritmia_5a14, arritmia_15a64, arritmia_65ym,

                         otrascirc_m1, otrascirc_1a4, otrascirc_5a14, otrascirc_15a64, otrascirc_65ym, 

                         transito_m1, transito_1a4, transito_5a14, transito_15a64, transito_65ym, 

                         otrasext_m1, otrasext_1a4, otrasext_5a14, otrasext_15a64, otrasext_65ym,

			 demas_m1, demas_1a4, demas_5a14, demas_15a64, demas_65ym )

                        VALUES (%s, %s,

                        %s, %s, %s, %s, %s, 

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, 

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, 

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s)",

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['infarto_m1'], "int"),

                       GetSQLValueString($_POST['infarto_1a4'], "int"),

                       GetSQLValueString($_POST['infarto_5a14'], "int"),

                       GetSQLValueString($_POST['infarto_15a64'], "int"),

                       GetSQLValueString($_POST['infarto_65ym'], "int"),

					   GetSQLValueString($_POST['vascular_m1'], "int"),

                       GetSQLValueString($_POST['vascular_1a4'], "int"),

                       GetSQLValueString($_POST['vascular_5a14'], "int"),

                       GetSQLValueString($_POST['vascular_15a64'], "int"),

                       GetSQLValueString($_POST['vascular_65ym'], "int"),

					   GetSQLValueString($_POST['hipertensiva_m1'], "int"),

                       GetSQLValueString($_POST['hipertensiva_1a4'], "int"),

                       GetSQLValueString($_POST['hipertensiva_5a14'], "int"),

                       GetSQLValueString($_POST['hipertensiva_15a64'], "int"),

                       GetSQLValueString($_POST['hipertensiva_65ym'], "int"),

					   GetSQLValueString($_POST['arritmia_m1'], "int"),

                       GetSQLValueString($_POST['arritmia_1a4'], "int"),

                       GetSQLValueString($_POST['arritmia_5a14'], "int"),

                       GetSQLValueString($_POST['arritmia_15a64'], "int"),

                       GetSQLValueString($_POST['arritmia_65ym'], "int"),

					   GetSQLValueString($_POST['otrascirc_m1'], "int"),

                       GetSQLValueString($_POST['otrascirc_1a4'], "int"),

                       GetSQLValueString($_POST['otrascirc_5a14'], "int"),

                       GetSQLValueString($_POST['otrascirc_15a64'], "int"),

                       GetSQLValueString($_POST['otrascirc_65ym'], "int"),

					   GetSQLValueString($_POST['transito_m1'], "int"),

                       GetSQLValueString($_POST['transito_1a4'], "int"),

                       GetSQLValueString($_POST['transito_5a14'], "int"),

                       GetSQLValueString($_POST['transito_15a64'], "int"),

                       GetSQLValueString($_POST['transito_65ym'], "int"),

					   GetSQLValueString($_POST['hipertensiva_m1'], "int"),

                       GetSQLValueString($_POST['otrasext_1a4'], "int"),

                       GetSQLValueString($_POST['otrasext_5a14'], "int"),

                       GetSQLValueString($_POST['otrasext_15a64'], "int"),

                       GetSQLValueString($_POST['otrasext_65ym'], "int"),

						GetSQLValueString($_POST['demas_m1'], "int"),

                       GetSQLValueString($_POST['demas_1a4'], "int"),

                       GetSQLValueString($_POST['demas_5a14'], "int"),

                       GetSQLValueString($_POST['demas_15a64'], "int"),

                       GetSQLValueString($_POST['demas_65ym'], "int") );

	   $Result1 = safe_query($insertSQL);

  

     if($_POST['falle0a14']=="")$_POST['falle0a14']=0;

     if($_POST['falle15a64']=="")$_POST['falle15a64']=0;

     if($_POST['falle65a74']=="")$_POST['falle65a74']=0;

     if($_POST['falle75ym']=="")$_POST['falle75ym']=0;

     if($_POST['falli0a14']=="")$_POST['falli0a14']=0;

     if($_POST['falli15a64']=="")$_POST['falli15a64']=0;

     if($_POST['falli65a74']=="")$_POST['falli65a74']=0;

     if($_POST['falli75ym']=="")$_POST['falli75ym']=0;

     if($_POST['falleh0a14']=="")$_POST['falleh0a14']=0;

     if($_POST['falleh15a64']=="")$_POST['falleh15a64']=0;

     if($_POST['falleh65a74']=="")$_POST['falleh65a74']=0;

     if($_POST['falleh75ym']=="")$_POST['falleh75ym']=0;





     $insertSQL = sprintf("INSERT INTO fallecidoh (id_estab, fecha, 

                        falli0a14, falli15a64, falli65a74, falli75ym,
						falli0a14ira, falli15a64ira, falli65a74ira, falli75ymira,
                        falle0a14, falle15a64, falle65a74,falle75ym,
						falle0a14ira, falle15a64ira, falle65a74ira,falle75ymira,
                        falleh0a14, falleh15a64, falleh65a74,falleh75ym,
						falleh0a14ira, falleh15a64ira, falleh65a74ira,falleh75ymira,
						ifi0a14, ifi15a64, ifi65a74, ifi75ym
						) values (

                        %s, %s, 
						%s, %s, %s, %s,
						 %s, %s, %s, %s 
						 ,%s, %s, %s, %s,
						 %s, %s, %s, %s,
						 %s, %s, %s, %s 
						 ,%s, %s, %s, %s
						,%s, %s, %s, %s)",

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['falli0a14'], "int"),
						GetSQLValueString($_POST['falli15a64'], "int"),
                       GetSQLValueString($_POST['falli65a74'], "int"),
                       GetSQLValueString($_POST['falli75ym'], "int"),
						GetSQLValueString($_POST['falli0a14ira'], "int"),
						GetSQLValueString($_POST['falli15a64ira'], "int"),
                       GetSQLValueString($_POST['falli65a74ira'], "int"),
                       GetSQLValueString($_POST['falli75ymira'], "int"),
					   
                       GetSQLValueString($_POST['falle0a14'], "int"),
                       GetSQLValueString($_POST['falle15a64'], "int"),
                       GetSQLValueString($_POST['falle65a74'], "int"),
                       GetSQLValueString($_POST['falle75ym'], "int") ,
						GetSQLValueString($_POST['falle0a14ira'], "int"),
                       GetSQLValueString($_POST['falle15a64ira'], "int"),
                       GetSQLValueString($_POST['falle65a74ira'], "int"),
                       GetSQLValueString($_POST['falle75ymira'], "int") ,

                       GetSQLValueString($_POST['falleh0a14'], "int"),
                       GetSQLValueString($_POST['falleh15a64'], "int"),
                       GetSQLValueString($_POST['falleh65a74'], "int"),
                       GetSQLValueString($_POST['falleh75ym'], "int") ,
						GetSQLValueString($_POST['falleh0a14ira'], "int"),
                       GetSQLValueString($_POST['falleh15a64ira'], "int"),
                       GetSQLValueString($_POST['falleh65a74ira'], "int"),
                       GetSQLValueString($_POST['falleh75ymira'], "int") ,
					   
					   GetSQLValueString($_POST['ifi0a14'], "int"),
                       GetSQLValueString($_POST['ifi15a64'], "int"),
                       GetSQLValueString($_POST['ifi65a74'], "int"),
                       GetSQLValueString($_POST['ifi75ym'], "int") 
                      );

    $Result1 = safe_query($insertSQL);





  if(strcmp($_SESSION['tipo'],'urbano')==0 || strcmp($_SESSION['tipo'],'provincial')==0){





     if($_POST['presp']=="")$_POST['presp']=0;

     if($_POST['hresp']=="")$_POST['hresp']=0;

     if($_POST['mresp']=="")$_POST['mresp']=0;

     if($_POST['potra']=="")$_POST['potra']=0;

     if($_POST['hotra']=="")$_POST['hotra']=0;

     if($_POST['motra']=="")$_POST['motra']=0;

     $insertSQL = sprintf("INSERT INTO egresos (id_estab, fecha, 

                        presp,hresp,mresp,

                        potra,hotra,motra ) values (

                        %s, %s, %s, %s, %s, %s, %s, %s )",

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['presp'], "int"),

                       GetSQLValueString($_POST['hresp'], "int"),

                       GetSQLValueString($_POST['mresp'], "int"),

                       GetSQLValueString($_POST['potra'], "int"),

                       GetSQLValueString($_POST['hotra'], "int"),

                       GetSQLValueString($_POST['motra'], "int") 

                      );

    $Result1 = safe_query($insertSQL);



     if($_POST['pbm1']=="")$_POST['pbm1']=0;

     if($_POST['pb1_9']=="")$_POST['pb1_9']=0;

     if($_POST['pb10_14']=="")$_POST['pb10_14']=0;

     if($_POST['pb15_64']=="")$_POST['pb15_64']=0;

     if($_POST['pb65ym']=="")$_POST['pb65ym']=0;

     if($_POST['pbotras']=="")$_POST['pbotras']=0;



     if($_POST['hbm1']=="")$_POST['hbm1']=0;

     if($_POST['hb1_9']=="")$_POST['hb1_9']=0;

     if($_POST['hb10_14']=="")$_POST['hb10_14']=0;

     if($_POST['hb15_64']=="")$_POST['hb15_64']=0;

     if($_POST['hb65ym']=="")$_POST['hb65ym']=0;

     if($_POST['hbotras']=="")$_POST['hbotras']=0;



     if($_POST['mbm1']=="")$_POST['mbm1']=0;

     if($_POST['mb1_9']=="")$_POST['mb1_9']=0;

     if($_POST['mb10_14']=="")$_POST['mb10_14']=0;

     if($_POST['mb15_64']=="")$_POST['mb15_64']=0;

     if($_POST['mb65ym']=="")$_POST['mb65ym']=0;

     if($_POST['mbotras']=="")$_POST['mbotras']=0;



     if($_POST['pom1']=="")$_POST['pom1']=0;

     if($_POST['po1_9']=="")$_POST['po1_9']=0;

     if($_POST['po10_14']=="")$_POST['po10_14']=0;

     if($_POST['po15_64']=="")$_POST['po15_64']=0;

     if($_POST['po65ym']=="")$_POST['po65ym']=0;

     if($_POST['pootras']=="")$_POST['pootras']=0;



     if($_POST['hom1']=="")$_POST['hom1']=0;

     if($_POST['ho1_9']=="")$_POST['ho1_9']=0;

     if($_POST['ho10_14']=="")$_POST['ho10_14']=0;

     if($_POST['ho15_64']=="")$_POST['ho15_64']=0;

     if($_POST['ho65ym']=="")$_POST['ho65ym']=0;

     if($_POST['hootras']=="")$_POST['hootras']=0;



     if($_POST['mom1']=="")$_POST['mom1']=0;

     if($_POST['mo1_9']=="")$_POST['mo1_9']=0;

     if($_POST['mo10_14']=="")$_POST['mo10_14']=0;

     if($_POST['mo15_64']=="")$_POST['mo15_64']=0;

     if($_POST['mo65ym']=="")$_POST['mo65ym']=0;

     if($_POST['mootras']=="")$_POST['mootras']=0;



     if($_POST['utitm1']=="")$_POST['utitm1']=0;

     if($_POST['utit1_9']=="")$_POST['utit1_9']=0;

     if($_POST['utit10_14']=="")$_POST['utit10_14']=0;

     if($_POST['utit15_64']=="")$_POST['utit15_64']=0;

     if($_POST['utit65ym']=="")$_POST['utit65ym']=0;

     if($_POST['utitotras']=="")$_POST['utitotras']=0;



     if($_POST['utibm1']=="")$_POST['utibm1']=0;

     if($_POST['utib1_9']=="")$_POST['utib1_9']=0;

     if($_POST['utib10_14']=="")$_POST['utib10_14']=0;

     if($_POST['utib15_64']=="")$_POST['utib15_64']=0;

     if($_POST['utib65ym']=="")$_POST['utib65ym']=0;

     if($_POST['utibotras']=="")$_POST['utibotras']=0;



     if($_POST['ucitm1']=="")$_POST['ucitm1']=0;

     if($_POST['ucit1_9']=="")$_POST['ucit1_9']=0;

     if($_POST['ucit10_14']=="")$_POST['ucit10_14']=0;

     if($_POST['ucit15_64']=="")$_POST['ucit15_64']=0;

     if($_POST['ucit65ym']=="")$_POST['ucit65ym']=0;

     if($_POST['ucitotras']=="")$_POST['ucitotras']=0;



     if($_POST['ucibm1']=="")$_POST['ucibm1']=0;

     if($_POST['ucib1_9']=="")$_POST['ucib1_9']=0;

     if($_POST['ucib10_14']=="")$_POST['ucib10_14']=0;

     if($_POST['ucib15_64']=="")$_POST['ucib15_64']=0;

     if($_POST['ucib65ym']=="")$_POST['ucib65ym']=0;

     if($_POST['ucibotras']=="")$_POST['ucibotras']=0;



     if($_POST['camillasxcr']=="")$_POST['camillasxcr']=0;

     if($_POST['camillasxo']=="")$_POST['camillasxo']=0;





     $insertSQL = sprintf("INSERT INTO hospitaliza (id_estab, fecha, 

                        pbm1,pb1_9,pb10_14,pb15_64,pb65ym,pbotras,

                        hbm1,hb1_9,hb10_14,hb15_64,hb65ym,hbotras,

                        mbm1,mb1_9,mb10_14,mb15_64,mb65ym,mbotras,

                        pom1,po1_9,po10_14,po15_64,po65ym,pootras,

                        hom1,ho1_9,ho10_14,ho15_64,ho65ym,hootras,

                        mom1,mo1_9,mo10_14,mo15_64,mo65ym,mootras,

                        utibm1,utib1_9,utib10_14,utib15_64,utib65ym,utibotras,

                        utitm1,utit1_9,utit10_14,utit15_64,utit65ym,utitotras,

                        ucibm1,ucib1_9,ucib10_14,ucib15_64,ucib65ym,ucibotras,

                        ucitm1,ucit1_9,ucit10_14,ucit15_64,ucit65ym,ucitotras,

                        camillasxcr, camillasxo

                         ) values (

                        %s, %s, 

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s, %s, 

                        %s, %s)",

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),



                       GetSQLValueString($_POST['pbm1'], "int"),

                       GetSQLValueString($_POST['pb1_9'], "int"),

                       GetSQLValueString($_POST['pb10_14'], "int"),

                       GetSQLValueString($_POST['pb15_64'], "int"),

                       GetSQLValueString($_POST['pb65ym'], "int"),

                       GetSQLValueString($_POST['pbotras'], "int"), 



                       GetSQLValueString($_POST['hbm1'], "int"),

                       GetSQLValueString($_POST['hb1_9'], "int"),

                       GetSQLValueString($_POST['hb10_14'], "int"),

                       GetSQLValueString($_POST['hb15_64'], "int"),

                       GetSQLValueString($_POST['hb65ym'], "int"),

                       GetSQLValueString($_POST['hbotras'], "int"), 



                       GetSQLValueString($_POST['mbm1'], "int"),

                       GetSQLValueString($_POST['mb1_9'], "int"),

                       GetSQLValueString($_POST['mb10_14'], "int"),

                       GetSQLValueString($_POST['mb15_64'], "int"),

                       GetSQLValueString($_POST['mb65ym'], "int"),

                       GetSQLValueString($_POST['mbotras'], "int"), 



                       GetSQLValueString($_POST['pom1'], "int"),

                       GetSQLValueString($_POST['po1_9'], "int"),

                       GetSQLValueString($_POST['po10_14'], "int"),

                       GetSQLValueString($_POST['po15_64'], "int"),

                       GetSQLValueString($_POST['po65ym'], "int"),

                       GetSQLValueString($_POST['pootras'], "int"), 



                       GetSQLValueString($_POST['hom1'], "int"),

                       GetSQLValueString($_POST['ho1_9'], "int"),

                       GetSQLValueString($_POST['ho10_14'], "int"),

                       GetSQLValueString($_POST['ho15_64'], "int"),

                       GetSQLValueString($_POST['ho65ym'], "int"),

                       GetSQLValueString($_POST['hootras'], "int"),

 

                       GetSQLValueString($_POST['mom1'], "int"),

                       GetSQLValueString($_POST['mo1_9'], "int"),

                       GetSQLValueString($_POST['mo10_14'], "int"),

                       GetSQLValueString($_POST['mo15_64'], "int"),

                       GetSQLValueString($_POST['mo65ym'], "int"),

                       GetSQLValueString($_POST['mootras'], "int"),



                       GetSQLValueString($_POST['utibm1'], "int"),

                       GetSQLValueString($_POST['utib1_9'], "int"),

                       GetSQLValueString($_POST['utib10_14'], "int"),

                       GetSQLValueString($_POST['utib15_64'], "int"),

                       GetSQLValueString($_POST['utib65ym'], "int"),

                       GetSQLValueString($_POST['utibotras'], "int"),



                       GetSQLValueString($_POST['utitm1'], "int"),

                       GetSQLValueString($_POST['utit1_9'], "int"),

                       GetSQLValueString($_POST['utit10_14'], "int"),

                       GetSQLValueString($_POST['utit15_64'], "int"),

                       GetSQLValueString($_POST['utit65ym'], "int"),

                       GetSQLValueString($_POST['utitotras'], "int"),



                       GetSQLValueString($_POST['ucibm1'], "int"),

                       GetSQLValueString($_POST['ucib1_9'], "int"),

                       GetSQLValueString($_POST['ucib10_14'], "int"),

                       GetSQLValueString($_POST['ucib15_64'], "int"),

                       GetSQLValueString($_POST['ucib65ym'], "int"),

                       GetSQLValueString($_POST['ucibotras'], "int"),



                       GetSQLValueString($_POST['ucitm1'], "int"),

                       GetSQLValueString($_POST['ucit1_9'], "int"),

                       GetSQLValueString($_POST['ucit10_14'], "int"),

                       GetSQLValueString($_POST['ucit15_64'], "int"),

                       GetSQLValueString($_POST['ucit65ym'], "int"),

                       GetSQLValueString($_POST['ucitotras'], "int"),



                       GetSQLValueString($_POST['camillasxcr'], "int"),

                       GetSQLValueString($_POST['camillasxo'], "int")



                      );

    $Result1 = safe_query($insertSQL);

	

	if($_POST['circulatorias_m1']=="")$_POST['circulatorias_m1']=0;

     if($_POST['circulatorias_1a4']=="")$_POST['circulatorias_1a4']=0;

     if($_POST['circulatorias_5a14']=="")$_POST['circulatorias_5a14']=0;

     if($_POST['circulatorias_15a64']=="")$_POST['circulatorias_15a64']=0;

     if($_POST['circulatorias_65ym']=="")$_POST['circulatorias_65ym']=0;

	 if($_POST['trauma_m1']=="")$_POST['trauma_m1']=0;

     if($_POST['trauma_1a4']=="")$_POST['trauma_1a4']=0;

     if($_POST['trauma_5a14']=="")$_POST['trauma_5a14']=0;

     if($_POST['trauma_15a64']=="")$_POST['trauma_15a64']=0;

     if($_POST['trauma_65ym']=="")$_POST['trauma_65ym']=0;
	 
	 if($_POST['cirurg_m1']=="")$_POST['cirurg_m1']=0;

     if($_POST['cirurg_1a4']=="")$_POST['cirurg_1a4']=0;

     if($_POST['cirurg_5a14']=="")$_POST['cirurg_5a14']=0;

     if($_POST['cirurg_15a64']=="")$_POST['cirurg_15a64']=0;

     if($_POST['cirurg_65ym']=="")$_POST['cirurg_65ym']=0;

	 if($_POST['demas_m1']=="")$_POST['demas_m1']=0;

     if($_POST['demas_1a4']=="")$_POST['demas_1a4']=0;

     if($_POST['demas_5a14']=="")$_POST['demas_5a14']=0;

     if($_POST['demas_15a64']=="")$_POST['demas_15a64']=0;

     if($_POST['demas_65ym']=="")$_POST['demas_65ym']=0;

	 $insertSQL = sprintf("INSERT INTO hospitalizao (id_estab, fecha, 

	                        circulatorias_m1, circulatorias_1a4, circulatorias_5a14,circulatorias_15a64,

			circulatorias_65ym, 

			trauma_m1, trauma_1a4, trauma_5a14,trauma_15a64,trauma_65ym, 
			cirurg_m1, cirurg_1a4, cirurg_5a14,cirurg_15a64,cirurg_65ym, 
			demas_m1, demas_1a4, demas_5a14,demas_15a64,demas_65ym 

                       ) values (

                        %s, %s, 

                        %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s,
						 %s, %s, %s, %s, %s,

                        %s, %s, %s, %s, %s )",

						GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['circulatorias_m1'], "int"),

                       GetSQLValueString($_POST['circulatorias_1a4'], "int"),

                       GetSQLValueString($_POST['circulatorias_5a14'], "int"),

                       GetSQLValueString($_POST['circulatorias_15a64'], "int"),

                       GetSQLValueString($_POST['circulatorias_65ym'], "int"),

                       GetSQLValueString($_POST['traumah_m1'], "int"),

                       GetSQLValueString($_POST['traumah_1a4'], "int"),

                       GetSQLValueString($_POST['traumah_5a14'], "int"),

                       GetSQLValueString($_POST['traumah_15a64'], "int"),

                       GetSQLValueString($_POST['traumah_65ym'], "int"),
					   
					   GetSQLValueString($_POST['cirurg_m1'], "int"),

                       GetSQLValueString($_POST['cirurg_1a4'], "int"),

                       GetSQLValueString($_POST['cirurg_5a14'], "int"),

                       GetSQLValueString($_POST['cirurg_15a64'], "int"),

                       GetSQLValueString($_POST['cirurg_65ym'], "int"),

		 GetSQLValueString($_POST['demas_m1'], "int"),

                       GetSQLValueString($_POST['demash_1a4'], "int"),

                       GetSQLValueString($_POST['demash_5a14'], "int"),

                       GetSQLValueString($_POST['demash_15a64'], "int"),

                       GetSQLValueString($_POST['demash_65ym'], "int")

     );

    $Result1 = safe_query($insertSQL);

  } // fin si urbano

  if(strcmp($_SESSION['tipo'],'sapu')==0){



     if($_POST['cbnino']=="")$_POST['cbnino']=0;

     if($_POST['cbadul']=="")$_POST['cbadul']=0;

     if($_POST['hbnino']=="")$_POST['hbnino']=0;

     if($_POST['hbadul']=="")$_POST['hbadul']=0;

     if($_POST['cnnino']=="")$_POST['cnnino']=0;

     if($_POST['cnadul']=="")$_POST['cnadul']=0;

     if($_POST['hnnino']=="")$_POST['hnnino']=0;

     if($_POST['hnadul']=="")$_POST['hnadul']=0;



     $insertSQL = sprintf("INSERT INTO derivaciones (id_estab, fecha, 

                        cbnino, cbadul, hbnino, hbadul,

                        cnnino, cnadul, hnnino, hnadul ) values (

                        %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )",

                       GetSQLValueString($_SESSION['id_estab'], "int"),

                       GetSQLValueString($_POST['fecha'], "date"),

                       GetSQLValueString($_POST['cbnino'], "int"),

                       GetSQLValueString($_POST['cbadul'], "int"),

                       GetSQLValueString($_POST['hbnino'], "int"),

                       GetSQLValueString($_POST['hbadul'], "int"),

                       GetSQLValueString($_POST['cnnino'], "int"),

                       GetSQLValueString($_POST['cnadul'], "int"), 

                       GetSQLValueString($_POST['hnnino'], "int"),

                       GetSQLValueString($_POST['hnadul'], "int") 



                      );

    $Result1 = safe_query($insertSQL);

  } // fin de si sapu

  $insertGoTo = "index.php?page=registra&file=indexn&func=listaurg";

   header(sprintf("Location: %s", $insertGoTo));

  }

   echo "<p><font color=red><b><ul> $mensajerror </ul>"

        ." Por favor reintente </p>";

}// fin de agregar registros a la BD

// formulario para la entrada de datos

function formulin(){

echo "<form method=\"post\" name=\"f\" action=\"index.php?page=registra&file=indexn&func=agrega\">"

  ."<table width=\"600\" align=\"center\">"

  ."  <caption>"

  ."  <strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

  ." Atenciones de Urgencia <br>"

  ."  y Causas Respiratorias Ni�s y Adultos</font></strong> "

  ."  </caption>"

."  <tr valign=\"baseline\"  >" 

."  <td  align=\"right\" nowrap><strong>"

." <font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."Establecimiento: </font></strong></td>"

."    <td  colspan=\"4\" > "

."      <div align=\"left\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

.$_SESSION['nombre'] ."</font></div></td>"

."      <input type=\"hidden\" name=\"id_estab\" value=\"".  $_SESSION['id_estab']. "\" size=\"4\">"

."    <td ><strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Fecha</font></strong></td>"

."    <td colspan=\"3\"> <strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."      <input name=\"fecha\" type=\"text\" onBlur=\"return esfecha(document.forms.f.fecha)\" value=\"". date("Y-m-d") ."\" size=\"10\" maxlength=\"10\">"

."      </font></strong></td>"

." <td colspan=\"2\"><a href=\"#\" onClick=\"window.open('ayuda.htm','v','width=600,height=400,scrollbars=YES')\">"

."<strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Ver instrucciones</font></strong></a>" 

."</td>"

."  </tr>"



."<tr   valign=\"middle\">" 

." <td width=\"100\" height=\"59\" align=\"right\" nowrap><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Grupos "

." de edad:</font></strong></td>"



." <td bgcolor=\"#DDDDDD\" width=\"50\"> <p align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Total</strong></font> "

." <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong> "

." Urgencias</strong></font></td> "



." <td width=\"50\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Resto "

." Urg. Medicas</strong></font> "

." </td>"

."<td width=\"50\"> <div align=\"right\"> "

."<p><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Total</strong></font> "

."<font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong> "

."Urg. Quirrg.</strong></font></p>"

."</div></td>"

."<td bgcolor=\"#DDDDDD\" width=\"50\"> <div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">Todas" 

." respirat.</font></strong></font></div></td>"

."<td width=\"50\"> <div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">Bronquitis</font></strong></font></div></td>"

."<td width=\"53\"> <div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">&nbsp;Asma&nbsp;</font></strong></font></div></td>"

."<td width=\"53\"> <div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">Neumonia</font></strong></font></div></td>"

."<td width=\"53\"> <div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">Influenza</font></strong></font></div></td>"

."<td width=\"53\"> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Laringitis</strong></font></div></td>"

."<td width=\"53\"> <div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Iras Altas</strong></font></div></td>"

."<td width=\"53\"> <div align=\"right\"> "

."<p><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Resto "

."</strong></font></p>"

."<p><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>respir.</strong></font></p>"

."</div></td>"

."</tr>"

    ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

    ."  <td width=\"100\" nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Total "

     ."   General</font></strong></td>"



     ." <td width=\"50\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"tottot\" type=\"text\" id=\"tottot\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"



     ." <td width=\"50\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"toturg\" type=\"text\" id=\"toturg\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

     ." <td width=\"50\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"totsin\" type=\"text\" id=\"totsin\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

     ." <td width=\"50\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

     ."     <input name=\"totgentod\" type=\"text\" id=\"totgentod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

     ." <td width=\"50\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"totgenbron\" type=\"text\" id=\"totgenbron\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totgenasma\" type=\"text\" id=\"totgenasma\" size=\"5\" maxlength=\"5\" readonly=\"true\" >"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totgenneumo\" type=\"text\" id=\"totgenneumo\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totgeninflu\" type=\"text\" id=\"totgeninflu\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

     ." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"totgenlarin\" type=\"text\" id=\"totgenlarin\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

	  ." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"totgeniraltas\" type=\"text\" id=\"totgeniraltas\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

     ." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"totgenresto\" type=\"text\" id=\"totgenresto\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

    ."</tr>"



    ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

     ." <td width=\"122\" height=\"25\" align=\"right\" nowrap><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Total "

     ."   Infantil</font></strong></td>"



     ." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"tottotinf\" type=\"text\" id=\"tottotinf\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"



     ." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"toturginf\" type=\"text\" id=\"toturginf\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

     ." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"totsininf\" type=\"text\" id=\"totsininf2\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

      ."    <input name=\"totinftod\" type=\"text\" id=\"totinftod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinfbron\" type=\"text\" id=\"totinfbron\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinfasma\" type=\"text\" id=\"totinfasma\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinfneumo\" type=\"text\" id=\"totinfneumo\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinfinflu\" type=\"text\" id=\"totinfinflu\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinflarin\" type=\"text\" id=\"totinflarin\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

	  ."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinfiraltas\" type=\"text\" id=\"totinfiraltas\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      ."    <input name=\"totinfresto\" type=\"text\" id=\"totinfresto\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

      ."    </font></div></td>"

    ."</tr>"



    ."<tr valign=\"baseline\">" 

    ."  <td width=\"100\" nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&lt; "

    ."    1 a&ntilde;o:</font></strong></td>"



     ." <td bgcolor=\"#DDDDDD\" width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"tottotm1\" type=\"text\" id=\"tottotinf\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"



    ."  <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

    ."      <input name=\"totm1\" type=\"text\" id=\"totm1\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.totm1,document.f.totm1h,document.f.toturg,document.f.toturginf,document.f.tottotm1,document.f.tottotinf,document.f.tottot)\" >"

    ."      <input type=\"hidden\" name=\"totm1h\" value=\"0\" id=\"totm1h\">"

    ."      </font></div></td>"

    ."  <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

    ."      <input name=\"totsinm1\" type=\"text\" id=\"totsinm1\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.totsinm1,document.f.totsinm1h,document.f.totsin,document.f.totsininf,document.f.tottotm1,document.f.tottotinf,document.f.tottot)\" >"

."          <input type=\"hidden\" name=\"totsinm1h\" value=\"0\" id=\"totsinm1h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input name=\"totm1tod\" type=\"text\" id=\"totm1tod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"bronq_m1\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.bronq_m1,document.f.bronq_m1h,document.f.totm1tod,document.f.totgenbron,document.f.totinfbron,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

."          <input name=\"bronq_m1h\" type=\"hidden\" value=\"0\" id=\"bronq_m1h\" >"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"asma_m1\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.asma_m1,document.f.asma_m1h,document.f.totm1tod,document.f.totgenasma,document.f.totinfasma,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"asma_m1h\" value=\"0\" id=\"asma_m1h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"neumo_m1\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.neumo_m1,document.f.neumo_m1h,document.f.totm1tod,document.f.totgenneumo,document.f.totinfneumo,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"neumo_m1h\" value=\"0\" id=\"neumo_m1h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input type=\"text\" name=\"influ_m1\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.influ_m1,document.f.influ_m1h,document.f.totm1tod,document.f.totgeninflu,document.f.totinfinflu,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

."          <input type=\"hidden\" name=\"influ_m1h\" value=\"0\" id=\"influ_m1h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"larin_m1\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.larin_m1,document.f.larin_m1h,document.f.totm1tod,document.f.totgenlarin,document.f.totinflarin,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"larin_m1h\" value=\"0\" id=\"larin_m1h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"iraltas_m1\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.iraltas_m1,document.f.iraltas_m1h,document.f.totm1tod,document.f.totgeniraltas,document.f.totinfiraltas,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"iraltas_m1h\" value=\"0\" id=\"iraltas_m1h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"resto_m1\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.resto_m1,document.f.resto_m1h,document.f.totm1tod,document.f.totgenresto,document.f.totinfresto,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"resto_m1h\" value=\"0\" id=\"resto_m1h\">"

."          </font></div></td>"

."    </tr>"

."    <tr valign=\"baseline\"> "

."      <td width=\"122\" nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">1-4" 

."        a&ntilde;os:</font></strong></td>"



     ." <td width=\"53\" bgcolor=\"#DDDDDD\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"tottot1a9\" type=\"text\" id=\"tottot1a9\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"



."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input name=\"tot1a9\" type=\"text\" id=\"tot1a9\" size=\"5\" maxlength=\"5\""

." onBlur=\"return calculo2(document.f.tot1a9,document.f.tot1a9h,document.f.toturg,document.f.toturginf,document.f.tottot1a9,document.f.tottotinf,document.f.tottot)\">"

."          <input type=\"hidden\" name=\"tot1a9h\" value=\"0\" id=\"tot1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input name=\"totsin1a9\" type=\"text\" id=\"totsin1a9\" size=\"5\" maxlength=\"5\""

." onBlur=\"return calculo2(document.f.totsin1a9,document.f.totsin1a9h,document.f.totsin,document.f.totsininf,document.f.tottot1a9,document.f.tottotinf,document.f.tottot)\">"

."          <input type=\"hidden\" name=\"totsin1a9h\" value=\"0\" id=\"totsin1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input name=\"tot1a9tod\" type=\"text\" id=\"tot1a9tod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"bronq_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.bronq_1a9,document.f.bronq_1a9h,document.f.tot1a9tod,document.f.totgenbron,document.f.totinfbron,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"bronq_1a9h\" value=\"0\" id=\"bronq_1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input type=\"text\" name=\"asma_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.asma_1a9,document.f.asma_1a9h,document.f.tot1a9tod,document.f.totgenasma,document.f.totinfasma,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"asma_1a9h\" value=\"0\" id=\"asma_1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"neumo_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.neumo_1a9,document.f.neumo_1a9h,document.f.tot1a9tod,document.f.totgenneumo,document.f.totinfneumo,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"neumo_1a9h\" value=\"0\" id=\"neumo_1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input type=\"text\" name=\"influ_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.influ_1a9,document.f.influ_1a9h,document.f.tot1a9tod,document.f.totgeninflu,document.f.totinfinflu,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"influ_1a9h\" value=\"0\" id=\"influ_1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input type=\"text\" name=\"larin_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.larin_1a9,document.f.larin_1a9h,document.f.tot1a9tod,document.f.totgenlarin,document.f.totinflarin,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"larin_1a9h\" value=\"0\" id=\"larin_1a9h\">"

."          </font></div></td>"



."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input type=\"text\" name=\"iraltas_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.iraltas_1a9,document.f.iraltas_1a9h,document.f.tot1a9tod,document.f.totgeniraltas,document.f.totinfiraltas,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"iraltas_1a9h\" value=\"0\" id=\"iraltas_1a9h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"resto_1a9\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.resto_1a9,document.f.resto_1a9h,document.f.tot1a9tod,document.f.totgenresto,document.f.totinfresto,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"resto_1a9h\" value=\"0\" id=\"resto_1a9h\">"

."          </font></div></td>"

."    </tr>"



."<tr valign=\"baseline\">" 

."      <td width=\"100\" nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">5-14 "

."        a&ntilde;os:</font></strong></td>"



     ." <td width=\"53\" bgcolor=\"#DDDDDD\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     ."     <input name=\"tottot10a14\" type=\"text\" id=\"tottot10a14\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

     ."     </font></div></td>"



."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."        <input name=\"tot10a14\" type=\"text\" id=\"tot10a14\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.tot10a14,document.f.tot10a14h,document.f.toturg,document.f.toturginf,document.f.tottot10a14,document.f.tottotinf,document.f.tottot)\">"

."          <input type=\"hidden\" name=\"tot10a14h\" value=\"0\" id=\"tot10a14h\">"

."          </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."        <input name=\"totsin10a14\" type=\"text\" id=\"totsin10a142\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.totsin10a14,document.f.totsin10a14h,document.f.totsin,document.f.totsininf,document.f.tottot10a14,document.f.tottotinf,document.f.tottot)\">"

."          <input type=\"hidden\" name=\"totsin10a14h\" value=\"0\" id=\"totsin10a14h\">"

."          </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."         <input name=\"tot10a14tod\" type=\"text\" id=\"tot10a14tod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."         </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."         <input type=\"text\" name=\"bronq_10a14\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.bronq_10a14,document.f.bronq_10a14h,document.f.tot10a14tod,document.f.totgenbron,document.f.totinfbron,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."     <input type=\"hidden\" name=\"bronq_10a14h\" value=\"0\" id=\"bronq_10a14h\">"

."  </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."       <input type=\"text\" name=\"asma_10a14\" value=\"\" size=\"4\""

 ."onBlur=\"return calculo(document.f.asma_10a14,document.f.asma_10a14h,document.f.tot10a14tod,document.f.totgenasma,document.f.totinfasma,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

 ."         <input type=\"hidden\" name=\"asma_10a14h\" value=\"0\" id=\"asma_10a14h\">"

 ."         </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   ."       <input type=\"text\" name=\"neumo_10a14\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.neumo_10a14,document.f.neumo_10a14h,document.f.tot10a14tod,document.f.totgenneumo,document.f.totinfneumo,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

 ."         <input type=\"hidden\" name=\"neumo_10a14h\" value=\"0\" id=\"neumo_10a14h\">"

 ."         </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   ."       <input type=\"text\" name=\"influ_10a14\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.influ_10a14,document.f.influ_10a14h,document.f.tot10a14tod,document.f.totgeninflu,document.f.totinfinflu,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"influ_10a14h\" value=\"0\" id=\"influ_10a14h\">"

 ."         </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

 ."         <input type=\"text\" name=\"larin_10a14\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.larin_10a14,document.f.larin_10a14h,document.f.tot10a14tod,document.f.totgenlarin,document.f.totinflarin,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

 ."         <input type=\"hidden\" name=\"larin_10a14h\" value=\"0\" id=\"larin_10a14h\">"

 ."         </font></div></td>"

 

       ."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

 ."         <input type=\"text\" name=\"iraltas_10a14\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.iraltas_10a14,document.f.iraltas_10a14h,document.f.tot10a14tod,document.f.totgeniraltas,document.f.totinfiraltas,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

 ."         <input type=\"hidden\" name=\"iraltas_10a14h\" value=\"0\" id=\"iraltas_10a14h\">"

 ."         </font></div></td>"

      ."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  ."        <input type=\"text\" name=\"resto_10a14\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.resto_10a14,document.f.resto_10a14h,document.f.tot10a14tod,document.f.totgenresto,document.f.totinfresto,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"resto_10a14h\" value=\"0\" id=\"resto_10a14h\">"

."          </font></div></td>"

."    </tr>"



." <tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

."      <td width=\"122\" nowrap align=\"right\"><strong>"

."<font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."        Total adultos:</font></strong></td>"



." <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."     <input name=\"tottotadu\" type=\"text\" id=\"tottotadu\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."     </font></div></td>"



."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."        <input name=\"toturgadu\" type=\"text\" id=\"toturgadu\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."        </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."        <input name=\"totsinadu\" type=\"text\" id=\"totsinadu\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."        </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."       <input name=\"totadutod\" type=\"text\" id=\"totadutod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."        </font></div></td>"

."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."       <input name=\"totadubron\" type=\"text\" id=\"totadubron\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."       </font></div></td>"

."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."     <input name=\"totaduasma\" type=\"text\" id=\"totaduasma\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."      </font></div></td>"

."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."     <input name=\"totaduneumo\" type=\"text\" id=\"totaduneumo\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."      </font></div></td>"

."<td width=\"53\"><div align=\"right\"><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."      <input name=\"totaduinflu\" type=\"text\" id=\"totaduinflu\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."      </font></div></td>"

."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."      <input name=\"totadularin\" type=\"text\" id=\"totadularin\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."          </font></div></td>"



."<td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."      <input name=\"totaduiraltas\" type=\"text\" id=\"totaduiraltas\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input name=\"totaduresto\" type=\"text\" id=\"totaduresto\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."          </font></div></td>"

."    </tr>"



." <tr valign=\"baseline\"> "

."  <td width=\"122\" nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">15-64 "

."   a&ntilde;os</font></strong></td>"



." <td width=\"53\" bgcolor=\"#DDDDDD\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."     <input name=\"tottot15a64\" type=\"text\" id=\"tottot15a64\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."     </font></div></td>"



."  <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

."          <input name=\"tot15a64\" type=\"text\" id=\"tot15a64\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.tot15a64,document.f.tot15a64h,document.f.toturg,document.f.toturgadu,document.f.tottot15a64,document.f.tottotadu,document.f.tottot)\">"

."          <input type=\"hidden\" name=\"tot15a64h\" value=\"0\" id=\"tot15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input name=\"totsin15a64\" type=\"text\" id=\"totsin15a64\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.totsin15a64,document.f.totsin15a64h,document.f.totsin,document.f.totsinadu,document.f.tottot15a64,document.f.tottotadu,document.f.tottot)\">"

."          <input type=\"hidden\" name=\"totsin15a64h\" value=\"0\" id=\"totsin15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input name=\"tot15a64tod\" type=\"text\" id=\"tot15a64tod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"bronq_15a64\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.bronq_15a64,document.f.bronq_15a64h,document.f.tot15a64tod,document.f.totgenbron,document.f.totadubron,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"bronq_15a64h\" value=\"0\" id=\"bronq_15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"asma_15a64\" value=\"\" size=\"4\""

." onBlur=\"return calculo(document.f.asma_15a64,document.f.asma_15a64h,document.f.tot15a64tod,document.f.totgenasma,document.f.totaduasma,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"asma_15a64h\" value=\"0\" id=\"asma_15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"neumo_15a64\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.neumo_15a64,document.f.neumo_15a64h,document.f.tot15a64tod,document.f.totgenneumo,document.f.totaduneumo,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"neumo_15a64h\" value=\"0\" id=\"neumo_15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"influ_15a64\" value=\"\" size=\"4\" "

."onBlur=\"return calculo(document.f.influ_15a64,document.f.influ_15a64h,document.f.tot15a64tod,document.f.totgeninflu,document.f.totaduinflu,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"influ_15a64h\" value=\"0\" id=\"influ_15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"larin_15a64\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.larin_15a64,document.f.larin_15a64h,document.f.tot15a64tod,document.f.totgenlarin,document.f.totadularin,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"larin_15a64h\" value=\"0\" id=\"larin_15a64h\">"

."          </font></div></td>"



."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"iraltas_15a64\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.iraltas_15a64,document.f.iraltas_15a64h,document.f.tot15a64tod,document.f.totgeniraltas,document.f.totaduiraltas,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"

."          <input type=\"hidden\" name=\"iraltas_15a64h\" value=\"0\" id=\"iraltas_15a64h\">"

."          </font></div></td>"

."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

."          <input type=\"text\" name=\"resto_15a64\" value=\"\" size=\"4\""

."onBlur=\"return calculo(document.f.resto_15a64,document.f.resto_15a64h,document.f.tot15a64tod,document.f.totgenresto,document.f.totaduresto,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"resto_15a64h\" value=\"0\" id=\"resto_15a64h\">"
."          </font></div></td>"
."    </tr>"
."    <tr valign=\"baseline\"> "
."      <td width=\"100\" nowrap align=\"right\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">65" 
."        y mas a&ntilde;os:</font></strong></td>"
." <td width=\"53\" bgcolor=\"#DDDDDD\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."     <input name=\"tottot65ym\" type=\"text\" id=\"tottot65ym\" size=\"5\" maxlength=\"5\" readonly=\"true\">"
."     </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."          <input name=\"tot65ym\" type=\"text\" id=\"tot65ym\" size=\"5\" maxlength=\"5\""
."onBlur=\"return calculo2(document.f.tot65ym,document.f.tot65ymh,document.f.toturg,document.f.toturgadu,document.f.tottot65ym,document.f.tottotadu,document.f.tottot)\">"
."          <input type=\"hidden\" name=\"tot65ymh\" value=\"0\" id=\"tot65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."          <input name=\"totsin65ym\" type=\"text\" id=\"totsin65ym\" size=\"5\" maxlength=\"5\""
."onBlur=\"return calculo2(document.f.totsin65ym,document.f.totsin65ymh,document.f.totsin,document.f.totsinadu,document.f.tottot65ym,document.f.tottotadu,document.f.tottot)\">"
."          <input type=\"hidden\" name=\"totsin65ymh\" value=\"0\" id=\"totsin65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."          <input name=\"tot65ymtod\" type=\"text\" id=\"tot65ymtod\" size=\"5\" maxlength=\"5\" readonly=\"true\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."          <input type=\"text\" name=\"bronq_65ym\" value=\"\" size=\"4\" "
."onBlur=\"return calculo(document.f.bronq_65ym,document.f.bronq_65ymh,document.f.tot65ymtod,document.f.totgenbron,document.f.totadubron,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"bronq_65ymh\" value=\"0\" id=\"bronq_65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."          <input type=\"text\" name=\"asma_65ym\" value=\"\" size=\"4\""
."onBlur=\"return calculo(document.f.asma_65ym,document.f.asma_65ymh,document.f.tot65ymtod,document.f.totgenasma,document.f.totaduasma,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"asma_65ymh\" value=\"0\" id=\"asma_65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."          <input type=\"text\" name=\"neumo_65ym\" value=\"\" size=\"4\""
."onBlur=\"return calculo(document.f.neumo_65ym,document.f.neumo_65ymh,document.f.tot65ymtod,document.f.totgenneumo,document.f.totaduneumo,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"neumo_65ymh\" value=\"0\" id=\"neumo_65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."          <input type=\"text\" name=\"influ_65ym\" value=\"\" size=\"4\""
."onBlur=\"return calculo(document.f.influ_65ym,document.f.influ_65ymh,document.f.tot65ymtod,document.f.totgeninflu,document.f.totaduinflu,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"influ_65ymh\" value=\"0\" id=\"influ_65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."          <input type=\"text\" name=\"larin_65ym\" value=\"\" size=\"4\" "
."onBlur=\"return calculo(document.f.larin_65ym,document.f.larin_65ymh,document.f.tot65ymtod,document.f.totgenlarin,document.f.totadularin,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"larin_65ymh\" value=\"0\" id=\"larin_65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 
."          <input type=\"text\" name=\"iraltas_65ym\" value=\"\" size=\"4\" "
."onBlur=\"return calculo(document.f.iraltas_65ym,document.f.iraltas_65ymh,document.f.tot65ymtod,document.f.totgeniraltas,document.f.totaduiraltas,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"iraltas_65ymh\" value=\"0\" id=\"iraltas_65ymh\">"
."          </font></div></td>"
."      <td width=\"53\"><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."          <input type=\"text\" name=\"resto_65ym\" value=\"\" size=\"4\" "
."onBlur=\"return calculo(document.f.resto_65ym,document.f.resto_65ymh,document.f.tot65ymtod,document.f.totgenresto,document.f.totaduresto,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\">"
."          <input type=\"hidden\" name=\"resto_65ymh\" value=\"0\" id=\"resto_65ymh\">"
."          </font></div></td>"
."    </tr>"
."</table>";
aturgo();
if(strcmp($_SESSION['tipo'],'urbano')==0 || strcmp($_SESSION['tipo'],'provincial')==0  ){
  hospitaliza();
  hospitalizao();
  egresos();
}
if(strcmp($_SESSION['tipo'],'sapu')==0){
  derivaciones();
}
  fallecidoh();
echo "<table>"
."    <tr valign=\"baseline\"> "
."      <td height=\"44\" align=\"right\" nowrap><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"
."      <td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"></font></font></div></td>"
."      <td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"></font></font></div></td>"
."      <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp; "
."        </font></td>"
."      <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"
."      <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"
."      <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"
."      <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"
."      <td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"
."      <td><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "
."        <input name=\"submit\" type=\"submit\" value=\"Grabar\">"
."        <input name=\"cuadrar\" type=\"button\" value=\"cuadrar\" id=\"cuadrar\" onclick=\"javascript:cuadra();\" >";
 if(strcmp($_SESSION['tipo'],'sapu')==0){
 echo "<input type=\"button\" name=\"cuadraderiva\" id=\"cuadraderiva\" value=\"Cuadrar derivaciones\" onclick=\"javascript:cuadraderivat();\">";
 }
echo "        </font></td>"
."    </tr>"
."  </table>"
."  <input type=\"hidden\" name=\"MM_insert\" value=\"form1\">"
."</form>";
}

function listaurg(){

if (isset($_GET['id']))
    $_SESSION['id_estab']=$_GET['id'];
if (isset($_GET['nom']))

    $_SESSION['nombre']=$_GET['nom'];

if (isset($_GET['tipo']))

    $_SESSION['tipo']=$_GET['tipo'];



$currentPage="index.php?page=registra&file=indexn&func=listaurg";



//$currentPage = $HTTP_SERVER_VARS["PHP_SELF"];

$maxRows_rs =20;

$pageNum_rs = 0;

if (isset($_GET['pageNum_rs'])) {

  $pageNum_rs = $_GET['pageNum_rs'];

}

$startRow_rs = $pageNum_rs * $maxRows_rs;

$query_rs = "SELECT id,id_estab,fecha, 

            bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       

            asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  

            neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  

            influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   

            larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +     

			 iraltas_m1 + iraltas_1a9 + iraltas_10a14 + iraltas_15a64+  iraltas_65ym +     

            resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym +

            totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym +

            totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym as toturg,



            bronq_m1+ bronq_1a9 + bronq_10a14 + bronq_15a64 + bronq_65ym +       

            asma_m1 + asma_1a9 + asma_10a14 + asma_15a64 + asma_65ym +  

            neumo_m1 + neumo_1a9 + neumo_10a14 + neumo_15a64+ neumo_65ym +  

            influ_m1 + influ_1a9 + influ_10a14 + influ_15a64+ influ_65ym +   

            larin_m1 + larin_1a9 + larin_10a14 + larin_15a64+  larin_65ym +   

			  iraltas_m1 + iraltas_1a9 + iraltas_10a14 + iraltas_15a64+  iraltas_65ym +   

            resto_m1 + resto_1a9 + resto_10a14 + resto_15a64 + resto_65ym as totira 

            FROM aturg_urbana 

            where id_estab=".$_SESSION['id_estab'].

           " GROUP BY fecha ORDER BY fecha desc";

$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);

$rs = safe_query($query_limit_rs);

$row_rs = mysql_fetch_assoc($rs);



if (isset($_GET['totalRows_rs'])) {

  $totalRows_rs = $_GET['totalRows_rs'];

} else {

  $all_rs = mysql_query($query_rs);

  $totalRows_rs = mysql_num_rows($all_rs);

}

$totalPages_rs = (int)($totalRows_rs/$maxRows_rs);



$queryString_rs = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_rs") == false && 

        stristr($param, "totalRows_rs") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_rs = "&" . implode("&", $newParams);

  }

}

$queryString_rs = sprintf("&totalRows_rs=%d%s", $totalRows_rs, $queryString_rs);

echo "<table width=\"500\" border=\"0\" align=\"center\">"

  ."<caption>"

  ."<strong><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

  ."Establecimiento: <i>" . $_SESSION['nombre'] . "</i><br>"

  ."Lista registros diarios de Atenciones de Urgencia e IRA</font></strong>" 

  ."</caption>"

  ."<tr>" 

  ."<td><div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Fecha</strong></font></div></td>"

  ."<td><div align=\"right\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Tot.Urgencia</strong></font></div></td>"

  ."<td><div align=\"right\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>"

  ."Total IRA</strong></font></div></td>"

  ."<td><div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Imprimir</strong></font></div></td>"

;

if(strcmp($_SESSION['nivelautorizado'],'direccion')!=0){

  echo "<td><div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Editar</strong></font></div></td>"

  ."<td><div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

//  ."<strong>Eliminar</strong>"

  ."</font></div></td>";

}

  echo "</tr>";

   $bgcolor1="#EEEEEE";

   $bgcolor2="#FFFFFF";

   $i=1;



 do { 

      $bgcolor=(bcmod( $i++,2)) ? $bgcolor1 : $bgcolor2; 

      echo " <tr bgcolor='". $bgcolor ."'> <td  >"

    ."<div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">". $row_rs['fecha']."</font></div></td>"

    ."<td><div align=\"right\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">". $row_rs['toturg']."</font></div></td>"

    ."<td><div align=\"right\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">". $row_rs['totira']."</font></div></td>"

    ."<td ><div align=\"center\">  "

    ."<a href=\"#\" onClick=\"window.open('verhojan.php?id=". $row_rs['id']."&nombre=".$_SESSION['nombre']."&tipo=".$_SESSION['tipo']."',"

    ."'ventana1','width=780,height=600,scrollbars=YES')\" > "

     ."<img src=\"button_browse.png\" width=\"12\" height=\"13\" border=\"0\">" 

    . "  </a> </div> </td>";

if(strcmp($_SESSION['nivelautorizado'],'direccion')!=0){

   echo "<td><div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

    ."    <a href=\"index.php?page=registra&file=indexn&func=formulup&id=".$row_rs['id']."\">"

    ."<img src=\"button_edit.png\" width=\"12\" height=\"13\" border=\"0\"></a> "

    ."    </font></div></td>"

    ."<td><div align=\"center\"><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

 //   ."<a href=\"index.php?page=registra&file=indexn&func=elimina&id=". $row_rs['id']."\">"

 //   ."<img src=\"button_drop.png\" width=\"11\" height=\"13\" border=\"0\" onClick=\"if(!confirm('Desea eliminar?'))return false;\">"

  // ."</a>"

   ."</font></div></td>";

}

  echo "</tr>";

  } while ($row_rs = mysql_fetch_assoc($rs)); 

echo "</table>";

if(strcmp($_SESSION['nivelautorizado'],'direccion')!=0){

 echo "<form name=\"form1\" method=\"post\" action=\"index.php?page=registra&file=indexn&func=formulin\">"

."  <div align=\"center\">"

."    <input type=\"submit\" name=\"Submit\" value=\"Agregar registro diario\">"

."  </div>"

."</form>";

}

echo "<p>&nbsp;" 

."<table border=\"0\" width=\"50%\" align=\"center\">"

."  <tr>" 

 ."   <td width=\"23%\" align=\"center\">";



 if ($pageNum_rsr > 0) { 

 echo " <a href=\"".$currentPage."&pageNum_rs=0"."".$queryString_rs."\">"

 ."<img src=\"First.gif\" border=0></a> ";

      } 

 echo "</td>"

   ." <td width=\"31%\" align=\"center\">";

 if ($pageNum_rs > 0) { 

   $maxi=max(0, $pageNum_rs - 1);

   echo "<a href=\"".$currentPage."&pageNum_rs=".$maxi."".$queryString_rs."\">"

     ." <img src=\"Previous.gif\" border=0></a>"; 

       } 

 echo "</td>"

  ."  <td width=\"23%\" align=\"center\"> ";

   if ($pageNum_rs < $totalPages_rs) { 

       $mini=min($totalPages_rs, $pageNum_rs + 1);

      echo "<a href=\"".$currentPage."&pageNum_rs=".$mini."".$queryString_rs."\" >"

       ."<img src=\"Next.gif\" border=0></a>"; 

      } 

 echo "   </td>"

  ."  <td width=\"23%\" align=\"center\">"; 

   if ($pageNum_rs < $totalPages_rs) { 

  echo "<a href=\"".$currentPage."&pageNum_rs=".$totalPages_rs."".$queryString_rs."\">"

    ." <img src=\"Last.gif\" border=0></a> ";

      } 



/*   if ($pageNum_rs > 0) { // Show if not first page 

   echo "<a href=\"";

   printf("%s&pageNum_rs=%d%s", $currentPage, 0, $queryString_rs);

   echo "><img src=\"First.gif\" border=0></a> ";

      } // Show if not first page 

  echo " </td>"

    ."<td width=\"31%\" align=\"center\">"; 

   if ($pageNum_rs > 0) { // Show if not first page 

  echo  "<a href=\"";

  printf("%s&pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); 

  echo "><img src=\"Previous.gif\" border=0></a> ";

      } // Show if not first page 

  echo " </td>"

   ." <td width=\"23%\" align=\"center\"> ";

  if ($pageNum_rs < $totalPages_rs) { // Show if not last page

  echo "<a href=\"";

  printf("%s&pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs);

  echo "><img src=\"Next.gif\" border=0></a>"; 

      } // Show if not last page 

  echo " </td>"

    ."<td width=\"23%\" align=\"center\">";

  if ($pageNum_rs < $totalPages_rs) { // Show if not last page 

  echo "<a href=\"";

  printf("%s&pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); 

  echo "><img src=\"Last.gif\" border=0></a>" ;

      } // Show if not last page 

*/

  echo " </td>"

  ."</tr>"

."</table></p>";

mysql_free_result($rs);

}

// Para modificar los datos del registro diario

function formulup(){

global $e,$f;

$query_rs = sprintf("SELECT *, 

                    bronq_m1+bronq_1a9+bronq_10a14+bronq_15a64+bronq_65ym as totgenbron,



                    bronq_m1+bronq_1a9+bronq_10a14 as totinfbron,



                    bronq_15a64+bronq_65ym as totadubron,



                    asma_m1+asma_1a9+asma_10a14+asma_15a64+asma_65ym as totgenasma,



                    asma_m1+asma_1a9+asma_10a14 as totinfasma,



                    asma_15a64+asma_65ym as totaduasma,



                    neumo_m1+neumo_1a9+neumo_10a14+neumo_15a64+neumo_65ym as totgenneumo,



                    neumo_m1+neumo_1a9+neumo_10a14 as totinfneumo,



                    neumo_15a64+neumo_65ym as totaduneumo,



                    influ_m1+influ_1a9+influ_10a14+influ_15a64+influ_65ym as totgeninflu,



                    influ_m1+influ_1a9+influ_10a14 as totinfinflu,



                    influ_15a64+influ_65ym as totaduinflu,



                    larin_m1+larin_1a9+larin_10a14+larin_15a64+larin_65ym as totgenlarin,



                    larin_m1+larin_1a9+larin_10a14 as totinflarin,



                    larin_15a64+larin_65ym as totadularin,

					

					 iraltas_m1 + iraltas_1a9 + iraltas_10a14 + iraltas_15a64 + iraltas_65ym as totgeniraltas,



                    iraltas_m1 + iraltas_1a9 + iraltas_10a14 as totinfiraltas,



                    iraltas_15a64 + iraltas_65ym as totaduiraltas,



                    resto_m1+resto_1a9+resto_10a14+resto_15a64+resto_65ym as totgenresto,



                    resto_m1+resto_1a9+resto_10a14 as totinfresto,



                    resto_15a64+resto_65ym as totaduresto,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+ iraltas_m1 + resto_m1 as totiram1,



                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+ iraltas_1a9 + resto_1a9 as totira1a9,



                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+ iraltas_10a14 + resto_10a14 as totira10a14,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+ iraltas_15a64 + resto_15a64 as totira15a64,



                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym + iraltas_65ym + resto_65ym as totira65ym,



                    totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym as toturg,



                    totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym as totsin,



                    totm1 + tot1a9 + tot10a14 as toturginf,



                    tot15a64 + tot65ym as toturgadu,



                    totsinm1 + totsin1a9 + totsin10a14 as totsininf,



                    totsin15a64 + totsin65ym as totsinadu,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+ iraltas_m1 + resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+ iraltas_1a9 + resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14 + iraltas_10a14 + resto_10a14 +

                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64 + iraltas_15a64 + resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym + iraltas_65ym + resto_65ym  as totgentod,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+ iraltas_m1 + resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+ iraltas_1a9 + resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+ iraltas_10a14 + resto_10a14 as totinftod,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+ iraltas_15a64 + resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+ iraltas_65ym + resto_65ym  as totadutod,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+ iraltas_m1 + resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+ iraltas_1a9 + resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+ iraltas_10a14 +resto_10a14 +

                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+ iraltas_15a64 +resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+ iraltas_65ym + resto_65ym  +

                    totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym +

                    totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym 

                    as tottot,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+ iraltas_m1 + resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+ iraltas_1a9 + resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+ iraltas_10a14 + resto_10a14 +

                    totm1 + tot1a9 + tot10a14 + totsinm1 + totsin1a9 + totsin10a14 as tottotinf,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+ iraltas_15a64 + resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+ iraltas_65ym + resto_65ym +

                    tot15a64 + tot65ym + totsin15a64 + totsin65ym as tottotadu,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+ iraltas_m1 + resto_m1 + totm1 + totsinm1 as tottotm1,



                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+ iraltas_1a9 + resto_1a9 + totsin1a9 + tot1a9 as tottot1a9,



                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+ iraltas_10a14 + resto_10a14 +

                    tot10a14 + totsin10a14 as tottot10a14,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+ iraltas_15a64 + resto_15a64 +

                     tot15a64 + totsin15a64 as tottot15a64,



                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+ iraltas_65ym + resto_65ym +

                     tot65ym + totsin65ym as tottot65ym



                    FROM aturg_urbana where id=%s", $_GET['id']);



$rs = safe_query($query_rs);

$row_rs = mysql_fetch_assoc($rs);

$totalRows_rs = mysql_num_rows($rs);



$f = $row_rs['fecha'];

$e = $row_rs['id_estab'];



$datos="<form method=\"post\" name=\"f\" action=\"index.php?page=registra&file=indexn&func=modifica\">"

 ."<table width=\"600\" align=\"center\">"

 ."   <caption><font color=\"#0000CC\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Atenciones "

 ."   de Urgencia y Causas Respiratorias<br>Establecimiento: <i>".$_SESSION['nombre']."</i> "

 ."&nbsp;&nbsp;&nbsp;Fecha: "

 ."<input name=\"fecha\" type=\"text\" onBlur=\"return esfecha(document.forms.f.fecha)\" value=\""

 . $row_rs['fecha'] ."\" size=\"10\" maxlength=\"10\">"

 ."<input name=\"fechah\" type=\"hidden\" value=\"". $row_rs['fecha'] ."\" >"

 ."</strong></font>"

 . "</caption>"

 ."<tr valign=\"baseline\">" 

 ."<td width=\"85\" align=\"right\" nowrap>" 

 ."<div align=\"left\"><strong><font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

 ."Grupos de edad:</font></strong></div></td>"

 ."<td width=\"53\" bgcolor=\"#DDDDDD\" > "

 ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"

 ."Total urgencias </font></strong></font></div></td>"

  ."<td width=\"53\"> "

  ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"

  ."Resto urgencia M�icas</font></strong></font></div></td>"

   ."<td width=\"56\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"

   ."Total urgencia Quirur.</font></strong></font></div></td>"

   ."<td bgcolor=\"#DDDDDD\" width=\"48\"> "

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

   ."<td width=\"48\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"

."IRAs Altas</font></strong></font></div></td>"

   ."<td width=\"48\"> " 

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">"

."Resto de Respirat.</font></strong></font></div></td>"

 ."</tr>"



 ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\">" 

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

 ."</tr>"



 ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

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

 ."</tr>"



 ."<tr valign=\"baseline\">" 

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#0000CC\">&lt;1 a&ntilde;o:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   ."<input name=\"tottotm1\" type=\"text\" id=\"tottotm1\" size=\"5\" maxlength=\"5\""

   ."    value=\"". $row_rs['tottotm1']."\" readonly=\"true\">"

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"totm1\" value=\"". $row_rs['totm1'] ."\"  size=\"5\" "

."onBlur=\"return calculo2(document.f.totm1,document.f.totm1h,document.f.toturg,document.f.toturginf,document.f.tottotm1,document.f.tottotinf,document.f.tottot)\" >"

       ."<input type=\"hidden\" name=\"totm1h\" value=\"". $row_rs['totm1'] ."\" id=\"totm1h\">"

       ."</font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input name=\"totsinm1\" type=\"text\" value=\"". $row_rs['totsinm1'] ."\" size=\"5\" maxlength=\"5\" "

."onBlur=\"return calculo2(document.f.totsinm1,document.f.totsinm1h,document.f.totsin,document.f.totsininf,document.f.tottotm1,document.f.tottotinf,document.f.tottot)\" >"

       ."<input type=\"hidden\" name=\"totsinm1h\" value=\"". $row_rs['totsinm1'] ."\" id=\"totsinm1h\">"

       ."</font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\">"

."<font face=\"Verdana, Arial, Helvetica, sans-serif\">"

       ."<input name=\"totiram1\" type=\"text\" id=\"totiram1\" size=\"5\" maxlength=\"5\" readonly=\"true\""

        ." value=\"". $row_rs['totiram1'] ."\">"

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"bronq_m1\" type=\"text\" value=\"". $row_rs['bronq_m1'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.bronq_m1,document.f.bronq_m1h,document.f.totiram1,document.f.totgenbron,document.f.totinfbron,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"bronq_m1h\" value=\"". $row_rs['bronq_m1'] ."\" id=\"bronq_m1h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"asma_m1\" type=\"text\" value=\"". $row_rs['asma_m1'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.asma_m1,document.f.asma_m1h,document.f.totiram1,document.f.totgenasma,document.f.totinfasma,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"asma_m1h\" value=\"". $row_rs['asma_m1'] ."\" id=\"asma_m1h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input type=\"text\" name=\"neumo_m1\" value=\"". $row_rs['neumo_m1'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.neumo_m1,document.f.neumo_m1h,document.f.totiram1,document.f.totgenneumo,document.f.totinfneumo,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"neumo_m1h\" value=\"". $row_rs['neumo_m1'] ."\" id=\"neumo_m1h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"influ_m1\" value=\"". $row_rs['influ_m1'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.influ_m1,document.f.influ_m1h,document.f.totiram1,document.f.totgeninflu,document.f.totinfinflu,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"influ_m1h\" value=\"". $row_rs['influ_m1'] ."\" id=\"influ_m1h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"larin_m1\" value=\"". $row_rs['larin_m1'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.larin_m1,document.f.larin_m1h,document.f.totiram1,document.f.totgenlarin,document.f.totinflarin,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"larin_m1h\" value=\"". $row_rs['larin_m1'] ."\" id=\"larin_m1h\">"

       ."</font></div></td>"

	   

	   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"iraltas_m1\" value=\"". $row_rs['iraltas_m1'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.iraltas_m1,document.f.iraltas_m1h,document.f.totiram1,document.f.totgeniraltas,document.f.totinfiraltas,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"iraltas_m1h\" value=\"". $row_rs['iraltas_m1'] ."\" id=\"iraltas_m1h\">"

       ."</font></div></td>"   

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"resto_m1\" value=\"". $row_rs['resto_m1'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.resto_m1,document.f.resto_m1h,document.f.totiram1,document.f.totgenresto,document.f.totinfresto,document.f.tottotm1,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"resto_m1h\" value=\"". $row_rs['resto_m1']."\" id=\"resto_m1h\">"

       ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\">" 

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#0000CC\">";

if(strcmp( $row_rs['fecha'],'2006-03-29')>0)

	$datos.= "1-4 a&ntilde;os:";

else

	$datos.= "1-9 a&ntilde;os:";

$datos.= "</font></strong></font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   ."<input name=\"tottot1a9\" type=\"text\" id=\"tottot1a9\" size=\"5\" maxlength=\"5\""

   ."    value=\"". $row_rs['tottot1a9']."\" readonly=\"true\">"

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input name=\"tot1a9\" type=\"text\" value=\"". $row_rs['tot1a9']."\" size=\"5\" maxlength=\"5\""

           ."onBlur=\"return calculo2(document.f.tot1a9,document.f.tot1a9h,document.f.toturg,document.f.toturginf)\" >"

            ."<input type=\"hidden\" name=\"tot1a9h\" value=\"". $row_rs['tot1a9'] ."\" id=\"tot1a9h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"totsin1a9\" type=\"text\" value=\"". $row_rs['totsin1a9'] ."\" size=\"5\" maxlength=\"5\""

           ."onBlur=\"return calculo2(document.f.totsin1a9,document.f.totsin1a9h,document.f.totsin,document.f.totsininf)\">"

       ."<input type=\"hidden\" name=\"totsin1a9h\" value=\"". $row_rs['totsin1a9'] ."\" id=\"totsin1a9h\">"

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

       ."<input name=\"totira1a9\" type=\"text\" id=\"totira1a9\" size=\"5\" maxlength=\"5\" readonly=\"true\""

          ." value=\"". $row_rs['totira1a9'] ."\">"

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input name=\"bronq_1a9\" type=\"text\" value=\"". $row_rs['bronq_1a9'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.bronq_1a9,document.f.bronq_1a9h,document.f.totira1a9,document.f.totgenbron,document.f.totinfbron,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"bronq_1a9h\" value=\"". $row_rs['bronq_1a9'] ."\" id=\"bronq_1a9h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input name=\"asma_1a9\" type=\"text\" value=\"". $row_rs['asma_1a9'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.asma_1a9,document.f.asma_1a9h,document.f.totira1a9,document.f.totgenasma,document.f.totinfasma,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"asma_1a9h\" value=\"". $row_rs['asma_1a9'] ."\" id=\"asma_1a9h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"neumo_1a9\" value=\"". $row_rs['neumo_1a9'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.neumo_1a9,document.f.neumo_1a9h,document.f.totira1a9,document.f.totgenneumo,document.f.totinfneumo,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"neumo_1a9h\" value=\"". $row_rs['neumo_1a9'] ."\" id=\"neumo_1a9h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input type=\"text\" name=\"influ_1a9\" value=\"". $row_rs['influ_1a9'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.influ_1a9,document.f.influ_1a9h,document.f.totira1a9,document.f.totgeninflu,document.f.totinfinflu,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"influ_1a9h\" value=\"". $row_rs['influ_1a9'] ."\" id=\"influ_1a9h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"larin_1a9\" value=\"". $row_rs['larin_1a9'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.larin_1a9,document.f.larin_1a9h,document.f.totira1a9,document.f.totgenlarin,document.f.totinflarin,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"larin_1a9h\" value=\"". $row_rs['larin_1a9'] ."\" id=\"larin_1a9h\">"

       ."</font></div></td>"

	   

	  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"iraltas_1a9\" value=\"". $row_rs['iraltas_1a9'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.iraltas_1a9,document.f.iraltas_1a9h,document.f.totira1a9,document.f.totgeniraltas,document.f.totinfiraltas,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"iraltas_1a9h\" value=\"". $row_rs['iraltas_1a9'] ."\" id=\"iraltas_1a9h\">"

       ."</font></div></td>"  

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"resto_1a9\" value=\"". $row_rs['resto_1a9'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.resto_1a9,document.f.resto_1a9h,document.f.totira1a9,document.f.totgenresto,document.f.totinfresto,document.f.tottot1a9,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"resto_1a9h\" value=\"". $row_rs['resto_1a9'] ."\" id=\"resto_1a9h\">"

       ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\"> "

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#0000CC\">";

if(strcmp( $row_rs['fecha'],'2006-03-29')>0)

	$datos.= "5-14 a&ntilde;os:";

else

	$datos.= "10-14 a&ntilde;os:";

$datos.="</font></strong></font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   ."<input name=\"tottot10a14\" type=\"text\" id=\"tottot10a14\" size=\"5\" maxlength=\"5\""

   ."    value=\"". $row_rs['tottot10a14']."\" readonly=\"true\">"

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"tot10a14\" type=\"text\" value=\"". $row_rs['tot10a14'] ."\" size=\"5\" maxlength=\"5\""

 ."onBlur=\"return calculo2(document.f.tot10a14,document.f.tot10a14h,document.f.toturg,document.f.toturginf)\" >"

            ."<input type=\"hidden\" name=\"tot10a14h\" value=\"". $row_rs['tot10a14'] ."\" id=\"tot10a14h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input name=\"totsin10a14\" type=\"text\" value=\"". $row_rs['totsin10a14'] ."\" size=\"5\" maxlength=\"5\" "

."onBlur=\"return calculo2(document.f.totsin10a14,document.f.totsin10a14h,document.f.totsin,document.f.totsininf)\">"

       ."<input type=\"hidden\" name=\"totsin10a14h\" value=\"". $row_rs['totsin10a14'] ."\" id=\"totsin10a14h\">"

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."</font><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

       ."<input name=\"totira10a14\" type=\"text\" id=\"totira10a14\" size=\"5\" maxlength=\"5\" readonly=\"true\" "

       ." value=\"". $row_rs['totira10a14'] ."\">"

       ."</font></font></font><font face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"bronq_10a14\" type=\"text\" value=\"". $row_rs['bronq_10a14'] ."\" size=\"5\" maxlength=\"5\" "

."onBlur=\"return calculo(document.f.bronq_10a14,document.f.bronq_10a14h,document.f.totira10a14,document.f.totgenbron,document.f.totinfbron,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"bronq_10a14h\" value=\"". $row_rs['bronq_10a14'] ."\" id=\"bronq_10a14h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"asma_10a14\" type=\"text\" value=\"". $row_rs['asma_10a14'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.asma_10a14,document.f.asma_10a14h,document.f.totira10a14,document.f.totgenasma,document.f.totinfasma,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"asma_10a14h\" value=\"". $row_rs['asma_10a14'] ."\" id=\"asma_10a14h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input type=\"text\" name=\"neumo_10a14\" value=\"". $row_rs['neumo_10a14'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.neumo_10a14,document.f.neumo_10a14h,document.f.totira10a14,document.f.totgenneumo,document.f.totinfneumo,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"neumo_10a14h\" value=\"". $row_rs['neumo_10a14'] ."\" id=\"neumo_10a14h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"influ_10a14\" value=\"". $row_rs['influ_10a14'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.influ_10a14,document.f.influ_10a14h,document.f.totira10a14,document.f.totgeninflu,document.f.totinfinflu,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"influ_10a14h\" value=\"". $row_rs['influ_10a14'] ."\" id=\"influ_10a14h\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"larin_10a14\" value=\"". $row_rs['larin_10a14'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.larin_10a14,document.f.larin_10a14h,document.f.totira10a14,document.f.totgenlarin,document.f.totinflarin,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"larin_10a14h\" value=\"". $row_rs['larin_10a14'] ."\" id=\"larin_10a14h\">"

       ."</font></div></td>"

	   

	 ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"iraltas_10a14\" value=\"". $row_rs['iraltas_10a14'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.iraltas_10a14,document.f.iraltas_10a14h,document.f.totira10a14,document.f.totgeniraltas,document.f.totinfiraltas,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"iraltas_10a14h\" value=\"". $row_rs['iraltas_10a14'] ."\" id=\"iraltas_10a14h\">"

       ."</font></div></td>"   

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"resto_10a14\" value=\"". $row_rs['resto_10a14'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.resto_10a14,document.f.resto_10a14h,document.f.totira10a14,document.f.totgenresto,document.f.totinfresto,document.f.tottot10a14,document.f.tottotinf,document.f.tottot,document.f.totinftod,document.f.totgentod)\" >"



       ."<input type=\"hidden\" name=\"resto_10a14h\" value=\"". $row_rs['resto_10a14'] ."\" id=\"resto_10a14h\">"

       ."</font></div></td>"

 ."</tr>"



 ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

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

 ."</tr>"



 ."<tr valign=\"baseline\"> "

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#0000CC\">15-64 a&ntilde;os:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   ."<input name=\"tottot15a64\" type=\"text\" id=\"tottot15a64\" size=\"5\" maxlength=\"5\""

   ."    value=\"". $row_rs['tottot15a64']."\" readonly=\"true\">"

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   ."<input name=\"tot15a64\" type=\"text\" value=\"". $row_rs['tot15a64'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.tot15a64,document.f.tot15a64h,document.f.toturg,document.f.toturgadu)\">"

   ."<input type=\"hidden\" name=\"tot15a64h\" value=\"". $row_rs['tot15a64'] ."\" id=\"tot15a64h\">"

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   ."<input name=\"totsin15a64\" type=\"text\" value=\"". $row_rs['totsin15a64'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.totsin15a64,document.f.totsin15a64h,document.f.totsin,document.f.totsinadu)\">"

   ."<input type=\"hidden\" name=\"totsin15a64h\" value=\"". $row_rs['totsin15a64'] ."\" id=\"totsin15a64h\">"

   ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   ."<input name=\"totira15a64\" type=\"text\" id=\"totira15a64\" size=\"5\" maxlength=\"5\" "

   ." value=\"". $row_rs['totira15a64'] ."\" readonly=\"true\">"

   ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   ."<input name=\"bronq_15a64\" type=\"text\" value=\"". $row_rs['bronq_15a64'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.bronq_15a64,document.f.bronq_15a64h,document.f.totira15a64,document.f.totgenbron,document.f.totadubron,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

  ."<input type=\"hidden\" name=\"bronq_15a64h\" value=\"". $row_rs['bronq_15a64'] ."\" id=\"bronq_15a64h\">"

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  ."<input name=\"asma_15a64\" type=\"text\" value=\"". $row_rs['asma_15a64'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.asma_15a64,document.f.asma_15a64h,document.f.totira15a64,document.f.totgenasma,document.f.totaduasma,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

  ."<input type=\"hidden\" name=\"asma_15a64h\" value=\"". $row_rs['asma_15a64'] ."\" id=\"asma_15a64h\">"

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  ."<input type=\"text\" name=\"neumo_15a64\" value=\"". $row_rs['neumo_15a64'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.neumo_15a64,document.f.neumo_15a64h,document.f.totira15a64,document.f.totgenneumo,document.f.totaduneumo,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

  ."<input type=\"hidden\" name=\"neumo_15a64h\" value=\"". $row_rs['neumo_15a64'] ."\" id=\"neumo_15a64h\">"

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  ."<input type=\"text\" name=\"influ_15a64\" value=\"". $row_rs['influ_15a64'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.influ_15a64,document.f.influ_15a64h,document.f.totira15a64,document.f.totgeninflu,document.f.totaduinflu,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

  ."<input type=\"hidden\" name=\"influ_15a64h\" value=\"". $row_rs['influ_15a64'] ."\" id=\"influ_15a64h\">"

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

  ."<input type=\"text\" name=\"larin_15a64\" value=\"". $row_rs['larin_15a64'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.larin_15a64,document.f.larin_15a64h,document.f.totira15a64,document.f.totgenlarin,document.f.totadularin,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

   ."<input type=\"hidden\" name=\"larin_15a64h\" value=\"". $row_rs['larin_15a64'] ."\" id=\"larin_15a64h\">"

   ."</font></div></td>"

   

  ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

  ."<input type=\"text\" name=\"iraltas_15a64\" value=\"". $row_rs['iraltas_15a64'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.iraltas_15a64,document.f.iraltas_15a64h,document.f.totira15a64,document.f.totgeniraltas,document.f.totaduiraltas,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

   ."<input type=\"hidden\" name=\"iraltas_15a64h\" value=\"". $row_rs['iraltas_15a64'] ."\" id=\"iraltas_15a64h\">"

   ."</font></div></td>"  

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   ."<input type=\"text\" name=\"resto_15a64\" value=\"". $row_rs['resto_15a64'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.resto_15a64,document.f.resto_15a64h,document.f.totira15a64,document.f.totgenresto,document.f.totaduresto,document.f.tottot15a64,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

   ."<input type=\"hidden\" name=\"resto_15a64h\" value=\"". $row_rs['resto_15a64'] ."\" id=\"resto_15a64h\">"

   ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\">" 

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#0000CC\">65 "

         ." y m&aacute;s a&ntilde;os:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   ."<input name=\"tottot65ym\" type=\"text\" id=\"tottot65ym\" size=\"5\" maxlength=\"5\""

   ."    value=\"". $row_rs['tottot65ym']."\" readonly=\"true\">"

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"tot65ym\" type=\"text\" value=\"". $row_rs['tot65ym'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.tot65ym,document.f.tot65ymh,document.f.toturg,document.f.toturgadu)\">"

       ."<input type=\"hidden\" name=\"tot65ymh\" value=\"". $row_rs['tot65ym'] ."\" id=\"tot65ymh\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"totsin65ym\" type=\"text\" value=\"". $row_rs['totsin65ym'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo2(document.f.totsin65ym,document.f.totsin65ymh,document.f.totsin,document.f.totsinadu)\">"

       ."<input type=\"hidden\" name=\"totsin65ymh\" value=\"". $row_rs['totsin65ym'] ."\" id=\"totsin65ymh\">"

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#0000CC\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

       ."<input name=\"totira65ym\" type=\"text\" id=\"totira65ym\" size=\"5\" maxlength=\"5\" readonly=\"true\""

         ." value=\"". $row_rs['totira65ym'] ."\">"

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"bronq_65ym\" type=\"text\" value=\"". $row_rs['bronq_65ym'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.bronq_65ym,document.f.bronq_65ymh,document.f.totira65ym,document.f.totgenbron,document.f.totadubron,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"bronq_65ymh\" value=\"". $row_rs['bronq_65ym'] ."\" id=\"bronq_65ymh\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input name=\"asma_65ym\" type=\"text\" value=\"". $row_rs['asma_65ym'] ."\" size=\"5\" maxlength=\"5\""

."onBlur=\"return calculo(document.f.asma_65ym,document.f.asma_65ymh,document.f.totira65ym,document.f.totgenasma,document.f.totaduasma,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

       ."<input type=\"hidden\" name=\"asma_65ymh\" value=\"". $row_rs['asma_65ym'] ."\" id=\"asma_65ymh\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input type=\"text\" name=\"neumo_65ym\" value=\"". $row_rs['neumo_65ym'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.neumo_65ym,document.f.neumo_65ymh,document.f.totira65ym,document.f.totgenneumo,document.f.totaduneumo,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

."<input type=\"hidden\" name=\"neumo_65ymh\" value=\"". $row_rs['neumo_65ym'] ."\" id=\"neumo_65ymh\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       ."<input type=\"text\" name=\"influ_65ym\" value=\"". $row_rs['influ_65ym'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.influ_65ym,document.f.influ_65ymh,document.f.totira65ym,document.f.totgeninflu,document.f.totaduinflu,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

."<input type=\"hidden\" name=\"influ_65ymh\" value=\"". $row_rs['influ_65ym'] ."\" id=\"influ_65ymh\">"

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"larin_65ym\" value=\"". $row_rs['larin_65ym'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.larin_65ym,document.f.larin_65ymh,document.f.totira65ym,document.f.totgenlarin,document.f.totadularin,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

."<input type=\"hidden\" name=\"larin_65ymh\" value=\"". $row_rs['larin_65ym'] ."\" id=\"larin_65ymh\">"

       ."</font></div></td>"

	   

	 ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"iraltas_65ym\" value=\"". $row_rs['iraltas_65ym'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.iraltas_65ym,document.f.iraltas_65ymh,document.f.totira65ym,document.f.totgeniraltas,document.f.totaduiraltas,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

."<input type=\"hidden\" name=\"iraltas_65ymh\" value=\"". $row_rs['iraltas_65ym'] ."\" id=\"iraltas_65ymh\">"

       ."</font></div></td>"   

   ."<td><div align=\"right\"> <font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."<input type=\"text\" name=\"resto_65ym\" value=\"". $row_rs['resto_65ym'] ."\" size=\"5\""

."onBlur=\"return calculo(document.f.resto_65ym,document.f.resto_65ymh,document.f.totira65ym,document.f.totgenresto,document.f.totaduresto,document.f.tottot65ym,document.f.tottotadu,document.f.tottot,document.f.totadutod,document.f.totgentod)\" >"

."<input type=\"hidden\" name=\"resto_65ymh\" value=\"".$row_rs['resto_65ym']."\" id=\"resto_65ymh\">"

  ."</font></div></td>"

 ."</tr>"

."</table>";

echo $datos;

aturgo();

if(strcmp($_SESSION['tipo'],'urbano')==0 || strcmp($_SESSION['tipo'],'provincial')==0 ){

  hospitaliza();

  hospitalizao();

  egresos();

}

if(strcmp($_SESSION['tipo'],'sapu')==0){

  derivaciones();

}

  fallecidoh();

echo "<table>"

 ."<tr valign=\"baseline\"> "

   ."<td height=\"25\" align=\"right\" nowrap> <div align=\"left\">"

   ."<font color=\"#0000CC\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></div></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

    ."<input type=\"submit\" value=\"Grabar\">"

 ."<input type=\"button\" name=\"cuadrar\" id=\"cuadrar\" value=\"cuadrar\" onclick=\"javascript:cuadra();\">";

 if(strcmp($_SESSION['tipo'],'sapu')==0){

 echo "<input type=\"button\" name=\"cuadraderiva\" id=\"cuadraderiva\" value=\"Cuadrar derivaciones\" onclick=\"javascript:cuadraderivat();\">";

 }

     echo "</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;";

// Link a correo

 if(strcmp($_SESSION['nivelautorizado'],'administrador')==0 ||strcmp($_SESSION['nivelautorizado'],'direccion')==0 ){ 
// HSJD, HFB, HTA, ITR, SPE, SRE
   if($_SESSION['id_estab']==1|| $_SESSION['id_estab']==3 || $_SESSION['id_estab']==14 || $_SESSION['id_estab']==29
   		|| $_SESSION['id_estab']==8 || $_SESSION['id_estab']==11 || $_SESSION['id_estab']==13 || $_SESSION['id_estab']==15)

    echo "<a href=\"index.php?page=registra&file=indexn&func=correo&id=".$_GET['id']."&fecha=".$row_rs['fecha']."\">"

         ."<font color=\"blue\" size=\"1\">Correo a DEIS</font></a>";

	else

	echo "<a href=\"index.php?page=registra&file=index&func=correo&id=".$_GET['id']."&fecha=".$row_rs['fecha']."\">"

         ."<font color=\"blue\" size=\"1\">Correo a DEIS</font></a>";

  }

echo "</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

   ."<td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td>"

 ."</tr>"

 ." </table>"

 ." <div align=\"center\">"

 ."<input type=\"hidden\" name=\"MM_update\" value=\"form1\">"

 ."<input type=\"hidden\" name=\"id\" value=\"". $row_rs['id']."\">"

."  </div>"

."</form>";



}

// funci� correo

function correo(){



$fileText=$_SESSION['nombre'].".txt";

$fileText=str_replace(" ","_",$fileText);

$fp=fopen($fileText,"w");



$query="select fecha, id_estab,

			   iraltas_m1+iraltas_1a9+iraltas_10a14+iraltas_15a64+iraltas_65ym as totgeniraltas,

			   

               iraltas_m1 as totinfiraltas,

               iraltas_1a9 as totiraltas1a9,

			   iraltas_10a14 as totiraltas10a14,

               iraltas_15a64,

               iraltas_65ym,

			   

               bronq_m1+bronq_1a9+bronq_10a14+bronq_15a64+bronq_65ym as totgenbron,

               bronq_m1 as totinfbron,

               bronq_1a9 as totbron1a9,

			   bronq_10a14 as totbron10a14,

               bronq_15a64,

               bronq_65ym,

			   

               neumo_m1+neumo_1a9+neumo_10a14+neumo_15a64+neumo_65ym as totgenneumo,

               neumo_m1 as totinfneumo,

               neumo_1a9 as totneumo1a9,

			   neumo_10a14 as totneumo10a14,

               neumo_15a64,

               neumo_65ym  ,

			   

               influ_m1+influ_1a9+influ_10a14+influ_15a64+influ_65ym as totgeninflu,

               influ_m1 as totinfinflu,

               influ_1a9 as totinflu1a9,

			   influ_10a14 as totinflu10a14,

               influ_15a64,

               influ_65ym,

			   

			   influ_m1+influ_1a9+influ_10a14+influ_15a64+influ_65ym +

               larin_m1+larin_1a9+larin_10a14+larin_15a64+larin_65ym +

               asma_m1+asma_1a9+asma_10a14+asma_15a64+asma_65ym +

               resto_m1+resto_1a9+resto_10a14+resto_15a64+resto_65ym as totgenresto,

			   

               larin_m1 + asma_m1 + resto_m1 + influ_m1    as totinfresto,

               larin_1a9 + asma_1a9 + resto_1a9 + influ_1a9   as totresto1a9,

			   larin_10a14+ asma_10a14+ resto_10a14+influ_10a14  as totresto10a14,

               larin_15a64 + asma_15a64 + resto_15a64 +influ_15a64 as totresto15a64,

               larin_65ym + asma_65ym + resto_65ym+influ_65ym as totresto65ym,

			   

			   larin_m1+larin_1a9+larin_10a14+larin_15a64+larin_65ym +

               asma_m1+ asma_1a9+ asma_10a14+ asma_15a64+ asma_65ym +

               resto_m1+resto_1a9+resto_10a14+resto_15a64+resto_65ym +

			   influ_m1+influ_1a9+influ_10a14+influ_15a64+influ_65ym +

			   neumo_m1+neumo_1a9+neumo_10a14+neumo_15a64+neumo_65ym +

			   bronq_m1+bronq_1a9+bronq_10a14+bronq_15a64+bronq_65ym +

			   iraltas_m1+iraltas_1a9+iraltas_10a14+iraltas_15a64+iraltas_65ym +

			   totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym +

               totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym as toturg,

			   

			   larin_m1+asma_m1+resto_m1+influ_m1+neumo_m1+bronq_m1+iraltas_m1+totsinm1+totm1 as toturgm1,

			   

   			   larin_10a14+asma_10a14+resto_10a14+influ_10a14+neumo_10a14+bronq_10a14+iraltas_10a14+totsin10a14+tot10a14 as toturg10a14,

			   

			   larin_15a64+asma_15a64+resto_15a64+influ_15a64+neumo_15a64+bronq_15a64+iraltas_15a64+totsin15a64+tot15a64 as toturg15a64,

			   

			   larin_1a9+asma_1a9+resto_1a9+influ_1a9+neumo_1a9+bronq_1a9+iraltas_1a9+totsin1a9+tot1a9 as toturg1a9,

			   

			   larin_65ym+asma_65ym+resto_65ym+influ_65ym+neumo_65ym+bronq_65ym+iraltas_65ym+totsin65ym+tot65ym as toturg65ym,

			   

			   larin_m1+larin_1a9+larin_10a14+larin_15a64+larin_65ym +

               asma_m1+ asma_1a9+ asma_10a14+ asma_15a64+ asma_65ym +

               resto_m1+resto_1a9+resto_10a14+resto_15a64+resto_65ym +

			   influ_m1+influ_1a9+influ_10a14+influ_15a64+influ_65ym +

			   neumo_m1+neumo_1a9+neumo_10a14+neumo_15a64+neumo_65ym +

			   bronq_m1+bronq_1a9+bronq_10a14+bronq_15a64+bronq_65ym +

			   iraltas_m1+iraltas_1a9+iraltas_10a14+iraltas_15a64+iraltas_65ym as totresp,

			   larin_m1+asma_m1+resto_m1+influ_m1+neumo_m1+bronq_m1+iraltas_m1 as totrespm1,

   			   larin_10a14+asma_10a14+resto_10a14+influ_10a14+neumo_10a14+bronq_10a14+iraltas_10a14 as totresp10a14,

			   larin_15a64+asma_15a64+resto_15a64+influ_15a64+neumo_15a64+bronq_15a64+iraltas_15a64 as totresp15a64,

			   larin_1a9+asma_1a9+resto_1a9+influ_1a9+neumo_1a9+bronq_1a9+iraltas_1a9 as totresp1a9,

			   larin_65ym+asma_65ym+resto_65ym+influ_65ym+neumo_65ym+bronq_65ym+iraltas_65ym as totresp65ym,

               totm1,tot1a9,tot10a14,tot15a64,tot65ym

        from aturg_urbana

        where id=".$_GET['id'];

$rsm = safe_query($query);

$row_rsm = mysql_fetch_assoc($rsm);

$totalRows_rsm = mysql_num_rows($rsm);



$query_rsa="select *,

			infarto_m1+infarto_1a4+infarto_5a14+infarto_15a64+infarto_65ym as totinfarto,

			vascular_m1+vascular_1a4+vascular_5a14+vascular_15a64+vascular_65ym as totvascular,

			hipertensiva_m1+hipertensiva_1a4+hipertensiva_5a14+hipertensiva_15a64+hipertensiva_65ym as tothipertensiva,

			arritmia_m1+arritmia_1a4+arritmia_5a14+arritmia_15a64+arritmia_65ym as totarritmia,

			otrascirc_m1+otrascirc_1a4+otrascirc_5a14+otrascirc_15a64+otrascirc_65ym as tototrascirc,

			transito_m1+transito_1a4+transito_5a14+transito_15a64+transito_65ym as tottransito,

			otrasext_m1+otrasext_1a4+otrasext_5a14+otrasext_15a64+otrasext_65ym as tototrasext,

			demas_m1+demas_1a4+demas_5a14+demas_15a64+demas_65ym as totdemas,

			infarto_m1+vascular_m1+hipertensiva_m1+arritmia_m1+otrascirc_m1 as totcirc_m1,

			infarto_1a4+vascular_1a4+hipertensiva_1a4+arritmia_1a4+otrascirc_1a4 as totcirc_1a4,

			infarto_5a14+vascular_5a14+hipertensiva_5a14+arritmia_5a14+otrascirc_5a14 as totcirc_5a14,

			infarto_15a64+vascular_15a64+hipertensiva_15a64+arritmia_15a64+otrascirc_15a64 as totcirc_15a64,

			infarto_65ym+vascular_65ym+hipertensiva_65ym+arritmia_65ym+otrascirc_65ym as totcirc_65ym,

			transito_m1+otrasext_m1  as tottrauma_m1,

			transito_1a4+otrasext_1a4  as tottrauma_1a4,

			transito_5a14+otrasext_5a14  as tottrauma_5a14,

			transito_15a64+otrasext_15a64  as tottrauma_15a64,

			transito_65ym+otrasext_65ym  as tottrauma_65ym,

			infarto_m1+vascular_m1+hipertensiva_m1+arritmia_m1+otrascirc_m1 +

			infarto_1a4+vascular_1a4+hipertensiva_1a4+arritmia_1a4+otrascirc_1a4 +

			infarto_5a14+vascular_5a14+hipertensiva_5a14+arritmia_5a14+otrascirc_5a14 +

			infarto_15a64+vascular_15a64+hipertensiva_15a64+arritmia_15a64+otrascirc_15a64 +

			infarto_65ym+vascular_65ym+hipertensiva_65ym+arritmia_65ym+otrascirc_65ym as totcirc,

			transito_m1+otrasext_m1  +

			transito_1a4+otrasext_1a4 +

			transito_5a14+otrasext_5a14  +

			transito_15a64+otrasext_15a64  +

			transito_65ym+otrasext_65ym  as tottrauma

             from aturgo

             where id_estab=".$row_rsm['id_estab']." and fecha='".$row_rsm['fecha']."'";

$rsa = safe_query($query_rsa);

$row_rsa = mysql_fetch_assoc($rsa);

$totalRows_rsa = mysql_num_rows($rsa);



$query_rsho="select pbm1,pom1,utibm1, pb1_9,po1_9,pb10_14,po10_14,

                    hb15_64, ho15_64, mb15_64, mo15_64,

                    utib15_64, utit15_64, ucit15_64, ucib15_64,

                    hb65ym, ho65ym, mb65ym, mo65ym,

                    utib65ym, utit65ym, ucit65ym, ucib65ym,

                    pbotras, pootras, hbotras, hootras, mbotras, mootras,

                    utitotras, utibotras, ucibotras, ucitotras

             from hospitaliza

             where id_estab=".$row_rsm['id_estab']." and fecha='".$row_rsm['fecha']."'";

$rsho = safe_query($query_rsho);

$row_rsho = mysql_fetch_assoc($rsho);

$totalRows_rsho = mysql_num_rows($rsho);



$query_rshot="select *,

			circulatorias_m1+circulatorias_1a4+circulatorias_5a14+circulatorias_15a64+circulatorias_65ym as totcirculatorias,

			trauma_m1+trauma_1a4+trauma_5a14+trauma_15a64+trauma_65ym as tottrauma,
			cirurg_m1+cirurg_1a4+cirurg_5a14+cirurg_15a64+cirurg_65ym as totcirurg,

			demas_m1+demas_1a4+demas_5a14+demas_15a64+demas_65ym as totdemas

             from hospitalizao

             where id_estab=".$row_rsm['id_estab']." and fecha='".$row_rsm['fecha']."'";

$rshot = safe_query($query_rshot);

$row_rshot = mysql_fetch_assoc($rshot);

$totalRows_rshot = mysql_num_rows($rshot);



$h2=$row_rsho['pbm1']+$row_rsho['utibm1'];

$h3=$row_rsho['pb1_9'];

$h32=$row_rsho['pb10_14'];

$h4=$row_rsho['hb15_64']+$row_rsho['mb15_64']+$row_rsho['utib15_64']+$row_rsho['ucib15_64'];

$h5=$row_rsho['hb65ym']+$row_rsho['mb65ym']+$row_rsho['utib65ym']+ $row_rsho['ucib65ym']; 

$h1=$h2+$h3+$h32+$h4+$h5;



$o2=$row_rsho['pom1']+$row_rsho['utitm1'];

$o3=$row_rsho['po1_9'];

$o32=$row_rsho['po10_14'];

$o4=$row_rsho['ho15_64']+$row_rsho['mo15_64']+$row_rsho['utit15_64']+$row_rsho['ucit15_64'];

$o5=$row_rsho['ho65ym']+$row_rsho['mo65ym']+$row_rsho['utit65ym']+$row_rsho['ucit65ym'];

$o1=$o2 + $o3 + + $o32 + $o4 + $o5 + $row_rsho['pbotras']+$row_rsho['pootras']+$row_rsho['hbotras']+$row_rsho['hootras']+

    $row_rsho['mbotras']+$row_rsho['mootras']+$row_rsho['utitbotras']+$row_rsho['utibotras']+

    $row_rsho['ucibotras']+$row_rsho['ucitotras'];



$a31=$row_rsm['totgenbron'];

$a32=$row_rsm['totinfbron'];

$a33=$row_rsm['totbron1a9'];

$a332=$row_rsm['totbron10a14'];

$a34=$row_rsm['bronq_15a64'];

$a35=$row_rsm['bronq_65ym'];

$a41=$row_rsm['totgeninflu'];

$a42=$row_rsm['totinfinflu'];

$a43=$row_rsm['totinflu1a9'];

$a432=$row_rsm['totinflu10a14'];

$a44=$row_rsm['influ_15a64'];

$a45=$row_rsm['influ_65ym'];

$a51=$row_rsm['totgenneumo'];

$a52=$row_rsm['totinfneumo'];

$a53=$row_rsm['totneumo1a9'];

$a532=$row_rsm['totneumo10a14'];

$a54=$row_rsm['neumo_15a64'];

$a55=$row_rsm['neumo_65ym'];

$a61=$row_rsm['totgenresto'];

$a62=$row_rsm['totinfresto'];

$a63=$row_rsm['totresto1a9'];

$a632=$row_rsm['totresto10a14'];

$a64=$row_rsm['totresto15a64'];

$a65=$row_rsm['totresto65ym'];

$a21=$a31+$a41+$a51+$a61;

$a22=$a32+$a42+$a52+$a62;

$a23=$a33+$a43+$a53+$a63;

$a232=$a332+$a432+$a532+$a632;

$a24=$a34+$a44+$a54+$a64;

$a25=$a35+$a45+$a55+$a65;

//$a11=$a21+$row_rsm['toturg'];

$a11=$row_rsm['toturg'];

$a12=$row_rsm['totrespm1']+$row_rsa['totcirc_m1']+$row_rsa['tottrauma_m1']+$row_rsa['demas_m1']+$row_rsa['cirurg_m1'];

$a13=$row_rsm['totresp1a9']+$row_rsa['totcirc_1a4']+$row_rsa['tottrauma_1a4']+$row_rsa['demas_1a4']+$row_rsa['cirurg_1a4'];

$a132=$row_rsm['totresp10a14']+$row_rsa['totcirc_5a14']+$row_rsa['tottrauma_5a14']+$row_rsa['demas_5a14']+$row_rsa['cirurg_5a14'];

$a14=$row_rsm['totresp15a64']+$row_rsa['totcirc_15a64']+$row_rsa['tottrauma_15a64']+$row_rsa['demas_15a64']+$row_rsa['cirurg_15a64'];

$a15=$row_rsm['totresp65ym']+$row_rsa['totcirc_65ym']+$row_rsa['tottrauma_65ym']+$row_rsa['demas_65ym']+$row_rsa['cirurg_65ym'];

//$a12=$a22+$row_rsm['totm1'];

//$a13=$a23+$row_rsm['tot1a9'];

//$a132=$a232+$row_rsm['tot10a14'];

//$a14=$a24+$row_rsm['tot15a64'];

//$a15=$a25+$row_rsm['tot65ym'];



$plano="Sres.DEIS:\n\n";

$plano.="Establecimiento:".$_SESSION['nombre']."\n";

$plano.="Fecha: ".$_GET['fecha']."\n\n";

$plano.="ATENCIONES Y HOSPITALIZACIONES DIARIAS EN URGENCIA\n";

$plano.="Atencion y hospitalizaciones  Total -1a   1-4a  5-14a 15-64a 65ymas\n";

$plano.="1.TOTAL ATENCIONES URGENCIA   ".$a11."\t ".$a12."\t ".$a13."\t ".$a132."\t ".$a14."\t ".$a15."\n";

$plano.="TOTAL CAUSAS RESPIRATORIAS    ".$row_rsm['totresp']."\t ".$row_rsm['totrespm1']."\t ".$row_rsm['totresp1a9'].

"\t ".$row_rsm['totresp10a14']."\t ".$row_rsm['totresp15a64']."\t ".$row_rsm['totresp65ym']."\n";

$plano.="IRA Altas                     ".$row_rsm['totgeniraltas']."\t ".$row_rsm['totinfiraltas']."\t ".$row_rsm['totiraltas1a9'].

"\t ".$row_rsm['totiraltas10a14']."\t ".$row_rsm['iraltas_15a64']."\t ".$row_rsm['iraltas_65ym']."\n";

//$plano.="Bronquitis-SOB \t\t\t".$a31."\t\t".$a32."\t\t".$a33."\t".$a332."\t\t".$a34."\t\t".$a35."\n";

//$plano.="Influenza \t \t \t\t".$a41."\t\t".$a42."\t\t".$a43."\t".$a432."\t\t".$a44."\t\t".$a45."\n";

$plano.="Neumonias                     ".$row_rsm['totgenneumo']."\t ".$row_rsm['totinfneumo']."\t ".$row_rsm['totneumo1a9'].

"\t ".$row_rsm['totneumo10a14']."\t ".$row_rsm['neumo_15a64']."\t ".$row_rsm['neumo_65ym']."\n";

$plano.="Crisis obstructivas bronquial.".$row_rsm['totgenbron']."\t ".$row_rsm['totinfbron']."\t ".$row_rsm['totbron1a9'].

"\t ".$row_rsm['totbron10a14']."\t ".$row_rsm['bronq_15a64']."\t ".$row_rsm['bronq_65ym']."\n";

$plano.="Otras causas respiratorias    ".$row_rsm['totgenresto']."\t ".$row_rsm['totinfresto']."\t ".$row_rsm['totresto1a9'].

"\t ".$row_rsm['totresto10a14']."\t ".$row_rsm['totresto15a64']."\t ".$row_rsm['totresto65ym']."\n";

$plano.="TOTAL CAUSAS CIRCULATORIAS    ".$row_rsa['totcirc']."\t ".$row_rsa['totcirc_m1']."\t ".$row_rsa['totcirc_1a4']."\t ".

$row_rsa['totcirc_5a14']."\t ".$row_rsa['totcirc_15a64']."\t ".$row_rsa['totcirc_65ym']."\n";

$plano.="Infarto agudo miocardio       ".$row_rsa['totinfarto']."\t ".$row_rsa['infarto_m1']."\t ".$row_rsa['infarto_1a4']."\t ".

$row_rsa['infarto_5a14']."\t ".$row_rsa['infarto_15a64']."\t ".$row_rsa['infarto_65ym']."\n";

$plano.="Accidente vascular encefalico ".$row_rsa['totvascular']."\t ".$row_rsa['vascular_m1']."\t ".$row_rsa['vascular_1a4']."\t ".

$row_rsa['vascular_5a14']."\t ".$row_rsa['vascular_15a64']."\t ".$row_rsa['vascular_65ym']."\n";

$plano.="Crisis Hipertensiva           ".$row_rsa['tothipertensiva']."\t ".$row_rsa['hipertensiva_m1']."\t ".$row_rsa['hipertensiva_1a4']."\t".

$row_rsa['hipertensiva_5a14']."\t ".$row_rsa['hipertensiva_15a64']."\t ".$row_rsa['hipertensiva_65ym']."\n";

$plano.="Arritmia severa               ".$row_rsa['totarritmia']."\t ".$row_rsa['arritmia_m1']."\t ".$row_rsa['arritmia_1a4']."\t ".

$row_rsa['arritmia_5a14']."\t ".$row_rsa['arritmia_15a64']."\t ".$row_rsa['arritmia_65ym']."\n";

$plano.="Otras causas circulatorias    ".$row_rsa['tototrascirc']."\t ".$row_rsa['otrascirc_m1']."\t ".$row_rsa['otrascirc_1a4']."\t ".

$row_rsa['otrascirc_5a14']."\t ".$row_rsa['otrascirc_15a64']."\t ".$row_rsa['otrascirc_65ym']."\n";

$plano.="TOTAL TRAUMATISMOS y ENVENENA ".$row_rsa['tottrauma']."\t ".$row_rsa['tottrauma_m1']."\t ".$row_rsa['tottrauma_1a4']."\t ".

$row_rsa['tottrauma_5a14']."\t ".$row_rsa['tottrauma_15a64']."\t ".$row_rsa['tottrauma_65ym']."\n";

$plano.="Accidentes de Transito        ".$row_rsa['tottransito']."\t ".$row_rsa['transito_m1']."\t ".$row_rsa['transito_1a4']."\t ".

$row_rsa['transito_5a14']."\t ".$row_rsa['transito_15a64']."\t ".$row_rsa['transito_65ym']."\n";

$plano.="Otras causas externas         ".$row_rsa['tototrasext']."\t ".$row_rsa['otrasext_m1']."\t ".$row_rsa['otrasext_1a4']."\t ".

$row_rsa['otrasext_5a14']."\t ".$row_rsa['otrasext_15a64']."\t ".$row_rsa['otrasext_65ym']."\n";

$plano.="TOTAL DEMAS CAUSAS            ".$row_rsa['totdemas']."\t ".$row_rsa['demas_m1']."\t ".$row_rsa['demas_1a4']."\t ".

$row_rsa['demas_5a14']."\t ".$row_rsa['demas_15a64']."\t ".$row_rsa['demas_65ym']."\n\n";



$plano.="2.HOSPITALIZACIONES \n";

$plano.="POR CAUSAS RESPIRATORIAS      ".$h1."\t  ".$h2."\t  ".$h3."\t  ".$h32."\t  ".$h4."\t  ".$h5."\n";

$plano.="POR CAUSAS CIRCULATORIAS      ".$row_rshot['totcirculatorias']."\t ".$row_rshot['circulatorias_m1']."\t ".$row_rshot['circulatorias_1a4'].

"\t ".$row_rshot['circulatorias_5a14']."\t ".$row_rshot['circulatorias_15a64']."\t ".$row_rshot['circulatorias_65ym']."\n";

$plano.="POR TRAUMATISMOS y ENVENENAMI ".$row_rshot['tottrauma']."\t ".$row_rshot['trauma_m1']."\t ".$row_rshot['trauma_1a4'].

"\t ".$row_rshot['trauma_5a14']."\t ".$row_rshot['trauma_15a64']."\t ".$row_rshot['trauma_65ym']."\n";

$plano.="Cirugías de Urgencias         ".$row_rshot['totcirurg']."\t ".$row_rshot['cirurg_m1']."\t ".$row_rshot['cirurg_1a4'].

"\t ".$row_rshot['cirurg_5a14']."\t ".$row_rshot['cirurg_15a64']."\t ".$row_rshot['cirurg_65ym']."\n";

$plano.="POR LAS DEMAS CAUSAS          ".$row_rshot['totdemas']."\t ".$row_rshot['demas_m1']."\t ".$row_rshot['demas_1a4'].

"\t ".$row_rshot['demas_5a14']."\t ".$row_rshot['demas_15a64']."\t ".$row_rshot['demas_65ym']."\n";



//$plano.="Hospitalizaciones diarias en Urgencia por otras causas\n";

//$plano.="Total\t-1a�\t1-4a�s\t5-14a�s\t15-64a�s\t65y m�\n";

//$plano.=$o1."\t  ".$o2."\t  ".$o3."\t\t  ".$o32."\t\t  ".$o4."\t\t  ".$o5."\n\n";



$plano.="\tAtentamente";



fwrite($fp,$plano);

fclose($fp);

echo " <a href=".$fileText."><strong>Bajar Archivo Deis</strong></a> &nbsp;&nbsp; ";



$message=$plano;



$headers  = 'MIME-Version: 1.0' . "\r\n";

//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";

$headers .= 'From: Lupe <guadalupe.pastore@redsalud.gov.cl>' . "\r\n";

$headers .= 'To: DEIS <urgeira@minsal.cl>' . "\r\n";

//$headers .= 'To: DAIMO <daimo.sanchez@redsalud.gov.cl>' . "\r\n";

$headers .= 'CC: Lupe <guadalupe.pastore@redsalud.gov.cl>' . "\r\n";

mail('urgeira@minsal.cl', 'Adjunto datos IRA', $message, $headers);

//mail('daimo.sanchez@redsalud.gov.cl', 'Adjunto datos IRA', $message, $headers);

echo "Su correo ha sido enviado";



} //fin funcion� correo



// Elimina registros

function elimina(){

  $id=$_GET['id'];

  $query="select id_estab,fecha from aturg_urbana where id=".$id;

  $rs = safe_query($query);

  $row_rs = mysql_fetch_assoc($rs);

  $totalRows_rsh = mysql_num_rows($rs);



  $es=$row_rs['id_estab'];

  $fe=$row_rs['fecha'];



  $deleteSQL="delete from aturg_urbana where id=".$id;

  $result=safe_query($deleteSQL);



  $deleteSQL="delete from aturgo where id_estab=".$es." and fecha='".$fe."'";

  $result=safe_query($deleteSQL);

	

  if(strcmp($_SESSION['tipo'],'urbano')==0){

    $deleteSQL="delete from hospitaliza where id_estab=".$es." and fecha='".$fe."'";

    $result=safe_query($deleteSQL);

	$deleteSQL="delete from hospitalizao where id_estab=".$es." and fecha='".$fe."'";

    $result=safe_query($deleteSQL);

    $deleteSQL="delete from egresos where id_estab=".$es." and fecha='".$fe."'";

    $result=safe_query($deleteSQL);

  }

  if(strcmp($_SESSION['tipo'],'sapu')==0){

    $deleteSQL="delete from derivaciones where id_estab=".$es." and fecha='".$fe."'";

    $result=safe_query($deleteSQL);

  }

    $deleteSQL="delete from fallecidoh where id_estab=".$es." and fecha='".$fe."'";

    $result=safe_query($deleteSQL);



  $insertGoTo = "index.php?page=registra&file=indexn&func=listaurg";

   header(sprintf("Location: %s", $insertGoTo));

}

// Hospitalizaciones de los hospitales urbanos

function hospitaliza(){

   global $e,$f;

  if(isset($_GET['id'])&&isset($e)&&isset($f)){

   $query_rsh="select *,

               pbm1 + pb1_9 + pb10_14 + pb15_64 + pb65ym as pbsubtotr,

               pom1 + po1_9 + po10_14 + po15_64 + po65ym as posubtotr,

               hbm1 + hb1_9 + hb10_14 + hb15_64 + hb65ym as hbsubtotr,

               hom1 + ho1_9 + ho10_14 + ho15_64 + ho65ym as hosubtotr,

               mbm1 + mb1_9 + mb10_14 + mb15_64 + mb65ym as mbsubtotr,

               mom1 + mo1_9 + mo10_14 + mo15_64 + mo65ym as mosubtotr,



               utibm1 + utib1_9 + utib10_14 + utib15_64 + utib65ym as utibsubtotr,

               utitm1 + utit1_9 + utit10_14 + utit15_64 + utit65ym as utitsubtotr,

               ucibm1 + ucib1_9 + ucib10_14 + ucib15_64 + ucib65ym as ucibsubtotr,

               ucitm1 + ucit1_9 + ucit10_14 + ucit15_64 + ucit65ym as ucitsubtotr,





               pbm1 + pb1_9 + pb10_14 + pb15_64 + pb65ym + pbotras as pbtot,

               pom1 + po1_9 + po10_14 + po15_64 + po65ym + pootras as potot,

               hbm1 + hb1_9 + hb10_14 + hb15_64 + hb65ym + hbotras as hbtot,

               hom1 + ho1_9 + ho10_14 + ho15_64 + ho65ym + hootras as hotot,

               mbm1 + mb1_9 + mb10_14 + mb15_64 + mb65ym + mbotras as mbtot,

               mom1 + mo1_9 + mo10_14 + mo15_64 + mo65ym + mootras as motot,



               utibm1 + utib1_9 + utib10_14 + utib15_64 + utib65ym + utibotras as utibtot,

               utitm1 + utit1_9 + utit10_14 + utit15_64 + utit65ym + utitotras as utittot,

               ucibm1 + ucib1_9 + ucib10_14 + ucib15_64 + ucib65ym + ucibotras as ucibtot,

               ucitm1 + ucit1_9 + ucit10_14 + ucit15_64 + ucit65ym + ucitotras as ucittot,

               camillasxcr, camillasxo

               from hospitaliza

               where id_estab=".$e." and fecha='".$f."'";

       $rsh = safe_query($query_rsh);

       $row_rsh = mysql_fetch_assoc($rsh);

       $totalRows_rsh = mysql_num_rows($rsh);

     }

print <<<EOQ

<table width="600" border="0" align="center">

<td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

No. Pacientes en camillas por mas de 4 horas, en espera de hospitalizacion x causas respiratorias</font></strong>

</td><td>

EOQ;

  echo "<input name=\"camillasxcr\" type=\"text\" id=\"camillasxcr\" value=\"";  

      if(!empty($row_rsh['camillasxcr']))

          echo $row_rsh['camillasxcr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" >";

print <<<EOQ

<td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

No. Pacientes en camillas por mas de 4 horas, en espera de hospitalizacion x otras causas</font></strong>

</td><td>

EOQ;

  echo "<input name=\"camillasxo\" type=\"text\" id=\"camillasxo\" value=\"";  

      if(!empty($row_rsh['camillasxo']))

          echo $row_rsh['camillasxo'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" >";

print <<<EOQ

</td></tr></table>

<table width="600" border="0" align="center">

  <caption>

  <strong><font color="#0000CC" size="2" face="Verdana, Arial, Helvetica, sans-serif">Hospitalizaciones</font></strong> 

  </caption>

  <tr> 

    <td width="96"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;

                   </font></strong></td>

    <td width="103"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

     &nbsp;</font></strong></td>

    <td colspan="2"> <div align="center"><font size="1"><strong>

    <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;os</font></strong></font></div></td>

    <td colspan="4"> <div align="center"><font size="1"><strong><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Adultos 

        Medicina</font></strong></font></div></td>

    <td colspan="4"> <div align="center"><font size="1"><strong>

     <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">

        Unidad Pac.Criticos</font></strong></font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Grupos 

      de Edad</font></strong></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

   <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Pediatr&iacute;a</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Hombres</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">Mujeres</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">U.Trat.Interm.</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif">U.Cuidado Int.</font></strong></font></div></td>



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

      if(!empty($row_rsh['pbm1']))

          echo $row_rsh['pbm1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\""

   ."onBlur=\"return calculo3(document.f.pbm1,document.f.pbm1h,document.f.pbtot,document.f.pbsubtotr)\">";

   echo "<input name=\"pbm1h\" type=\"hidden\" id=\"pbm1h\" value=\"";  

          echo $row_rsh['pbm1'];

   echo "\" >";

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"pom1\" type=\"text\" id=\"pom1\" value=\"";  

      if(!empty($row_rsh['pom1']))

          echo $row_rsh['pom1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\""

   ."onBlur=\"return calculo3(document.f.pom1,document.f.pom1h,document.f.potot,document.f.posubtotr)\">" ; 

   echo "<input name=\"pom1h\" type=\"hidden\" id=\"pom1h\" value=\"";  

          echo $row_rsh['pom1'];

   echo "\" >";    

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"hbm1\" type=\"text\" id=\"hbm1\" value=\"";  

      if(!empty($row_rsh['hbm1']))

          echo $row_rsh['hbm1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hbm1,document.f.hbm1h,document.f.hbtot,document.f.hbsubtotr)\">" ;

   echo "<input name=\"hbm1h\" type=\"hidden\" id=\"hbm1h\" value=\"";  

          echo $row_rsh['hbm1'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hom1\" type=\"text\" id=\"hom1\" value=\"";  

      if(!empty($row_rsh['hom1']))

          echo $row_rsh['hom1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hom1,document.f.hom1h,document.f.hotot,document.f.hosubtotr)\">";

   echo "<input name=\"hom1h\" type=\"hidden\" id=\"hom1h\" value=\"";  

          echo $row_rsh['hom1'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mbm1\" type=\"text\" id=\"mbm1\" value=\"";  

      if(!empty($row_rsh['mbm1']))

          echo $row_rsh['mbm1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mbm1,document.f.mbm1h,document.f.mbtot,document.f.mbsubtotr)\">";

   echo "<input name=\"mbm1h\" type=\"hidden\" id=\"mbm1h\" value=\"";  

          echo $row_rsh['mbm1'];

   echo "\" >";    

print <<<EOQ

    </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mom1\" type=\"text\" id=\"mom1\" value=\"";  

      if(!empty($row_rsh['mom1']))

          echo $row_rsh['mom1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mom1,document.f.mom1h,document.f.motot,document.f.mosubtotr)\">";

     echo "<input name=\"mom1h\" type=\"hidden\" id=\"mom1h\" value=\"";  

          echo $row_rsh['mom1'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utibm1\" type=\"text\" id=\"utibm1\" value=\"";  

      if(!empty($row_rsh['utibm1']))

          echo $row_rsh['utibm1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utibm1,document.f.utibm1h,document.f.utibtot,document.f.utibsubtotr)\">";

     echo "<input name=\"utibm1h\" type=\"hidden\" id=\"utibm1h\" value=\"";  

          echo $row_rsh['utibm1'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utitm1\" type=\"text\" id=\"utitm1\" value=\"";  

      if(!empty($row_rsh['utitm1']))

          echo $row_rsh['utitm1'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utitm1,document.f.utitm1h,document.f.utittot,document.f.utitsubtotr)\">";

     echo "<input name=\"utitm1h\" type=\"hidden\" id=\"utitm1h\" value=\"";  

          echo $row_rsh['utitm1'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucibm1\" type=\"text\" id=\"ucibm1\" value=\"";  

      if(!empty($row_rsh['ucibm1']))
          echo $row_rsh['ucibm1'];
         else
             echo 0;
   echo "\" size=\"4\" maxlength=\"4\" "
   ."onBlur=\"return calculo3(document.f.ucibm1,document.f.ucibm1h,document.f.ucibtot,document.f.ucibsubtotr)\">";
     echo "<input name=\"ucibm1h\" type=\"hidden\" id=\"ucibm1h\" value=\"";  
          echo $row_rsh['ucibm1'];
   echo "\" >";  
print <<<EOQ
        </font></div></td>
    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
EOQ;
   echo "<input name=\"ucitm1\" type=\"text\" id=\"ucitm1\" value=\"";  
      if(!empty($row_rsh['ucitm1']))
          echo $row_rsh['ucitm1'];
         else
             echo 0;
   echo "\" size=\"4\" maxlength=\"4\" "
   ."onBlur=\"return calculo3(document.f.ucitm1,document.f.ucitm1h,document.f.ucittot,document.f.ucitsubtotr)\">";
     echo "<input name=\"ucitm1h\" type=\"hidden\" id=\"ucitm1h\" value=\"";  
          echo $row_rsh['ucitm1'];
   echo "\" >";  
print <<<EOQ
        </font></div></td>



  </tr>

  <tr> 

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

//if(strcmp( $f,'2006-03-29')>0)

	echo "1-4 a&ntilde;os:";

//else

//	echo  "1-9 a&ntilde;os:";

print <<<EOQ

</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"pb1_9\" type=\"text\" id=\"pb1_9\" value=\"";  

      if(!empty($row_rsh['pb1_9']))

          echo $row_rsh['pb1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.pb1_9,document.f.pb1_9h,document.f.pbtot,document.f.pbsubtotr)\">" ; 

   echo "<input name=\"pb1_9h\" type=\"hidden\" id=\"pb1_9h\" value=\"";  

          echo $row_rsh['pb1_9'];

   echo "\" >";   

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"po1_9\" type=\"text\" id=\"po1_9\" value=\"";  

      if(!empty($row_rsh['po1_9']))

          echo $row_rsh['po1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.po1_9,document.f.po1_9h,document.f.potot,document.f.posubtotr)\">";

   echo "<input name=\"po1_9h\" type=\"hidden\" id=\"po1_9h\" value=\"";  

          echo $row_rsh['po1_9'];

   echo "\" >";     

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hb1_9\" type=\"text\" id=\"hb1_9\" value=\"";  

      if(!empty($row_rsh['hb1_9']))

          echo $row_rsh['hb1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hb1_9,document.f.hb1_9h,document.f.hbtot,document.f.hbsubtotr)\">" ;

   echo "<input name=\"hb1_9h\" type=\"hidden\" id=\"hb1_9h\" value=\"";  

          echo $row_rsh['hb1_9'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ho1_9\" type=\"text\" id=\"ho1_9\" value=\"";  

      if(!empty($row_rsh['ho1_9']))

          echo $row_rsh['ho1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hom1,document.f.hom1h,document.f.hotot,document.f.hosubtotr)\">";

  

   echo "<input name=\"ho1_9h\" type=\"hidden\" id=\"ho1_9h\" value=\"";  

          echo $row_rsh['ho1_9'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mb1_9\" type=\"text\" id=\"mb1_9\" value=\"";  

      if(!empty($row_rsh['mb1_9']))

          echo $row_rsh['mb1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mbm1,document.f.mbm1h,document.f.mbtot,document.f.mbsubtotr)\">"; 

   echo "<input name=\"mb1_9h\" type=\"hidden\" id=\"mb1_9h\" value=\"";  

          echo $row_rsh['mb1_9'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mo1_9\" type=\"text\" id=\"mo1_9\" value=\"";  

      if(!empty($row_rsh['mo1_9']))

          echo $row_rsh['mo1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mo1_9,document.f.mo1_9h,document.f.motot,document.f.mosubtotr)\">";

   echo "<input name=\"mo1_9h\" type=\"hidden\" id=\"mo1_9h\" value=\"";  

          echo $row_rsh['mo1_9'];

   echo "\" >";      

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utib1_9\" type=\"text\" id=\"utib1_9\" value=\"";  

      if(!empty($row_rsh['utib1_9']))

          echo $row_rsh['utib1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utib1_9,document.f.utib1_9h,document.f.utibtot,document.f.utibsubtotr)\">";

     echo "<input name=\"utib1_9h\" type=\"hidden\" id=\"utib1_9h\" value=\"";  

          echo $row_rsh['utib1_9'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utit1_9\" type=\"text\" id=\"utit1_9\" value=\"";  

      if(!empty($row_rsh['utit1_9']))

          echo $row_rsh['utit1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utit1_9,document.f.utit1_9h,document.f.utittot,document.f.utitsubtotr)\">";

     echo "<input name=\"utit1_9h\" type=\"hidden\" id=\"utit1_9h\" value=\"";  

          echo $row_rsh['utit1_9'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucib1_9\" type=\"text\" id=\"ucib1_9\" value=\"";  

      if(!empty($row_rsh['ucib1_9']))

          echo $row_rsh['ucib1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucib1_9,document.f.ucib1_9h,document.f.ucibtot,document.f.ucibsubtotr)\">";

     echo "<input name=\"ucib1_9h\" type=\"hidden\" id=\"ucib1_9h\" value=\"";  

          echo $row_rsh['ucib1_9'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucit1_9\" type=\"text\" id=\"ucit1_9\" value=\"";  

      if(!empty($row_rsh['ucit1_9']))

          echo $row_rsh['ucit1_9'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucit1_9,document.f.ucit1_9h,document.f.ucittot,document.f.ucitsubtotr)\">";

     echo "<input name=\"ucit1_9h\" type=\"hidden\" id=\"ucit1_9h\" value=\"";  

          echo $row_rsh['ucit1_9'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>



  </tr>

  <tr> 

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

//if(strcmp( $f,'2006-03-29')>0)

	echo "5-14 a&ntilde;os:";

//else

//	echo  "10-14 a&ntilde;os:";

print <<<EOQ

</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"pb10_14\" type=\"text\" id=\"pb10_14\" value=\"";  

      if(!empty($row_rsh['pb10_14']))

          echo $row_rsh['pb10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.pb10_14,document.f.pb10_14h,document.f.pbtot,document.f.pbsubtotr)\">";  

   echo "<input name=\"pb10_14h\" type=\"hidden\" id=\"pb10_14h\" value=\"";  

          echo $row_rsh['pb10_14'];

   echo "\" >";   

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC">

EOQ;

   echo "<input name=\"po10_14\" type=\"text\" id=\"po10_14\" value=\"";  

      if(!empty($row_rsh['po10_14']))

          echo $row_rsh['po10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.po10_14,document.f.po10_14h,document.f.potot,document.f.posubtotr)\">";  

   echo "<input name=\"po10_14h\" type=\"hidden\" id=\"po10_14h\" value=\"";  

          echo $row_rsh['po10_14'];

   echo "\" >";     

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hb10_14\" type=\"text\" id=\"hb10_14\" value=\"";  

      if(!empty($row_rsh['hb10_14']))

          echo $row_rsh['hb10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hb10_14,document.f.hb10_14h,document.f.hbtot,document.f.hbsubtotr)\">";    

   echo "<input name=\"hb10_14h\" type=\"hidden\" id=\"hb10_14h\" value=\"";  

          echo $row_rsh['hb10_14'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ho10_14\" type=\"text\" id=\"ho10_14\" value=\"";  

      if(!empty($row_rsh['ho10_14']))

          echo $row_rsh['ho10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ho10_14,document.f.ho10_14h,document.f.hotot,document.f.hosubtotr)\">";  

   echo "<input name=\"ho10_14h\" type=\"hidden\" id=\"ho10_14h\" value=\"";  

          echo $row_rsh['ho10_14'];

   echo "\" >";      

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"mb10_14\" type=\"text\" id=\"mb10_14\" value=\"";  

      if(!empty($row_rsh['mb10_14']))

          echo $row_rsh['mb10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mb10_14,document.f.mb10_14h,document.f.mbtot,document.f.mbsubtotr)\">";    

   echo "<input name=\"mb10_14h\" type=\"hidden\" id=\"mb10_14h\" value=\"";  

          echo $row_rsh['mb10_14'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mo10_14\" type=\"text\" id=\"mo10_14\" value=\"";  

      if(!empty($row_rsh['mo10_14']))

          echo $row_rsh['mo10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mo10_14,document.f.mo10_14h,document.f.motot,document.f.mosubtotr)\">";     

   echo "<input name=\"mo10_14h\" type=\"hidden\" id=\"mo10_14h\" value=\"";  

          echo $row_rsh['mo10_14'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utib10_14\" type=\"text\" id=\"utib10_14\" value=\"";  

      if(!empty($row_rsh['utib10_14']))

          echo $row_rsh['utib10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utib10_14,document.f.utib10_14h,document.f.utibtot,document.f.utibsubtotr)\">";

     echo "<input name=\"utib10_14h\" type=\"hidden\" id=\"utib10_14h\" value=\"";  

          echo $row_rsh['utib10_14'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utit10_14\" type=\"text\" id=\"utit10_14\" value=\"";  

      if(!empty($row_rsh['utit10_14']))

          echo $row_rsh['utit10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utit10_14,document.f.utit10_14h,document.f.utittot,document.f.utitsubtotr)\">";

     echo "<input name=\"utit10_14h\" type=\"hidden\" id=\"utit10_14h\" value=\"";  

          echo $row_rsh['utit10_14'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucib10_14\" type=\"text\" id=\"ucib10_14\" value=\"";  

      if(!empty($row_rsh['ucib10_14']))

          echo $row_rsh['ucib10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucib10_14,document.f.ucib10_14h,document.f.ucibtot,document.f.ucibsubtotr)\">";

     echo "<input name=\"ucib10_14h\" type=\"hidden\" id=\"ucib10_14h\" value=\"";  

          echo $row_rsh['ucib10_14'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucit10_14\" type=\"text\" id=\"ucit10_14\" value=\"";  

      if(!empty($row_rsh['ucit10_14']))

          echo $row_rsh['ucit10_14'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucit10_14,document.f.ucit10_14h,document.f.ucittot,document.f.ucitsubtotr)\">";

     echo "<input name=\"ucit10_14h\" type=\"hidden\" id=\"ucit10_14h\" value=\"";  

          echo $row_rsh['ucit10_14'];

   echo "\" >";  

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

      if(!empty($row_rsh['pb15_64']))

          echo $row_rsh['pb15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.pb15_64,document.f.pb15_64h,document.f.pbtot,document.f.pbsubtotr)\">";   

   echo "<input name=\"pb15_64h\" type=\"hidden\" id=\"pb15_64h\" value=\"";  

          echo $row_rsh['pb15_64'];

   echo "\" >";    

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"po15_64\" type=\"text\" id=\"po15_64\" value=\"";  

      if(!empty($row_rsh['po15_64']))

          echo $row_rsh['po15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.po15_64,document.f.po15_64h,document.f.potot,document.f.posubtotr)\">";      

   echo "<input name=\"po15_64h\" type=\"hidden\" id=\"po15_64h\" value=\"";  

          echo $row_rsh['po15_64'];

   echo "\" >";    

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hb15_64\" type=\"text\" id=\"hb15_64\" value=\"";  

      if(!empty($row_rsh['hb15_64']))

          echo $row_rsh['hb15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hb15_64,document.f.hb15_64h,document.f.hbtot,document.f.hbsubtotr)\">";     

   echo "<input name=\"hb15_64h\" type=\"hidden\" id=\"hb15_64h\" value=\"";  

          echo $row_rsh['hb15_64'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ho15_64\" type=\"text\" id=\"ho15_64\" value=\"";  

      if(!empty($row_rsh['ho15_64']))

          echo $row_rsh['ho15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ho15_64,document.f.ho15_64h,document.f.hotot,document.f.hosubtotr)\">";      

   echo "<input name=\"ho15_64h\" type=\"hidden\" id=\"ho15_64h\" value=\"";  

          echo $row_rsh['ho15_64'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mb15_64\" type=\"text\" id=\"mb15_64\" value=\"";  

      if(!empty($row_rsh['mb15_64']))

          echo $row_rsh['mb15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mb15_64,document.f.mb15_64h,document.f.mbtot,document.f.mbsubtotr)\">";     

   echo "<input name=\"mb15_64h\" type=\"hidden\" id=\"mb15_64h\" value=\"";  

          echo $row_rsh['mb15_64'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mo15_64\" type=\"text\" id=\"mo15_64\" value=\"";  

      if(!empty($row_rsh['mo15_64']))

          echo $row_rsh['mo15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mo15_64,document.f.mo15_64h,document.f.motot,document.f.mosubtotr)\">";      

   echo "<input name=\"mo15_64h\" type=\"hidden\" id=\"mo15_64h\" value=\"";  

          echo $row_rsh['mo15_64'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utib15_64\" type=\"text\" id=\"utib15_64\" value=\"";  

      if(!empty($row_rsh['utib15_64']))

          echo $row_rsh['utib15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utib15_64,document.f.utib15_64h,document.f.utibtot,document.f.utibsubtotr)\">";

     echo "<input name=\"utib15_64h\" type=\"hidden\" id=\"utib15_64h\" value=\"";  

          echo $row_rsh['utib15_64'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utit15_64\" type=\"text\" id=\"utit15_64\" value=\"";  

      if(!empty($row_rsh['utit15_64']))

          echo $row_rsh['utit15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utit15_64,document.f.utit15_64h,document.f.utittot,document.f.utitsubtotr)\">";

     echo "<input name=\"utit15_64h\" type=\"hidden\" id=\"utit15_64h\" value=\"";  

          echo $row_rsh['utit15_64'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucib15_64\" type=\"text\" id=\"ucib15_64\" value=\"";  

      if(!empty($row_rsh['ucib15_64']))

          echo $row_rsh['ucib15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucib15_64,document.f.ucib15_64h,document.f.ucibtot,document.f.ucibsubtotr)\">";

     echo "<input name=\"ucib15_64h\" type=\"hidden\" id=\"ucib15_64h\" value=\"";  

          echo $row_rsh['ucib15_64'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucit15_64\" type=\"text\" id=\"ucit15_64\" value=\"";  

      if(!empty($row_rsh['ucit15_64']))

          echo $row_rsh['ucit15_64'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucit15_64,document.f.ucit15_64h,document.f.ucittot,document.f.ucitsubtotr)\">";

     echo "<input name=\"ucit15_64h\" type=\"hidden\" id=\"ucit15_64h\" value=\"";  

          echo $row_rsh['ucit15_64'];

   echo "\" >";  

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

      if(!empty($row_rsh['pb65ym']))

          echo $row_rsh['pb65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.pb65ym,document.f.pb65ymh,document.f.pbtot,document.f.pbsubtotr)\">";     

   echo "<input name=\"pb65ymh\" type=\"hidden\" id=\"pb65ymh\" value=\"";  

          echo $row_rsh['pb65ym'];

   echo "\" >";   

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC">

EOQ;

   echo "<input name=\"po65ym\" type=\"text\" id=\"po65ym\" value=\"";  

      if(!empty($row_rsh['po65ym']))

          echo $row_rsh['po65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.po65ym,document.f.po65ymh,document.f.potot,document.f.posubtotr)\">";       

   echo "<input name=\"po65ymh\" type=\"hidden\" id=\"po65ymh\" value=\"";  

          echo $row_rsh['po65ym'];

   echo "\" >";    

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hb65ym\" type=\"text\" id=\"hb65ym\" value=\"";  

      if(!empty($row_rsh['hb65ym']))

          echo $row_rsh['hb65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.hb65ym,document.f.hb65ymh,document.f.hbtot,document.f.hbsubtotr)\">";        

   echo "<input name=\"hb65ymh\" type=\"hidden\" id=\"hb65ymh\" value=\"";  

          echo $row_rsh['hb65ym'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ho65ym\" type=\"text\" id=\"ho65ym\" value=\"";  

      if(!empty($row_rsh['ho65ym']))

          echo $row_rsh['ho65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ho65ym,document.f.ho65ymh,document.f.hotot,document.f.hosubtotr)\">";     

   echo "<input name=\"ho65ymh\" type=\"hidden\" id=\"ho65ymh\" value=\"";  

          echo $row_rsh['ho65ym'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mb65ym\" type=\"text\" id=\"mb65ym\" value=\"";  

      if(!empty($row_rsh['mb65ym']))

          echo $row_rsh['mb65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mb65ym,document.f.mb65ymh,document.f.mbtot,document.f.mbsubtotr)\">";         

   echo "<input name=\"mb65ymh\" type=\"hidden\" id=\"mb65ymh\" value=\"";  

          echo $row_rsh['mb65ym'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mo65ym\" type=\"text\" id=\"mo65ym\" value=\"";  

      if(!empty($row_rsh['mo65ym']))

          echo $row_rsh['mo65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.mo65ym,document.f.mo65ymh,document.f.motot,document.f.mosubtotr)\">";      

   echo "<input name=\"mo65ymh\" type=\"hidden\" id=\"mo65ymh\" value=\"";  

          echo $row_rsh['mo65ym'];

   echo "\" >";     

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utib65ym\" type=\"text\" id=\"utib65ym\" value=\"";  

      if(!empty($row_rsh['utib65ym']))

          echo $row_rsh['utib65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utib65ym,document.f.utib65ymh,document.f.utibtot,document.f.utibsubtotr)\">";

     echo "<input name=\"utib65ymh\" type=\"hidden\" id=\"utib65ymh\" value=\"";  

          echo $row_rsh['utib65ym'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utit65ym\" type=\"text\" id=\"utit65ym\" value=\"";  

      if(!empty($row_rsh['utit65ym']))

          echo $row_rsh['utit65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.utit65ym,document.f.utit65ymh,document.f.utittot,document.f.utitsubtotr)\">";

     echo "<input name=\"utit65ymh\" type=\"hidden\" id=\"utit65ymh\" value=\"";  

          echo $row_rsh['utit65ym'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucib65ym\" type=\"text\" id=\"ucib65ym\" value=\"";  

      if(!empty($row_rsh['ucib65ym']))

          echo $row_rsh['ucib65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucib65ym,document.f.ucib65ymh,document.f.ucibtot,document.f.ucibsubtotr)\">";

     echo "<input name=\"ucib65ymh\" type=\"hidden\" id=\"ucib65ymh\" value=\"";  

          echo $row_rsh['ucib65ym'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucit65ym\" type=\"text\" id=\"ucit65ym\" value=\"";  

      if(!empty($row_rsh['ucit65ym']))

          echo $row_rsh['ucit65ym'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculo3(document.f.ucit65ym,document.f.ucit65ymh,document.f.ucittot,document.f.ucitsubtotr)\">";

     echo "<input name=\"ucit65ymh\" type=\"hidden\" id=\"ucit65ymh\" value=\"";  

          echo $row_rsh['ucit65ym'];

   echo "\" >";  

print <<<EOQ

        </font></div></td>



  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Subtotal</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"pbsubtotr\" type=\"text\" id=\"pbsubtotr\" value=\"";  

      if(!empty($row_rsh['pbsubtotr']))

          echo $row_rsh['pbsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"posubtotr\" type=\"text\" id=\"posubtotr\" value=\"";  

      if(!empty($row_rsh['posubtotr']))

          echo $row_rsh['posubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hbsubtotr\" type=\"text\" id=\"hbsubtotr\" value=\"";  

      if(!empty($row_rsh['hbsubtotr']))

          echo $row_rsh['hbsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hosubtotr\" type=\"text\" id=\"hosubtotr\" value=\"";  

      if(!empty($row_rsh['hosubtotr']))

          echo $row_rsh['hosubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mbsubtotr\" type=\"text\" id=\"mbsubtotr\" value=\"";  

      if(!empty($row_rsh['mbsubtotr']))

          echo $row_rsh['mbsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mosubtotr\" type=\"text\" id=\"mosubtotr\" value=\"";  

      if(!empty($row_rsh['mosubtotr']))

          echo $row_rsh['mosubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utibsubtotr\" type=\"text\" id=\"utibsubtotr\" value=\"";  

      if(!empty($row_rsh['utibsubtotr']))

          echo $row_rsh['utibsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utitsubtotr\" type=\"text\" id=\"utitsubtotr\" value=\"";  

      if(!empty($row_rsh['utitsubtotr']))

          echo $row_rsh['utitsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucibsubtotr\" type=\"text\" id=\"ucibsubtotr\" value=\"";  

      if(!empty($row_rsh['ucibsubtotr']))

          echo $row_rsh['ucibsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucitsubtotr\" type=\"text\" id=\"ucitsubtotr\" value=\"";  

      if(!empty($row_rsh['ucitsubtotr']))

          echo $row_rsh['ucitsubtotr'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";       

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

   echo "<input name=\"pbotras\" type=\"text\" id=\"pbotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['pbotras']))

          echo $row_rsh['pbotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.pbotras,document.f.pbotrash,document.f.pbtot)\">";       

   echo "<input name=\"pbotrash\" type=\"hidden\" id=\"pbotrash\" value=\"";  

          echo $row_rsh['pbotras'];

   echo "\" >";

    

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"pootras\" type=\"text\" id=\"pootras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['pootras']))

          echo $row_rsh['pootras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.pootras,document.f.pootrash,document.f.potot)\">";         

   echo "<input name=\"pootrash\" type=\"hidden\" id=\"pootrash\" value=\"";  

          echo $row_rsh['pootras'];

   echo "\" >";

     

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hbotras\" type=\"text\" id=\"hbotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['hbotras']))

          echo $row_rsh['hbotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.hbotras,document.f.hbotrash,document.f.hbtot)\">";        

   echo "<input name=\"hbotrash\" type=\"hidden\" id=\"hbotrash\" value=\"";  

          echo $row_rsh['hbotras'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hootras\" type=\"text\" id=\"hootras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['hootras']))

          echo $row_rsh['hootras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.hootras,document.f.hootrash,document.f.hotot)\">";       

   echo "<input name=\"hootrash\" type=\"hidden\" id=\"hootrash\" value=\"";  

          echo $row_rsh['hootras'];

   echo "\" >";    

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mbotras\" type=\"text\" id=\"mbotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['mbotras']))

          echo $row_rsh['mbotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.mbotras,document.f.mbotrash,document.f.mbtot)\">";       

   echo "<input name=\"mbotrash\" type=\"hidden\" id=\"mbotrash\" value=\"";  

          echo $row_rsh['mbotras'];

   echo "\" >";     

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mootras\" type=\"text\" id=\"mootras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['mootras']))

          echo $row_rsh['mootras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.mootras,document.f.mootrash,document.f.motot)\">";          

   echo "<input name=\"mootrash\" type=\"hidden\" id=\"mootrash\" value=\"";  

          echo $row_rsh['mootras'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utibotras\" type=\"text\" id=\"utibotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['utibotras']))

          echo $row_rsh['utibotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.utibotras,document.f.utibotrash,document.f.utibtot)\">";          

   echo "<input name=\"utibotrash\" type=\"hidden\" id=\"utibotrash\" value=\"";  

          echo $row_rsh['utibotras'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"utitotras\" type=\"text\" id=\"utitotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['utitotras']))

          echo $row_rsh['utitotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.utitotras,document.f.utitotrash,document.f.utittot)\">";          

   echo "<input name=\"utitotrash\" type=\"hidden\" id=\"utitotrash\" value=\"";  

          echo $row_rsh['utitotras'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucibotras\" type=\"text\" id=\"ucibotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['ucibotras']))

          echo $row_rsh['ucibotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.ucibotras,document.f.ucibotrash,document.f.ucibtot)\">";          

   echo "<input name=\"ucibotrash\" type=\"hidden\" id=\"ucibotrash\" value=\"";  

          echo $row_rsh['ucibotras'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ucitotras\" type=\"text\" id=\"ucitotras\" readonly=\"true\" value=\"";  

      if(!empty($row_rsh['ucitotras']))

          echo $row_rsh['ucitotras'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.ucitotras,document.f.ucitotrash,document.f.ucittot)\">";          

   echo "<input name=\"ucitotrash\" type=\"hidden\" id=\"ucitotrash\" value=\"";  

          echo $row_rsh['ucitotras'];

   echo "\" >";   

print <<<EOQ

        </font></div></td>

  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td colspan="2"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 

      Hospitalizaciones</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"pbtot\" type=\"text\" id=\"pbtot\" value=\"";  

      if(!empty($row_rsh['pbtot']))

          echo $row_rsh['pbtot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\"";       

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#0000CC"> 

EOQ;

   echo "<input name=\"potot\" type=\"text\" id=\"potot\" value=\"";  

      if(!empty($row_rsh['potot']))

          echo $row_rsh['potot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\"";       

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hbtot\" type=\"text\" id=\"hbtot\" value=\"";  

      if(!empty($row_rsh['hbtot']))

          echo $row_rsh['hbtot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\"";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"hotot\" type=\"text\" id=\"hotot\" value=\"";  

      if(!empty($row_rsh['hotot']))

          echo $row_rsh['hotot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\"";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mbtot\" type=\"text\" id=\"mbtot\" value=\"";  

      if(!empty($row_rsh['mbtot']))

          echo $row_rsh['mbtot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\"";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"motot\" type=\"text\" id=\"motot\" value=\"";  

      if(!empty($row_rsh['motot']))

          echo $row_rsh['motot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\"";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"utibtot\" type=\"text\" id=\"utibtot\" value=\"";  

      if(!empty($row_rsh['utibtot']))

          echo $row_rsh['utibtot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"utittot\" type=\"text\" id=\"utittot\" value=\"";  

      if(!empty($row_rsh['utittot']))

          echo $row_rsh['utittot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"ucibtot\" type=\"text\" id=\"ucibtot\" value=\"";  

      if(!empty($row_rsh['ucibtot']))

          echo $row_rsh['ucibtot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

   echo "<input name=\"ucittot\" type=\"text\" id=\"ucittot\" value=\"";  

      if(!empty($row_rsh['ucittot']))

          echo $row_rsh['ucittot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></div></td>



  </tr>

</table>

EOQ;



}// fin hospitaliza

// Egresos de los hospitales urbanos

function egresos(){

  global $e,$f;

  if(isset($_GET['id'])&&isset($e)&&isset($f)){

   $query_rse="select *,

               presp + potra as ptot  ,

               hresp + hotra as htot  ,

               mresp + motra as mtot

               from egresos

               where id_estab=".$e." and fecha='".$f."'";

       $rse = safe_query($query_rse);

       $row_rse = mysql_fetch_assoc($rse);

       $totalRows_rse = mysql_num_rows($rse);

     }

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

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.presp,document.f.presph,document.f.ptot)\" >";

 

   echo "<input name=\"presph\" type=\"hidden\" id=\"presph\" value=\""; 

         if(!empty($row_rse['presp']))

          echo $row_rse['presp'];

         else

           echo 0;

   echo "\" >";

    

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hresp\" type=\"text\" id=\"hresp\" value=\"";  

      if(!empty($row_rse['hresp']))

          echo $row_rse['hresp'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.hresp,document.f.hresph,document.f.htot)\" >";

 

    echo "<input name=\"hresph\" type=\"hidden\" id=\"hresph\" value=\""; 

     if(!empty( $row_rse['hresp']))

          echo $row_rse['hresp'];

     else 

          echo 0;

   echo "\" >";

    

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mresp\" type=\"text\" id=\"mresp\" value=\"";  

      if(!empty($row_rse['mresp']))

          echo $row_rse['mresp'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.mresp,document.f.mresph,document.f.mtot)\" >"; 

   echo "<input name=\"mresph\" type=\"hidden\" id=\"mresph\" value=\""; 

       if(!empty( $row_rse['mresp']))

          echo $row_rse['mresp'];

          else

          echo 0;

   echo "\" >";

    

print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Por 

      otras Patologias</font></strong></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"potra\" type=\"text\" id=\"potra\" value=\"";  

      if(!empty($row_rse['potra']))

          echo $row_rse['potra'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.potra,document.f.potrah,document.f.ptot)\" >";  

   echo "<input name=\"potrah\" type=\"hidden\" id=\"potrah\" value=\""; 

      if(!empty( $row_rse['potra']))

          echo $row_rse['potra'];

      else

          echo 0;

   echo "\" >";

    

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"hotra\" type=\"text\" id=\"hotra\" value=\"";  

      if(!empty($row_rse['hotra']))

          echo $row_rse['hotra'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.hotra,document.f.hotrah,document.f.htot)\" >";

   echo "<input name=\"hotrah\" type=\"hidden\" id=\"hotrah\" value=\"";  

      if(!empty($row_rse['hotra']))

          echo $row_rse['hotra'];

          else

          echo 0;

   echo "\" >";

      

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"motra\" type=\"text\" id=\"motra\" value=\"";  

      if(!empty($row_rse['motra']))

          echo $row_rse['motra'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" "

   ."onBlur=\"return calculod(document.f.motra,document.f.motrah,document.f.mtot)\" >";

   echo "<input name=\"motrah\" type=\"hidden\" id=\"motrah\" value=\"";  

         if (!empty($row_rse['motra']))

             echo $row_rse['motra'];

         else

             echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 

      Egresos</font></strong></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"ptot\" type=\"text\" id=\"ptot\" value=\"";  

      if(!empty($row_rse['ptot']))

          echo $row_rse['ptot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"htot\" type=\"text\" id=\"htot\" value=\"";  

      if(!empty($row_rse['htot']))

          echo $row_rse['htot'];

         else

             echo 0;

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

   echo "<input name=\"mtot\" type=\"text\" id=\"mtot\" value=\"";  

      if(!empty($row_rse['mtot']))

          echo $row_rse['mtot'];

   echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";       

print <<<EOQ

        </font></strong></div></td>

  </tr>

</table>



EOQ;

}

// Derivaciones de los SAPU

function derivaciones(){

global $e,$f;

if(isset($e)&&isset($f)){

$query_rsd = "SELECT *, 

               cbnino + hbnino as totbn, 

               cbadul + hbadul as totba,

               cnnino + hnnino as totnn, 

               cnadul + hnadul as totna 

              FROM derivaciones where id_estab=".$e." and fecha='".$f."'";

$rsd = safe_query($query_rsd);

$row_rsd = mysql_fetch_assoc($rsd);

$totalRows_rsd = mysql_num_rows($rsd);

}

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

  <tr bgcolor="#DDDDDD"> 

    <td><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"totbn\" type=\"text\" id=\"totbn\" value=\"";

     if(!empty($row_rsd['totbn']))

        echo $row_rsd['totbn']; 

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"totba\" type=\"text\" id=\"totba\" value=\"";

     if(!empty($row_rsd['totba']))

        echo $row_rsd['totba']; 

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"totnn\" type=\"text\" id=\"totnn\" value=\"";

     if(!empty($row_rsd['totnn']))

        echo $row_rsd['totnn']; 

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"totna\" type=\"text\" id=\"totna\" value=\"";

     if(!empty($row_rsd['totna']))

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

     if(!empty($row_rsd['cbnino']))

        echo $row_rsd['cbnino']; 

         else

             echo 0;

    echo "\" size=\"4\" maxlength=\"4\"" 

    ."onBlur=\"return calculod(document.f.cbnino,document.f.cbninoh,document.f.totbn)\" >";



   echo "<input name=\"cbninoh\" type=\"hidden\" id=\"cbninoh\" value=\"";

         if (!empty( $row_rsd['cbnino'] ) )

          echo $row_rsd['cbnino'];

         else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"cbadul\" type=\"text\" id=\"cbadul\" value=\"";

     if(!empty($row_rsd['cbadul']))

        echo $row_rsd['cbadul']; 

         else

             echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

    ."onBlur=\"return calculod(document.f.cbadul,document.f.cbadulh,document.f.totba)\" >";



   echo "<input name=\"cbadulh\" type=\"hidden\" id=\"cbadulh\" value=\"";  

        if(isset($row_rsd['cbadul']))

          echo $row_rsd['cbadul'];

        else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"cnnino\" type=\"text\" id=\"cnnino\" value=\"";

     if(!empty($row_rsd['cnnino']))

        echo $row_rsd['cnnino']; 

         else

             echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

    ."onBlur=\"return calculod(document.f.cnnino,document.f.cnninoh,document.f.totnn)\" >";



   echo "<input name=\"cnninoh\" type=\"hidden\" id=\"cnninoh\" value=\""; 

        if (isset($row_rsd['cnnino']))

          echo $row_rsd['cnnino'];

        else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

    echo "<input name=\"cnadul\" type=\"text\" id=\"cnadul\" value=\"";

     if(!empty($row_rsd['cnadul']))

        echo $row_rsd['cnadul']; 

    echo "\" size=\"4\" maxlength=\"4\""

    ."onBlur=\"return calculod(document.f.cnadul,document.f.cnadulh,document.f.totna)\" >";



   echo "<input name=\"cnadulh\" type=\"hidden\" id=\"cnadulh\" value=\""; 

       if (isset( $row_rsd['cnadul']))

          echo $row_rsd['cnadul'];

       else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr> 

    <td><div align="center"><strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">Hospital</font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"hbnino\" type=\"text\" id=\"hbnino\" value=\"";

     if(!empty($row_rsd['hbnino']))

        echo $row_rsd['hbnino']; 

    echo "\" size=\"4\" maxlength=\"4\" "

    ."onBlur=\"return calculod(document.f.hbnino,document.f.hbninoh,document.f.totbn)\" >";



   echo "<input name=\"hbninoh\" type=\"hidden\" id=\"hbninoh\" value=\""; 

       if (isset( $row_rsd['hbnino']))

          echo $row_rsd['hbnino'];

       else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"hbadul\" type=\"text\" id=\"hbadul\" value=\"";

     if(!empty($row_rsd['hbadul']))

        echo $row_rsd['hbadul']; 

    echo "\" size=\"4\" maxlength=\"4\" "

    ."onBlur=\"return calculod(document.f.hbadul,document.f.hbadulh,document.f.totba)\" >";



   echo "<input name=\"hbadulh\" type=\"hidden\" id=\"hbadulh\" value=\""; 

       if (isset( $row_rsd['hbadul']))

          echo $row_rsd['hbadul'];

       else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

    echo "<input name=\"hnnino\" type=\"text\" id=\"hnnino\" value=\"";

     if(!empty($row_rsd['hnnino']))

        echo $row_rsd['hnnino']; 

    echo "\" size=\"4\" maxlength=\"4\" "

    ."onBlur=\"return calculod(document.f.hnnino,document.f.hnninoh,document.f.totnn)\" >";



   echo "<input name=\"hnninoh\" type=\"hidden\" id=\"hnninoh\" value=\"";

         if (isset( $row_rsd['hnnino']) )

          echo $row_rsd['hnnino'];

         else 

           echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

    echo "<input name=\"hnadul\" type=\"text\" id=\"hnadul\" value=\"";

     if(!empty($row_rsd['hnadul']))

        echo $row_rsd['hnadul']; 

         else

             echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

    ."onBlur=\"return calculod(document.f.hnadul,document.f.hnadulh,document.f.totna)\" >";



   echo "<input name=\"hnadulh\" type=\"hidden\" id=\"hnadulh\" value=\""; 

     if( isset( $row_rsd['hnadul']))

          echo $row_rsd['hnadul'];

     else

          echo 0;

   echo "\" >";



print <<<EOQ

        </font></strong></div></td>

  </tr>

</table>

EOQ;

}

// Ingresa datos de fallecidos en hospitales

function fallecidoh(){

global $e,$f;

if(isset($e)&&isset($f)){

$query_rsfh = "SELECT * FROM fallecidoh where id_estab=".$e." and fecha='".$f."'";

$rsfh = safe_query($query_rsfh);

$row_rsfh = mysql_fetch_assoc($rsfh);

$totalRows_rsfh = mysql_num_rows($rsfh);

}

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
    <td> <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>0-14 a�nnos</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>15 - 64 annos</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>65 - 74 a�nnos</strong></font></div></td>
    <td>
      <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
      <strong>75 y mas</strong></font></div></td>
  </tr>

  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Al Ingreso Urg. x otras causas</strong></font></div></td>
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
    <strong>Al Ingreso Urg. x IRA</strong></font></div></td>
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
    <strong>En el Serv.Urg.x otras causas</strong></font></div></td>
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
EOQ;

if(strcmp($_SESSION['tipo'],'sapu')==0){

print <<<EOQ

  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>&nbsp;</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh0a14\" type=\"hidden\" id=\"falle0ha14\" value=\"0\" >";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh15a64\" type=\"hidden\" id=\"falleh15a64\" value=\"0\" >";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh65a74\" type=\"hidden\" id=\"falleh65a74\" value=\"0\" >";
print <<<EOQ
        </strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh75ym\" type=\"hidden\" id=\"falleh75ym\" value=\"0\" >";
print <<<EOQ
        </strong></font></div></td>
  </tr>

EOQ;

}

else {

print <<<EOQ

  <tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>Hospitalizados x otras causas</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh0a14\" type=\"text\" id=\"falle0ha14\" value=\"";
     if(!empty($row_rsfh['falleh0a14']))
        echo $row_rsfh['falleh0a14']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" >";
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
    <strong>Hospitalizados x IRA</strong></font></div></td>
    <td>
      <div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
EOQ;
    echo "<input name=\"falleh0a14ira\" type=\"text\" id=\"falle0ha14ira\" value=\"";
     if(!empty($row_rsfh['falleh0a14ira']))
        echo $row_rsfh['falleh0a14ira']; 
     else
        echo 0;
    echo "\" size=\"4\" maxlength=\"4\" >";
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

EOQ;

} // fin de sapu
print <<<EOQ
<tr> 
    <td>
    <div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">
    <strong>IFI</strong></font></div></td>
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
EOQ;
print <<<EOQ

</table>

EOQ;

}

// Ingresa datos de consultas no ira

function aturgo(){
global $e,$f;
if(isset($e)&&isset($f)){
$query_rsfh = "SELECT * 
, infarto_m1 + vascular_m1 + hipertensiva_m1 + arritmia_m1 + otrascirc_m1 as circ_m1
, infarto_1a4 + vascular_1a4 + hipertensiva_1a4 + arritmia_1a4 + otrascirc_1a4 as circ_1a4
, infarto_5a14 + vascular_5a14 + hipertensiva_5a14 + arritmia_5a14 + otrascirc_5a14 as circ_5a14
, infarto_15a64 + vascular_15a64 + hipertensiva_15a64 + arritmia_15a64 + otrascirc_15a64 as circ_15a64
, infarto_65ym + vascular_65ym + hipertensiva_65ym + arritmia_65ym + otrascirc_65ym as circ_65ym
, infarto_m1 + vascular_m1 + hipertensiva_m1 + arritmia_m1 + otrascirc_m1 +
 infarto_1a4 + vascular_1a4 + hipertensiva_1a4 + arritmia_1a4 + otrascirc_1a4 +
infarto_5a14 + vascular_5a14 + hipertensiva_5a14 + arritmia_5a14 + otrascirc_5a14 +
 infarto_15a64 + vascular_15a64 + hipertensiva_15a64 + arritmia_15a64 + otrascirc_15a64 +
 infarto_65ym + vascular_65ym + hipertensiva_65ym + arritmia_65ym + otrascirc_65ym as totcirc
 , transito_m1 + otrasext_m1 as trauma_m1
  , transito_1a4 + otrasext_1a4 as trauma_1a4
   , transito_5a14 + otrasext_5a14 as trauma_5a14
    , transito_15a64 + otrasext_15a64 as trauma_15a64
	 , transito_65ym + otrasext_65ym as trauma_65ym
 , transito_m1 + otrasext_m1 +
  transito_1a4 + otrasext_1a4 +
  transito_5a14 + otrasext_5a14 +
  transito_15a64 + otrasext_15a64 +
  transito_65ym + otrasext_65ym as tottrauma
  , infarto_m1+infarto_1a4+infarto_5a14+infarto_15a64+infarto_65ym as totinfarto
, vascular_m1+vascular_1a4+vascular_5a14+vascular_15a64+vascular_65ym as totvascular
, hipertensiva_m1+hipertensiva_1a4+hipertensiva_5a14+hipertensiva_15a64+hipertensiva_65ym as tothipertensiva
, arritmia_m1+arritmia_1a4+arritmia_5a14+arritmia_15a64+arritmia_65ym as totarritmia
, otrascirc_m1+otrascirc_1a4+otrascirc_5a14+otrascirc_15a64+otrascirc_65ym as tototrascirc
, transito_m1+transito_1a4+transito_5a14+transito_15a64+transito_65ym as tottransito
, otrasext_m1+otrasext_1a4+otrasext_5a14+otrasext_15a64+otrasext_65ym as tototrasext
, demas_m1+demas_1a4+demas_5a14+demas_15a64+demas_65ym as totdemas
FROM aturgo where id_estab=".$e." and fecha='".$f."'";
$rsfh = safe_query($query_rsfh);
$row_rsfh = mysql_fetch_assoc($rsfh);
$totalRows_rsfh = mysql_num_rows($rsfh);
}

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

      <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>TOTAL CAUSAS CIRCULATORIAS</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"totcirc\" type=\"text\" id=\"totcirc\" value=\"";

	 if(!empty($row_rsfh['totcirc']))

        echo $row_rsfh['totcirc']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"circ_m1\" type=\"text\" id=\"circ_m1\" value=\"";

     if(!empty($row_rsfh['circ_m1']))

        echo $row_rsfh['circ_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"circ_1a4\" type=\"text\" id=\circ_1a4\" value=\"";

     if(!empty($row_rsfh['circ_1a4']))

        echo $row_rsfh['circ_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"circ_5a14\" type=\"text\" id=\"circ_5a14\" value=\"";

     if(!empty($row_rsfh['circ_5a14']))

        echo $row_rsfh['circ_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"circ_15a64\" type=\"text\" id=\"circ_15a64\" value=\"";

     if(!empty($row_rsfh['circ_15a64']))

        echo $row_rsfh['circ_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"circ_65ym\" type=\"text\" id=\"circ_65ym\" value=\"";

     if(!empty($row_rsfh['circ_65ym']))

        echo $row_rsfh['circ_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

  </tr> 

  <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Infarto agudo miocardio</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"totinfarto\" type=\"text\" id=\"totinfarto\" value=\"";

	 if(!empty($row_rsfh['totinfarto']))

        echo $row_rsfh['totinfarto']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

	

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"infarto_m1\" type=\"text\" id=\"infarto_m1\" value=\"";

     if(!empty($row_rsfh['infarto_m1']))

        echo $row_rsfh['infarto_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

	."onBlur=\"return calculoh(document.f.infarto_m1,document.f.infarto_m1h,document.f.totinfarto,document.f.circ_m1,document.f.totcirc)\" >";

   echo "<input name=\"infarto_m1h\" type=\"hidden\" id=\"infarto_m1h\" value=\""; 

     if( isset( $row_rsfh['infarto_m1']))

          echo $row_rsfh['infarto_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"infarto_1a4\" type=\"text\" id=\"infarto_1a4\" value=\"";

     if(!empty($row_rsfh['infarto_1a4']))

        echo $row_rsfh['infarto_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.infarto_1a4,document.f.infarto_1a4h,document.f.totinfarto,document.f.circ_1a4,document.f.totcirc)\" >";

   echo "<input name=\"infarto_1a4h\" type=\"hidden\" id=\"infarto_1a4h\" value=\""; 

     if( isset( $row_rsfh['infarto_1a4']))

          echo $row_rsfh['infarto_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"infarto_5a14\" type=\"text\" id=\"infarto_5a14\" value=\"";

     if(!empty($row_rsfh['infarto_5a14']))

        echo $row_rsfh['infarto_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.infarto_5a14,document.f.infarto_5a14h,document.f.totinfarto,document.f.circ_5a14,document.f.totcirc)\" >";

   echo "<input name=\"infarto_5a14h\" type=\"hidden\" id=\"infarto_5a14h\" value=\""; 

     if( isset( $row_rsfh['infarto_5a14']))

          echo $row_rsfh['infarto_5a14'];

     else

          echo 0;

   echo "\" >";	

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"infarto_15a64\" type=\"text\" id=\"infarto_15a64\" value=\"";

     if(!empty($row_rsfh['infarto_15a64']))

        echo $row_rsfh['infarto_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.infarto_15a64,document.f.infarto_15a64h,document.f.totinfarto,document.f.circ_15a64,document.f.totcirc)\" >";

   echo "<input name=\"infarto_15a64h\" type=\"hidden\" id=\"infarto_15a64h\" value=\""; 

     if( isset( $row_rsfh['infarto_15a64']))

          echo $row_rsfh['infarto_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"infarto_65ym\" type=\"text\" id=\"infarto_65ym\" value=\"";

     if(!empty($row_rsfh['infarto_65ym']))

        echo $row_rsfh['infarto_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

	."onBlur=\"return calculoh(document.f.infarto_65ym,document.f.infarto_65ymh,document.f.totinfarto,document.f.circ_65ym,document.f.totcirc)\" >";

   echo "<input name=\"infarto_65ymh\" type=\"hidden\" id=\"infarto_65ymh\" value=\""; 

     if( isset( $row_rsfh['infarto_65ym']))

          echo $row_rsfh['infarto_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>

 <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Accidente Vascular Encefalico</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"totvascular\" type=\"text\" id=\"totvascular\" value=\"";

	  if(!empty($row_rsfh['totvascular']))

        echo $row_rsfh['totvascular']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"vascular_m1\" type=\"text\" id=\"vascular_m1\" value=\"";

     if(!empty($row_rsfh['vascular_m1']))

        echo $row_rsfh['vascular_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.vascular_m1,document.f.vascular_m1h,document.f.totvascular,document.f.circ_m1,document.f.totcirc)\" >";

   echo "<input name=\"vascular_m1h\" type=\"hidden\" id=\"vascular_m1h\" value=\""; 

     if( isset( $row_rsfh['vascular_m1']))

          echo $row_rsfh['vascular_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"vascular_1a4\" type=\"text\" id=\"vascular_1a4\" value=\"";

     if(!empty($row_rsfh['vascular_1a4']))

        echo $row_rsfh['vascular_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.vascular_1a4,document.f.vascular_1a4h,document.f.totvascular,document.f.circ_1a4,document.f.totcirc)\" >";

   echo "<input name=\"vascular_1a4h\" type=\"hidden\" id=\"vascular_1a4h\" value=\""; 

     if( isset( $row_rsfh['vascular_1a4']))

          echo $row_rsfh['vascular_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"vascular_5a14\" type=\"text\" id=\"vascular_5a14\" value=\"";

     if(!empty($row_rsfh['vascular_5a14']))

        echo $row_rsfh['vascular_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.vascular_5a14,document.f.vascular_5a14h,document.f.totvascular,document.f.circ_5a14,document.f.totcirc)\" >";

   echo "<input name=\"vascular_5a14h\" type=\"hidden\" id=\"vascular_5a14h\" value=\""; 

     if( isset( $row_rsfh['vascular_5a14']))

          echo $row_rsfh['vascular_5a14'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"vascular_15a64\" type=\"text\" id=\"vascular_15a64\" value=\"";

     if(!empty($row_rsfh['vascular_15a64']))

        echo $row_rsfh['vascular_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.vascular_15a64,document.f.vascular_15a64h,document.f.totvascular,document.f.circ_15a64,document.f.totcirc)\" >";

   echo "<input name=\"vascular_15a64h\" type=\"hidden\" id=\"vascular_15a64h\" value=\""; 

     if( isset( $row_rsfh['vascular_15a64']))

          echo $row_rsfh['vascular_15a64'];

     else

          echo 0;

   echo "\" >";	

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"vascular_65ym\" type=\"text\" id=\"vascular_65ym\" value=\"";

     if(!empty($row_rsfh['vascular_65ym']))

        echo $row_rsfh['vascular_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.vascular_65ym,document.f.vascular_65ymh,document.f.totvascular,document.f.circ_65ym,document.f.totcirc)\" >";

   echo "<input name=\"vascular_65ymh\" type=\"hidden\" id=\"vascular_65ymh\" value=\""; 

     if( isset( $row_rsfh['vascular_65ym']))

          echo $row_rsfh['vascular_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>

   <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Crisis Hipertensiva</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"tothipertensiva\" type=\"text\" id=\"tothipertensiva\" value=\"";

	  if(!empty($row_rsfh['tothipertensiva']))

        echo $row_rsfh['tothipertensiva']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"hipertensiva_m1\" type=\"text\" id=\"hipertensiva_m1\" value=\"";

     if(!empty($row_rsfh['hipertensiva_m1']))

        echo $row_rsfh['hipertensiva_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.hipertensiva_m1,document.f.hipertensiva_m1h,document.f.tothipertensiva,document.f.circ_m1,document.f.totcirc)\" >";

   echo "<input name=\"hipertensiva_m1h\" type=\"hidden\" id=\"hipertensiva_m1h\" value=\""; 

     if( isset( $row_rsfh['hipertensiva_m1']))

          echo $row_rsfh['hipertensiva_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"hipertensiva_1a4\" type=\"text\" id=\"hipertensiva_1a4\" value=\"";

     if(!empty($row_rsfh['hipertensiva_1a4']))

        echo $row_rsfh['hipertensiva_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\""

."onBlur=\"return calculoh(document.f.hipertensiva_1a4,document.f.hipertensiva_1a4h,document.f.tothipertensiva,document.f.circ_1a4,document.f.totcirc)\" >";

   echo "<input name=\"hipertensiva_1a4h\" type=\"hidden\" id=\"hipertensiva_1a4h\" value=\""; 

     if( isset( $row_rsfh['hipertensiva_1a4']))

          echo $row_rsfh['hipertensiva_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"hipertensiva_5a14\" type=\"text\" id=\"hipertensiva_5a14\" value=\"";

     if(!empty($row_rsfh['hipertensiva_5a14']))

        echo $row_rsfh['hipertensiva_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.hipertensiva_5a14,document.f.hipertensiva_5a14h,document.f.tothipertensiva,document.f.circ_5a14,document.f.totcirc)\" >";

   echo "<input name=\"hipertensiva_5a14h\" type=\"hidden\" id=\"hipertensiva_5a14h\" value=\""; 

     if( isset( $row_rsfh['hipertensiva_5a14']))

          echo $row_rsfh['hipertensiva_5a14'];

     else

          echo 0;

   echo "\" >";	

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"hipertensiva_15a64\" type=\"text\" id=\"hipertensiva_15a64\" value=\"";

     if(!empty($row_rsfh['hipertensiva_15a64']))

        echo $row_rsfh['hipertensiva_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.hipertensiva_15a64,document.f.hipertensiva_15a64h,document.f.tothipertensiva,document.f.circ_15a64,document.f.totcirc)\" >";

   echo "<input name=\"hipertensiva_15a64h\" type=\"hidden\" id=\"hipertensiva_15a64h\" value=\""; 

     if( isset( $row_rsfh['hipertensiva_15a64']))

          echo $row_rsfh['hipertensiva_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"hipertensiva_65ym\" type=\"text\" id=\"hipertensiva_65ym\" value=\"";

     if(!empty($row_rsfh['hipertensiva_65ym']))

        echo $row_rsfh['hipertensiva_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" " 

."onBlur=\"return calculoh(document.f.hipertensiva_65ym,document.f.hipertensiva_65ymh,document.f.tothipertensiva,document.f.circ_65ym,document.f.totcirc)\" >";

   echo "<input name=\"hipertensiva_65ymh\" type=\"hidden\" id=\"hipertensiva_65ymh\" value=\""; 

     if( isset( $row_rsfh['hipertensiva_65ym']))

          echo $row_rsfh['hipertensiva_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>

  <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Arritmia Severa</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"totarritmia\" type=\"text\" id=\"totarritmia\" value=\"";

	  if(!empty($row_rsfh['totarritmia']))

        echo $row_rsfh['totarritmia']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"arritmia_m1\" type=\"text\" id=\"arritmia_m1\" value=\"";

     if(!empty($row_rsfh['arritmia_m1']))

        echo $row_rsfh['arritmia_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.arritmia_m1,document.f.arritmia_m1h,document.f.totarritmia,document.f.circ_m1,document.f.totcirc)\" >";

   echo "<input name=\"arritmia_m1h\" type=\"hidden\" id=\"arritmia_m1h\" value=\""; 

     if( isset( $row_rsfh['arritmia_m1']))

          echo $row_rsfh['arritmia_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"arritmia_1a4\" type=\"text\" id=\"arritmia_1a4\" value=\"";

     if(!empty($row_rsfh['arritmia_1a4']))

        echo $row_rsfh['arritmia_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.arritmia_1a4,document.f.arritmia_1a4h,document.f.totarritmia,document.f.circ_1a4,document.f.totcirc)\" >";

   echo "<input name=\"arritmia_1a4h\" type=\"hidden\" id=\"arritmia_1a4h\" value=\""; 

     if( isset( $row_rsfh['arritmia_1a4']))

          echo $row_rsfh['arritmia_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"arritmia_5a14\" type=\"text\" id=\"arritmia_5a14\" value=\"";

     if(!empty($row_rsfh['arritmia_5a14']))

        echo $row_rsfh['arritmia_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.arritmia_5a14,document.f.arritmia_5a14h,document.f.totarritmia,document.f.circ_5a14,document.f.totcirc)\" >";

   echo "<input name=\"arritmia_5a14h\" type=\"hidden\" id=\"arritmia_5a14h\" value=\""; 

     if( isset( $row_rsfh['arritmia_5a14']))

          echo $row_rsfh['arritmia_5a14'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"arritmia_15a64\" type=\"text\" id=\"arritmia_15a64\" value=\"";

     if(!empty($row_rsfh['arritmia_15a64']))

        echo $row_rsfh['arritmia_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.arritmia_15a64,document.f.arritmia_15a64h,document.f.totarritmia,document.f.circ_15a64,document.f.totcirc)\" >";

   echo "<input name=\"arritmia_15a64h\" type=\"hidden\" id=\"arritmia_15a64h\" value=\""; 

     if( isset( $row_rsfh['arritmia_15a64']))

          echo $row_rsfh['arritmia_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"arritmia_65ym\" type=\"text\" id=\"arritmia_65ym\" value=\"";

     if(!empty($row_rsfh['arritmia_65ym']))

        echo $row_rsfh['arritmia_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.arritmia_65ym,document.f.arritmia_65ymh,document.f.totarritmia,document.f.circ_65ym,document.f.totcirc)\" >";

   echo "<input name=\"arritmia_65ymh\" type=\"hidden\" id=\"arritmia_65ymh\" value=\""; 

     if( isset( $row_rsfh['arritmia_65ym']))

          echo $row_rsfh['arritmia_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>

   <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Otras causas circulatorias</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"tototrascirc\" type=\"text\" id=\"tototrascirc\" value=\"";

	  if(!empty($row_rsfh['tototrascirc']))

        echo $row_rsfh['tototrascirc']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrascirc_m1\" type=\"text\" id=\"otrascirc_m1\" value=\"";

     if(!empty($row_rsfh['otrascirc_m1']))

        echo $row_rsfh['otrascirc_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrascirc_m1,document.f.otrascirc_m1h,document.f.tototrascirc,document.f.circ_m1,document.f.totcirc)\" >";

   echo "<input name=\"otrascirc_m1h\" type=\"hidden\" id=\"otrascirc_m1h\" value=\""; 

     if( isset( $row_rsfh['otrascirc_m1']))

          echo $row_rsfh['otrascirc_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrascirc_1a4\" type=\"text\" id=\"otrascirc_1a4\" value=\"";

     if(!empty($row_rsfh['otrascirc_1a4']))

        echo $row_rsfh['otrascirc_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrascirc_1a4,document.f.otrascirc_1a4h,document.f.tototrascirc,document.f.circ_1a4,document.f.totcirc)\" >";

   echo "<input name=\"otrascirc_1a4h\" type=\"hidden\" id=\"otrascirc_1a4h\" value=\""; 

     if( isset( $row_rsfh['otrascirc_1a4']))

          echo $row_rsfh['otrascirc_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrascirc_5a14\" type=\"text\" id=\"otrascirc_5a14\" value=\"";

     if(!empty($row_rsfh['otrascirc_5a14']))

        echo $row_rsfh['otrascirc_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrascirc_5a14,document.f.otrascirc_5a14h,document.f.tototrascirc,document.f.circ_5a14,document.f.totcirc)\" >";

   echo "<input name=\"otrascirc_5a14h\" type=\"hidden\" id=\"otrascirc_5a14h\" value=\""; 

     if( isset( $row_rsfh['otrascirc_5a14']))

          echo $row_rsfh['otrascirc_5a14'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrascirc_15a64\" type=\"text\" id=\"otrascirc_15a64\" value=\"";

     if(!empty($row_rsfh['otrascirc_15a64']))

        echo $row_rsfh['otrascirc_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrascirc_15a64,document.f.otrascirc_15a64h,document.f.tototrascirc,document.f.circ_15a64,document.f.totcirc)\" >";

   echo "<input name=\"otrascirc_15a64h\" type=\"hidden\" id=\"otrascirc_15a64h\" value=\""; 

     if( isset( $row_rsfh['otrascirc_15a64']))

          echo $row_rsfh['otrascirc_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrascirc_65ym\" type=\"text\" id=\"otrascirc_65ym\" value=\"";

     if(!empty($row_rsfh['otrascirc_65ym']))

        echo $row_rsfh['otrascirc_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrascirc_65ym,document.f.otrascirc_65ymh,document.f.tototrascirc,document.f.circ_65ym,document.f.totcirc)\" >";

   echo "<input name=\"otrascirc_65ymh\" type=\"hidden\" id=\"otrascirc_65ymh\" value=\""; 

     if( isset( $row_rsfh['otrascirc_65ym']))

          echo $row_rsfh['otrascirc_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>

      <tr> 

<td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

<strong>TOTAL TRAUMATISMOS Y ENVENENAMIENTOS</strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"tottrauma\" type=\"text\" id=\"tottrauma\" value=\"";

	  if(!empty($row_rsfh['tottrauma']))

        echo $row_rsfh['tottrauma']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"trauma_m1\" type=\"text\" id=\"trauma_m1\" value=\"";

     if(!empty($row_rsfh['trauma_m1']))

        echo $row_rsfh['trauma_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"trauma_1a4\" type=\"text\" id=\"trauma_1a4\" value=\"";

     if(!empty($row_rsfh['trauma_1a4']))

        echo $row_rsfh['trauma_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"trauma_5a14\" type=\"text\" id=\"trauma_5a14\" value=\"";

     if(!empty($row_rsfh['trauma_5a14']))

        echo $row_rsfh['trauma_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"trauma_15a64\" type=\"text\" id=\"trauma_15a64\" value=\"";

     if(!empty($row_rsfh['trauma_15a64']))

        echo $row_rsfh['trauma_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"trauma_65ym\" type=\"text\" id=\"trauma_65ym\" value=\"";

     if(!empty($row_rsfh['trauma_65ym']))

        echo $row_rsfh['trauma_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr> 

      <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Accidentes del transito</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"tottransito\" type=\"text\" id=\"tottransito\" value=\"";

	 if(!empty($row_rsfh['tottransito']))

        echo $row_rsfh['tottransito']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"transito_m1\" type=\"text\" id=\"transito_m1\" value=\"";

     if(!empty($row_rsfh['transito_m1']))

        echo $row_rsfh['transito_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.transito_m1,document.f.transito_m1h,document.f.tottransito,document.f.trauma_m1,document.f.tottrauma)\" >";

   echo "<input name=\"transito_m1h\" type=\"hidden\" id=\"transito_m1h\" value=\""; 

     if( isset( $row_rsfh['transito_m1']))

          echo $row_rsfh['transito_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"transito_1a4\" type=\"text\" id=\"transito_1a4\" value=\"";

     if(!empty($row_rsfh['transito_1a4']))

        echo $row_rsfh['transito_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.transito_1a4,document.f.transito_1a4h,document.f.tottransito,document.f.trauma_1a4,document.f.tottrauma)\" >";

   echo "<input name=\"transito_1a4h\" type=\"hidden\" id=\"transito_1a4h\" value=\""; 

     if( isset( $row_rsfh['transito_1a4']))

          echo $row_rsfh['transito_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"transito_5a14\" type=\"text\" id=\"transito_5a14\" value=\"";

     if(!empty($row_rsfh['transito_5a14']))

        echo $row_rsfh['transito_5a14']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.transito_5a14,document.f.transito_5a14h,document.f.tottransito,document.f.trauma_5a14,document.f.tottrauma)\" >";

   echo "<input name=\"transito_5a14h\" type=\"hidden\" id=\"transito_5a14h\" value=\""; 

     if( isset( $row_rsfh['transito_5a14']))

          echo $row_rsfh['transito_5a14'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"transito_15a64\" type=\"text\" id=\"transito_15a64\" value=\"";

     if(!empty($row_rsfh['transito_15a64']))

        echo $row_rsfh['transito_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.transito_15a64,document.f.transito_15a64h,document.f.tottransito,document.f.trauma_15a64,document.f.tottrauma)\" >";

   echo "<input name=\"transito_15a64h\" type=\"hidden\" id=\"transito_15a64h\" value=\""; 

     if( isset( $row_rsfh['transito_15a64']))

          echo $row_rsfh['transito_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"transito_65ym\" type=\"text\" id=\"transito_65ym\" value=\"";

     if(!empty($row_rsfh['transito_65ym']))

        echo $row_rsfh['transito_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.transito_65ym,document.f.transito_65ymh,document.f.tottransito,document.f.trauma_65ym,document.f.tottrauma)\" >";

   echo "<input name=\"transito_65ymh\" type=\"hidden\" id=\"transito_65ymh\" value=\""; 

     if( isset( $row_rsfh['transito_65ym']))

          echo $row_rsfh['transito_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr> 

    <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Otras causas externas</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"tototrasext\" type=\"text\" id=\"tototrasext\" value=\"";

	 if(!empty($row_rsfh['tototrasext']))

        echo $row_rsfh['tototrasext']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrasext_m1\" type=\"text\" id=\"otrasext_m1\" value=\"";

     if(!empty($row_rsfh['otrasext_m1']))

        echo $row_rsfh['otrasext_m1']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrasext_m1,document.f.otrasext_m1h,document.f.tototrasext,document.f.trauma_m1,document.f.tottrauma)\" >";

   echo "<input name=\"otrasext_m1h\" type=\"hidden\" id=\"otrasext_m1h\" value=\""; 

     if( isset( $row_rsfh['otrasext_m1']))

          echo $row_rsfh['otrasext_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrasext_1a4\" type=\"text\" id=\"otrasext_1a4\" value=\"";

     if(!empty($row_rsfh['otrasext_1a4']))

        echo $row_rsfh['otrasext_1a4']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrasext_1a4,document.f.otrasext_1a4h,document.f.tototrasext,document.f.trauma_1a4,document.f.tottrauma)\" >";

   echo "<input name=\"otrasext_1a4h\" type=\"hidden\" id=\"otrasext_1a4h\" value=\""; 

     if( isset( $row_rsfh['otrasext_1a4']))

          echo $row_rsfh['otrasext_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrasext_5a14\" type=\"text\" id=\"otrasext_5a14\" value=\"";

     if(!empty($row_rsfh['otrasext_5a14']))

        echo $row_rsfh['otrasext_5a14'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrasext_5a14,document.f.otrasext_5a14h,document.f.tototrasext,document.f.trauma_5a14,document.f.tottrauma)\" >";

   echo "<input name=\"otrasext_5a14h\" type=\"hidden\" id=\"otrasext_5a14h\" value=\""; 

     if( isset( $row_rsfh['otrasext_5a14']))

          echo $row_rsfh['otrasext_5a14'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrasext_15a64\" type=\"text\" id=\"otrasext_15a64\" value=\"";

     if(!empty($row_rsfh['otrasext_15a64']))

        echo $row_rsfh['otrasext_15a64']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrasext_15a64,document.f.otrasext_15a64h,document.f.tototrasext,document.f.trauma_15a64,document.f.tottrauma)\" >";

   echo "<input name=\"otrasext_15a64h\" type=\"hidden\" id=\"otrasext_15a64h\" value=\""; 

     if( isset( $row_rsfh['otrasext_15a64']))

          echo $row_rsfh['otrasext_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"otrasext_65ym\" type=\"text\" id=\"otrasext_65ym\" value=\"";

     if(!empty($row_rsfh['otrasext_65ym']))

        echo $row_rsfh['otrasext_65ym']; 

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculoh(document.f.otrasext_65ym,document.f.otrasext_65ymh,document.f.tototrasext,document.f.trauma_65ym,document.f.tottrauma)\" >";

   echo "<input name=\"otrasext_65ymh\" type=\"hidden\" id=\"otrasext_65ymh\" value=\""; 

     if( isset( $row_rsfh['otrasext_65ym']))

          echo $row_rsfh['otrasext_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr> 

  <tr> 

    <td><div align="center"><font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>TOTAL DEMAS CAUSAS</strong></font></div></td>

	<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"totdemas\" type=\"text\" id=\"totdemas\" value=\"";

	 if(!empty($row_rsfh['totdemas']))

        echo $row_rsfh['totdemas'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" readonly=\"true\">";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"demas_m1\" type=\"text\" id=\"demas_m1\" value=\"";

     if(!empty($row_rsfh['demas_m1']))

        echo $row_rsfh['demas_m1'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculod(document.f.demas_m1,document.f.demas_m1h, document.f.totdemas);\" >";

   echo "<input name=\"demas_m1h\" type=\"hidden\" id=\"demas_m1h\" value=\"";

     if( isset( $row_rsfh['demas_m1']))

          echo $row_rsfh['demas_m1'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>

EOQ;

    echo "<input name=\"demas_1a4\" type=\"text\" id=\"demas_1a4\" value=\"";

     if(!empty($row_rsfh['demas_1a4']))

        echo $row_rsfh['demas_1a4'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculod(document.f.demas_1a4,document.f.demas_1a4h,document.f.totdemas)\" >";

   echo "<input name=\"demas_1a4h\" type=\"hidden\" id=\"demas_1a4h\" value=\"";

     if( isset( $row_rsfh['demas_1a4']))

          echo $row_rsfh['demas_1a4'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"demas_5a14\" type=\"text\" id=\"demas_5a14\" value=\"";

     if(!empty($row_rsfh['demas_5a14']))

        echo $row_rsfh['demas_5a14'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculod(document.f.demas_5a14,document.f.demas_5a14h,document.f.totdemas)\" >";

   echo "<input name=\"demas_5a14h\" type=\"hidden\" id=\"demas_5a14h\" value=\""; 

     if( isset( $row_rsfh['demas_5a14']))

          echo $row_rsfh['demas_5a14'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

    <td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"demas_15a64\" type=\"text\" id=\"demas_15a64\" value=\"";

     if(!empty($row_rsfh['demas_15a64']))

        echo $row_rsfh['demas_15a64'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculod(document.f.demas_15a64,document.f.demas_15a64h,document.f.totdemas)\" >";

   echo "<input name=\"demas_15a64h\" type=\"hidden\" id=\"demas_15a64h\" value=\""; 

     if( isset( $row_rsfh['demas_15a64']))

          echo $row_rsfh['demas_15a64'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

<td><div align="center"> <font color="#0000CC" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>

EOQ;

    echo "<input name=\"demas_65ym\" type=\"text\" id=\"demas_65ym\" value=\"";

     if(!empty($row_rsfh['demas_65ym']))

        echo $row_rsfh['demas_65ym'];

     else

        echo 0;

    echo "\" size=\"4\" maxlength=\"4\" "

."onBlur=\"return calculod(document.f.demas_65ym,document.f.demas_65ymh,document.f.totdemas)\" >";

   echo "<input name=\"demas_65ymh\" type=\"hidden\" id=\"demas_65ymh\" value=\"";

     if( isset( $row_rsfh['demas_65ym']))

          echo $row_rsfh['demas_65ym'];

     else

          echo 0;

   echo "\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr> 

print <<<EOQ

</table>

EOQ;

}

function hospitalizao(){
global $e,$f;
if(isset($e)&&isset($f)){
$query_rsfh = "SELECT * 
, circulatorias_m1 + trauma_m1 + cirurg_m1 + demas_m1  as tothospo_m1
, circulatorias_1a4 + trauma_1a4 + cirurg_1a4 + demas_1a4  as tothospo_1a4
, circulatorias_5a14 + trauma_5a14 + cirurg_5a14 + demas_5a14  as tothospo_5a14
, circulatorias_15a64 + trauma_15a64 + cirurg_15a64 + demas_15a64 as tothospo_15a64
, circulatorias_65ym + trauma_65ym + cirurg_65ym + demas_65ym as tothospo_65ym
,circulatorias_m1 + trauma_m1 + demas_m1 + cirurg_m1 +
circulatorias_1a4 + trauma_1a4 + demas_1a4 + cirurg_1a4 +
circulatorias_5a14 + trauma_5a14 + demas_5a14  + cirurg_5a14 +
circulatorias_15a64 + trauma_15a64 + demas_15a64 + cirurg_15a64 +
circulatorias_65ym + trauma_65ym + demas_65ym + cirurg_65ym as tothospo
, circulatorias_m1+circulatorias_1a4+circulatorias_5a14+circulatorias_15a64+circulatorias_65ym as totcirculatorias
, trauma_m1+trauma_1a4+trauma_5a14+trauma_15a64+trauma_65ym as tottrauma
, cirurg_m1+cirurg_1a4+cirurg_5a14+cirurg_15a64+cirurg_65ym as totcirurg
, demas_m1+demas_1a4+demas_5a14+demas_15a64+demas_65ym as totdemas
FROM hospitalizao where id_estab=".$e." and fecha='".$f."'";
$rsfh = safe_query($query_rsfh);
$row_rsfh = mysql_fetch_assoc($rsfh);
$totalRows_rsfh = mysql_num_rows($rsfh);
}
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

}

// Llamada a las funciones de la p�ina

switch($func){

   default:

     estalis();

     break;

  case "listaurg":

    listaurg();

	break;

  case "formulin":

   formulin();

   break;

  case "formulup":

   formulup();

   break;

  case "elimina":

   elimina();

   break;

  case "agrega":

   agrega();

   break;

  case "modifica":

   modifica();

   break;

  case "correo":

   correo();

   break;

}

?>

<script type="text/javascript">



function MM_openBrWindow(theURL,winName,features) { //v2.0

  window.open(theURL,winName,features);

}

function cuadraderivat(){

//alert("totaduneumo:"+document.f.totaduneumo.value+"totna:"+document.f.totna.value);

if(document.f.totinfbron.value!=document.f.totbn.value){

alert("Atenciones bronquitis infantil no coinciden con derivaciones");

return; 

}

if(document.f.totadubron.value!=document.f.totba.value){

alert("Atenciones bronquitis adulto no coinciden con derivaciones");

return; 

}

if(document.f.totinfneumo.value!=document.f.totnn.value){

alert("Atenciones neumonía infantil no coinciden con derivaciones");

return; 

}

if(document.f.totaduneumo.value!=document.f.totna.value){

alert("Atenciones neumonía adulto no coinciden con derivaciones");

return; 

}

}

function cuadra(){

/*	um65ym=parseFloat(document.f.circ_65ym.value) + parseFloat(document.f.demas_65ym.value);

	tot65ym=parseFloat(document.f.tot65ym.value);

	if(um65ym!=tot65ym){

	alert("circulatorias y demas de 65ym = "+um65ym+" no coincide con total de 65ym de urgencias medicas = " + tot65ym);

	return;

	}

	uq65ym=parseFloat(document.f.trauma_65ym.value) ;

	totsin65ym=parseFloat(document.f.totsin65ym.value);

	if(uq65ym!=totsin65ym){

	alert("traumatismos de 65ym = "+uq65ym+" no coincide con total de 65ym de urgencias quirurgicas = " + totsin65ym);

	return;

	} */

	oa65ym=parseFloat(document.f.circ_65ym.value) + parseFloat(document.f.demas_65ym.value)+ parseFloat(document.f.trauma_65ym.value);

	tot65ym=parseFloat(document.f.tot65ym.value)+parseFloat(document.f.totsin65ym.value);

	if(oa65ym!=tot65ym){

	alert("Otras atenciones de 65ym = "+oa65ym+" no coincide con total de 65ym = " + tot65ym);

	return;

	}

	

/*	um15a64=parseFloat(document.f.circ_15a64.value) + parseFloat(document.f.demas_15a64.value);

	tot15a64=parseFloat(document.f.tot15a64.value);

	if(um15a64!=tot15a64){

	alert("circulatorias y demas de 15 a 64 = "+um15a64+" no coincide con total de 15 a 64 de urgencias medicas = " + tot15a64);

	return;

	}

	uq15a64=parseFloat(document.f.trauma_15a64.value) ;

	totsin15a64=parseFloat(document.f.totsin15a64.value);

	if(uq15a64!=totsin15a64){

	alert("traumatismos de 15 a 64 = "+uq15a64+" no coincide con total de 15 a 64 de urgencias quirurgicas = " + totsin15a64);

	return;

	} */

	oa15a64=parseFloat(document.f.circ_15a64.value) + parseFloat(document.f.demas_15a64.value)+ parseFloat(document.f.trauma_15a64.value);

	tot15a64=parseFloat(document.f.tot15a64.value)+parseFloat(document.f.totsin15a64.value);

	if(oa15a64!=tot15a64){

	alert("Otras atenciones de 15a64 = "+oa15a64+" no coincide con total de 15a64 = " + tot15a64);

	return;

	}

	

/*	um5a14=parseFloat(document.f.circ_5a14.value) + parseFloat(document.f.demas_5a14.value);

	tot10a14=parseFloat(document.f.tot10a14.value);

	if(um5a14!=tot10a14){

	alert("circulatorias y demas de 5 a 14 = "+um5a14+" no coincide con total de 5 a 14 de urgencias medicas = " + tot10a14);

	return;

	}

	uq5a14=parseFloat(document.f.trauma_5a14.value) ;

	totsin10a14=parseFloat(document.f.totsin10a14.value);

	if(uq5a14!=totsin10a14){

	alert("traumatismos de 5 a 14 = "+uq5a14+" no coincide con total de 5 a 14 de urgencias quirurgicas = " + totsin10a14);

	return;

	} */

	oa5a14=parseFloat(document.f.circ_5a14.value) + parseFloat(document.f.demas_5a14.value)+ parseFloat(document.f.trauma_5a14.value);

	tot5a14=parseFloat(document.f.tot10a14.value)+parseFloat(document.f.totsin10a14.value);

	if(oa5a14!=tot5a14){

	alert("Otras atenciones de 5a14 = "+oa5a14+" no coincide con total de 5a14 = " + tot5a14);

	return;

	}

	

/*	um1a4=parseFloat(document.f.circ_1a4.value) + parseFloat(document.f.demas_1a4.value);

	tot1a9=parseFloat(document.f.tot1a9.value);

	if(um1a4!=tot1a9){

	alert("circulatorias y demas de 1 a 4 = "+um1a4+" no coincide con total de 1 a 4 de urgencias medicas = " + tot1a9);

	return;

	}

	uq1a4=parseFloat(document.f.trauma_1a4.value) ;

	totsin1a9=parseFloat(document.f.totsin1a9.value);

	if(uq1a4!=totsin1a9){

	alert("traumatismos de 1 a 4 = "+uq1a4+" no coincide con total de 1 a 4 de urgencias quirurgicas = " + totsin1a9);

	return;

	} */

	oa1a4=parseFloat(document.f.circ_1a4.value) + parseFloat(document.f.demas_1a4.value)+ parseFloat(document.f.trauma_1a4.value);

	tot1a4=parseFloat(document.f.tot1a9.value)+parseFloat(document.f.totsin1a9.value);

	if(oa1a4!=tot1a4){

	alert("Otras atenciones de 1a4 = "+oa1a4+" no coincide con total de 1a4 = " + tot1a4);

	return;

	}

	

/*	umm1=parseFloat(document.f.circ_m1.value) + parseFloat(document.f.demas_m1.value);

	totm1=parseFloat(document.f.totm1.value);

	if(umm1!=totm1){

	alert("circulatorias y demas de menos 1 año = "+umm1+" no coincide con total de menos de 1 año de urgencias medicas = " + totm1);

	return;

	}

	uqm1=parseFloat(document.f.trauma_m1.value) ;

	totsinm1=parseFloat(document.f.totsinm1.value);

	if(uqm1!=totsinm1){

	alert("traumatismos de menos de 1 año = "+uqm1+" no coincide con total de menos de 1 año de urgencias quirurgicas = " + totsinm1);

	return;

	} */

	oam1=parseFloat(document.f.circ_m1.value) + parseFloat(document.f.cirurg_m1.value)+parseFloat(document.f.demas_m1.value)+ parseFloat(document.f.trauma_m1.value);

	totm1=parseFloat(document.f.totm1.value)+parseFloat(document.f.totsinm1.value);

	if(oam1!=totm1){

	alert("Otras atenciones de menos de 1 = "+oam1+" no coincide con total de menos de 1 = " + totm1);

	return;

	}

	

	resto=parseFloat(document.f.toturg.value) + parseFloat(document.f.totsin.value);

	otro=parseFloat(document.f.totcirc.value) + parseFloat(document.f.tottrauma.value) + parseFloat(document.f.totdemas.value);

	if(resto!=otro){

	alert("Resto atenciones medicas + urgencias quirurgicas = "+resto+" no coincide con total de causas circulatorias + total traumatismos + demas causas = " + otro);

//	vale=false;

	return;

	}

	otros=parseFloat(document.f.posubtotr.value) + parseFloat(document.f.hosubtotr.value) + parseFloat(document.f.mosubtotr.value) + 

	parseFloat(document.f.utitsubtotr.value) + parseFloat(document.f.ucitsubtotr.value) ;

	if(document.f.tothospo.value != otros){

	alert("Total otras hospitalizaciones = "+document.f.tothospo.value+" no coincide con otros pediatra + otros hombres medicina + otras mujeres medicina + otras uti + otras uci = " + otros);

//	vale=false;

	return;

	}

	//if(vale)

	//document.f.submit();

}



function calculoh(elemento, elemh, ev, eh, et){

  cant=elemento.value;

  hidden=elemh.value;

  sumav=ev.value;

  sumah=eh.value;

  sumat=et.value;

  //alert("elemento:"+cant+"elemh:"+hidden+"ev:"+sumav+"eh:"+sumah+"et:"+sumat);



  if(isNaN(cant) && cant!="" ){

    alert("El valor ingresado no vale");

    return false;

  }

  if(sumav=="")sumav=0;

  if(cant=="")cant=0;

  if(hidden=="")hidden=0;

  if(sumah=="")sumah=0;

  if(sumat=="")sumat=0;

  sumav=parseFloat(sumav) + 

        parseFloat(cant) - parseFloat(hidden);

  sumah=parseFloat(sumah) + 

        parseFloat(cant) - parseFloat(hidden);

  sumat=parseFloat(sumat) + 

        parseFloat(cant) - parseFloat(hidden);		

  hidden=cant;

  elemento.value=cant;

  elemh.value=hidden;

  ev.value=sumav;

  eh.value=sumah;

  et.value=sumat;

}



function calculod(elemento, elemh, ev){

  cant=elemento.value;

  hidden=elemh.value;

  sumav=ev.value;

// alert("entra " + cant + "-" + hidden + "-" + sumav );

  if(isNaN(cant) && cant!="" ){

    alert("El valor ingresado "+cant+" no vale");

    return false;

  }

  if(sumav=="")sumav=0;

  if(cant=="")cant=0;

  if(hidden=="")hidden=0;

  sumav=parseFloat(sumav) + 

        parseFloat(cant) - parseFloat(hidden);

  hidden=cant;

  elemento.value=cant;

  elemh.value=hidden;

  ev.value=sumav;

}

function calculo(elemento,elemh,ev,eh,ee,h1,h2,h3,rg,rt){

  cant=elemento.value;

  sumav=ev.value;

  sumah=eh.value;

  sumae=ee.value;

  sumah1=h1.value;

  sumah2=h2.value;

  sumah3=h3.value;

  sumarg=rg.value;

  sumart=rt.value;



  hidden=elemh.value;

  if(isNaN(cant) && cant!="" ){

    alert("El valor ingresado no es v�ido");

    return false;

  }

  if(sumah=="")sumah=0;

  if(sumav=="")sumav=0;

  if(sumae=="")sumae=0;

  if(sumah1=="")sumah1=0;

  if(sumah2=="")sumah2=0;

  if(sumah3=="")sumah3=0;

  if(sumarg=="")sumarg=0;

  if(sumart=="")sumart=0;





  if(cant=="")cant=0;

  if(hidden=="")hidden=0;

  sumah=parseFloat(sumah) + 

   parseFloat(cant) - parseFloat(hidden);

  sumav=parseFloat(sumav) + 

   parseFloat(cant) - parseFloat(hidden);

  sumae=parseFloat(sumae) + 

   parseFloat(cant) - parseFloat(hidden);

  sumah1=parseFloat(sumah1) + 

   parseFloat(cant) - parseFloat(hidden);

  sumah2=parseFloat(sumah2) + 

   parseFloat(cant) - parseFloat(hidden);

  sumah3=parseFloat(sumah3) + 

   parseFloat(cant) - parseFloat(hidden);

  sumarg=parseFloat(sumarg) + 

   parseFloat(cant) - parseFloat(hidden);

  sumart=parseFloat(sumart) + 

   parseFloat(cant) - parseFloat(hidden);



  hidden=cant;

//  alert("entra " + cant + "-" + hidden + "-" + sumav + "-" + sumah );

  elemento.value=cant;

  elemh.value=hidden;

  ev.value=sumav;

  eh.value=sumah;

  ee.value=sumae;

  h1.value=sumah1;

  h2.value=sumah2;

  h3.value=sumah3;

  rg.value=sumarg;

  rt.value=sumart;



}

function calculo2(elemento,elemh,ev,ee,h1,h2,h3){

  cant=elemento.value;

  sumav=ev.value;

  sumae=ee.value;

  sumah1=h1.value;

  sumah2=h2.value;

  sumah3=h3.value;

  hidden=elemh.value;

  if(isNaN(cant) && cant!="" ){

    alert("El valor ingresado no es val�ido");

    return false;

  }

  if(sumav=="")sumav=0;

  if(sumae=="")sumae=0;

  if(sumah1=="")sumah1=0;

  if(sumah2=="")sumah2=0;

  if(sumah3=="")sumah3=0;



  if(cant=="")cant=0;

  if(hidden=="")hidden=0;

  sumav=parseFloat(sumav) + 

   parseFloat(cant) - parseFloat(hidden);

  sumae=parseFloat(sumae) + 

   parseFloat(cant) - parseFloat(hidden);

  sumah1=parseFloat(sumah1) + 

   parseFloat(cant) - parseFloat(hidden);

  sumah2=parseFloat(sumah2) + 

   parseFloat(cant) - parseFloat(hidden);

  sumah3=parseFloat(sumah3) + 

   parseFloat(cant) - parseFloat(hidden);



  hidden=cant;

//  alert("entra " + cant + "-" + hidden + "-" + sumav + "-" + sumah );

  elemento.value=cant;

  elemh.value=hidden;

  ev.value=sumav;

  ee.value=sumae;

  h1.value=sumah1;

  h2.value=sumah2;

  h3.value=sumah3;

}

function calculo3(elemento,elemh,ev,ee){

  cant=elemento.value;

  sumav=ev.value;

  sumae=ee.value;

  hidden=elemh.value;

  if(isNaN(cant) && cant!="" ){

    alert("El valor ingresado no es val�ido");

    return false;

  }

  if(sumav=="")sumav=0;

  if(sumae=="")sumae=0;



  if(cant=="")cant=0;

  if(hidden=="")hidden=0;

  sumav=parseFloat(sumav) + 

   parseFloat(cant) - parseFloat(hidden);

  sumae=parseFloat(sumae) + 

   parseFloat(cant) - parseFloat(hidden);

  hidden=cant;

//  alert("entra " + cant + "-" + hidden + "-" + sumav + "-" + sumah );

  elemento.value=cant;

  elemh.value=hidden;

  ev.value=sumav;

  ee.value=sumae;

}



function esfecha(elemento) {

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

	alert ("Valor debe ser una fecha v�ida");

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

