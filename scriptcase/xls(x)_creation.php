<?php
/**
* @Author: Ronyan Alves
* @Date: 2016-05-05 09:44
* @Project: Scriptcase
*
**/

require_once('../../../..'.$this->Ini->path_prod.'/third/phpexcel/PHPExcel.php');

$objPHPExcel = new PHPExcel();


for($i=0;$i<10;$i++){
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $i)
							  ->setCellValue('B'.$i, $i)
							  ->setCellValue('C'.$i, '=SUM(A'.$i.':B'.$i.')');
	
}
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save(str_replace('.php', date('s').'.xlsx', __FILE__));
