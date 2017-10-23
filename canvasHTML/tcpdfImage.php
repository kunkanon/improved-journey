/**
* @Author: Ronyan Alves
* @Date: 2017-10-23 15:27
* @Project: JQuery
*
**/

sc_include_lib('tcpdf');
$sql = "SELECT id,img,img_file FROM canvasImg";
sc_lookup(rs,$sql);
$pdf = new TCPDF();
foreach($rs as $key => $arr_dt){
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->AddPage();
	$x = 10;
	$y=10;
	$pdf->setXY($x,$y);
	$pdf->Cell(10, 0,$rs[$key][0], "", 1, 'L', 0, '', 0);
	$pdf->setJPEGQuality(75);
	if(isset($rs[$key][1]) && $rs[$key][1]!=""){
		$img = '@'.base64_decode($rs[$key][1]);
		$pdf->Image($img);
	}else{
		$img = str_replace('httpimgs','httpdocs',str_replace('doc','img',$this->Ini->path_doc)).DIRECTORY_SEPARATOR.$rs[$key][2];
		$pdf->Image($img, $x,$y+10 ,'' ,'' , 'PNG', '', '', true, 150);
	}
}
$pdf->output('pantilla_'.date('YmdHis').'.pdf','I');
