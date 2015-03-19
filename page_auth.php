<?php

if(!($_GET['setPage'])){
	$chkMenuAuth = "1";
}else{

	$auth = new Auth();
	$auth->user_id = $_SESSION['sess_user_id'];
	$auth->db = $db;

	$chkMenuAuth =  $auth->checkPageAuth($_GET['setPage']);
}

?>