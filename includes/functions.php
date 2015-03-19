<?php
###########################################
# Global Setiting
$bgmouse_over = "#FFE6CC";


###########################################
# Section : Data Format
$year = (date('Y')+543);

$ThaiMonth=array("01"=>"ม.ค.","02"=>"ก.พ.","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");	

$ArrYearListBox = array( ($year)=>$year,($year+1)=>($year+1) , ($year+2)=>($year+2));

$iconPath = "./images/icons_file/";

$arrIcons = array("pdf"=>"pdf.gif" ,
						  "doc"=>"word.gif",
						  "docx"=>"word.gif",
						  "xls"=>"xlsx.gif",
						  "xlsx"=>"xlsx.gif",
						  "zip"=>"zip.gif",
						  "rar"=>"zip.gif",
						  "txt"=>"text.gif",
						  "htm"=>"html.gif",
						  "html"=>"html.gif",
						  "html"=>"html.gif",
						  "ppt"=>"ppt.gif",
						   "pptx"=>"ppt.gif",
						  
						  "jpg"=>"picture.gif",
						  "jpeg"=>"picture.gif",
						  "gif"=>"picture.gif",
						  "bmp"=>"picture.gif",
						   "png"=>"picture.gif"
					);

###########################################
//แสดง Title Menu
function title_menu($menu_file){
global $db;
	$sql_title = "SELECT a.menu_name_th , a.menu_name_en ,  b.menu_group_en ,b.menu_group_th
						FROM tbl_menu a ,  tbl_menu_group b
						WHERE a.mgroup_id = b.mgroup_id
						AND a.menu_file  = '$menu_file' ";
	$rs_title = $db->GetRow($sql_title);
	$title = $rs_title['menu_group_'.LANGUAGE]. " &gt; ".$rs_title['menu_name_'.LANGUAGE];
	return $title;	

}

###########################################
//Insert NULL VALUE
function chkNull($var){
	if(trim($var) == ""){
		return "NULL";
	}else{
		return "'".$var."'";	
	}
}


/**********************************************/

//##################  MySQL Format ######################
# Display date format  2010-12-31 -> 31 ธันวาคม 2553
function showdateThai($date){
global  $ThaiMonth;
	if($date!=""){		
		$d = substr($date , 8 , 2);
		$m = substr($date , 5, 2 );
		$y = substr($date ,0,4)+543;	
		return  (int) $d." ".$ThaiMonth[$m]." ".$y;
	}else{
		return "";	
	}	
}
# Display date format  14-10-2010 -> 2010-10-14
function date2db($date){
global  $ThaiMonthl;
	$split = explode("-",$date);
		$d = $split[0];
		$m = $split[1];
		$y = $split[2];
		return  $y."-".$m."-".$d;

}

# Display date format  2010-12-31 12:32:12 -> 31 ธันวาคม 2553 12:32:12
function showdateTimeThai($datetime){
global  $ThaiMonth;
	if($datetime!=""){		
		$splitDT = explode(" ",$datetime);
		$splitD = explode("-",$splitDT[0]);
		$d = $splitD[2];
		$m = $splitD[1];
		$y = ($splitD[0]+543);	
		return  $y."-".$m."-".$d." ".$splitDT[1];
	}else{
		return "";	
	}	
}




// ฟังก์ชันตรวจสอบว่าเป็นกลุ่ม User ไหน
function chk_group($gid){
global $db;
 $sql = "SELECT group_id
			FROM tbl_user_auth
			WHERE user_id = $_SESSION[sess_user_id]
				   AND group_id IN( $gid )";	
$rs = $db->GetAll($sql);	
if(count($rs)>0){
	return true;
}else{
	return false;	
}

}// End Function


// Get File Extension
function file_extension($file){
		$temp = explode(".", $file);
		return strtolower(end($temp));
}

function show_icon($file){
		global $arrIcons , $iconPath;
		$ext = file_extension($file);
		$img = $arrIcons[$ext] == "" ? "text.gif" : $arrIcons[$ext] ;
		return 	"<img src='$iconPath/$img' align='absmiddle'> ";
}


/***********************************************/



###########################################
# Section : Page Control
###########################################
//Set Page goto
function pageBack($backStep, $err_msg) 
{
	echo "<script language=\"javascript\">";
	if($err_msg != "") {
		echo "	alert('$err_msg');";
	}
	if($backStep == -1){
		echo "	history.back($backStep);";
	}else if($backStep == "x"){
		echo "window.close();";
	}else if($backStep != ""){
		echo "window.location = '".$backStep."';";
	}
	echo "</script>";
}

###########################################
# Section : Display Data
###########################################

# Set array to listbox number per page
$arrPerPage = array(5=>5,10=>10,15=>15);


# create listmenu/Combobox function
function listComboBox($arrData , $selectedVal=""){
		foreach($arrData as   $key =>$val ){
		$sel=$selectedVal == $key?"selected":"";
		echo "<option value='$key' $sel>$val</option>\n";	
	}
}

 //######################################################################
function genOptionSelect($arrdata,$key,$value,$select="",$valueOption=""){
		  for($i=0;$i<count($arrdata);$i++){ 
				if($valueOption!=""){ $paramOption = "|".$arrdata[$i][$valueOption];}
					 $sel=$select == $arrdata[$i][$key]?"selected":""; 					  			
						echo "<option value=\"".$arrdata[$i][$key].$paramOption."\"  $sel>".$arrdata[$i][$value]."</option>\n";				   
		   }

}

# Query data from DB table more 1 Record
function getTableData($sql){
global $db;	
$result = $db->GetAll($sql);
	return $result;
}

# Query data from DB table more 1 Record
function getRowTable($sql){
global $db;	
$result = $db->GetRow($sql);
	return $result;
}


# Query data from DB table more 1 Filed
function getFieldValue($sql,$filed){
global $db;	
$result = $db->GetRow($sql);
	echo $result[$filed];
}



/***************************************/


###########################################
# Section : Debug Mode
###########################################
 ###########################################
//Print POST Data
function show_post(){
		print "<pre>";
		print_r($_POST);
		print "</pre>";
}

 ###########################################
//Print GET Data
function show_get(){
		print "<pre>";
		print_r($_GET);
		print "</pre>";
}

 ###########################################
//Print session Data
function show_session(){
		print "<pre>";
		print_r($_SESSION);
		print "</pre>";
}

 ###########################################
//Print Array Data
function show_array($arrData){
		print "<pre>";
		print_r($arrData);
		print "</pre>";
}
############################################

?>