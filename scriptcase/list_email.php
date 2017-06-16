<?php
/**
* @Author: Ronyan Alves
* @Date: 06/08/2017 18:28
* @Project: Scriptcase
*
**/

$arr_email = explode("@",$email);
$server = end($arr_email);
switch($server){
	case 'domain.com':
	$mail = 'mail.domain.com';
	$port = 993;
	break;
	case 'gmail.com':
	$mail = 'imap.gmail.com';
	$port = 993;
	break;
	default:
		$mail = false;
	break;
}
$srv = '{'.$mail.':'.$port.'/ssl/novalidate-cert}';
$correo = $email;
$pswd	= $pswd;
$conn = imap_open($srv, $correo, $pswd);
$boxes = imap_list($conn, $srv, '*');
foreach($boxes as $key => $box){
	$mystring = $box;
	$findme   = 'INBOX';
	$pos = strpos($mystring, $findme);
	if($pos!==FALSE){
		$inbox_index=$key;
	}
}
//retorna la lista de las carpetas que tiene en lo correo.
imap_reopen($conn, $boxes[$inbox_index]) or die(implode(", ", imap_errors()));
$correos = imap_search($conn, "ALL");
echo ' 
	
	<table class="table" style="width:100%">
  <tr>
  	<th></th>
  	<th></th>
    <th>FROM</th>
    <th>Subjetct</th> 
    <th>Fecha</th>
  </tr>
';
if($correos!=false){
	$correos = array_reverse($correos);
	foreach($correos as $key => $correo){
		if($key<=10){
			$datos_correo = imap_header($conn, $correo);
			echo "<tr>
				<td><span class='glyphicon glyphicon-eye-open'></span></td>
				<td><span class='glyphicon glyphicon-trash'></span></td>
				<td>".$datos_correo->fromaddress."</td>
				<td>".imap_utf8($datos_correo->Subject)."</td> 
				<td>".$datos_correo->MailDate."</td>
			</tr>";	
		}
	}
}
echo "</table>";
if($correos!=false){
	echo "<center>";
	echo "<span class='glyphicon glyphicon-step-backward'></span> ";
	$counter = 0;
	foreach(array_reverse($correos) as $key => $correo){
		if($counter==0){
			echo $correo." - ";
		}
		if($counter == 10){
			echo $correo;
		}
		$counter++;
	}
	echo " de ".count($correos)." ";
	echo "<span class='glyphicon glyphicon-step-forward'></span>";
	echo "</center>";
}
