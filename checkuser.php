<?php
@session_start();

include('./includes/config.inc.php');

if(!$_POST['doAction']) return;
$username = $_POST['username'];
$password = base64_encode($_POST['password']);

$sql_chk = "SELECT * FROM tbl_users WHERE username = '$username'  AND password = '$password';";
$rs_chk=$db->GetRow($sql_chk);

if(count($rs_chk)>0){
	// หาหน่วยงานแรกที่สังกัดเพื่อกำหนดเป็นค่าแรกใน Session
	
	
	$_SESSION['sess_id'] = session_id();
	$_SESSION['sess_user_id'] = $rs_chk['user_id'];
	$_SESSION['sess_user_name'] = $rs_chk['username'];
	$_SESSION['sess_name'] = $rs_chk['first_name'];
	$_SESSION['sess_email'] = $rs_chk['email'];

	
	echo "1";
}else{
	echo "0";
}
?>