<?php
/**
* @Author: Ronyan Alves
* @Date: 2017-06-08 08:18
* @Project: Scriptcase
*
**/

if({login}!="" && {contrasena}!=""){
	$sql = "SELECT COUNT(*),base FROM tbl_users_multi_conn WHERE login = '".{login}."' AND pswd = '". md5({contrasena}). "'";
	sc_lookup(ds,$sql);
	if({ds[0][0]}==0){
		sc_error_message("Usuário o contraseña inválidos");
		sc_error_exit();
	}else{
		$arr_conn = array();
		$arr_conn['database'] = {ds[0][1]};
		sc_connection_edit("conn_mysql", $arr_conn);
		[glo_username] = {login};
		[glo_base_datos] = {ds[0][1]};
	}
}
