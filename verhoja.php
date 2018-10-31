<?php 

include "header.php";

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

<td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

No. Pacientes en camillas por más de 4 horas, en espera de hospitalización x causas respiratorias</font></strong>

</td><td>

EOQ;

      if(!empty($row_rsh['camillasxcr']))

          echo $row_rsh['camillasxcr'];

         else

             echo 0;

print <<<EOQ

</td><td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

No. Pacientes en camillas por más de 4 horas, en espera de hospitalización x otras causas</font></strong>

</td><td>

EOQ;

      if(!empty($row_rsh['camillasxo']))

          echo $row_rsh['camillasxo'];

         else

             echo 0;

print <<<EOQ

</td></tr></table>

<table width="600" border="0" align="center">

  <caption>

  <strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Hospitalizaciones</font></strong> 

  </caption>

  <tr> 

    <td width="96"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;

                   </font></strong></td>

    <td width="103"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

     &nbsp;</font></strong></td>

    <td colspan="2"> <div align="center"><font size="1"><strong>

    <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;os</font></strong></font></div></td>

    <td colspan="4"> <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Adultos 

        Medicina</font></strong></font></div></td>

    <td colspan="4"> <div align="center"><font size="1"><strong>

     <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">

        Unidad Pac.Criticos</font></strong></font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Grupos 

      de Edad</font></strong></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

   <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Pediatr&iacute;a</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Hombres</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Mujeres</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">U.Trat.Interm.</font></strong></font></div></td>

    <td colspan="2"><div align="center"><font size="1"><strong>

    <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">U.Cuidado Int.</font></strong></font></div></td>



  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td width="58"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>

    <td width="42"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>

    <td width="31"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>

    <td width="37"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>

    <td width="27"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>

    <td width="52"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>

    <td width="31"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>

    <td width="37"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>

    <td width="27"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">C.Resp.</font></strong></font></div></td>

    <td width="52"> 

      <div align="center"><font size="1"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Otras</font></strong></font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&lt;1 

      a&ntilde;o</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

        <strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pbm1']))

          echo $row_rsh['pbm1'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pom1']))

          echo $row_rsh['pom1'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['hbm1']))

          echo $row_rsh['hbm1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hom1']))

          echo $row_rsh['hom1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mbm1']))

          echo $row_rsh['mbm1'];

         else

             echo 0;

print <<<EOQ

    </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mom1']))

          echo $row_rsh['mom1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utibm1']))

          echo $row_rsh['utibm1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utitm1']))

          echo $row_rsh['utitm1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucibm1']))

          echo $row_rsh['ucibm1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucitm1']))

          echo $row_rsh['ucitm1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

if(strcmp( $f,'2006-03-29')>0)

	echo "1-4 a&ntilde;os:";

else

	echo  "1-9 a&ntilde;os:";

print <<<EOQ

</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pb1_9']))

          echo $row_rsh['pb1_9'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['po1_9']))

          echo $row_rsh['po1_9'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hb1_9']))

          echo $row_rsh['hb1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ho1_9']))

          echo $row_rsh['ho1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mb1_9']))

          echo $row_rsh['mb1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mo1_9']))

          echo $row_rsh['mo1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utib1_9']))

          echo $row_rsh['utib1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utit1_9']))

          echo $row_rsh['utit1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucib1_9']))

          echo $row_rsh['ucib1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucit1_9']))

          echo $row_rsh['ucit1_9'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

if(strcmp( $f,'2006-03-29')>0)

	echo "5-14 a&ntilde;os:";

else

	echo  "10-14 a&ntilde;os:";

print <<<EOQ

</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pb10_14']))

          echo $row_rsh['pb10_14'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000">

EOQ;

      if(!empty($row_rsh['po10_14']))

          echo $row_rsh['po10_14'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hb10_14']))

          echo $row_rsh['hb10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ho10_14']))

          echo $row_rsh['ho10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['mb10_14']))

          echo $row_rsh['mb10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mo10_14']))

          echo $row_rsh['mo10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utib10_14']))

          echo $row_rsh['utib10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utit10_14']))

          echo $row_rsh['utit10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucib10_14']))

          echo $row_rsh['ucib10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucit10_14']))

          echo $row_rsh['ucit10_14'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Respiratorias</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">15-64 

      a&ntilde;os</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pb15_64']))

          echo $row_rsh['pb15_64'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['po15_64']))

          echo $row_rsh['po15_64'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hb15_64']))

          echo $row_rsh['hb15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ho15_64']))

          echo $row_rsh['ho15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mb15_64']))

          echo $row_rsh['mb15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mo15_64']))

          echo $row_rsh['mo15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utib15_64']))

          echo $row_rsh['utib15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utit15_64']))

          echo $row_rsh['utit15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucib15_64']))

          echo $row_rsh['ucib15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucit15_64']))

          echo $row_rsh['ucit15_64'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">65 

      y m&aacute;s</font></strong></td>

   <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000">

EOQ;

      if(!empty($row_rsh['pb65ym']))

          echo $row_rsh['pb65ym'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000">

EOQ;

      if(!empty($row_rsh['po65ym']))

          echo $row_rsh['po65ym'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hb65ym']))

          echo $row_rsh['hb65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ho65ym']))

          echo $row_rsh['ho65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mb65ym']))

          echo $row_rsh['mb65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mo65ym']))

          echo $row_rsh['mo65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utibm1']))

          echo $row_rsh['utibm1'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utit65ym']))

          echo $row_rsh['utit65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucib65ym']))

          echo $row_rsh['ucib65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucit65ym']))

          echo $row_rsh['ucit65ym'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>



  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Subtotal</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pbsubtotr']))

          echo $row_rsh['pbsubtotr'];

         else

             echo 0;



print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['posubtotr']))

          echo $row_rsh['posubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hbsubtotr']))

          echo $row_rsh['hbsubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hosubtotr']))

          echo $row_rsh['hosubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mbsubtotr']))

          echo $row_rsh['mbsubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mosubtotr']))

          echo $row_rsh['mosubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utibsubtotr']))

          echo $row_rsh['utibsubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utitsubtotr']))

          echo $row_rsh['utitsubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucibsubtotr']))

          echo $row_rsh['ucibsubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucitsubtotr']))

          echo $row_rsh['ucitsubtotr'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Otras 

      Causas</font></strong></td>

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Subtotal</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

        <strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pbotras']))

          echo $row_rsh['pbotras'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pootras']))

          echo $row_rsh['pootras'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hbotras']))

          echo $row_rsh['hbotras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hootras']))

          echo $row_rsh['hootras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mbotras']))

          echo $row_rsh['mbotras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mootras']))

          echo $row_rsh['mootras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utibotras']))

          echo $row_rsh['utibotras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['utitotras']))

          echo $row_rsh['utitotras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucibotras']))

          echo $row_rsh['ucibotras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['ucitotras']))

          echo $row_rsh['ucitotras'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td colspan="2"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 

      Hospitalizaciones</font></strong></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['pbtot']))

          echo $row_rsh['pbtot'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000"> 

EOQ;

      if(!empty($row_rsh['potot']))

          echo $row_rsh['potot'];

         else

             echo 0;

print <<<EOQ

        </font></strong></font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['hbtot']))

          echo $row_rsh['hbtot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['hotot']))

          echo $row_rsh['hotot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rsh['mbtot']))

          echo $row_rsh['mbtot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['motot']))

          echo $row_rsh['motot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['utibtot']))

          echo $row_rsh['utibtot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['utittot']))

          echo $row_rsh['utittot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['ucibtot']))

          echo $row_rsh['ucibtot'];

         else

             echo 0;

print <<<EOQ

        </font></div></td>

    <td><div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

      if(!empty($row_rsh['ucittot']))

          echo $row_rsh['ucittot'];

         else

             echo 0;

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

  <strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Egresos </font></strong> 

  </caption>

  <tr> 

    <td width="152">&nbsp;</td>

    <td width="126"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;os</font></strong></div></td>

    <td colspan="2"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Adultos</font></strong></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Causas</font></strong></td>

    <td><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Pediatr&iacute;a</font></strong></div></td>

    <td colspan="2"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Medicina</font></strong></div></td>

  </tr>

  <tr> 

    <td>&nbsp;</td>

    <td><div align="center"></div></td>

    <td width="147"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Hombres 

        </font></strong></div></td>

    <td width="157"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Mujeres</font></strong></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Por 

      causas respiratorias</font></strong></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['presp']))

          echo $row_rse['presp'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['hresp']))

          echo $row_rse['hresp'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['mresp']))

          echo $row_rse['mresp'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Por 

      otras Patologias</font></strong></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['potra']))

          echo $row_rse['potra'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['hotra']))

          echo $row_rse['hotra'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['motra']))

          echo $row_rse['motra'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 

      Egresos</font></strong></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['ptot']))

          echo $row_rse['ptot'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['htot']))

          echo $row_rse['htot'];

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

      if(!empty($row_rse['mtot']))

          echo $row_rse['mtot'];

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

  <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Derivaciones </strong></font> 

  </caption>

  <tr> 

    <td width="112"><div align="center"></div></td>

    <td colspan="2"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Bronquitis, 

        sindrome bronquial obst.</font></strong></div></td>

    <td colspan="2"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Neumonia, 

        Bronconeumonia</font></strong></div></td>

  </tr>

  <tr> 

    <td><div align="center"></div></td>

    <td width="169">

      <div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;o</font></strong></div></td>

    <td width="46">

      <div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Adulto</font></strong></div></td>

    <td width="125"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Ni&ntilde;o 

        </font></strong></div></td>

    <td width="126"><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Adulto</font></strong></div></td>

  </tr>

  <tr bgcolor="#DDDDDD"> 

    <td><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['totbn']))

        echo $row_rsd['totbn']; 

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['totba']))

        echo $row_rsd['totba']; 

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['totnn']))

        echo $row_rsd['totnn']; 

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['totna']))

        echo $row_rsd['totna']; 

print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr> 

    <td><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

     Casa/Consultorio</font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['cbnino']))

        echo $row_rsd['cbnino']; 

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['cbadul']))

        echo $row_rsd['cbadul']; 

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['cnnino']))

        echo $row_rsd['cnnino']; 

         else

             echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

     if(!empty($row_rsd['cnadul']))

        echo $row_rsd['cnadul']; 

       else

          echo 0;

print <<<EOQ

        </font></strong></div></td>

  </tr>

  <tr> 

    <td><div align="center"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Hospital</font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['hbnino']))

        echo $row_rsd['hbnino']; 

       else

          echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['hbadul']))

        echo $row_rsd['hbadul']; 

       else

          echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

EOQ;

     if(!empty($row_rsd['hnnino']))

        echo $row_rsd['hnnino']; 

       else

          echo 0;

print <<<EOQ

        </font></strong></div></td>

    <td><div align="center"> <strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

EOQ;

     if(!empty($row_rsd['hnadul']))

        echo $row_rsd['hnadul']; 

         else

             echo 0;

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

  <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Fallecidos 

</strong></font> 

</caption>

  <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Condici&oacute;n</strong></font></div></td>

    <td> <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>0-14 años</strong></font></div></td>

    <td>

      <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

      <strong>15 - 64 años</strong></font></div></td>

    <td>

      <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

      <strong>65 - 74 años</strong></font></div></td>

    <td>

      <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

      <strong>75 y más años</strong></font></div></td>



  </tr>

  <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Al Ingreso Urg. x otras causas</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli0a14']))

        echo $row_rsfh['falli0a14']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli15a64']))

        echo $row_rsfh['falli15a64']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli65a74']))

        echo $row_rsfh['falli65a74']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli75ym']))

        echo $row_rsfh['falli75ym']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>

 <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Al Ingreso Urg. x IRA</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli0a14ira']))

        echo $row_rsfh['falli0a14ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli15a64ira']))

        echo $row_rsfh['falli15a64ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli65a74ira']))

        echo $row_rsfh['falli65a74ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falli75ymira']))

        echo $row_rsfh['falli75ymira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>
  
  <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>En el Serv.Urg.x otras causas</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle0a14']))

        echo $row_rsfh['falle0a14']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle15a64']))

        echo $row_rsfh['falle15a64']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle65a74']))

        echo $row_rsfh['falle65a74']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle75ym']))

        echo $row_rsfh['falle75ym']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>
   <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>En el Serv.Urg.x IRA</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle0a14ira']))

        echo $row_rsfh['falle0a14ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle15a64ira']))

        echo $row_rsfh['falle15a64ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle65a74ira']))

        echo $row_rsfh['falle65a74ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falle75ymira']))

        echo $row_rsfh['falle75ymira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>

EOQ;

if(strcmp($_SESSION['tipo'],'sapu')==0){

print <<<EOQ

  <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>&nbsp;</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh0a14\" type=\"hidden\" id=\"falle0ha14\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh15a64\" type=\"hidden\" id=\"falleh15a64\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh65a74\" type=\"hidden\" id=\"falleh65a74\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh75ym\" type=\"hidden\" id=\"falleh75ym\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>
<tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>&nbsp;</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh0a14ira\" type=\"hidden\" id=\"falle0ha14ira\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh15a64ira\" type=\"hidden\" id=\"falleh15a64ira\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh65a74ira\" type=\"hidden\" id=\"falleh65a74ira\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

    echo "<input name=\"falleh75ymira\" type=\"hidden\" id=\"falleh75ymira\" value=\"0\" >";

print <<<EOQ

        </strong></font></div></td>

  </tr>

EOQ;

}

else {

print <<<EOQ

  <tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Hospitalizados x otras causas</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh0a14']))

        echo $row_rsfh['falleh0a14']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh15a64']))

        echo $row_rsfh['falleh15a64']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh65a74']))

        echo $row_rsfh['falleh65a74']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh75ym']))

        echo $row_rsfh['falleh75ym']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>
<tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>Hospitalizados x IRA</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh0a14ira']))

        echo $row_rsfh['falleh0a14ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh15a64ira']))

        echo $row_rsfh['falleh15a64ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh65a74ira']))

        echo $row_rsfh['falleh65a74ira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['falleh75ymira']))

        echo $row_rsfh['falleh75ymira']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>
<tr> 

    <td>

    <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">

    <strong>IFI</strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['ifi0a14']))

        echo $row_rsfh['ifi0a14']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['ifi15a64']))

        echo $row_rsfh['ifi15a64']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['ifi65a74']))

        echo $row_rsfh['ifi65a74']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

    <td>

      <div align="center"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 

EOQ;

     if(!empty($row_rsfh['ifi75ym']))

        echo $row_rsfh['ifi75ym']; 

     else

        echo 0;

print <<<EOQ

        </strong></font></div></td>

  </tr>

EOQ;

} // fin de sapu

print <<<EOQ

</table>

EOQ;

}

// comienza a desplegar datos de consultas, después siguen las otras actividades

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



                    resto_m1+resto_1a9+resto_10a14+resto_15a64+resto_65ym as totgenresto,



                    resto_m1+resto_1a9+resto_10a14 as totinfresto,



                    resto_15a64+resto_65ym as totaduresto,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 as totiram1,



                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 as totira1a9,



                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 as totira10a14,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 as totira15a64,



                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym as totira65ym,



                    totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym as toturg,



                    totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym as totsin,



                    totm1 + tot1a9 + tot10a14 as toturginf,



                    tot15a64 + tot65ym as toturgadu,



                    totsinm1 + totsin1a9 + totsin10a14 as totsininf,



                    totsin15a64 + totsin65ym as totsinadu,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 +

                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym  as totgentod,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 as totinftod,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym  as totadutod,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 +

                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym  +

                    totm1 + tot1a9 + tot10a14 + tot15a64 + tot65ym +

                    totsinm1 + totsin1a9 + totsin10a14 + totsin15a64 + totsin65ym 

                    as tottot,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 +

                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 +

                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 +

                    totm1 + tot1a9 + tot10a14 + totsinm1 + totsin1a9 + totsin10a14 as tottotinf,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +

                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym +

                    tot15a64 + tot65ym + totsin15a64 + totsin65ym as tottotadu,



                    bronq_m1+asma_m1+neumo_m1+influ_m1+larin_m1+resto_m1 + totm1 + totsinm1 as tottotm1,



                    bronq_1a9+asma_1a9+neumo_1a9+influ_1a9+larin_1a9+resto_1a9 + totsin1a9 + tot1a9 as tottot1a9,



                    bronq_10a14+asma_10a14+neumo_10a14+influ_10a14+larin_10a14+resto_10a14 +

                    tot10a14 + totsin10a14 as tottot10a14,



                    bronq_15a64+asma_15a64+neumo_15a64+influ_15a64+larin_15a64+resto_15a64 +

                     tot15a64 + totsin15a64 as tottot15a64,



                    bronq_65ym+asma_65ym+neumo_65ym+influ_65ym+larin_65ym+resto_65ym +

                     tot65ym + totsin65ym as tottot65ym



                    FROM aturg_urbana where id=%s", $_GET['id']);



$rs = safe_query($query_rs);

$row_rs = mysql_fetch_assoc($rs);

$totalRows_rs = mysql_num_rows($rs);



$f = $row_rs['fecha'];

$e = $row_rs['id_estab'];

print <<<EOQ

<html>

<head>

<title>Imprimir Hoja Registro</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>

<body>

EOQ;

print <<<EOQ

<p align="center"> 

  <input type="button" name="Button" value="Imprimir"

   onClick="javascript:window.print();">

   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <input type="button" name="Button" value="Cerrar"

   onClick="javascript:window.close();">

</p>

EOQ;



echo "<form method=\"post\" name=\"f\" action=\"index.php?page=registra&file=index&func=modifica\">"

 ."<table width=\"600\" align=\"center\">"

 ."   <caption><font color=\"#000000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Atenciones "

 ."   de Urgencia y Causas Respiratorias<br>Establecimiento: <i>".$_GET['nombre']."</i> "

 ."&nbsp;&nbsp;&nbsp;Fecha: "

 . $row_rs['fecha'] 

 ."</strong></font><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong></strong></font> "

 ."</caption>"

 ."<tr valign=\"baseline\">" 

   ."<td width=\"85\" align=\"right\" nowrap>" 

."<div align=\"left\"><strong><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."Grupos de edad:</font></strong></div></td>"



  ."<td width=\"53\" bgcolor=\"#DDDDDD\" > "

  ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

  ."Total urgencias </font></strong></font></div></td>"



  ."<td width=\"53\"> "

  ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

  ."Total urgencia Médicas</font></strong></font></div></td>"

   ."<td width=\"56\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

   ."Total urgencia Quirur.</font></strong></font></div></td>"

   ."<td bgcolor=\"#DDDDDD\" width=\"48\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

   ."Todas respirat.</font></strong></font></div></td>"

   ."<td width=\"55\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Bronquitis</font></strong></font></div></td>"

   ."<td width=\"47\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Asma</font></strong></font></div></td>"

   ."<td width=\"49\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Neumo.</font></strong></font></div></td>"

   ."<td width=\"50\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Influenza</font></strong></font></div></td>"

   ."<td width=\"52\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Laringitis</font></strong></font></div></td>"

   ."<td width=\"48\"> "

     ."<div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Resto de Respirat.</font></strong></font></div></td>"

 ."</tr>"



 ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\">" 

 ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">"

."Total General:</font></strong></font></div></td>"



   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottot']

   ."</font></font></div></td>"



   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['toturg']

   ."</font></font></div></td>"



   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totsin']

   ."</font></font></div></td>"

   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totgentod']

   ."</font></font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totgenbron']

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['totgenasma']

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totgenneumo'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totgeninflu']

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totgenlarin'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totgenresto'] 

   ."</font></div></td>"

 ."</tr>"



 ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

 ."<td height=\"26\" align=\"right\" nowrap>" 

."<div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">Total "

 ."        Infantil:</font></strong></font></div></td>"

   ."<td ><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottotinf']

   ."</font></font></div></td>"



 ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

 . $row_rs['toturginf'] 

   ."</font></font></div></td>"

   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totsininf'] 

   ."</font></font></div></td>"

   ."<td><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totinftod'] 

   ."</font></font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totinfbron'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['totinfasma'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totinfneumo'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totinfinflu'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totinflarin'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['totinfresto'] 

       ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\">" 

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#000000\">&lt;1 a&ntilde;o:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottotm1']

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['totm1'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

      . $row_rs['totsinm1'] 

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#000000\"><font size=\"1\">"

   ."<font face=\"Verdana, Arial, Helvetica, sans-serif\">"

        . $row_rs['totiram1']

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      . $row_rs['bronq_m1'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['asma_m1'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

     . $row_rs['neumo_m1'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      . $row_rs['influ_m1']

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     . $row_rs['larin_m1'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['resto_m1'] 

       ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\">" 

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#000000\">";

if(strcmp( $row_rs['fecha'],'2006-03-29')>0)

	echo "1-4 a&ntilde;os:";

else

	echo  "1-9 a&ntilde;os:";

echo "</font></strong></font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

  . $row_rs['tottot1a9']

   ."</font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       . $row_rs['tot1a9']

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     . $row_rs['totsin1a9'] 

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

          .$row_rs['totira1a9'] 

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

     . $row_rs['bronq_1a9'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['asma_1a9'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

     . $row_rs['neumo_1a9'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

      . $row_rs['influ_1a9'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['larin_1a9'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

    . $row_rs['resto_1a9']

       ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\"> "

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#000000\">";

if(strcmp( $row_rs['fecha'],'2006-03-29')>0)

	echo "5-14 a&ntilde;os:";

else

	echo  "10-14 a&ntilde;os:";

echo "</font></strong></font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottot10a14']

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      . $row_rs['tot10a14']

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

      . $row_rs['totsin10a14'] 

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."</font><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

       . $row_rs['totira10a14']

       ."</font></font></font><font face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      . $row_rs['bronq_10a14'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      . $row_rs['asma_10a14'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       . $row_rs['neumo_10a14'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

      . $row_rs['influ_10a14'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['larin_10a14']

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['resto_10a14'] 

       ."</font></div></td>"

 ."</tr>"



 ."<tr bgcolor=\"#DDDDDD\" valign=\"baseline\"> "

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">Total "

   ."      adultos:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottotadu']

   ."</font></font></div></td>"



   ."<td> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['toturgadu'] 

   ."</font></font></font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totsinadu'] 

   ."</font></font></font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totadutod']

   ."</font></font></font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totadubron']

   ."</font></div></td> "

   ."<td> <div align=\"right\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totaduasma']

   ."</font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['totaduneumo'] 

   ."</font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['totaduinflu'] 

   ."</font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['totadularin'] 

   ."</font></div></td>"

   ."<td> <div align=\"right\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totaduresto']

   ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\"> "

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">"

."<strong><font color=\"#000000\">15-64 a&ntilde;os:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottot15a64']

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['tot15a64'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['totsin15a64'] 

   ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['totira15a64'] 

   ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

   . $row_rs['bronq_15a64'] 

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  . $row_rs['asma_15a64'] 

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  . $row_rs['neumo_15a64'] 

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

  . $row_rs['influ_15a64'] 

  ."</font></div></td>"

  ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

  . $row_rs['larin_15a64'] 

   ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

   . $row_rs['resto_15a64'] 

   ."</font></div></td>"

 ."</tr>"



 ."<tr valign=\"baseline\">" 

   ."<td nowrap align=\"right\"><div align=\"left\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><font color=\"#000000\">65 "

         ." y m&aacute;s a&ntilde;os:</font></strong></font></div></td>"



   ."<td bgcolor=\"#DDDDDD\"><div align=\"right\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

   . $row_rs['tottot65ym']

   ."</font></font></div></td>"



   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['tot65ym'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['totsin65ym'] 

       ."</font></div></td>"

   ."<td bgcolor=\"#DDDDDD\"> <div align=\"right\"><font color=\"#000000\"><font size=\"1\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">"

    . $row_rs['totira65ym'] 

       ."</font></font></font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['bronq_65ym'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['asma_65ym'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

      . $row_rs['neumo_65ym'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">" 

       . $row_rs['influ_65ym'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['larin_65ym'] 

       ."</font></div></td>"

   ."<td><div align=\"right\"> <font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> "

       . $row_rs['resto_65ym'] 

       ."</font></div></td>"

 ."</tr>"

."</table>";



if(strcmp($_GET['tipo'],'urbano')==0 || strcmp($_GET['tipo'],'provincial')==0 ){

  hospitaliza();

  egresos();

}

if(strcmp($_GET['tipo'],'sapu')==0){

  derivaciones();

}

  fallecidoh();



?>