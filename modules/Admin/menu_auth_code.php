﻿<?php
include('../../includes/config.inc.php');

if($_POST['doAction']){
	$group_id = $_POST['group_id'];
	
	// ลบข้อมมูลทั้งหมดก่อนทำการ Insert
	 $sql_del_meu_auth = "DELETE FROM tbl_menu_auth WHERE group_id = $group_id";
		$db->Execute($sql_del_meu_auth);
		
	//เพิ่มข้อมูล
	for($i=0;$i<count($_POST['chk_menu']);$i++){
		$menu_id = $_POST['chk_menu'][$i];
	 	$sql_add_menu_auth = "INSERT INTO tbl_menu_auth ( group_id ,menu_id) VALUES( $group_id ,$menu_id);";
		$result = $db->Execute($sql_add_menu_auth);
	} // End for
} // End if

if($result){
			echo  "1";
	}else{
			echo "0";
}

?>
