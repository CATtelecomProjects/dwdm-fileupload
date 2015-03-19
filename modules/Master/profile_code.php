<?php
@session_start();
include('../../includes/config.inc.php');

if(!$_POST['doAction']) return;

$action = $_POST['doAction'];
$user_id = $_POST['user_id'];
$passwords = base64_encode($_POST['new_passwords']);

	//แก้ไขข้อมูล
	  	 $sql = "UPDATE tbl_users 
								SET 
										password = '".$passwords."'										
					WHERE user_id = $user_id ";
		$result = $db->Execute($sql);

if($result){
			echo  "1";
	}else{
			echo "0";
}

?>
