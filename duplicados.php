<?php
include "header.php";
$q="SELECT `id_estab`,`fecha`,count(*) as n FROM `aturg_urbana`
group by `id_estab`,`fecha`
having count(*)>1";
$r=mysql_query($q);
?>
<table>
<?php
while($row=mysql_fetch_assoc($r)){
?>
<tr>
<td><?php echo $row['id_estab'];?></td>
<td><?php echo $row['fecha'];?></td>
<td><?php echo $row['n'];?></td>
</tr>
<?php
}
?>
</table>


