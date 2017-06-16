<?php
/**
* @Author: Ronyan Alves
* @Date: 12/02/2016 08:58
* @Projet: Scriptcase
*
**/
//verifica la extension ( xls o xlsx )
$fileExtension = explode('.',$this->importacion_ul_name);

if(end($fileExtension)=='xlsx' || end($fileExtension)=='xls'){
	
	$inputFileName 	= $_SERVER["DOCUMENT_ROOT"].$_SESSION['scriptcase'][$this->Ini->nm_cod_apl]['glo_nm_path_imag_temp'].'/'.$this->importacion_ul_name;
	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch (Exception $e) {
		die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' . $e->getMessage());
	}
	//  Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();		
	$colum = array();
	//  Loop through each row of the worksheet in turn
	for ($row = 1; $row <= $highestRow; $row++) {
		$values = array();
		//  Read a row of data into an array
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL, TRUE, FALSE);	
		$lastIndex = count($rowData[0]).'<br>';
		$sql="";
		foreach($rowData[0] as $k=>$v){			
			if($k+1==1){
				if(isset($v)){				
					$sql = "SELECT COUNT(*) FROM articulos_copy WHERE codigo = $v";
					sc_lookup(rs,$sql);
					$codigo = $v;
				}				
			}
			if($codigo!=""){
				if($row==1){
					//echo "Column: Row: ".$row."- Col: ".($k+1)." = ".$v."<br />";			
					$colum[$k+1] = $v;
				}else{				
					if({rs[0][0]}==0){
						//insert
						if($k+1==6){
							$values[$k+1] = "'".date("Ymd", PHPExcel_Shared_Date::ExcelToPHP($v))."'";
						}else{
							$values[$k+1] = "'".$v."'";
						}
						$update = 1;
						$stm = "INSERT INTO Tabla ";
					}else{
						$sql2 = "SELECT fecha_modificacion FROM articulos_copy WHERE codigo = '$codigo'";
						sc_lookup(rs2,$sql2);
						$dias = sc_date_dif(date('Ymd'),"aaaammdd",{rs2[0][0]}, "aaaa-mm-dd");
						if($dias>0){
							//update																								
							$update = 0;
							$stm = "UPDATE Tabla SET ";

							if($k+1==6){
								$values[$k+1] = $colum[$k+1]." = '".date("Ymd", PHPExcel_Shared_Date::ExcelToPHP($v))."'";
							}else{
								$values[$k+1] = $colum[$k+1]." = '".$v."'";
							}
						}
					}
				}
			}
		}
		if($row!=1){
			if($codigo!=""){
				echo $sql;
				echo "<br>";
				if(isset($sql2)){ echo $sql2; echo "<br>"; }			
				if($update==1){
					//insert
					echo "$stm (".implode(',',$colum).") VALUES (".implode(',',$values).")";
				}else{
					//update
					echo "$stm ".implode(',',$values). " WHERE codigo = '".$codigo."'";
				}			
				echo "<br>";
			}
		}		
		unset($values);
		$codigo="";
	}
}else{
	sc_error_message("Archivo no soportado. Utilice un archivo xls o xlsx");
}
