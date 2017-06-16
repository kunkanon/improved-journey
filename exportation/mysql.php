<?php
/**
* @Author: Ronyan Alves
* @Date: 03/23/2016 13:48
* @Projet: Scriptcase
*
**/
$dbname = $this->Ini->nm_banco.'.sql';
$arquivo = fopen($dbname,"w");
sc_lookup(quantidade, "SELECT COUNT(*) FROM information_schema.tables WHERE TABLE_TYPE NOT IN ('SYSTEM VIEW')");
$count = {quantidade[0][0]};
$inicial=0;
$final=50;
fwrite($arquivo,"SET foreign_key_checks = 0; \n");
for($i=$inicial;$i<$final;$i++){
	sc_lookup(tabelas,"SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_TYPE NOT IN ('SYSTEM VIEW') LIMIT $i,$final");
	if(is_array({tabelas})){
		foreach({tabelas} as $rs1){
			if(is_array($rs1)){
				foreach($rs1 as $table){
					$sql = "SHOW CREATE TABLE `$table`";
					sc_lookup(createTable,$sql);
					if(is_array({createTable})){
						foreach({createTable} as $create ){
							fwrite($arquivo,$create[1]."; \n");
						}
					}
					$sql_insert = "SELECT * FROM `$table`";
					sc_lookup(valoresInsert,$sql_insert);
					if(is_array({valoresInsert})){
						foreach({valoresInsert} as $cs1){
							$array = array();
							foreach($cs1 as $values){
								$array[] = "'".$values."'";
							}
							fwrite($arquivo,"INSERT INTO `$table` VALUES (".implode(",",$array)."); \n");
							unset($array);
						}
					}
				}
			}
		}
	}
	$x=$i+$final;
	$i=$x;
	if($final>$count){
		break;
	}
	if($i==$x){
		$i = $final;
		$final = $final+50;
	}
	
}
fwrite($arquivo,"SET foreign_key_checks = 1; \n");
fclose($arquivo);
echo "<a href='".$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$this->Ini->path_link.'/'.$this->Ini->nm_cod_apl.'/'.$dbname."' target='_blank'>".$dbname."</a>";
