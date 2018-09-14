<?php
/** usage: put  on top of onValidate event from  prefix_sync_apps **/

/** fork to remove unused applications (mysql only) **/

$path = $this->Ini->path_aplicacao . "../";
$dir = array_values(array_diff(scandir($path),array('.','..','_lib','index.php', 'index.html')));
$sql = "";
$sec_apps = " DELETE FROM sec_apps WHERE APP_NAME NOT IN (";
$sec_users_apps = " DELETE FROM sec_groups_apps WHERE APP_NAME NOT IN (";

if(isset($dir[0])){
	$iniFile = array();
	foreach($dir as $values){
		if(is_dir($path.$values)){
			$sql .= "'".$values."',";
			$iniFile[] = $values."_ini.txt";
			$iniFile[] = $values."_mob_ini.txt";
		}
	}
	$sql = substr($sql,0,-1)." )";
	$iniFile = array_merge($iniFile,array(".","..","index.php","index.html"));
	$files = array_values(array_diff(scandir($this->Ini->path_aplicacao . "../_lib/friendly_url/"),$iniFile));
	if(isset($files[0])){
		foreach($files as $values){
			unlink($this->Ini->path_aplicacao. "../_lib/friendly_url/".$values);
		}
	}
	$check_fk_0 = "SET FOREIGN_KEY_CHECKS=0";
	$check_fk_1 = "SET FOREIGN_KEY_CHECKS=1";
	$sql1  = $sec_apps.$sql;
	$sql2 = $sec_users_apps.$sql;
	sc_exec_sql($check_fk_0);
	sc_exec_sql($sql1);
	sc_exec_sql($sql2);
	sc_exec_sql($check_fk_1);

}
