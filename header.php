<?php

//include("functions/charset.php");

include("functions/basic.php");

// include("clases.php");

// $conn=mysql_connect("localhost","daimo","dsl982") or

// die("No se conectaria a la base de datos");

$conn=mysql_connect("localhost","root","silver") or die("No se conectara a la base de datos");

mysql_select_db("ira", $conn) or  die("no seleccionaria base datos"); 

define ("PAGE_LIMIT", 2);

function print_entry($row, $preserve=""){

  $numargs=func_num_args();

  for($i=2; $i < $numargs; $i++){

  		$field=func_get_arg($i);

		$dbfield=str_replace(" ","_",strtolower($field));

		$dbvalue=cleanup_text($row[$dbfield],$preserve);

		$name=ucwords($field);

		print " <tr>\n";

		print " <td valign=top align=right><b>$name:</b></td>\n";

		print " <td valign=top align=left>$dbvalue</td>\n";

		print " </tr>\n\n";

		}

}



function print_input_fields(){

  $fields=func_get_args();

  while (list($index,$field)=each($fields)){

      print " <tr>\n";

	  print " <td valign=top align=right><b>" .ucfirst($field) . ":</b></td>\n";

	  print " <td valign=top align=left><input type=text name=$field size=40 value=\"".

	           $GLOBALS["last_$field"] . "\"></td>\n";

	  print " </tr>\n\n";

	}

}

/* 

function create_entry($name,$location,$email,$url,$comments){

  $name = cleanup_text($name);

  $location = cleanup_text($location);

  $email = cleanup_text($email);

  $url = cleanup_text($url);

  $comments = cleanup_text($comments);



  $errmsg = "";

  

  if (empty($name)){

   $errmsg .= "<li>Tiene que poner un nombre a lo menos!</li>\n";

   }



   if (empty($email) || !eregi("^[A-Za-z0-9\_-]+@[A-Za-z0-9\_-]+.[A-Za-z0-9\_-]+.*", $email))

   {

      $errmsg .= "<li>$email no parece una direccion email valida</li>\n";

   }

   else

   {

     $query="select * from guestbook where email='$email'";

	 $result=safe_query($query);

	 if(mysql_num_rows($result) > 0){

	   $errmsg .= "<li>$email ya ha sido registrado en este libro.\n";

      }

   }

  if (!empty($url) && !eregi("^http://[A-Za-z0-9\%\?\_\:\/\.-]+$" , $url)){

       $errmsg .= "<li>$url no parece una URL valida\n";

	}

	   

   if (empty($errmsg)){

       $query="insert into guestbook "

	   ."(name,location,email,url,comments,remote_addr) values "

	   ."('$name','$location','$email','$url','$comments','$REMOTE_ADDR')";

	   safe_query($query);

	   print "<h2>Gracias ,$name!!</h2>\n";

	   }

	else

	{

     print "<p><font color=red><b><ul>$errmsg</ul>";

	 print "Por favor trate de nuevo </p>";

	}

	  return $errmsg;

} 

*/



function select_entries($offset=0,$tabla=' ',$orden=' '){

  if(empty($offset)){ $offset=0; }

  $query = "select *

           from " . $tabla .

		   " order by " . $orden .

		   " limit " . $offset . ", " . PAGE_LIMIT ;

	$result=safe_query($query);

	return $result;

}



function nav ($tabla, $offset=0, $this_script="" ){

  global $PHP_SELF;

  if (empty($this_script)) { $this_script=$PHP_SELF; }

  if (empty($offset)) { $offset=0; }

  $result=safe_query("select count(*) from $tabla");

  list($total_rows)=mysql_fetch_array($result);

  print "<p>\n";

  

  if($offset>0){

     print "<a href=\"$this_script?offset=".

	        ($offset - PAGE_LIMIT) . "\">&lt;&lt;Entradas previas</a>&nbsp;" ;

  }

  

  if($offset+PAGE_LIMIT < $total_rows ){



    print "<a href=\"$this_script?offset=". ($offset + PAGE_LIMIT ). 

	"\">Sgte. entradas&gt;&gt;</a> &nbsp;"  ;

	

	}

	print  "</p>\n";

}



function anchor_tag($href="",$text="",$atts=""){

  $attlist=get_attlist($atts,array("href"=>$href));

  $output="<a $attlist > $text </a>";

  return $output;

}



?>
