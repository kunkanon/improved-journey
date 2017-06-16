<?php
/**
* @Author: Ronyan Alves
* @Date: 11/30/2016 09:06
* @Projet: Scriptcase
*
**/

if(isset($_SESSION['sc_session'])){
	$index=array();
	$index = array_keys($_SESSION['sc_session']);
	if(isset($_SESSION['sc_session'][$index[0]][$this->Ini->nm_cod_apl]['campos_busca'])){		
		$valorCampoBusca = $_SESSION['sc_session'][$index[0]][$this->Ini->nm_cod_apl]['campos_busca'];
		foreach($valorCampoBusca as $key=>$value){
			echo "Label: ".$key." Valor: ".$value."<br>";
		}
	}
}
