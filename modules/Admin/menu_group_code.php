<?php
include('../../includes/config.inc.php');

$action = $_POST['doAction'];
$mgroup_id = $_POST['mgroup_id'];
$menu_group_th = $_POST['menu_group_th'];
$menu_group_en = $_POST['menu_group_en'];
$menu_path = $_POST['menu_path'];
$menu_order = $_POST['menu_order'];
$icon_id = $_POST['icon_id'];

if($action == "new"){     
		$sql = "INSERT INTO tbl_menu_group 
								(  menu_group_th, menu_group_en, menu_path,menu_order, icon_id )
					VALUES ( '$menu_group_th',
								 ".chkNull($menu_group_en).", 
								 ".chkNull($menu_path).",
								 ".chkNull($menu_order).", 
								 ".chkNull($icon_id)."
								 );";
		
}else if($action == "edit"){ 
		$sql = "UPDATE tbl_menu_group 
								SET   
										menu_group_th = '$menu_group_th', 
										menu_group_en=".chkNull($menu_group_en).",  
										menu_path=".chkNull($menu_path).",  
										menu_order =".chkNull($menu_order).",  
										icon_id = ".chkNull($icon_id)." 
					WHERE mgroup_id = $mgroup_id ";

}else if($_GET['action'] == "delete"){
		$sql = "DELETE FROM tbl_menu_group WHERE mgroup_id = ".$_GET['mgroup_id'];
}
	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>