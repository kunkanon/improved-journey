<?php
/**
* @Author: Ronyan Alves
* @Date: 2017-10-23
* @Projet: Scriptcase
*
**/

sc_lookup(ds,"SELECT id,fecha,cliente_id,gastos_envio,precio,pais_iso,estado FROM pedidos LIMIT 0,10");
$range = range("A", "Z");
sc_include_lib("excel");

// Tell PHPExcel that you're planning on using the tcPDF library
// and where the tcPDF library is installed on your server
$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
$rendererLibrary = 'tcpdf.php';
$rendererLibraryPath = $this->Ini->path_third . "/tcpdf/";

if (!PHPExcel_Settings::setPdfRenderer(
        $rendererName,
        $rendererLibraryPath
    )) {
    die(
        'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
        EOL .
        'at the top of this script as appropriate for your directory structure'
    );
}

$xlsFile = 'plantilla_'.date('YmdHhIs').'.pdf';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Hide grid lines
//$objPHPExcel->getActiveSheet()->setShowGridLines(false);

// Change to LandScape
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set document properties
$objPHPExcel->getProperties()->setCreator("Ronyan Alves")
							 ->setLastModifiedBy("Ronyan Alves")
							 ->setTitle("XLS to PDF Document")
							 ->setSubject("XLS to PDF Document")
							 ->setDescription("XLS to PDF, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php pdf")
							 ->setCategory("Test result file");
// Change column size
for($i=0;$i<count({ds[0]});$i++){
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($range[$i])->setAutoSize(false);
	$objPHPExcel->getActiveSheet()->getColumnDimension($range[$i])->setWidth(15);
}

// Custom position ( centering )
/*$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
$objPHPExcel->getDefaultStyle()->applyFromArray($style);
*/
// Add some data
$objPHPExcel->setActiveSheetIndex(0);
foreach({ds} as $key => $arr_value){
	foreach($arr_value as $key2 => $data){
		if(is_float({ds[$key][$key2]})){
			$objPHPExcel->getActiveSheet()->getStyle($range[$key2].$key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($range[$key2].$key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		$objPHPExcel->getActiveSheet()->setCellValue($range[$key2].$key, {ds[$key][$key2]});
	}
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('XLS to PDF');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save($xlsFile);


?>
<script>
	window.location = '../<?php echo $this->Ini->nm_cod_apl.'/'.$xlsFile; ?>';
</script>
<?php
