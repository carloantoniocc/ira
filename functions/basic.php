<?php
function authenticate ( $realm="Secure Area"
   , $errmsg="Please enter a username and password" ){
    Header ("WWW-Authenticate: Basic realm=\"$realm\" ");
	Header ("HTTP/1.1 401 Unauthorized");
	die($errmsg);
}

function cleanup_text( $value="", $preserve="", $allowed_tags="") {
    if (empty($preserve)) {
	    $value=strip_tags($value, $allowed_tags);
	}
	$value=htmlspecialchars($value);
	return $value;
}

function safe_query($query=""){
 if(empty($query)){ return FALSE; }
   $result = mysql_query ($query)
             or die("ack! query fallado: "
			 . "<li>errorno=".mysql_errno()."</li>"
			 . "<li>error=".mysql_error()."</li>"
			 . "<li>query=".$query."</li>"
			 );
	return $result;
}

function get_attlist($atts="",$defaults=""){
  $localatts=array();
  $attlist="";
  if(is_array($defaults)){
    $localatts=$defaults;}
  if(is_array($atts)){
    $localatts=array_merge($localatts,$atts);}
  while(list($name,$value)=each($localatts)){
   if($value==""){ $attlist .= "$name"; }
    else { $attlist .= "$name=\"$value\""; }
  }
  return $attlist;
}

?>
