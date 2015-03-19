<?php
include('../../includes/config.inc.php');

//menu_id , menu_name_th, menu_name_th,menu_file,mgroup_id,icon_id
$action = $_POST['doAction'];
$menu_id = $_POST['menu_id'];
$menu_name_th = $_POST['menu_name_th'];
$menu_name_en = $_POST['menu_name_en'];
$menu_file = $_POST['menu_file'];
$mgroup_id = $_POST['mgroup_id'];
$menu_order = $_POST['menu_order'];
$icon_id = $_POST['icon_id'];

if($action == "new"){     
		$sql = "INSERT INTO tbl_menu 
								(  menu_name_th, menu_name_en,menu_file,mgroup_id,menu_order,icon_id )
					VALUES ( '$menu_name_th',
								 ".chkNull($menu_name_en).", 
								 ".chkNull($menu_file).",
								 ".chkNull($mgroup_id).", 
								 ".chkNull($menu_order).", 
								 ".chkNull($icon_id)."
								 );";
		
}else if($action == "edit"){ 
		 $sql = "UPDATE tbl_menu 
								SET   
										menu_name_th = '$menu_name_th', 
										menu_name_en=".chkNull($menu_name_en).",  
										menu_file=".chkNull($menu_file).",  
										mgroup_id = ".chkNull($mgroup_id).",  
										menu_order = ".chkNull($menu_order).",
										icon_id = ".chkNull($icon_id)." 
					WHERE menu_id = $menu_id ";

}else if($_GET['action'] == "delete"){
	$sql = "DELETE FROM tbl_menu WHERE menu_id = ".$_GET['menu_id'];
}
	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>