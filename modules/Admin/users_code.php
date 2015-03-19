<?php
include('../../includes/config.inc.php');

$action = $_POST['doAction'];
$user_id = $_POST['user_id'];
$username = $_POST['username'];
$password = base64_encode($_POST['password']);
$emp_code = $_POST['emp_code'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
/*
$email = $_POST['email'];
$gender = $_POST['gender'];
$telephone = $_POST['telephone'];
$prefix_id = $_POST['prefix_id'];
$position_id = $_POST['position_id'];
$site_id = $_POST['site_id'];
*/
$db->debug = 0;
/************************************************/

function set_authorize(){
global $db ,$user_id,$action;			
				
		/************************************************/
		# เพิ่มค่าที่ tbl_user_auth
		// ทำการเคลียร์ค่าใน table tbl_user_auth ตามรหัส user_id	 ทุกครั้ง
	 	$sql_del_group = "DELETE FROM tbl_user_auth WHERE user_id = $user_id ";			
		$db->Execute($sql_del_group);
		
		if($action == "new"){ 
			// หาค่าล่าสุดจาก tbl_users จากค่า auto increatment
			$rs_get_lastID = $db->GetRow("SELECT MAX(user_id) as MAXID FROM  tbl_users ");
			$getMaxID = $rs_get_lastID['MAXID'];	
			$set_user_id = $getMaxID;
		}else if($action == "edit"){
			$set_user_id = $user_id;
		}
	
		// วนเพิ่มข้อมูลใน Table tbl_user_auth
		
		if($_POST['user_group']){ // ถ้าไม่มีการเลือกกลุ่มผู้ใช้งานให้ค่าเริ่มต้นเป็น User/Requester group_id =4						
					//	echo	$sql_add_ugroup = "INSERT INTO tbl_user_auth (group_id,user_id) VALUES (4,$set_user_id); ";			
					//	$db->Execute($sql_add_ugroup);
				foreach($_POST['user_group'] as $v){
					 	$sql_add_ugroup = "INSERT INTO tbl_user_auth (group_id,user_id) VALUES ($v,$set_user_id); ";			
						$db->Execute($sql_add_ugroup);
				}
		}
		/************************************************/
		# End เพิ่มค่าที่ tbl_user_auth
		
		
		/************************************************/
		# เพิ่มค่าที่ tbl_user_on_site
		// ทำการเคลียร์ค่าใน table tbl_user_on_site ตามรหัส user_id	 ทุกครั้ง
		/*	
		$sql_del_usersite = "DELETE FROM tbl_user_on_site WHERE user_id = $user_id ";			
		$db->Execute($sql_del_usersite);
		
		// วนเพิ่มข้อมูลใน Table tbl_user_on_site
	
		if(!$_POST['onsite_id']) return;
		foreach($_POST['onsite_id'] as $v){
			if($site_id <> $v){	// ถ้าไซต์งานอื่นๆ เท่ากับ ไซต์งานหลัก ไม่ต้องบันทึกซ้ำ		
				$sql_add_usersite = "INSERT INTO tbl_user_on_site (user_id,site_id) VALUES ($user_id,$v); ";			
				$db->Execute($sql_add_usersite);
			}
		}
		*/
		/************************************************/
		# End เพิ่มค่าที่ tbl_user_auth
		
} // End function


if($action == "new"){     
	 	 $sql = "INSERT INTO tbl_users
								( username, password,  first_name , updatetime )
					VALUES ( '".$username."','".$password."','".$first_name."' , NOW());";
		$result = $db->Execute($sql);
		
			
		set_authorize(); // เรียกใช้การ update ค่าในตาราง  tbl_user_auth
		
		
}else if($action == "edit"){ 
	 $sql = "UPDATE tbl_users 
								SET  username ='".$username."', 
										password = '".$password."', 
										first_name='".$first_name."',
										updatetime = NOW()					
					WHERE user_id = $user_id ";
		$result = $db->Execute($sql);
		
		set_authorize(); // เรียกใช้การ update ค่าในตาราง tbl_user_on_site และ tbl_user_auth

}else if($_GET['action'] == "delete"){
	$sql = "DELETE FROM tbl_users WHERE user_id = ".$_GET['user_id'];
	$result = $db->Execute($sql);
	
	$sql = "DELETE FROM tbl_user_auth WHERE user_id = ".$_GET['user_id'];
	$result = $db->Execute($sql);
}
	
	
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>