<?php
//header('Content-Type: text/html; charset=utf-8');
include('../../includes/config.inc.php');

//show_post();
$datetime = date('Ymd');

$action = $_POST['doAction'];
$is_exists = $_POST['is_exists'];

$docs_cate_code = $_POST['docs_cate_code'];
$docs_cate_code_old = $_POST['docs_cate_code_old'];

$docs_filename = $is_exists == '1' ? $_POST['docs_filename'] :  $datetime.'-'.$_FILES['docs_filename']['name']; // ถ้ามีไฟล์อยู่แล้วให้ update ชื่อไฟล์เดิม ถ้าไม่มีให้เอาจาก file field
$docs_owner = $_POST['docs_owner'];
$docs_desc = $_POST['docs_desc'];
$docs_uploadby = $_POST['docs_uploadby'];
$docs_publish = $_POST['docs_publish'];
$docs_years = $_POST['docs_years'];
$docs_years_old = $_POST['docs_years_old'];

//show_get();
//exit;
//show_array($_POST);
//show_array($_FILES);

$path = "../../".UPLOADS_DIR."/$docs_cate_code/$docs_years/";


function docs_uploads(){
		
		global $path, $datetime;		
		
		create_dir(); // สร้าง directory ตามปี
			 
		// Upload File
		if (!file_exists($path . iconv('UTF-8','TIS620', $datetime."-".$_FILES["docs_filename"]["name"]))) {
		  //echo $_FILES["docs_filename"]["name"] . " already exists. ";
		  //echo "0";
		  //exit;
	  //}else {
		  move_uploaded_file($_FILES["docs_filename"]["tmp_name"], $path . iconv('UTF-8','TIS620', $datetime."-".$_FILES["docs_filename"]["name"]));					  
		}	
		
}


function delete_file($docs_id){
	global $db;
// หาชื่อไฟล์เพื่อทำการลบ
	$sqldownload = "select docs_filename , docs_cate_code , docs_years from tbl_documents where docs_id=$docs_id";
	
	$rsdownload = $db -> GetRow($sqldownload);	
	
	$filePath = "../../".UPLOADS_DIR."/".$rsdownload['docs_cate_code']."/".$rsdownload['docs_years']."/".iconv('UTF-8','TIS620',$rsdownload['docs_filename']);
	
	@unlink($filePath);
		
}


function create_dir(){
		global $path;
		//$dirname = $_POST['docs_years'];
		$filename = $path;// . $dirname . "/";
		
		if (!file_exists($filename)) {
				mkdir($path . $dirname, 777, true);
			//	echo "The directory $dirname was successfully created.";
		//exit;
		} 
}



function move_file(){
		global $path, $docs_filename , $docs_cate_code , $docs_cate_code_old  , $docs_years_old;
		
		create_dir();
	
	   $newPath = $path.iconv('UTF-8','TIS620',$docs_filename);
		$oldPath = "../../".UPLOADS_DIR."/".$docs_cate_code_old."/".$docs_years_old."/".iconv('UTF-8','TIS620',$docs_filename);
		
		// คัดลอกไฟล์จากพาทเดิมไปพาทใหม่
		if (@copy("$oldPath" , "$newPath")) {
		  @unlink($oldPath);
		}	
}


if($action == "new"){      // New Record action
		
		docs_uploads(); // Upload Document to server

		$sql = "INSERT INTO tbl_documents  
								(   docs_years ,
									docs_filename,
									docs_desc ,
									docs_owner ,
									docs_uploadby,
									docs_updatetime,
									docs_cate_code ,
									docs_publish )
					VALUES ( 
								 ".chkNull($docs_years).", 								 
								 ".chkNull($docs_filename).",
								  ".chkNull($docs_desc).",
								  '$docs_owner' ,
								 ".chkNull($docs_uploadby).", 
								 NOW(), 
								 ".chkNull($docs_cate_code).",
								 ".chkNull($docs_publish)."
								 );";
				
					
		
}else if($action == "edit"){   /// Update Record action

	if($is_exists  <> '1'){
		docs_uploads();
	}

	// ถ้าปีไม่เหมือนค่าเดิม ให้สร้าง directory ใหม่
	if($docs_years <> $docs_cate_code_old){
			move_file();
	}
	
	// ถ้าเลือกหมวดเอกสารใหม่
	if($docs_cate_code <> $docs_cate_code_old){
			move_file();
	}

	 	 $sql = "UPDATE tbl_documents 
								SET   
										docs_years = ".chkNull($docs_years).", 
										docs_filename  =  ".chkNull($docs_filename).", 
										docs_desc =  ".chkNull($docs_desc).",  
										docs_owner = '$docs_owner' ,
										docs_uploadby = ".chkNull($docs_uploadby).", 
										docs_updatetime = NOW(), 
										docs_cate_code  =  ".chkNull($docs_cate_code).",
										docs_publish =  ".chkNull($docs_publish)."
					WHERE docs_id = $docs_id ";
					



}else if($_GET['doAction'] == "delete"){ // Delete Record action
	
	delete_file($_GET['docs_id']); // Function for Delete file
	
	$sql = "DELETE FROM tbl_documents WHERE docs_id = ".$_GET['docs_id'];
	
	
		
}else if($_GET['doAction'] == "delete_file"){ // Delete file action 
	
	delete_file($_GET['docs_id']); // Function for Delete file
	
	 $sql = "UPDATE  tbl_documents SET docs_filename = null , docs_downloads = 0 WHERE docs_id = ".$_GET['docs_id'];

}


	$result = $db->Execute($sql);
	
	if($result){
			echo  "1";
	}else{
			echo "0";
	}

?>