<?php
$boundary='-----='.md5(uniqid(rand()));
$message .= "Content-Type: application/html; name=\"my attachment\"\n";
$message .= "Content-Transfer-Encoding: base64\n";
$message .= "Content-Disposition: attachment; filename=\"Hosp.Felix_Bulnes_Cerda.htm\"\n\n";
$message .= "--" . $boundary . "\n";

$headers  = "From: \"Yo\"<dsl@vtr.net>\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";

mail('dsl@vtr.net', 'Adjunto indicadores', $message, $headers);
?>