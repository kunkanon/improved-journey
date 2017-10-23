<?php
/**
* @Author: Ronyan Alves
* @Date: 2017-10-23 15:22
* @Project: JQuery
*
**/

if(isset($_GET['id'])){
	sc_lookup(ds,"SELECT img,img_file FROM canvasImg WHERE id = ".$_GET['id']);
	if(isset({ds[0][0]})){
		$varImg={ds[0][0]};
		echo "<img border=0 width='600px' height='100px' src='data:image/png;base64,$varImg'>";
	}else{
		echo "<img src='".$this->Ini->path_imagens."/".{ds[0][1]}."'>";
	}
}
