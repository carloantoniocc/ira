<?php
  require_once('Connections/ira.php');
  mysql_select_db($database_ira, $ira);
  $id=$_GET['id'];
  $deleteSQL="delete from aturg_urbana where id=".$id;
  $result=mysql_query($deleteSQL,$ira) or die(mysql_error());
  header("Location: lisaturg.php");
?>

