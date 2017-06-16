<?php
/**
* @Author: Ronyan Alves
* @Date: 07/02/2017 12:31
* @Projet: Scriptcase
*
**/
if( empty( {ipaddress} )  ){
     sc_ajax_message("IpAddress vacio");
}



if( empty({ipaddress}) || {ipaddress}==""){
	sc_ajax_message("IpAddress requerido");
}else{
	$url = "http://www.webservicex.net/geoipservice.asmx?WSDL";
	$soapClient = sc_webservice("soap", $url, 80, "POST", "", array(), 30);
	$datos = $soapClient->GetGeoIP(array('IPAddress' => {ipaddress}));	
	
	{resultado} 	= "Codigo: ".$datos->GetGeoIPResult->ReturnCode.'<br>';
	{resultado}    .= "IP: ".$datos->GetGeoIPResult->IP.'<br>';
	{resultado}    .= "CountryName: ".$datos->GetGeoIPResult->CountryName.'<br>';
	{resultado}    .= "CountryCode: ".$datos->GetGeoIPResult->CountryCode.'<br>';
	{resultado}    .= "Detalle: ".$datos->GetGeoIPResult->ReturnCodeDetails.'<br>';
}
