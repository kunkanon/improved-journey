<?php
/**
* @Author: Ronyan Alves
* @Date: 2017-06-15 10:50
* @Project: Scriptcase
*
**/

if({log}=='S'){
	$loc_c_login = "usr_".{login};
	$loc_c_pswd = "usr_".{pswd};		
	//$sq = "INSERT INTO tbl_usr_cookies (login,pswd) VALUES ('".$loc_c_login."','".$loc_c_pswd."')";
	//sc_exec_sql($sql);
	setcookie($loc_c_login,{login},time()+360);
	setcookie($loc_c_pswd,{pswd},time()+360);
	sc_set_global($loc_c_login);
	sc_set_global($loc_c_pswd);
}
