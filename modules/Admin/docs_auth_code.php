<?php
include('../../includes/config.inc.php');

$db->debug=0;

if($_POST['doAction']){
	$group_id = $_POST['group_id'];
	
	// ลบข้อมมูลทั้งหมดก่อนทำการ Insert
	 $sql_del_docs_auth = "DELETE FROM tbl_docs_auth WHERE group_id = $group_id";
		$db->Execute($sql_del_docs_auth);
		
	//เพิ่มข้อมูล
	for($i=0;$i<count($_POST['chk_docs']);$i++){
		$docs_cate_id = $_POST['chk_docs'][$i];
	 	 $sql_add_docs_auth = "INSERT INTO tbl_docs_auth ( group_id ,docs_cate_id) VALUES( $group_id ,$docs_cate_id);";
		$result = $db->Execute($sql_add_docs_auth);
	} // End for
} // End if

if($result){
			echo  "1";
	}else{
			echo "0";
}

?>
