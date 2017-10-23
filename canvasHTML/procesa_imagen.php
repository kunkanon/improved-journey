if(isset($_POST['img'])){
	if($_POST['tipo']=='base'){
		$sql = "INSERT INTO canvasImg (img) VALUES ('".$_POST['img']."')";
	}else{
		$img_name = date('YmdHis').'.png';
		$path = str_replace('httpimgs','httpdocs',str_replace('doc','img',$this->Ini->path_doc)).DIRECTORY_SEPARATOR.$img_name;
		$sql = "INSERT INTO canvasImg (img_file) VALUES ('".$img_name."')";
		file_put_contents($path,base64_decode($_POST['img']));
	}
		sc_exec_sql($sql);
		sc_lookup(ds,"SELECT LAST_INSERT_ID()");
		sc_commit_trans();
		$data = (isset({ds[0][0]}) ? {ds[0][0]} : 'error' );
}
echo json_encode($data);
