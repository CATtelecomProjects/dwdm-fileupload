<?php
include('../../includes/config.inc.php');

$action = $_POST['doAction'];
$group_id = $_POST['group_id'];
$group_name = $_POST['group_name'];

if($action == "new"){     
		$sql = "INSERT INTO tbl_user_group
								( group_name  )
					VALUES ( ".chkNull($group_name).");";
		
}else if($action == "edit"){ 
		$sql = "UPDATE tbl_user_group
								SET   
										group_name =".chkNull($group_name)."
					WHERE group_id = $group_id ";

}else if($_GET['action'] == "delete"){
	$sql = "DELETE FROM tbl_user_group WHERE group_id = ".$_GET['group_id'];
}
	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>