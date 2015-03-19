<?php
@header('Content-Type: text/html; charset=utf-8');
#################################
#Configuration Section
#################################
include_once("dbConnect.php");
include_once("functions.php");


$sql_config = "SELECT * FROM tbl_configs";
$rs_config = $db->GetRow($sql_config);

/* Site Name*/
define("SITE_NAME",$rs_config['website_name']);

/* Language*/
define("LANGUAGE",$rs_config['website_language']);

/* Themes : */
$arr_theme = array("cupertino-theme" , "flick-theme" , "smoothness-theme" , "ui.lightness-theme");
define("THEMES",$arr_theme[$rs_config['website_theme']]);

/* Upload Path*/
define("UPLOADS_DIR","uploads_dir");

/* Copy Right*/
define("COPYRIGHT"," &copy;2014 CAT TELECOM");


/* i-cons */
define("ICON_PATH","./images/menu_actions/");
$arr_icon = array("home"=>ICON_PATH."icon-home.png",
				  			"config"=>ICON_PATH."icon-config.png",
							"keyin"=>ICON_PATH."icon-keyin.gif",
							"profile"=>ICON_PATH."icon-profile.gif",
							"report"=>ICON_PATH."icon-report.png",
							"logout"=>ICON_PATH."icon-logout.png",
							"manual"=>ICON_PATH."icon-manual.gif",
							"company"=>ICON_PATH."icon-company.png",
							"db"=>ICON_PATH."icon-db.png",
							"menu"=>ICON_PATH."icon-menu.gif");



/* Menu Action*/
define("MENU_ACTION","<div class='doAction'> <button>เพิ่ม</button> <button>แก้ไข</button> <button>&nbsp;ลบ&nbsp;</button></div>");
define("MENU_SAVE_ONLY","<div class='doAction'> <button>บันทึก</button></div>");
define("MENU_ADD","<div class='doAction'> <button>เพิ่ม</button></div>");
define("MENU_TOOLS","<div class='doAction'><button>แก้ไข</button> <button>ลบ</button></div>");
define("MENU_SUBMIT","<input type='submit' name='btnSave' id='btnSave' value='บันทึก'  /> <input type='reset' name='btnReset' id='btnReset' value='ล้างค่า' /> <span id='ajaxloading'>Loading..</span><span id='divMsgDiag'></span>");


?>