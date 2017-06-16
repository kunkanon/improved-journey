<?php
/**
* @Author: Ronyan Alves
* @Date: 08/31/2016 14:19
* @Projet: Scriptcase
*
**/
$filename = date('Ymdhis')."_img";
$ext = ".png"; //here is the extension of your images
$path = scandir(__DIR__);
foreach($path as $v){
	$name = explode(".",$v);		
	if($name[0] == $filename){
		unlink($name[0].$ext);
	}
}
sc_lookup(rs,"SELECT file FROM Files WHERE file_id = {file_id}"); //change here for your SELECT and field ( primary key ).
$data ={rs[0][0]};
file_put_contents($filename.$ext, $data);
$path = substr($_SERVER["REQUEST_URI"], 1);
$pos = strstr($path, '?nmgp_outra_jan=true', true);
if($pos===false){
	$path = $path;
}else{
	$path = $pos;
}
[global_img] = $path.$filename.$ext;
