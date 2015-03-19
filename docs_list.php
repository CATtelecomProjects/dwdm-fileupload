<?php
#############################
# Section : Includes Files
require_once("./includes/config.inc.php");
?>

<!DOCTYPE HTML>
<html lang="th-th">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="HandheldFriendly" content="true" />
<meta name="apple-mobile-web-app-capable" content="YES" />
<title>
<?=SITE_NAME;?>
</title>
<link type="text/css" href="css/main.css" rel="stylesheet" />
<link type="text/css" href="css/<?=THEMES?>/jquery-ui-1.8.2.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/main_index.js"></script>
<link rel="shortcut icon" href="./images/favicon.ico" />
<style type="text/css">
#main {
	padding: 10px;
}
#tbl_content {
	-moz-border-radius-topright: 5px;
	-moz-border-radius-topright: 5px;
	border-top-right-radius: 5px;
	border-top-left-radius: 5px;
	border-radius: 5px;
	-moz-border-radius: 5px;
}
</style>
</head>
<body>
<?php
#############################
# Section : Includes Files

require_once("./includes/Class/DataTable.Class.php");
############################

// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = 'docs_list';
$tbl->title = 'Docments List';//title_menu('docs_upload');
//$tbl->menu = MENU_ACTION;
$tbl->order = 5;
$tbl->module = 'Uploads';
$tbl->page = 'docs_list';
$tbl->orderType = "desc";
//$tbl->openTable();

$db->debug =0;


$group_id = $_GET['group_id'];

// หาค่า Doc years
$sql_doc_years = "SELECT
							  DISTINCT(docs_years)
							FROM tbl_documents
							WHERE docs_cate_code IN(SELECT
													  a.docs_cate_code
													FROM tbl_docs_category a,
													  tbl_docs_auth b
													WHERE a.docs_cate_id = b.docs_cate_id
														AND b.group_id = $group_id
													GROUP BY a.docs_cate_code, a.docs_cate_name)
							ORDER BY docs_years DESC ";

$rs_doc_years = $db->GetAll($sql_doc_years);



// หาค่า Doc Group
$sql_doc_group = "SELECT
							  docs_cate_code,
							  docs_cate_name
							FROM tbl_docs_category a,
							  tbl_docs_auth b
							WHERE a.docs_cate_id = b.docs_cate_id
								AND b.group_id = $group_id
							ORDER BY docs_cate_name";
$rs_doc_group = $db->GetAll($sql_doc_group);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า docs_cate_code มา where
$get_docs_cate_code = $_GET['docs_cate_code'] ? $_GET['docs_cate_code'] : $rs_doc_group[0]['docs_cate_code'];

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า docs_years มา where

if(!isset($_GET['docs_years']) || $_GET['docs_years'] == "null"){
	$get_docs_years =  $rs_doc_years[0]['docs_years'];
}else{
	$get_docs_years = $_GET['docs_years'];
}

//$docs_years = $_GET['docs_years'] ? $_GET['docs_years'] : $rs_doc_years[0]['docs_years'];

//$get_docs_years = $docs_years == 'null' ? $rs_doc_years[0]['docs_years'] :  $_GET['docs_years'];


// List Document
$sql_list = "SELECT
			  a.*,
			  b.docs_cate_name
			FROM tbl_documents a,
			  tbl_docs_category b
			WHERE a.docs_cate_code = b.docs_cate_code
			AND a.docs_cate_code = '$get_docs_cate_code'
			AND a.docs_years = '$get_docs_years' 
			AND a.docs_publish = 'Y' 
			ORDER BY a.docs_updatetime DESC ";
$rs_list = $db->GetAll($sql_list);


?>
<div id="main">
  <?php
$tbl->openTable();
?>
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td width="54%" align="left" valign="middle"> Years :
        <select name="sel_docs_years" id="sel_docs_years" class="input">
          <?php					  
		  			// $docs_years = isset($_GET['docs_years']) ? $_GET['docs_years'] :  ;
					  genOptionSelect($rs_doc_years,'docs_years','docs_years',$get_docs_years);
		  ?>
        </select>
        Modules :
        <label>
          <select name="sel_docs_cate_code" id="sel_docs_cate_code" class="input">
            <?php					  
					  genOptionSelect($rs_doc_group,'docs_cate_code','docs_cate_name',$_GET['docs_cate_code']);
		  ?>
          </select>
        </label></td>
      <td width="46%" align="right" valign="top"><!--
      <div class='doAction'>
        <button> Upload File </button>
        <button>&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
        <button>Delete</button>
      </div>--></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
    <thead>
      <tr>
        <th width="4%"  class="header_height">No</th>
        <th width="21%">Documents name</th>
        <th width="32%">Descriptions</th>
        <th width="13%">Documents Owner</th>
        <th width="11%">Uploaded By</th>
        <th width="11%">Update time</th>
        <th width="8%"> Downloads</th>
      </tr>
    </thead>
    <tbody>
      <?php for($i=0;$i<count($rs_list);$i++){ 
	
		$docs_filename = $rs_list[$i]['docs_filename'];
		$docs_cate_code = $rs_list[$i]['docs_cate_code'];
		$docs_id = $rs_list[$i]['docs_id'];
		$docs_desc = $rs_list[$i]['docs_desc'];
		$docs_owner = $rs_list[$i]['docs_owner'];
		$docs_updatetime = $rs_list[$i]['docs_updatetime'];
		$docs_uploadby = $rs_list[$i]['docs_uploadby'];
		$docs_downloads = $rs_list[$i]['docs_downloads'];
		$docs_years = $rs_list[$i]['docs_years'];
		
		$filePath = "./".UPLOADS_DIR."/".$docs_cate_code."/".$docs_years."/".$docs_filename;
		
		//$filename = "./DOWNLOADS/".$docs_cate_code."/".iconv('TIS620' ,'UTF-8',$docs_filename);
		
		$arrPublish = array("Y" => array("icons" => "./images/on.gif",
														"title" => "เผยแพร่"),
									"N" => array("icons" => "./images/off.gif",
														"title" => "ไม่เผยแพร่"));					
		
		$publish_img = $arrPublish[$docs_publish]['icons'];
		$publish_title = $arrPublish[$docs_publish]['title'];
	?>
      <tr>
        <td align="center" valign="top"><?=($i+1);?></td>
        <td valign="top"><?=show_icon($docs_filename);?>
          <a href="<?=$filePath;?>" class="downloads" id="<?=$docs_id;?>" target="_blank">
          <?=$docs_filename;?>
          </a></td>
        <td valign="top"><?=$docs_desc;?></td>
        <td valign="top"><?=$docs_owner;?></td>
        <td valign="top"><?=$docs_uploadby;?></td>
        <td align="center" valign="top"><?=showdateTimeThai($docs_updatetime);?></td>
        <td align="center" valign="top"><?=$docs_downloads;?></td>
      </tr>
      <?php } // End For ?>
    </tbody>
  </table>
  <?php 
	$tbl->closeTable(); 
?>
<hr width="100%" style="border-style:solid 1px; border-color:#eee; opacity:.4" >
<div id="footer" style="text-align:right; width:99%" class="font-small">
  <?=SITE_NAME." ".COPYRIGHT?>
</div>
</div>


<input type="hidden" name="group_id" id="group_id" value="<?=$_GET['group_id']?>">
</body>
</html>
<?php
// Close Database
$db->Close();
?>