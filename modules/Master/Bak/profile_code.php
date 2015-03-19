<?php
@session_start();
include('../../includes/config.inc.php');

if(!$_POST['doAction']) return;

$action = $_POST['doAction'];
$user_id = $_SESSION['sess_user_id'];
$username = $_POST['username'];
$passwords = base64_encode($_POST['passwords']);
$emp_code = $_POST['emp_code'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$telephone = $_POST['telephone'];
$prefix_id = $_POST['prefix_id'];

	
	//แก้ไขข้อมูล
	  	$sql = "UPDATE tbl_users 
								SET  username ='".$username."', 
										passwords = '".$passwords."', 
										emp_code='".$emp_code."', 
										first_name='".$first_name."', 
										last_name='".$last_name."', 
										email='".$email."', 
										gender='".$gender."', 
										telephone=".chkNull($telephone).",
										prefix_id='".$prefix_id."'
					WHERE user_id = $user_id ";
		$result = $db->Execute($sql);

if($result){
			echo  "1";
	}else{
			echo "0";
}

?>
