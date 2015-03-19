<?php
include('../../includes/config.inc.php');

$action = $_POST['doAction'];
$docs_cate_id = $_POST['docs_cate_id'];
$docs_cate_code = $_POST['docs_cate_code'];
$docs_cate_name = $_POST['docs_cate_name'];

$path = "../../".UPLOADS_DIR;
$db->debug = 0;

function create_dir(){
		global $path ,$docs_cate_code;
		$dirname = $docs_cate_code;
		$filename = $path."/".$docs_cate_code;// . $dirname . "/";
		
		if (!file_exists($filename)) {
				mkdir($path ."/". $dirname, 777, true);
			//	echo "The directory $dirname was successfully created.";
		//exit;
		} 
}


if($action == "new"){     
	
		create_dir();
		
		$sql = "INSERT INTO tbl_docs_category
								(docs_cate_code , 
								docs_cate_name  ,
								docs_cate_updatetime)
					VALUES ( ".chkNull($docs_cate_code)." , 
								 ".chkNull($docs_cate_name).",
								 NOW()
								 );";
		
}else if($action == "edit"){ 
		
			 $sql = "UPDATE tbl_docs_category
								SET   
										docs_cate_code =  ".chkNull($docs_cate_code)." ,
										docs_cate_name =".chkNull($docs_cate_name)." ,
										docs_cate_updatetime = NOW() 
					WHERE docs_cate_id = $docs_cate_id ";
		

}else if($_GET['action'] == "delete"){
	$sql = "DELETE FROM tbl_docs_category WHERE docs_cate_id = ".$_GET['docs_cate_id'];
}
	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>